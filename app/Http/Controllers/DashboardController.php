<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $authUserId = Auth::user()->id;

        $users = User::where('id', '!=', $authUserId)->get();

        $users->transform(function ($user) use ($authUserId) {
            $user->lastMessage = Message::where(function ($query) use ($user, $authUserId) {
                $query->where('sender_id', $authUserId)
                    ->where('receiver_id', $user->id);
            })
                ->orWhere(function ($query) use ($user, $authUserId) {
                    $query->where('sender_id', $user->id)
                        ->where('receiver_id', $authUserId);
                })
                ->latest()
                ->first();

            $user->unreadCount = Message::where('receiver_id', $authUserId)
                ->where('sender_id', $user->id)
                ->where('is_read', false)
                ->count();

            return $user;
        });

        $users = $users->filter(fn($user) => $user->lastMessage !== null)
            ->sortByDesc(fn($user) => $user->lastMessage->created_at)
            ->values();

        return view('dashboard', compact('users'));
    }
}
