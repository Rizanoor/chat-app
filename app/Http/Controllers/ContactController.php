<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index()
    {
        $users = User::whereNot('id', Auth::user()->id)->get();

        foreach ($users as $user) {
            $user->lastMessage = Message::where(function ($query) use ($user) {
                $query->where('sender_id', Auth::user()->id)
                    ->where('receiver_id', $user->id);
            })->orWhere(function ($query) use ($user) {
                $query->where('sender_id', $user->id)
                    ->where('receiver_id', Auth::user()->id);
            })->latest()->first();

            $user->unreadCount = Message::where('receiver_id', Auth::user()->id)
                ->where('sender_id', $user->id)
                ->where('is_read', false)
                ->count();
        }

        $users = $users->sortByDesc(function ($user) {
            return optional($user->lastMessage)->created_at;
        });

        return view('contact', compact('users'));
    }
}
