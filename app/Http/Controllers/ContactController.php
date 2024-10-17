<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Laravel\Prompts\password;

class ContactController extends Controller
{
    public function index()
    {
        $user = User::where('id', '!=', Auth::user()->id)->get();

        return view('contact', compact('user'));
    }

    public function store(Request $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt('password'),
        ];

        User::create($data);

        return response()->json(['message' => 'Contact created successfully!'], 201);
    }
}
