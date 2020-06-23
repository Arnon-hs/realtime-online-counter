<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function send(\Illuminate\Http\Request $request)
    {
        \App\Events\Message::dispatch($request->input('body'));
    }
}
