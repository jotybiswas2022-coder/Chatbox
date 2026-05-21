<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MessageController extends Controller
{
    public function media($path)
    {
        if (!Storage::disk('public')->exists($path)) {
            abort(404);
        }

        // Resolve absolute path on the public disk and return a proper file response
        $fullPath = Storage::disk('public')->path($path);
        if (!file_exists($fullPath)) {
            abort(404);
        }

        return response()->file($fullPath);
    }

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
        // If message came as an array (malformed), coerce to null so validation won't fail with "must be a string"
        if (is_array($request->input('message'))) {
            $request->merge(['message' => null]);
        }

        // Validate: message may be null (when sending image only), but must be a string when present
        $request->validate([
            'message' => 'nullable|string|max:1000',
            // increase max to 5MB (5120 KB)
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ]);

        // Ensure at least one of message or image is present
        if (!$request->filled('message') && !$request->hasFile('image')) {
            return back()->withErrors(['message' => 'Please provide a message or attach an image.']);
        }

        $filePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if (!$file->isValid()) {
                return back()->with('error', 'Uploaded image is not valid.');
            }

            try {
                $filePath = $file->store('messages', 'public');
            } catch (\Exception $e) {
                return back()->with('error', 'Failed to save image.');
            }
        }

        $messageText = $request->input('message');
        if ($messageText !== null) {
            $messageText = trim($messageText);
            if ($messageText === '') $messageText = null;
        }

        Message::create([
            'sender_id' => auth()->id(),
            'recipient_id' => $user_id,
            'message' => $messageText,
            'image_path' => $filePath,
        ]);

        return back()->with('success', 'Message sent successfully!');
    }
}
