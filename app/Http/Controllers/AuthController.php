<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;


use function Laravel\Prompts\error;

class AuthController extends Controller
{
    public function login()
    {
        return view('user_views.login');
    }
    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->input('remember');

        if (auth::attempt($credentials)) {
            if (!empty($remember)) {
                auth::login(auth::user(), true);
                redirect()->back();
            }
            redirect()->back();
        }else{
            return redirect()->back()->with('error_login', 'Email or password is incorrect');
        }
        return redirect()->back()->with('error_login', 'Email or password is incorrect');
    }
    public function logout()
    {
        auth::logout();
        return redirect()->back();
    }
}