<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::with(['sender', 'recipient'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('backend.messages.index', compact('messages'));
    }

    public function update(Request $request, $message_id)
    {
        $message = Message::findOrFail($message_id);

        $request->validate([
            'message' => 'nullable|string|max:1000',
        ]);

        $message->update([
            'message' => $request->input('message'),
        ]);

        return back()->with('success', 'Message updated successfully!');
    }

    public function destroy($message_id)
    {
        $message = Message::findOrFail($message_id);

        if ($message->image_path) {
            Storage::disk('public')->delete($message->image_path);
        }

        $message->delete();

        return back()->with('success', 'Message deleted successfully!');
    }
}
