<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::with('sender')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('backend.messages.index', compact('messages'));
    }
}
