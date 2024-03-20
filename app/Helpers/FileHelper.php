<?php
/**
 * Created by PhpStorm.
 * User: GameBoY
 * Date: 14-Jul-21
 * Time: 12:26 AM
 */

namespace App\Helpers;


use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileHelper
{
    /*Stores file in storage and returns viewable public link*/
    function storeFileOnLocal(UploadedFile $file)
    {
        return asset(Storage::url(Storage::putFile('public', $file)));
    }


    function storeFileOnS3(UploadedFile $file, $path)
    {

        $file = Storage::disk('s3')->putFile($path, $file, 'public');

        return Storage::disk('s3')->url($file);

    }

    function storeBase64FileOnS3($base64Data, $path)
    {
        $image_64 = $base64Data; //your base64 encoded data

        $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf

        $replace = substr($image_64, 0, strpos($image_64, ',') + 1);

// find substring fro replace here eg: data:image/png;base64,

        $image = str_replace($replace, '', $image_64);

        $image = str_replace(' ', '+', $image);

        $imageName = Str::uuid() . '.' . $extension;


        Storage::disk('s3')->put($path . '/' . $imageName, base64_decode($image), 'public'); // old : $file
        $image_url = Storage::disk('s3')->url($path . '/' . $imageName);
        return $image_url;
    }

}