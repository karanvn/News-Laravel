<?php

namespace App\Libraries;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Image;

class Func
{
    public function storageFile($html, $rootPath, $file_name){
        if(!empty($file_name)){
            $client = Storage::createLocalDriver(['root' => $rootPath]);
            $client->put($file_name, $html);
        }
    }
}
