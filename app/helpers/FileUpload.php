<?php

namespace App\helpers;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class FileUpload
{
    public static function upload($path, $file)
    {
        $folder = "uploads/";
        if(!is_dir(public_path($folder.$path))) mkdir(public_path($folder.$path), 0777);
        return $file = Storage::putFile($path, new File($file), 'public');
    }
}
