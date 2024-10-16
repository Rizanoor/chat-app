<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::whereNot('id', Auth::user()->id)->get();

        return view('dashboard', compact('users'));
    }
}
