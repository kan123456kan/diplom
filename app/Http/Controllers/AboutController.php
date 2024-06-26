<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AboutController extends Controller
{
    public function index(){
        $products = DB::table('products')->select('id', 'img', 'title')->get()->sortByDesc('created_at');
        return view('welcome', ['products' => $products]);
    }


}
