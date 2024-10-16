<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\MessageSent;
use App\Models\Message;

class MessageController extends Controller
{
    public function send(Request $request)
    {
        try{
            $message = Message::create([
                'sender_id' => 1 ,
                'sender_type' => $request->sender_type ,
                'receiver_id' => $request->receiver_id,
                'receiver_type' => $request->receiver_type,
                'message' => $request->message,
         ]);

         broadcast(new MessageSent($message))->toOthers();

         return response()->json(['status' => 'Message Sent!']);
        }catch(\Exception $e){
            return response()->json([
            'error' => 'Something went wrong',
            'message' => $e->getMessage()], 500);
        }
    }

}
