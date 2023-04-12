<?php

namespace App\Http\Controllers;

class WebHelper
{

    public static function saveImageToPublic($file, $dir)
    {
        $imageName = time() . rand() . '.' . $file->getClientOriginalExtension();
        $destinationPath = public_path($dir);
        $file->move($destinationPath, $imageName);
        return $dir . '/' . $imageName;
    }
}
