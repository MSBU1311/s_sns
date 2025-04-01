<?php

namespace App\Http\Middleware;


use Illuminate\View\View;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    // ログインしていないユーザーが、ログイン後の画面を指定した場合、どこに返すかを指定
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            // routeの中は、返したい画面表示のルーティングのnameを記入
            return route('login');
        }
    }
}
