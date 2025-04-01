<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FollowsController extends Controller
{
    //
    public function followList(){
        return view('follows.followList');
    }

    public function follow(User $user, Request $request)
    {
        Auth::user()->follows()->attach($user->id);

        return redirect()->back();

    if ($request->has('from_search')) {
        return redirect()->route('search', ['keyword' => null]); // 検索画面に戻る
    } else {
        return redirect()->back(); // プロフィールページに戻る
    }
    }

    public function unfollow(User $user, Request $request)
    {
        Auth::user()->follows()->detach($user->id);

    if ($request->has('from_search')) {
        return redirect()->route('search', ['keyword' => null]); // 検索画面に戻る
    } else {
        return redirect()->back(); // プロフィールページに戻る
    }
    }

}
