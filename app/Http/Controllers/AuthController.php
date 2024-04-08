<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
        if (auth::attempt($credentials)) {
            redirect()->back();
        }
        return redirect()->back()->with('error_login', 'Username or password is incorrect');
    }
    public function logout()
    {
        auth::logout();
        return redirect()->back();
    }
}