<?php

namespace App\Http\Controllers;

use App\Events\GroupChanged;
use App\Events\GroupCreated;
use App\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function store()
    {
        $group = Group::create(['name' => request('name')]);

        $users = collect(request('users'));
        $users->push(auth()->user()->id);

        $group->users()->attach($users);

        broadcast(new GroupCreated($group))->toOthers();

        return $group->load('users');
    }

    public function leaveGroup($id)
    {
        $group = Group::find($id);
        $users = collect();
        $users->push(\Auth::user()->id);
        $group->users()->detach($users);
        broadcast(new GroupChanged($group, \Auth::user()))->toOthers();

        return $group;
    }
}
