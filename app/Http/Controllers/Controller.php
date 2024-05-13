<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;

abstract class Controller
{
    //saveImage

    public function saveImage($image , $path = 'public')
    {
        if(!$image)
        {
          return null;
        }

        $filename = time() . '.png';

        //save image 
       Storage::disk($path)->put($filename ,base64_decode($image));
        return URL::to('/').'/Storage/'.$path.'/'.$filename;
    }
}
