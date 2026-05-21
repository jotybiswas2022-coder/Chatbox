@extends('frontend.app')

@section('content')

@php
    use Illuminate\Support\Facades\Storage;

    $recipientInitial = strtoupper(substr($recipient->name ?? 'U', 0, 1));
    $senderInitial = strtoupper(substr(auth()->user()->name ?? 'Y', 0, 1));
    $isSelfChat = (int) auth()->id() === (int) $user_id;
@endphp

<div class="chat-page">
    <div class="chat-container">

        <div class="chat-header">
            <div class="chat-user">
                <div class="chat-avatar recipient">{{ $recipientInitial }}</div>
                <div class="chat-user-info">
                    <h5 class="chat-user-name">
                        {{ $recipient->name }}
                        @if($isSelfChat)
                            <span class="chat-self-badge">(You)</span>
                        @endif
                    </h5>
                    <span class="chat-status">
                        <span class="status-dot"></span>
                        {{ $isSelfChat ? 'Saved messages' : 'Online' }}
                    </span>
                </div>
            </div>
        </div>

        <div class="chat-messages" id="chatMessages">
            @if($messages->isEmpty())
                <div class="empty-chat">
                    <div class="empty-chat-icon">
                        <i class="bi bi-chat-left-text"></i>
                    </div>
                    <h4>No messages yet</h4>
                    <p>Start the conversation by sending a message.</p>
                </div>
            @endif

            @foreach($messages as $message)
                @php $isOutgoing = $message->sender_id === auth()->id(); @endphp
                <div class="message-row {{ $isOutgoing ? 'outgoing' : 'incoming' }}">
                    @if(!$isOutgoing)
                        <div class="message-avatar">{{ $recipientInitial }}</div>
                    @endif

                    <div class="message-bubble {{ $message->image_path ? 'has-image' : '' }}">
                        @if($message->message)
                            <p>{{ $message->message }}</p>
                        @endif

                        @if($message->image_path)
                            <img src="{{ Storage::url($message->image_path) }}" alt="Chat image" class="message-image">
                        @endif

                        <span class="message-time">{{ $message->created_at->format('h:i A') }}</span>
                    </div>

                    @if($isOutgoing)
                        <div class="message-avatar sender">{{ $senderInitial }}</div>
                    @endif
                </div>
            @endforeach
        </div>

        @if(session('success') || session('error'))
            <div class="chat-alert {{ session('success') ? 'success' : 'error' }}">
                {{ session('success') ?? session('error') }}
            </div>
        @endif

        <form class="chat-input-area" id="chatForm" action="{{ route('message.send', $user_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="image" id="imageInput" accept="image/*" hidden>

            <label for="imageInput" class="chat-attach-btn" title="Attach image">
                <i class="bi bi-image"></i>
            </label>

            <textarea
                name="message"
                id="messageInput"
                class="chat-text-input"
                rows="1"
                placeholder="{{ $isSelfChat ? 'Write your notes or reminders here.' : 'Write a message...' }}"
            >{{ old('message') }}</textarea>

            <button type="submit" class="chat-send-btn" title="Send message">
                <i class="bi bi-send-fill"></i>
            </button>
        </form>

    </div>
</div>

<style>
    .chat-page {
        flex: 1;
        display: flex;
        flex-direction: column;
        min-height: 0;
        height: 100%;
        font-family: 'Inter', sans-serif;
    }

    .chat-container {
        flex: 1;
        display: flex;
        flex-direction: column;
        background: #fff;
        border-left: 1px solid #e3e6f0;
        min-height: calc(100vh - 56px);
        overflow: hidden;
    }

    .chat-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px 20px;
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        color: #fff;
        flex-shrink: 0;
        box-shadow: 0 2px 12px rgba(99, 102, 241, 0.25);
    }

    .chat-user {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .chat-avatar {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        font-weight: 700;
        flex-shrink: 0;
    }

    .chat-avatar.recipient {
        background: rgba(255, 255, 255, 0.2);
        border: 2px solid rgba(255, 255, 255, 0.5);
    }

    .message-avatar.sender,
    .chat-avatar.sender {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        color: #fff;
        font-weight: 700;
        font-size: 13px;
    }

    .message-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: #e5e7eb;
        color: #6b7280;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
        font-weight: 700;
        flex-shrink: 0;
    }

    .chat-user-name {
        margin: 0;
        font-size: 16px;
        font-weight: 700;
    }

    .chat-self-badge {
        font-size: 12px;
        font-weight: 500;
        opacity: 0.85;
    }

    .chat-status {
        font-size: 12px;
        color: rgba(255, 255, 255, 0.75);
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .status-dot {
        width: 8px;
        height: 8px;
        background: #22c55e;
        border-radius: 50%;
    }

    .chat-messages {
        flex: 1;
        overflow-y: auto;
        padding: 20px;
        display: flex;
        flex-direction: column;
        gap: 16px;
        background: #f8f9fc;
    }

    .empty-chat {
        text-align: center;
        padding: 36px 16px;
        border: 1px dashed #d1d5db;
        border-radius: 16px;
        background: #ffffff;
        color: #6b7280;
    }

    .empty-chat-icon {
        width: 52px;
        height: 52px;
        margin: 0 auto 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #eef2ff;
        color: #6366f1;
        font-size: 24px;
    }

    .message-row {
        display: flex;
        align-items: flex-end;
        gap: 8px;
        max-width: 85%;
    }

    .message-row.incoming { align-self: flex-start; }
    .message-row.outgoing { align-self: flex-end; }

    .message-bubble {
        padding: 10px 14px;
        border-radius: 16px;
        word-break: break-word;
        max-width: 100%;
    }

    .incoming .message-bubble {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-bottom-left-radius: 4px;
    }

    .outgoing .message-bubble {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        color: #fff;
        border-bottom-right-radius: 4px;
    }

    .message-bubble p {
        margin: 0 0 8px;
        font-size: 14px;
        line-height: 1.5;
    }

    .message-bubble.has-image p { margin-top: 0; }

    .message-image {
        display: block;
        max-width: 220px;
        border-radius: 10px;
        width: 100%;
        height: auto;
        margin-top: 8px;
    }

    .message-time {
        display: block;
        margin-top: 8px;
        font-size: 11px;
        opacity: 0.7;
    }

    .chat-alert {
        margin: 0 20px 12px;
        padding: 10px 14px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 500;
    }

    .chat-alert.success { background: #d1fae5; color: #065f46; }
    .chat-alert.error { background: #fee2e2; color: #991b1b; }

    .chat-input-area {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 16px 20px;
        background: #ffffff;
        border-top: 1px solid #e5e7eb;
        flex-shrink: 0;
    }

    .chat-attach-btn,
    .chat-send-btn {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        border: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        color: #fff;
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        cursor: pointer;
        transition: transform 0.2s ease;
    }

    .chat-attach-btn:hover,
    .chat-send-btn:hover {
        transform: translateY(-1px);
    }

    .chat-text-input {
        flex: 1;
        min-height: 44px;
        padding: 12px 14px;
        border-radius: 18px;
        border: 1px solid #e5e7eb;
        resize: none;
        font-size: 14px;
        line-height: 1.6;
        outline: none;
        color: #111827;
    }

    .chat-text-input:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.12);
    }
</style>

@endsection
