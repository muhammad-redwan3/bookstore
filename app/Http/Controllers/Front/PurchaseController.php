<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use App\Models\Shopping;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PurchaseController  extends Controller
{
    public array $data;
    public function __construct()
    {
        $this->middleware('auth')->except('allProduct');
        $this->middleware('auth:admin')->only('allProduct');
    }

    public function creditCheckout()
    {
        $this->data['intent'] = auth()->user()->createSetupIntent();
        $this->data['total'] = $this->getBook();;
        return view('credit.checkout',$this->data);
    }

    private function getUser()
    {
       return User::findOrFail(auth()->id());
    }

    private function getBook()
    {
        $total =0;
        $books = $this->getUser()->booksInCart;
        foreach ($books as $book)
        {
            $total+= $book->price * $book->pivot->number_of_copies;
        }

        return $total;
    }

    public function purchase(Request $request)
    {
        $user = $request->user();
        $paymentMethod = $request->input('payment_method');

        try {
            $user->createOrGetStripeCustomer();
            $user->updateDefaultPaymentMethod($paymentMethod);
            $user->charge($this->getBook()*100,$paymentMethod);
        }catch (\Exception $exception)
        {
            return back()->with('حصل خطأ أثناء عملية شراء المنتج , الرجاء التأكد من صحة المعلومات',$exception->getMessage());
        }

        $books = $this->getUser()->booksInCart;
        $this->sendOrderConfirmationMail($books,auth()->user());
        foreach ($books as $book)
        {
            $bookPrice =$book->price;
            $purchaseTime =Carbon::now();
            $user->booksInCart()->updateExistingPivot($book->id,[
                'bought' =>true,
                'price' => $bookPrice,
                'created_at' =>$purchaseTime
            ]);
            $book->save();
        }
        return  redirect('/cart')->with('message','تم شراء الكتب بنجاح');
    }

    protected function sendOrderConfirmationMail($order ,$user)
    {
        Mail::to($user->email)->send(new OrderMail($order,$user));
    }

    public function myProduct()
    {
        $this->data['myBooks'] = $this->getUser()->purchedProdcut;

        return view('books.myProduct',$this->data);
    }

    public function allProduct()
    {
        $this->data['allBooks']  = Shopping::with(['user','book'])->where('bought',true)->get();

        return view('admin.books.allProduct',$this->data);
    }
}
