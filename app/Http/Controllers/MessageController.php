<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use DB;

class MessageController extends Controller
{
    public function get($contact){
        $messagesFrom=Message::where('from',$contact,'and')->where("to",auth()->user()->id)->get();
        $messagesTo=Message::where('to',$contact,'and')->where("from",auth()->user()->id)->get();
        
        $messages=DB::select("select * from messages where (messages.to=$contact and messages.from=".auth()->user()->id.") or (messages.to=".auth()->user()->id." and messages.from=$contact) order by updated_at");

        return response()->json($messages)->setStatusCode(200);
    }

    public function post(Request $request){
        $message=Message::create(['to'=>$request->to,
                                        'from'=>auth()->user()->id,
                                            'body'=>$request->message]);

        return response()->json($message)->setStatusCode(200);
    }
}
