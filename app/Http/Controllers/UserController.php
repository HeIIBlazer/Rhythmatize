<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
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

    public function show_user($crypt_user)
    {

        $crypt = Crypt::decrypt($crypt_user);
        $user = User::find($crypt);

        $artists = $user->likedArtists()->latest('like_artists.id')->take(3)->get();
        $tracks = $user->likedTracks()->latest('like_tracks.id')->take(4)->get();
        $albums = $user->likedAlbums()->latest('like_albums.id')->take(3)->get();

        return view('user_views.userInfo', compact('user', 'artists', 'tracks', 'albums'));
    }

    public function show_liked_albums($crypt_user)
    {
        $crypt = Crypt::decrypt($crypt_user);
        $user = User::find($crypt);
        $albums = $user->likedAlbums()->latest('like_albums.id')->paginate(12);
        return view('album_views.albumsList', compact('albums', 'user'));
    }
    
    public function show_liked_artists($crypt_user)
    {
        $crypt = Crypt::decrypt($crypt_user);
        $user = User::find($crypt);
        $artists = $user->likedArtists()->latest('like_artists.id')->paginate(12);
        return view('artist_views.artistsList', compact('artists', 'user'));
    }

    public function show_liked_tracks($crypt_user)
    {
        $crypt = Crypt::decrypt($crypt_user);
        $user = User::find($crypt);
        $tracks = $user->likedTracks()->latest('like_tracks.id')->paginate(12);
        return view('tracks_views.tracksChart', compact('tracks', 'user'));
    }


    public function store_register(Request $request)
    {

        $userExistsEmail = User::where('email', $request->email)->first();
        $userExistsUsername = User::where('username', $request->username)->first();
        if ($userExistsEmail && $userExistsUsername) {
            return redirect()->back()->with('error_signup', 'The username and email is already in use.');
        } elseif ($userExistsUsername) {
            return redirect()->back()->with('error_signup', 'The username is already in use.');
        } elseif ($userExistsEmail) {
            return redirect()->back()->with('error_signup', 'The email is already in use.');
        }

        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|',
            'password_confirmation' => 'required|string|min:6|',
            'avatar_url' => 'image',
        ]);

        if ($request->password != $request->password_confirmation) {
            return redirect()->back()->with('error_signup', 'Passwords do not match.');
        }

        if ($request->avatar_url == null) {
            User::create([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'user',
                'avatar_url' => '../images/avatars/Default_avatar.png',
                'description' => '',
                'banner_url' => '../images/banners/Default_banner.png',
            ]);

            if (
                auth()->attempt([
                    'email' => $request->email,
                    'password' => $request->password
                ])
            ) {
                return redirect()->back();
            }
        }

        //Запрос на добавление пользователя

        if ($request->hasFile('avatar_url')) {
            $file = $request->file('avatar_url');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/avatars'), $filename);
            $avatar_url = 'images/avatars/' . $filename;
        } else {
            $avatar_url = "../images/avatars/Default_avatar.png";
        }

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'avatar_url' => $avatar_url,
            'description' => '',
            'banner_url' => '../images/banners/Default_banner.png',
        ]);
        $file = $request->file('avatar_url');

        if (
            auth()->attempt([
                'email' => $request->email,
                'password' => $request->password
            ])
        ) {
            return redirect()->back(); // or any other page for logged-in users
        }
    }

    /**
     * update user info
    */

    public function update(Request $request, User $user) {
        
        $request->validate([
            'username' => '',
            'email' => '',
            'password' => 'required',
            'new_password' => '',
            'password_confirmation' => '',
            'avatar_url' => '',
            'banner_url' => '',
        ]);


        if (Hash::check($request->password, $user->password)) {

            if ($request->hasFile('avatar_url')) {
                $file = $request->file('avatar_url');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/avatars'), $filename);
                $avatar_url = 'images/avatars/' . $filename;
            } else {
                $avatar_url = $user->avatar_url;
            }

            if ($request->hasFile('banner_url')) {
                $file = $request->file('banner_url');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/banners'), $filename);
                $banner_url = 'images/banners/' . $filename;
            } else {
                $banner_url = $user->banner_url;
            }

            if ($request->new_password != null) {
                if ($request->new_password != $request->password_confirmation) {
                    return redirect()->back()->with('error', 'New passwords do not match');
                }

                $user->update([
                    'username' => $request->username,
                    'email' => $request->email,
                    'password' => Hash::make($request->new_password),
                    'avatar_url' => $avatar_url,
                    'banner_url' => $banner_url,
                ]);

                return redirect()->back();
            } else {
                $user->update([
                    'username' => $request->username,
                    'email' => $request->email,
                    'avatar_url' => $avatar_url,
                    'banner_url' => $banner_url,
                ]);

                return redirect()->back();
            }

        }else{

            return redirect()->back()->with('error', 'Incorrect current password');
            
        }
    }

    // public function update(Request $request, User $user)
    // {

    //     $request->validate([
    //         'username' => '',
    //         'email' => '',
    //         'password' => 'required',
    //         'new_password' => '',
    //         'password_confirmation' => '',
    //         'avatar_url' => 'image',
    //         'banner_url' => 'image',
    //     ]);

    //     $data = $request->all();

    //     if (Hash::check($request->password, $user->password)) {
    //         if ($request->new_password != null) {
    //             if ($request->new_password != $request->password_confirmation) {
    //                 return redirect()->back()->with('error', 'New passwords do not match');
    //             }

    //             if ($request->hasFile('avatar_url') && $request->file('avatar_url')->isValid() && $request->hasFile('banner_url') && $request->file('banner_url')->isValid()) {
    //                 $filename = $request->file('avatar_url')->getClientOriginalName();
    //                 $filebanner = $request->file('banner_url')->getClientOriginalName();
    //                 $data['avatar_url'] = '';
    //                 $data['banner_url'] = '';
    //                 $data['avatar_url'] = '../images/avatars/' . $filename;
    //                 $data['banner_url'] = '../images/banners/' . $filebanner;

    //                 $user->update([
    //                     'username' => $data['username'],
    //                     'description' => $data['description'],
    //                     'password' => Hash::make($data['new_password']),
    //                     'avatar_url' => $data['avatar_url'],
    //                     'banner_url' => $data['banner_url'],
    //                     'email' => $data['email']
    //                 ]);

    //                 $file = $request->file('avatar_url');
    //                 $filebannersave = $request->file('banner_url');
    //                 if ($filename) {
    //                     $file->move('../public/images/avatars/', $filename);
    //                 }
    //                 if ($filebannersave) {
    //                     $filebannersave->move('../public/images/banners/', $filebanner);
    //                 }

    //                 return redirect()->back();
    //             } else if ($request->hasFile('avatar_url') && $request->file('avatar_url')->isValid()) {
    //                 $filename = $request->file('avatar_url')->getClientOriginalName();
    //                 $data['avatar_url'] = '';
    //                 $data['avatar_url'] = '../images/avatars/' . $filename;

    //                 $user->update([
    //                     'username' => $data['username'],
    //                     'description' => $data['description'],
    //                     'password' => Hash::make($data['new_password']),
    //                     'avatar_url' => $data['avatar_url'],
    //                     'email' => $data['email']
    //                 ]);

    //                 $file = $request->file('avatar_url');
    //                 if ($filename) {
    //                     $file->move('../public/images/avatars/', $filename);
    //                 }

    //                 return redirect()->back();
    //             } elseif ($request->hasFile('banner_url') && $request->file('banner_url')->isValid()) {
    //                 $filebanner = $request->file('banner_url')->getClientOriginalName();
    //                 $data['banner_url'] = '';
    //                 $data['banner_url'] = '../images/banners/' . $filebanner;

    //                 $user->update([
    //                     'username' => $data['username'],
    //                     'description' => $data['description'],
    //                     'password' => Hash::make($data['new_password']),
    //                     'banner_url' => $data['banner_url'],
    //                     'email' => $data['email']

    //                 ]);

    //                 $filebannersave = $request->file('banner_url');
    //                 if ($filebanner) {
    //                     $filebannersave->move('../public/images/banners/', $filebanner);
    //                 }

    //                 return redirect()->back();
    //             }

    //             $user->update([
    //                 'username' => $data['username'],
    //                 'password' => Hash::make($data['new_password']),
    //                 'description' => $data['description'],
    //                 'avatar_url' => $data['avatar_url'],
    //                 'banner_url' => $data['banner_url'],
    //                 'email' => $data['email']
    //             ]);

    //             return redirect()->back();
    //         } else {
    //             $data = $request->all();

    //             if ($request->hasFile('avatar_url') && $request->file('avatar_url')->isValid() && $request->hasFile('banner_url') && $request->file('banner_url')->isValid()) {
    //                 $filename = $request->file('avatar_url')->getClientOriginalName();
    //                 $filebanner = $request->file('banner_url')->getClientOriginalName();
    //                 $data['avatar_url'] = '';
    //                 $data['banner_url'] = '';
    //                 $data['avatar_url'] = '../images/avatars/' . $filename;
    //                 $data['banner_url'] = '../images/banners/' . $filebanner;

    //                 $user->update([
    //                     'username' => $data['username'],
    //                     'description' => $data['description'],
    //                     'avatar_url' => $data['avatar_url'],
    //                     'banner_url' => $data['banner_url'],
    //                     'email' => $data['email']
    //                 ]);
    //                 $file = $request->file('avatar_url');
    //                 if ($filename) {
    //                     $file->move('../public/images/avatars/', $filename);
    //                 }

    //                 $filebannersave = $request->file('banner_url');
    //                 if ($filebanner) {
    //                     $filebannersave->move('../public/images/banners/', $filebanner);
    //                 }

    //                 return redirect()->back();
    //             } else if ($request->hasFile('avatar_url') && $request->file('avatar_url')->isValid()) {
    //                 $filename = $request->file('avatar_url')->getClientOriginalName();
    //                 $data['avatar_url'] = '';
    //                 $data['avatar_url'] = '../images/avatars/' . $filename;

    //                 $user->update([
    //                     'username' => $data['username'],
    //                     'description' => $data['description'],
    //                     'avatar_url' => $data['avatar_url'],
    //                     'email' => $data['email']
    //                 ]);

    //                 $file = $request->file('avatar_url');
    //                 if ($filename) {
    //                     $file->move('../public/images/avatars/', $filename);
    //                 }

    //                 return redirect()->back();
    //             } elseif ($request->hasFile('banner_url') && $request->file('banner_url')->isValid()) {
    //                 $filebanner = $request->file('banner_url')->getClientOriginalName();
    //                 $data['banner_url'] = '';
    //                 $data['banner_url'] = '../images/banners/' . $filebanner;

    //                 $user->update([
    //                     'username' => $data['username'],
    //                     'description' => $data['description'],
    //                     'banner_url' => $data['banner_url'],
    //                     'email' => $data['email']
    //                 ]);

    //                 $filebannersave = $request->file('banner_url');
    //                 if ($filebanner) {
    //                     $filebannersave->move('../public/images/banners/', $filebanner);
    //                 }

    //                 return redirect()->back();
    //             } else {
    //                 $user->update([
    //                     'username' => $data['username'],
    //                     'description' => $data['description'],
    //                     'email' => $data['email']
    //                 ]);
    //                 return redirect()->back();
    //             }
    //         }
    //     } else {
    //         return redirect()->back()->with('error', 'Incorrect current password');
    //     }
    // }

    public function dashboard()
    {
            $artists = DB::table('artists')->get();
            $albums = DB::table('albums')->get();
            $tracks = DB::table('tracks')->get();
            return view('admin_views.dashboard', compact('artists', 'albums', 'tracks'));
    }
}