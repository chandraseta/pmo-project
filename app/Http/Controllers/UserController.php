<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('Second');
    }
    
    public function showPath(Request $request){
        echo '<br>URI : '.$request->path();
        echo '<br>URL :'.$request->url();
        echo '<br>Method :'.$request->method();
    }
}