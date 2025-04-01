<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Follow;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index(){
        // Postモデル（postsテーブル）からレコードを取得
        $list=Post::get();
        $user=User::get();

        // フォローしているユーザーのidを取得
        $followed_id=Auth::user()->follows()->pluck('followed_id');
        $user_id=Auth::id();

        // フォローしているユーザーのidを元に投稿内容を取得
        $list=Post::with('user')
        ->whereIn('user_id',$followed_id)
        ->orWhere('user_id',$user_id)
        ->latest()
        ->get();

        return view('posts.index',['list'=>$list]);
    }

    // 投稿機能
    public function postCreate (Request $request)
    {
        $request->validate([
            'post' => ['required', 'min:1', 'max:150']
        ]);

        $post = $request->input('post');
        $user_id = Auth::user()->id;

        Post::create([
            'user_id' => $user_id,
            'post' => $post
        ]);

        return redirect('/posts/index');
    }

    // 削除機能
    public function delete(Request $request){
        $id = $request->input('id');
        // // idカラムの値が$id変数と一致するレコードを検索する->whereメソッドで指定した条件に一致するレコードを削除
        Post::where('id',$id)->delete();
        // dd($id);
        return redirect('/posts/index');
    }

    // 編集機能
    public function postUpdate(Request $request){

        $request->validate([
            'updatePost' => ['required', 'min:1', 'max:150']
        ]);

        $id = $request->input('id');
        $update_post = $request->input('updatePost');

        $request->validate([
            'updatePost' => 'required|min:1,max:150'
        ]);

        // 選択したレコードの値を更新
        Post::where('id', $id)->update([
              'id' => $id,
              'post' => $update_post
        ]);

        return redirect('/posts/index');
    }

    // 自分が(following)フォローしている人(followed)の投稿を表示する機能
    public function follow(){

        // 自分がフォローしているユーザーのidを取得
        $followed_id=Auth::user()->follows()->pluck('followed_id');
        // dd($following_id);

        // 自分がフォローしているユーザーのidを元に投稿内容を取得
        $posts=Post::with('user')->whereIn('user_id',$followed_id)->get()->sortByDesc('created_at');
        $icon=User::whereIn('id',$followed_id)->get();

        return view('follows.followList',compact('posts','icon'));

    }

    // 自分(followed)をフォローしている人(following)の投稿を表示する機能
    public function follower(){

        // 自分をフォローしているユーザーのidを取得
        // （今ログインしているuser->followersメソッドのリレーションに則って->following_idを取得する)
        $following_id=Auth::user()->followers()->pluck('following_id');
        // dd($following_id);

        // 自分をフォローしているユーザーのidを元に投稿内容を取得
        $posts=Post::with('user')->whereIn('user_id',$following_id)->get()->sortByDesc('created_at');
        $icon=User::whereIn('id',$following_id)->get()->sortByDesc('created_at');

        return view('follows.followerList',compact('posts','icon'));

    }
}
