<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function downloadepk($file_name){
        $file_path=public_path('firmware/'.$file_name);
        return response()->download($file_path);
    }
    public function downloadipk($file_name){
        $file_path=public_path('ipk/'.$file_name);
        return response()->download($file_path);
    }
    public function downloadimg($file_name){
    	$file_path=public_path('files/'.$file_name);
    	return response()->download($file_path);
    }
}
