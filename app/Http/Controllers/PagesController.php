<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function welcome(){
        return view('welcome');
    }

    public function get_article(){
        return view('pages.article');
    }

    public function get_contact(){
        return view('pages.contact');
    }

    public function get_list(){
        return view('pages.list');
    }
}
