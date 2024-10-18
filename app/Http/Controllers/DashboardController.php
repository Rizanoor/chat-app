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

        // Ambil semua user kecuali user yang sedang login
        $users = User::where('id', '!=', $authUserId)->get();

        // Loop untuk mengambil pesan terakhir dan jumlah pesan belum dibaca
        $users->transform(function ($user) use ($authUserId) {
            // Ambil pesan terakhir antara auth user dan user tertentu
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

            // Hitung jumlah pesan yang belum dibaca
            $user->unreadCount = Message::where('receiver_id', $authUserId)
                ->where('sender_id', $user->id)
                ->where('is_read', false)
                ->count();

            return $user;
        });

        // Filter hanya user dengan pesan terakhir, lalu urutkan berdasarkan pesan terbaru
        $users = $users->filter(fn($user) => $user->lastMessage !== null)
            ->sortByDesc(fn($user) => $user->lastMessage->created_at)
            ->values(); // Reset index setelah diurutkan

        // Kirim ke view
        return view('dashboard', compact('users'));
    }
}
