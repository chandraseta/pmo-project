<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;

class UriController extends Controller
{
    public function index(Request $req){
        echo '<br>Path method: '.$req->path();
        
        echo '<br>Pattern: '.$req->is('foo/*');
        
        echo '<br>URL: '.$req->url();
    }
}
