<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::with('users')->get();
        $users = User::all();
        $loggedInUserId = Auth::user()->id;

        return view('groups', compact('groups', 'users', 'loggedInUserId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'user_ids' => 'array',
        ]);

        $group = Group::create(['name' => $request->name]);

        if ($request->user_ids) {
            $group->users()->attach($request->user_ids);
        }

        return response()->json(['group' => $group], 201);
    }


}
