<?php

namespace App\Http\Controllers;

use App\Helpers\FileHelper;
use Illuminate\Http\Request;
use App\Picture;

class CropImageController extends Controller
{

    public function index()
    {
        return view('crop-image-upload');
    }


    public function uploadCropImage(Request $request)
    {

        $this->validate($request, [
            'image' => 'required_without:image_base64|image',
            'image_base64' => 'required_without:image'
        ]);


//        $folderPath = public_path('upload/');

//        $image_parts = explode(";base64,", $request->image);
//        $image_type_aux = explode("image/", $image_parts[0]);
//        $image_type = $image_type_aux[1];
//        $image_base64 = base64_decode($image_parts[1]);

//        $imageName = uniqid() . '.png';

//        $imageFullPath = $folderPath . $imageName;

//        file_put_contents($imageFullPath, $image_base64);

//        $saveFile = new Picture;
//        $saveFile->name = $imageName;
//        $saveFile->save();

        if ($request->image_base64)
            $filename = (new FileHelper())->storeBase64FileOnS3($request->image_base64, 'upload-image');
        else
            $filename = (new FileHelper())->storeFileOnS3($request->file('image'), 'profile-pics');


        return response()->json(['success' => 'Crop Image Uploaded Successfully', 'file_name' => $filename]);
    }
}
