<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Repositories\Books\BookRepository;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private $book;
    public $data = [];

    public function __construct(BookRepository $book)
    {
        $this->book = $book;

    }

    public function addToCart(Request $request)
    {
        if ($this->book->containsInCart($request)) {
            $newQuantity =$request->quantity + $this->book->quantity($request->id);
            if ($newQuantity > $this->book->stock($request)){
                session()->flash('warning_message',  'لم تتم إضافة الكتاب، لقد تجاوزت عدد النسخ الموجودة لدينا، أقصى عدد موجود بإمكانك حجزه من هذا الكتاب هو ' . ($book->number_of_copies - auth()->user()->booksInCart()->where('book_id', $book->id)->first()->pivot->number_of_copies) . ' كتاب');
                return redirect()->back();
            }else{
                $this->book->updatePivot($request->id,$newQuantity);
            }
        }else{
            $this->book->storeQuantity($request);
        }
         return response()->json(['num_of_product' => $this->book->countInCart()]);
    }

    public function viewCart()
    {
        $this->data['items'] = $this->book->viewCart();
        return view('cart',$this->data);
    }

    public function removeOne($id)
    {
        $oldQuantity = $this->book->quantity($id);
        $oldQuantity > 1 ?   $this->book->updatePivot($id,--$oldQuantity) : $this->book->removeBook($id);

        return redirect()->back()->with('success','تم حذف نسخة من العربة');
    }
    public function removeAll($id) {

        $this->book->removeBook($id);

        return redirect()->back()->with('success','تم حذف جميع النسخ من العربة');
    }
}
