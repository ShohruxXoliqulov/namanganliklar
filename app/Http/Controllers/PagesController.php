<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function welcome(){
        return view('welcome');
    }

    public function article(){
        return view('pages.article');
    }

    public function contact(){
        return view('pages.contact');
    }

    public function list(){
        return view('pages.list');
    }
}
