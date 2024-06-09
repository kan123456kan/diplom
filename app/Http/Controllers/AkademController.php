<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class AkademController extends Controller
{

    private $weeekApiUrl = 'https://api.weeek.net/public/v1';
    private $weeekApiKey = 'bcb0ecb3-a1ec-43d2-899a-629574f8c342';

    public function addTask(Request $request)
    {
        $title = $request->input('title');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $message = $request->input('message');
        $description = $phone . ' ' . $email . ' ' . $message;

        $currentDateTime = Carbon::now();

        $response = Http::baseUrl($this->weeekApiUrl)
            ->withToken($this->weeekApiKey)
            ->acceptJson()
            ->asJson()
            ->post('/tm/tasks', [
                'title' => $title,
                'phone' => $phone,
                'email' => $email,
                'message' => $message,
                'description' => $description,
                'projectId' => 2,
                'boardId' => 3,
                'boardColumnId' => 10,
                'day'  => $currentDateTime->format('d.m.Y'),
                'time' => $currentDateTime->format('H:i'),
            ]);

        $result = $response->json();

        if ($result['success']) {
            return redirect('/akadem')->with('success_message', 'Заявка успешно отправлена!');
        } else {
            return response()->json($result);
        }
    }
    public function index(){
        return view('akadem');
    }
}
