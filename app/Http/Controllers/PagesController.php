<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function post_message(Request $request){
        DB::table('applies')->insert([
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'message' => $request->message,
        ]);
        return back();
    }
}
