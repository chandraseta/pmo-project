<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;

class Registration extends Controller
{
    public function postRegistration(Request $request){
        $name = $request->input('name');
        
        $uname = $request->input('username');
        
        $pass = $request->input('password');
        
        echo 'Name: '.$name;
        echo '<br>Uname: '.$uname;
        echo '<br>Pass: '.$pass;
    }
}

?>