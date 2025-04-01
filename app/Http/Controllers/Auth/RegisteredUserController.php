<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request ->validate([
            'username' => 'required|unique:users,username|min:2,max:12',
            // どことuniqueなのか、後ろの記載で指定している
            'email' => 'required|unique:users,email|min:5,max:40|email',
            'password' => 'required|min:8,max:20|alpha_num|confirmed',
            'password_confirmation' => 'required'
        ]);

        $username=$request->input('username');
        $email=$request->input('email');
        $password=$request->input('password');

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $request->session()->flash('username',$username);

        return redirect('added');
    }

    public function added(Request $request): View
    {
        // sessionから$usernameを取り出す記述。bladeに＄usernameがないため、今回は記述なしでOK
        // $username=$request->session()->get('username',[]);

        return view('auth.added');
    }
}
