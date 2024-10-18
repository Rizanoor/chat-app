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
        $loggedInUserId = Auth::user()->id;

        $groups = Group::whereHas('users', function ($query) use ($loggedInUserId) {
            $query->where('user_id', $loggedInUserId);
        })->with('users')->get();

        $users = User::all();

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

    public function show($id)
    {
        $group = Group::with(['users', 'messages.user'])->findOrFail($id);

        if (!$group->users->contains(Auth::user()->id)) {
            abort(403, 'Anda tidak diundang ke grup ini.');
        }

        $allUsers = User::all();

        return view('groupschat', compact('group', 'allUsers'));
    }
}
