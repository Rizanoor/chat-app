<?php

namespace App\Http\Controllers;

use App\Events\MessageGroupSent;
use App\Models\Group;
use App\Models\Message;
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

    // create groups
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

    // update group
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'user_ids' => 'required|array',
        ]);

        $group = Group::findOrFail($id);
        $group->name = $request->name;
        $group->users()->sync($request->user_ids);
        $group->save();

        return response()->json(['message' => 'Group updated successfully.']);
    }

    public function show($id)
    {
        $group = Group::with(['users', 'messages'])->findOrFail($id);

        if (!$group->users->contains(Auth::user()->id)) {
            abort(403, 'Anda tidak diundang ke grup ini.');
        }

        $allUsers = User::all();

        return view('groupschat', compact('group', 'allUsers'));
    }

    public function sendMessage(Request $request, $groupId)
    {
        $message = Message::create([
            'text' => $request->input('text'),
            'sender_id' => Auth::id(),
            'group_id' => $groupId,
        ]);
        
        broadcast(new MessageGroupSent($message))->toOthers();

        return response()->json($message);
    }

}
