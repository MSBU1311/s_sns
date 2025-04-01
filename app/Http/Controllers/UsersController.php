<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    //
    public function search(){
        $users=User::get();
        return view('users.search',compact('users'));
    }

    public function userSearch(Request $request){
        $users=User::query();
        $keyword=$request->input('keyword');
        $query=User::query();

        // keywordがnullではない場合
        if(!empty($keyword)){
            $query->where('username','LIKE',"%{$keyword}%");
        }

        // usersとqueryの変数が一緒だったら取得する
        $users=$query->get();


        return view('/users/search',compact('users','keyword'));
    }

    // 他ユーザーのプロフィールページを表示する
    public function show(User $user){
        $posts=$user->posts->sortByDesc('created_at');
        return view('users.other-profile',compact('user','posts'));
    }


}
