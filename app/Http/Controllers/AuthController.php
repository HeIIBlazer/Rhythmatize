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
    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }

    // <a href="/delete_artist/eyJpdiI6IlByZk9YTVh2ZWxGbG92WjB5eWw5dEE9PSIsInZhbHVlIjoiVHBwdHE0VlRsMk9QeEp2MHNXUlJ3dz09IiwibWFjIjoiMTFkZjRhYTUxMjMyYTZmYjlkODZiMzk5MTQyYjc2NDcwMmJmMjI4MTdmODllYWQxMzlhN2JkZmIxNDlmZGNiNyIsInRhZyI6IiJ9" class="save-button-confirmation text-decoration-none"><button type="submit" class="buttons-inside-confirm">DELETE</button></a>
}