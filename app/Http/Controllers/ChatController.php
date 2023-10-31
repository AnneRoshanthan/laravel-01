<?php

namespace App\Http\Controllers;

use App\Events\SendMessages;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function index() {
        try {
           return Message::with('user')->get();
        } catch (\Error $th) {
            throw $th;
        }
    }

    public function store(Request $request) {
        try {
            Log::info("WORKING");
            $user = Auth::user();
            // $message =  $user->message()->create([
            //     'message' => $request->message
            // ]);
            broadcast(new SendMessages($user,'hello'))->toOthers();

            return redirect()->back();
        } catch (\Error $th) {
            throw $th;
        }
    }

}
