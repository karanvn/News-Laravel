<?php

namespace App\Libraries;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Image;

class Upload
{
    public function doUpload($path, $file, $name = "", $resize = false, $size = false) {
        $extension = $file->getClientOriginalExtension();
        $time = time();
        $tmp_name  = $file->getClientOriginalName();
        $name      = pathinfo($tmp_name, PATHINFO_FILENAME);
        $file_name = Str::slug($name, '-') . '-' .$time. '.' . $extension;
        $image = Image::make($file->getRealPath());
        $height = $image->height();
        $width = $image->width();
        if($resize){
            $image->resize($resize[0], $resize[1], function($constraint){
                $constraint->aspectRatio();
            });
        }
        $destinationPath = storage_path('app/public');
        $dictory = $destinationPath . '/' . $path . '/' ;
        File::isDirectory($dictory) or File::makeDirectory($dictory, 0777, true, true);
        $image->save($dictory.$file_name);
        return $size ? [
            'name' => $file_name,
            'width' => $width,
            'height' => $height
        ] : $file_name;
    }
    public function doUploadLogo($path, $file, $name = "", $resize = false, $size = false) {
        $extension = $file->getClientOriginalExtension();
        $time = time();
        $tmp_name  = $file->getClientOriginalName();
        $file_name = 'logo.png';
        $image = Image::make($file->getRealPath());
        $height = $image->height();
        $width = $image->width();
        if($resize){
            $image->resize($resize[0], $resize[1], function($constraint){
                $constraint->aspectRatio();
            });
        }
        $destinationPath = '';
        $dictory = 'Logo/' ;
        File::isDirectory($dictory) or File::makeDirectory($dictory, 0777, true, true);
        $image->save($dictory.$file_name);
        return $size ? [
            'name' => $file_name,
            'width' => $width,
            'height' => $height
        ] : $file_name;
    }
    public function doUploadmd5($path, $file, $namemd5 = "", $resize = false, $size = false) {
        $extension = $file->getClientOriginalExtension();
        $time = time();
        $tmp_name = $file->getClientOriginalName();
        $name = pathinfo($tmp_name, PATHINFO_FILENAME);
        $file_name = Str::slug($name, '-') . '-' .$namemd5.'.'. $extension;
        $image = Image::make($file->getRealPath());
        $height = $image->height();
        $width = $image->width();
        if($resize){
            $image->resize($resize[0], $resize[1], function($constraint){
                $constraint->aspectRatio();
            });
        }
        $destinationPath = storage_path('app/public');
        $dictory = $destinationPath . '/' . $path . '/' ;
        File::isDirectory($dictory) or File::makeDirectory($dictory, 0777, true, true);
        $image->save($dictory.$file_name);
        return $size ? [
            'name' => $file_name,
            'width' => $width,
            'height' => $height
        ] : $file_name;
    }


    public function doDirectory($path){
        $destinationPath = storage_path('app/public');
        $dictory = $destinationPath . '/' . $path . '/' ;
        File::isDirectory($dictory) or File::makeDirectory($dictory, 0777, true, true);
    }
}
