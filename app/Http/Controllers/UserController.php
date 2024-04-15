<?php

namespace App\Http\Controllers;

use App\Models\User;
use app\Models\Artist;
use app\Models\Album;
use app\Models\Track;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;




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

    public function show_user(User $user){

        
        $artists = $user->likedArtists()->latest('like_artists.id')->take(3)->get();
        $tracks = $user->likedTracks()->latest('like_tracks.id')->take(4)->get();
        $albums = $user->likedAlbums()->latest('like_albums.id')->take(3)->get();

        return view('user_views.userInfo', compact('user', 'artists', 'tracks', 'albums'));

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
            'avatar_url',
            'banner_url'
        ]);

        if($request-> avatar_url == null){
            $avatar_url = asset('images/default_avatar.png');

            User::create([
                'avatar_url' => $avatar_url,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'description' => '',
                'banner_url' => asset('images/Default_banner.jpg'),
            ]);
        }

        User::create([
            'avatar_url' => $request->avatar_url,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'description' => '',
            'banner_url' => asset('images/Default_banner.jpg'),

        ]);
        
        return redirect('/users');
    }

    public function store_register(Request $request)
    {

        $userExistsEmail = User::where('email', $request->email)->first();
        $userExistsUsername = User::where('username', $request->username)->first();
        if ($userExistsEmail && $userExistsUsername) {
            return redirect()->back()->with('error_signup', 'The username and email is already in use.');
        }elseif ($userExistsUsername) {
            return redirect()->back()->with('error_signup', 'The username is already in use.');
        }elseif ($userExistsEmail) {
            return redirect()->back()->with('error_signup', 'The email is already in use.');
        }

        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|',
            'password_confirmation' => 'required|string|min:6|',
            'avatar_url' => 'image',
        ]);

        if($request->password != $request->password_confirmation){
            return redirect()->back()->with('error_signup', 'Passwords do not match.');
        }

        if($request -> avatar_url == null) {
            User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'user',
                'avatar_url' => asset('../images/avatars/Default_avatar.png'),
                'description' => '',
                'banner_url' => asset('../images/banners/Default_banner.png'),
            ]);
    
            if (auth()->attempt([
                'email' => $request->email,
                'password' => $request->password
            ])) {
                return redirect()->back();
        }
    }

        //Запрос на добавление пользователя


        $filename = $request->file('avatar_url')->getClientOriginalName();
        $data = $request->all(); //данные, переданы формой
        $data['avatar_url'] = '../images/avatars/'.$filename; 
        User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'user',
            'avatar_url' => $data['avatar_url'],
            'description' => '',
            'banner_url' => asset('../images/banners/Default_banner.png'),
        ]);
        $file = $request->file('avatar_url');
        if ($filename) {
            $file->move('../public/images/avatars/', $filename);
        }

        if (auth()->attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            return redirect()->back(); // or any other page for logged-in users
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
        return view('users.edit', compact('roles', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {

        // $2y$12$8g82HaQoJ0mtHAAQK7X1h.MpzZFC9TPx9jRPdMso0WI7WrHiJaqsS

        $request->validate([
            'username' => '',
            'email' => '',
            'password' => 'required',
            'new_password' =>'',
            'password_confirmation' => '',
            'avatar_url' => 'image',
            'banner_url'=> 'image',
        ]);

        $data = $request->all();

        if (Hash::check($request->password, $user->password)) {
            if ($request->new_password != null) {
                if($request->new_password != $request->password_confirmation) {
                    return redirect()->back()->with('error', 'New passwords do not match');
                }

                if($request->hasFile('avatar_url') && $request->file('avatar_url')->isValid() && $request->hasFile('banner_url') && $request->file('banner_url')->isValid()) {
                    $filename = $request->file('avatar_url')->getClientOriginalName();
                    $filebanner = $request->file('banner_url')->getClientOriginalName();
                    $data['avatar_url'] = '';
                    $data['banner_url'] = '';
                    $data['avatar_url'] = '../images/avatars/'.$filename;
                    $data['banner_url'] = '../images/banners/'.$filebanner;
                    
                    $user->update([
                        'username' => $data['username'],
                        'description' => $data['description'],
                        'password' => Hash::make($data['new_password']),
                        'avatar_url' => $data['avatar_url'],
                        'banner_url' => $data['banner_url'],
                        'email' => $data['email']
                    ]);

                    $file = $request->file('avatar_url');
                    $filebannersave = $request->file('banner_url');
                    if ($filename) {
                        $file->move('../public/images/avatars/', $filename);
                    }
                    if ($filebannersave){
                        $filebannersave->move('../public/images/banners/', $filebanner);
                    }

                    return redirect()->back();

                } else if($request->hasFile('avatar_url') && $request->file('avatar_url')->isValid()){
                    $filename = $request->file('avatar_url')->getClientOriginalName();
                    $data['avatar_url'] = '';
                    $data['avatar_url'] = '../images/avatars/'.$filename;
                    
                    $user->update([
                        'username' => $data['username'],
                        'description' => $data['description'],
                        'password' => Hash::make($data['new_password']),
                        'avatar_url' => $data['avatar_url'],
                        'email' => $data['email']
                    ]);

                    $file = $request->file('avatar_url');
                    if ($filename ) {
                        $file->move('../public/images/avatars/', $filename);
                    }

                    return redirect()->back();

                }elseif ($request->hasFile('banner_url') && $request->file('banner_url')->isValid()){
                    $filebanner = $request->file('banner_url')->getClientOriginalName();
                    $data['banner_url'] = '';
                    $data['banner_url'] = '../images/banners/'.$filebanner;

                    $user->update([
                        'username' => $data['username'],
                        'description' => $data['description'],
                        'password' => Hash::make($data['new_password']),
                        'banner_url' => $data['banner_url'],
                        'email' => $data['email']
                        
                    ]);

                    $filebannersave = $request->file('banner_url');
                    if ($filebanner) {
                        $filebannersave->move('../public/images/banners/', $filebanner);
                    }

                    return redirect()->back();
                }

                $user->update([
                    'username' => $data['username'],
                    'password' => Hash::make($data['new_password']),
                    'description' => $data['description'],
                    'avatar_url' => $data['avatar_url'],
                    'banner_url' => $data['banner_url'],
                    'email' => $data['email']
                ]);

                return redirect()->back();
            } else {
                $data = $request->all();

                if($request->hasFile('avatar_url') && $request->file('avatar_url')->isValid() && $request->hasFile('banner_url') && $request->file('banner_url')->isValid()) {
                    $filename = $request->file('avatar_url')->getClientOriginalName();
                    $filebanner = $request->file('banner_url')->getClientOriginalName();
                    $data['avatar_url'] = '';
                    $data['banner_url'] = '';
                    $data['avatar_url'] = '../images/avatars/'.$filename;
                    $data['banner_url'] = '../images/banners/'.$filebanner;
                    
                    $user->update([
                        'username' => $data['username'],
                        'description' => $data['description'],
                        'avatar_url' => $data['avatar_url'],
                        'banner_url' => $data['banner_url'],
                        'email' => $data['email']
                    ]);
                    $file = $request->file('avatar_url');
                    $filebannersave = $request->file('banner_url');
                    if ($filename) {
                        $file->move('../public/images/avatars/', $filename);
                    }
                    if ($filebannersave){
                        $file->move('../public/images/banners/', $filebanner);
                    }

                    return redirect()->back();

                } else if($request->hasFile('avatar_url') && $request->file('avatar_url')->isValid()){
                    $filename = $request->file('avatar_url')->getClientOriginalName();
                    $data['avatar_url'] = '';
                    $data['avatar_url'] = '../images/avatars/'.$filename;
                    
                    $user->update([
                        'username' => $data['username'],
                        'description' => $data['description'],
                        'avatar_url' => $data['avatar_url'],
                        'email' => $data['email']
                    ]);

                    $file = $request->file('avatar_url');
                    if ($filename) {
                        $file->move('../public/images/avatars/', $filename);
                    }

                    return redirect()->back();

                }elseif ($request->hasFile('banner_url') && $request->file('banner_url')->isValid()){
                    $filebanner = $request->file('banner_url')->getClientOriginalName();
                    $data['banner_url'] = '';
                    $data['banner_url'] = '../images/banners/'.$filebanner;

                    $user->update([
                        'username' => $data['username'],
                        'description' => $data['description'],
                        'banner_url' => $data['banner_url'],
                        'email' => $data['email']
                    ]);

                    $filebannersave = $request->file('banner_url');
                    if ($filebanner) {
                        $filebannersave->move('../public/images/banners/', $filebanner);
                    }

                    return redirect()->back();

                }else{
                    $user->update([
                        'username' => $data['username'],
                        'description' => $data['description'],
                        'email' => $data['email']
                    ]);
                    return redirect()->back();
                }


            }
        } else {
            return redirect()->back()->with('error', 'Incorrect current password');
        }
        // return redirect()->back();


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
