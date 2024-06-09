<?php

namespace App\Http\Controllers;

use App\Mail\OrderConfirmation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Controllers\Cart;
use Exception;
use Illuminate\Support\Facades\Mail;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function index(Request $request){
        $cartTable = DB::table('cart')->where('uid', $request->user()->id)->get();
        $goodCart = [];
        $total = 0;
        foreach ($cartTable as $cartItem){
            $product = DB::table('products')->select('title', 'price', 'qty')->where('id', $cartItem->pid)->first();
            $total += $cartItem->qty * $product->price;
            array_push(
                $goodCart,
                (object)[
                    'id'=>$cartItem->id,
                    'title'=>$product->title,
                    'price'=>$product->price,
                    'qty'=>$cartItem->qty,
                    'limit'=>$product->qty,
                ]
                );
        }
        return view('createOrder', ['cart' =>$goodCart, 'total' => $total]);
    }

    public function createOrder(Request $request){
        $user = $request->user();
        $orderTable = DB::table('orders');
        $userCartTable = DB::table('cart')->where('uid', $user->id)->get();

        $orderNumber = Str::random(8);
        $checkOrderNumber = $orderTable->where('number', $orderNumber)->exists();
        $orderNumber = $checkOrderNumber ? Str::random(8) : $orderNumber;

        DB::beginTransaction();
        try {
            foreach ($userCartTable as $cartItem){
                $product = DB::table('products')->where('id', $cartItem->pid)->first();
                if($product->qty >= $cartItem->qty) {
                    DB::table('products')->where('id', $cartItem->pid)
                        ->update(['qty' => $product->qty - $cartItem->qty]);

                    $orderTable->insert([
                        'uid' => $cartItem->uid,
                        'pid' => $cartItem->pid,
                        'qty' => $cartItem->qty,
                        'number' => $orderNumber
                    ]);
                } else {
                    throw new Exception("Not enough product in stock for product ID {$cartItem->pid}");
                }
            }
            DB::table('cart')->where('uid', $user->id)->delete();
            DB::commit();
            return response()->json(['message'=>'good']);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['message'=>'err', 'error' => $e->getMessage()]);
        }
    }

    public function getOrders(Request $request){
        $goodOrders = [];
        $filter = $request->query('filter');
        if ($filter == 'new'){
            $ordersTable = DB::table('orders')->where('status', 'Новый');
        }elseif($filter == 'confirmed'){
            $ordersTable = DB::table('orders')->where('status', 'Подтвержден');
        }elseif($filter == 'canceled'){
            $ordersTable = DB::table('orders')->where('status', 'Отменен');
        }else {
            $ordersTable = DB::table('orders');
        }
        $ordersTable = $ordersTable->get()->groupBy(['number']);
        foreach($ordersTable as $order){
            $openedOrder = $order->all();
            $userName = DB::table('users')->where('id', $openedOrder[0]->uid)->select('name', 'surname', 'patronymic')->first();
            $date = $openedOrder[0]->created_at;
            $orderNumber = $openedOrder[0]->number;
            $orderStatus = $openedOrder[0]->status;
            $totalPrice=0;
            $totalQty = 0;
            $products = [];

            foreach ($openedOrder as $orderItem){

                $product = DB::table('products')->where('id', $orderItem->pid)->first();
                $totalPrice += $product->price * $orderItem->qty;
                $totalQty += $orderItem->qty;

                array_push(
                    $products,
                    (object)[
                        'title' => $product ->title,
                        'price' => $product ->price,
                        'qty' => $orderItem ->qty,
                    ]
                    );
            }
            array_push(
                $goodOrders,
                (object)[
                    'name' => $userName->surname . ' ' . $userName->name . ' ' . $userName->patronymic,
                    'number' => $orderNumber,
                    'products' => $products,
                    'date' => $date,
                    'totalPrice' => $totalPrice,
                    'totalQty' => $totalQty,
                    'status' => $orderStatus,
                ]
                );
        }
        return view('admin.orders', ['orders' => $goodOrders]);
    }

    public function editOrderStatus(Request $request){
        $action = $request->action;
        $orderNumber = $request->number;

        $orderItems = DB::table('orders')->where('number', $orderNumber)->get();

        if ($action == 'confirm') {
            DB::beginTransaction();
            try {
                foreach ($orderItems as $item) {
                    $product = DB::table('products')->where('id', $item->pid)->first();

                    if ($product->qty >= $item->qty) {
                        DB::table('products')->where('id', $item->pid)->decrement('qty', $item->qty);
                    } else {
                        throw new Exception("Not enough product in stock for product ID {$item->pid}");
                    }
                }

                DB::table('orders')->where('number', $orderNumber)->update(['status' => 'Подтвержден']);

                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                return abort(500);
            }
        } elseif ($action == 'cancel') {
            DB::table('orders')->where('number', $orderNumber)->update(['status' => 'Отменен']);
        } else {
            return abort(404);
        }

        return redirect()->route('admin.orders');
    }


    public function deleteOrder(Request $request){
        $order = DB::table('orders')->where('uid', $request->user()->id)->where('number', $request->number)->first();

        if($order && $order->status == 'Новый'){
            DB::beginTransaction();
            try {
                $orderItems = DB::table('orders')->where('number', $order->number)->get();

                foreach ($orderItems as $item) {
                    $product = DB::table('products')->where('id', $item->pid)->first();
                    DB::table('products')->where('id', $item->pid)->update(['qty' => $product->qty + $item->qty]);
                }

                DB::table('orders')->where('uid', $request->user()->id)->where('number', $request->number)->delete();

                DB::commit();
                return redirect()->route('user');
            } catch (Exception $e) {
                DB::rollBack();
                return abort(500);
            }
        } else {
            return abort(404);
        }
    }
    public function cancelOrder(Request $request, $orderNumber) {
        $order = DB::table('orders')->where('number', $orderNumber)->first();

        if ($order && ($order->status == 'Новый' || $order->status == 'Подтвержден')) {
            DB::beginTransaction();
            try {
                $orderItems = DB::table('orders')->where('number', $order->number)->get();
                foreach ($orderItems as $item) {
                    $product = DB::table('products')->where('id', $item->pid)->first();
                    if ($product && $item->qty > 0) {
                        DB::table('products')->where('id', $item->pid)->update(['qty' => $product->qty + $item->qty]);
                    }
                }

                DB::table('orders')->where('number', $orderNumber)->update(['status' => 'Отменен']);
                DB::commit();
                return redirect()->route('admin.orders')->with('success', 'Заказ успешно отменен.');
            } catch (Exception $e) {
                DB::rollBack();
                return redirect()->route('admin.orders')->with('error', 'Ошибка при отмене заказа: ' . $e->getMessage());
            }
        } else {
            return redirect()->route('admin.orders')->with('error', 'Невозможно отменить заказ с текущим статусом.');
        }
    }

    public function sendConfirmationCode(Request $request){

        $confirmationCode = rand(100000, 999999);

        Mail::to($request->user()->email)->send(new OrderConfirmation($confirmationCode));

        Session::put('confirmation_code', $confirmationCode);

        return response()->json(['confirmation_code' => $confirmationCode]);
    }

    public function verifyConfirmationCode(Request $request){

        $enteredCode = $request->input('confirmation_code');
        
        $savedCode = Session::get('confirmation_code');

        if ($enteredCode == $savedCode) {
            return response()->json(['message' => 'Confirmation code verified successfully']);
        } else {
            return response()->json(['error' => 'Invalid confirmation code'], 400);
        }
    }


}
