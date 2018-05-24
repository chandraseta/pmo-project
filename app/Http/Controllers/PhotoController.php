<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\APIBaseController as APIBaseController;

class PhotoController extends APIBaseController
{
    public function profile($filename){
    	$path = public_path() . '/profile/' . $filename;
    	if(!file_exists($path)){
    		return Response::download(public_path() . '/profile/' . 'default_profile.jpg');
    	}
    	return Response::download($path);
    }

    public function sertifikat($filename){
    	$path = public_path() . '/sertifikat/' . $filename;
    	if(!file_exists($path)){
    		return Response::download(public_path() . '/sertifikat/' . 'default_sertifikat.png');
    	}
    	return Response::download($path);
    }
}
