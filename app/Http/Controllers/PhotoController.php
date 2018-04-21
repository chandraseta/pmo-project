<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class PhotoController extends Controller
{
    public function profile($filename){
    	$path = public_path() . '/profile/' . $filename;
    	return Response::download($path);
    }

    public function sertifikat($filename){
    	$path = public_path() . '/sertifikat/' . $filename;
    	return Response::download($path);
    }
}
