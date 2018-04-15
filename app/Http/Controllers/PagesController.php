<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index() {
        return view('welcome');
    }

    public function pmo() {
        return view('pages.pmo')->with('page', 'pmo');
    }

    public function admin() {
        return view('pages.admin')->with('page', 'admin');
    }

    public function addUser() {
        return view('pages.admin.adduser')->with('page', 'addUser');
    }
}
