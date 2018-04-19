<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\APIBaseController as APIBaseController;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Pegawai;
use App\PMO;
use App\Admin;

class PagesController extends APIBaseController
{
    public function index() {
        if(!$this->authenticate(5)){return $this->sendError('You are not authenticated.');}
        return view('welcome');
    }

    public function landing() {
        if(!$this->authenticate(5)){return $this->sendError('You are not authenticated.');}
        return view('pages');
    }

    public function pmo() {
        if(!$this->authenticate(2)){return $this->sendError('You are not authenticated.');}
        return view('pages.pmo')->with('page', 'pmo');
    }

    public function admin() {
        if(!$this->authenticate(3)){return $this->sendError('You are not authenticated.');}
        return view('pages.admin')->with('page', 'admin');
    }

    public function addUser() {
        if(!$this->authenticate(3)){return $this->sendError('You are not authenticated.');}
        return view('pages.admin.adduser')->with('page', 'addUser');
    }

    private function authenticate($role){
        if (Auth::check()) {
            $session_id = Auth::user()->id;
        }else{
            return false;
        }

        $auth = NULL;
        switch ($role) {
            case 1:
                $auth = Pegawai::find($session_id);
                break;
            
            case 2:
                $auth = PMO::find($session_id);
                break;

            case 3:
                $auth = Admin::find($session_id);
                break;

            case 4:
                $auth = PMO::find($session_id);
                if (is_null($auth)) {
                    $auth = Pegawai::find($session_id);
                }
                break;
            case 5:
                $auth = User::find($session_id);
                break;
        }

        if (is_null($auth)) {
            return false;
        }

        return true;
    }
}
