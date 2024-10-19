<?php

namespace App\Http\Controllers;

use App\Events\MessageDelivered;
use App\Events\MessageRead;
use App\Events\MessageSent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index(User $user)
    {
        $messages = Message::query()
            ->where(function ($query) use ($user) {
                $query->where('sender_id', Auth::user()->id)
                    ->where('receiver_id', $user->id);
            })
            ->orWhere(function ($query) use ($user) {
                $query->where('sender_id', $user->id)
                    ->where('receiver_id', Auth::user()->id);
            })
            ->with(['sender', 'receiver', 'repliedTo'])
            ->orderBy('created_at', 'asc')
            ->get();

        // Tandai pesan sebagai terbaca dan broadcast event read
        Message::where('sender_id', $user->id)
            ->where('receiver_id', Auth::user()->id)
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $unreadMessages = Message::where('sender_id', $user->id)
            ->where('receiver_id', Auth::user()->id)
            ->where('is_read', true)
            ->get();

        foreach ($unreadMessages as $message) {
            broadcast(new MessageRead($message));
        }

        return $messages;
    }


    public function show(User $user)
    {
        return view('chat', [
            'user' => $user
        ]);
    }

    public function sendMessage(Request $request, User $user)
    {
        $replyToId = $request->input('reply_to');

        $message = Message::create([
            'sender_id' => Auth::user()->id,
            'receiver_id' => $user->id,
            'text' => $request->input('message'),
            'is_delivered' => true,
            'reply_to' => $replyToId,
        ]);

        broadcast(new MessageSent($message));

        broadcast(new MessageDelivered($message))->toOthers();

        return response()->json($message);
    }

    public function markAsRead(Message $message)
    {
        if ($message->receiver_id === Auth::id()) {
            $message->is_read = true;
            $message->save();

            broadcast(new MessageRead($message))->toOthers();
        }
    }
}
