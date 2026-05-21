<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function message($user_id)
    {
        $recipient = User::findOrFail($user_id);
        $senderId = auth()->id();

        if ($senderId === (int) $user_id) {
            $messages = Message::where('sender_id', $senderId)
                ->where('recipient_id', $senderId)
                ->orderBy('created_at')
                ->get();
        } else {
            $messages = Message::where(function ($query) use ($senderId, $user_id) {
                    $query->where('sender_id', $senderId)
                        ->where('recipient_id', $user_id);
                })
                ->orWhere(function ($query) use ($senderId, $user_id) {
                    $query->where('sender_id', $user_id)
                        ->where('recipient_id', $senderId);
                })
                ->orderBy('created_at')
                ->get();
        }

        return view('frontend.message', compact('user_id', 'recipient', 'messages'));
    }

    public function sendMessage(Request $request, $user_id)
    {
        User::findOrFail($user_id);

        $request->validate([
            'message' => 'required_without:image|string|max:1000',
            'image' => 'nullable|image|max:2048',
        ]);

        $filePath = null;
        if ($request->hasFile('image')) {
            $filePath = $request->file('image')->store('messages', 'public');
        }

        Message::create([
            'sender_id' => auth()->id(),
            'recipient_id' => $user_id,
            'message' => $request->input('message'),
            'image_path' => $filePath,
        ]);

        return back()->with('success', 'Message sent successfully!');
    }
}
