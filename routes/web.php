<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FollowsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



require __DIR__ . '/auth.php';

  // Route::get('top', [PostsController::class, 'index']);

  // Route::get('profile', [ProfileController::class, 'profile']);

  // Route::get('search', [UsersController::class, 'index']);

  // Route::get('follow-list', [PostsController::class, 'index']);
  // Route::get('follower-list', [PostsController::class, 'index']);

// ログイン前の人のみが見れる画面
Route::middleware(['guest'])->group(function(){
// Route::group(['middleware'=>['guest']],function(){
  // ログイン画面表示
  Route::get('/auth/login', [AuthenticatedSessionController::class, 'create'])->name('login');

  // ログイン機能
  // Route::get('/auth/login', [AuthenticatedSessionController::class, 'store']);
  Route::post('/auth/login', [AuthenticatedSessionController::class, 'store']);

  // 新規登録画面表示
  Route::get('/auth/register', [RegisteredUserController::class, 'create'])->name('register');

  // 新規登録フォーム送信
  Route::post('/user/create', [RegisteredUserController::class, 'store']);

  // 新規登録完了画面表示
  Route::get('added', [RegisteredUserController::class, 'added'])->name('added');

});

// ログイン後の人が見れる画面
Route::middleware(['auth'])->group(function(){
  Route::get('/posts/index', [PostsController::class, 'index']);

  Route::get('profile', [ProfileController::class, 'profile']);

  Route::get('search', [UsersController::class, 'search']);

  Route::get('/followList', [PostsController::class, 'follow']);
  Route::get('/followerList', [PostsController::class, 'follower']);

  Route::get('/logout', [AuthenticatedSessionController::class, 'logout']);

  // 投稿機能
  Route::post('/posts/index', [PostsController::class, 'postCreate']);

  // 投稿削除機能
  Route::post('/posts/delete',[PostsController::class,'delete']);

  // 投稿編集機能
  Route::post('/post/update',[PostsController::class,'postUpdate']);

  // 検索機能
  Route::get('/search',[UsersController::class,'userSearch'])->name('search');


  // フォローする
  Route::post('/users/{user}/follow', [FollowsController::class, 'follow'])->name('users.follow');

  // フォロー解除
  Route::post('/users/{user}/unfollow', [FollowsController::class, 'unfollow'])->name('users.unfollow');

  // 他ユーザーのプロフィールページ
  Route::get('/users/{user}/profile',[UsersController::class,'show'])->name('users.show');

  // 自分のプロフィールを編集する
  Route::post('/profile/update',[ProfileController::class,'update']);
});
