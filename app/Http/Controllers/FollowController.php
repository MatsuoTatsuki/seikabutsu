<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FollowController extends Controller
{
    public function follow(User $user)
    {
        if (auth()->user()->id !== $user->id) {
            auth()->user()->following()->attach($user->id);
        }
        return back();
    }

    public function unfollow(User $user)
    {
        if (auth()->user()->id !== $user->id) {
            auth()->user()->following()->detach($user->id);
        }
        return back();
    }
}
