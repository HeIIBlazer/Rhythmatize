<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = array('admin', 'user');
        $users = User::orderBy('name', 'acs')->get();
        return view('users.index', compact('users', 'roles'));
    }

    public function userByrole(Request $request)
    {
        $roles = array('admin', 'user');
        $data = $request->all();
        $selectRole = $data['role'];
        if ($data['role'] == "0") {
            return redirect('/users');
        } else {
            $users = User::where('role', 'LIKE', $data['role'])->get();
            return view('users.index', compact('users', 'roles', 'selectRole'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = array('admin', 'user');
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $roles = array('admin', 'user');
        $request->validate([
            'avatar_url' => 'required',
            'username' => 'required',
            'email' => 'required|sting|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'password_conformation' => 'required', // 'password' => 'required|confirmed
            'role' => 'required',
            'description' => 'required',
        ]);

        User::create([
            'avatar_url' => $request->avatar_url,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'description' => $request->description,

        ]);
        
        return redirect('/users');
    }

    public function form_register()
    {
        return view('user_views.registration');
    }

    public function store_register(Request $request)
    {

        $userExistsEmail = User::where('email', $request->email)->first();
        $userExistsUsername = User::where('username', $request->username)->first();
        if ($userExistsEmail && $userExistsUsername) {
            return redirect('/registration')->with('error', 'The username and email is already in use.');
        }elseif ($userExistsUsername) {
            return redirect('/registration')->with('error', 'The username is already in use.');
        }elseif ($userExistsEmail) {
            return redirect('/registration')->with('error', 'The email is already in use.');
        }

        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|',
            'password_confirmation' => 'required|string|min:6|',
        ]);

        if($request->password != $request->password_confirmation){
            return redirect('/registration')->with('error', 'Passwords do not match.');
        }

        //Запрос на добавление пользователя
        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'avatar_url' => '0',
            'description' => 'NO DESCRIPTION',
         ]);

         if (auth()->attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            return redirect('/'); // or any other page for logged-in users
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = array('admin', 'user');
        return view('users.edit', compact('roles', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        if (!isset($request->role)) $request->role = Auth::user()->role;
        if ($request->password) {
            $request->validate([
                'password' => 'required|string|min:6|confirmed',
                'password_confirmation' => 'required',
            ]);
            $user->update([
                'name' => $request->name,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'description' => $request->description,
                'avatar_url' => $request->avatar_url,          
            ]);
        }
        return redirect('/users');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/users');
    }
}
