<?php

namespace App\Http\Controllers;

use App\Mail\SubscriptionMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class SubscriptionController extends Controller
{
    public function subscribe(Request $request)
    {

        $request->validate(['email' => 'required|email']);

        Mail::to($request->email)->send(new SubscriptionMail());

        return back()->with('success', 'Вы успешно подписались на рассылку!');
    }
}

