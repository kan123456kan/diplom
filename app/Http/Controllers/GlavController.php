<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GlavController extends Controller
{
    public function index()
    {
        $products = DB::table('products')->select('id', 'img', 'title','price', 'rating', 'country')->get()->sortByDesc('created_at');
        return view('glav', ['products' => $products]);
    }
}
