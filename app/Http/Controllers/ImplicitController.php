<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use app\Http\Requests;

class ImplicitController extends Controller
{
//    public function getIndex(){
//        echo 'index';
//    }
//    
//    public function getShow($id){
//        echo 'show '.$id;
//    }
//    
//    public function getAdminProfile(){
//        echo 'admin profile section';
//    }
//    
//    public function postProfile(){
//        echo 'profile';
//    }
    
//    private $claz;
//    
//    public function __construct(\Classes $cls){
//        $this->claz = $cls;
//    }
    public function index(\Classes $cls){
        dd($cls);
    }
}