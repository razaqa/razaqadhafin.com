<?php

namespace App\Http\Controllers;

use App\Http\Controllers\WebHelper;
use Illuminate\Http\Request;

class CKEditorController extends Controller
{
    public function upload(Request $request)
    {

        if ($request->hasFile('upload')) {
            $image = WebHelper::saveImageToPublic($request->file('upload'), '/img/post');
    
            $url = asset($image);         
            $msg = 'Image uploaded successfully';
            $ckeditor = $request->input('CKEditorFuncNum');
    
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($ckeditor, '$url', '$msg')</script>";
    
            @header('Content-type: text/html; charset=utf-8'); 
            return $response;
        }

    }
}
