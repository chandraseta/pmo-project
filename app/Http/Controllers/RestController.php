<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use app\Http\Requests;

class RestController extends Controller
{
    public function index(){
        echo 'index';
    }
    public function create(){
        echo 'create';
    }
    public function store(Request $request){
        echo 'store '.$request;
    }
    public function show($id){
        echo 'show '.$id;
    }
    public function edit($id){
        echo 'edit '.$id;
    }
    public function update(Request $request, $id){
        echo 'update '.id;
    }
    public function destroy($id){
        echo 'destroy '.$id;
    }
}
