<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait ImageUploadTrait
{
    protected $path = "public/images/";

    public function StoreImage($img)
    {
        $img_name = $this->ImageName($img);
        $img->storeAs($this->path, $img_name);
        return $img_name;
    }

    public function ImageName($image)
    {
        return time().'-'.$image->getClientOriginalName();
    }

    public function deleteImage($img)
    {
       return   Storage::delete($img);
    }

}
