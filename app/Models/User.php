<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Follow;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'bio',
        'icon_image',
    ];

    public function posts(){
        return $this->hasMany('App\Models\Post');
    }

    // フォローしているユーザーを取得
    public function follows()
    {
        // (関係するモデルの場所、中間テーブルの名前、中間テーブルにある自分のIDが入るカラム名、中間テーブルにある相手のIDに入るカラム名)
        return $this->belongsToMany(User::class, 'follows','following_id', 'followed_id');
    }

    // フォローされているユーザーを取得
        public function followers()
    {
        return $this->belongsToMany(User::class, 'follows','followed_id', 'following_id');

    }

    // ユーザーをフォローする
    public function follow(User $user){
        $this->follows()->attach($user->id);
    }

    // ユーザーのフォローを解除する
    public function unfollow(User $user){
        $this->follows()->detach($user->id);
    }

    // ユーザーをフォローしているか確認する
    public function isFollowing(User $user){
        return $this->follows()->where('following_id', $user->id)->exists();
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
}
