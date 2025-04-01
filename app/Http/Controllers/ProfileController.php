<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profile(){
        $user = Auth::user();
        return view('profiles.profile',compact('user'));
    }

    public function update(Request $request)
    {
        // バリデーション
        $request->validate([
            'username' => 'required|min:2|max:12',
            'email' => 'required|min:5|max:40|email',
            'password' => 'required|min:8|max:20|alpha_num|confirmed', // パスワードは変更しない場合はnullable
            'password_confirmation' => 'required',
            'bio' => 'max:150',
            'icon_image' => 'image|mimes:jpg,png,bmp,gif,svg|max:2048', // 画像サイズ制限を追加
        ]);

        // ユーザー情報を取得
        $user = Auth::user();

        // パスワードが確認用と一致する場合
        if($request->input('password') === $request->input('password_confirmation')){
            // ユーザー情報を更新
            $user->username = $request->input('username');
            $user->email = $request->input('email');
            $user->bio = $request->input('bio');

            // パスワードが入力されていれば更新
            if ($request->filled('password')) {
                $user->password = Hash::make($request->input('password'));
            }

            // アイコン画像がアップロードされていれば更新
            if ($request->hasFile('icon_image')) {

                // 新しいアイコン画像を保存
                // storeAs('app/publicのどこのファイルに入れるか',登録画像,'appのどこに入れるか')
                $iconPath = $request->file('icon_image')->storeAs('', $request->file('icon_image')->getClientOriginalName(), 'public');
                $user->icon_image = str_replace('public/', '', $iconPath); // public/を除いたパスを保存
            }

        $user->save();

        // プロフィール画面へリダイレクト
        return redirect('/posts/index');
        }
    }
}
