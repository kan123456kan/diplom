<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request) {
        $product = DB::table('products')->where('id', $request->id)->first();

        // Проверяем, есть ли товар на складе
        if ($product && $product->qty > 0) {
            $itemInCart = DB::table('cart')->where('uid', $request->user()->id)->where('pid', $request->id)->first();

            if (is_null($itemInCart)) {
                DB::table('cart')->insert([
                    'uid' => $request->user()->id,
                    'pid' => $request->id,
                    'qty' => 1
                ]);
            } elseif ($itemInCart->qty < $product->qty) {
                DB::table('cart')->where('uid', $request->user()->id)->where('pid', $request->id)
                    ->update(['qty' => $itemInCart->qty + 1]);
            } else {
                return response()->json(['error' => 'Not enough product in stock.'], 400);
            }
        } else {
            return response()->json(['error' => 'Product not available.'], 400);
        }
    }

    public function index(Request $request){
        $cartTable = DB::table('cart')->where('uid', $request->user()->id)->get();
        $goodCart = [];
        $total=0;

        foreach ($cartTable as $cartItem) {
            $product = DB::table('products')->select('title', 'price', 'qty', 'img', )->where('id', $cartItem->pid)->first();
            $total += $product->price * $cartItem->qty;
            array_push(
                $goodCart,
                (object)[
                    'id' => $cartItem->id,
                    'title' => $product->title,
                    'price' => $product->price,
                    'qty' => $cartItem->qty,
                    'limit' => $product->qty,
                    'img' => $product->img,
                ]
            );
        }
        return view('cart', ['cart' =>$goodCart, 'total' => $total]);
    }

    public function changeQty(Request $request) {
        $cartItem = DB::table('cart')->where('uid', $request->user()->id)->where('id', $request->id)->first();
        $product = DB::table('products')->where('id', $cartItem->pid)->first();

        if ($request->param == "incr" && $product->qty > $cartItem->qty) {
            DB::table('cart')->where('uid', $request->user()->id)->where('id', $request->id)
                ->update(['qty' => $cartItem->qty + 1]);
        } elseif ($request->param == "decr" && $cartItem->qty > 1) {
            DB::table('cart')->where('uid', $request->user()->id)->where('id', $request->id)
                ->update(['qty' => $cartItem->qty - 1]);
        } elseif ($request->param == "decr" && $cartItem->qty == 1) {
            DB::table('cart')->where('uid', $request->user()->id)->where('id', $request->id)->delete();
        } else {
            return response()->json(['error' => 'Cannot increase quantity beyond stock availability.'], 400);
        }
    }
}

