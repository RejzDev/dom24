<?php

namespace App\Helper;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageSaver
{

    public function upl($file, $dir){
        $path = $file->store($dir, 'public');
        return $path;
    }

    public function remove($dir){
        Storage::disk('public')->delete($dir);

    }


}
