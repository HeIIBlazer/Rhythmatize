<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Encryption\DecryptException;




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
        if ($request->hasFile('avatar_url') && $request->file('avatar_url')->getSize() > 15360 * 1024) {
            return redirect()->back()->with('error_signup', 'The avatar image may not be larger than 15 megabytes.');
        }

        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|',
            'password_confirmation' => 'required|string|min:6|',
            'avatar_url' => 'image|mimes:jpeg,png,jpg,gif|max:15360',
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

        if ($request->hasFile('avatar_url') && $request->file('avatar_url')->getSize() > 15360 * 1024) {
            return redirect()->back()->with('error', 'The avatar image may not be larger than 15 megabytes.');
        }
        
        if ($request->hasFile('banner_url') && $request->file('banner_url')->getSize() > 15360 * 1024) {
            return redirect()->back()->with('error', 'The banner image may not be larger than 15 megabytes.');
        }
        
        $request->validate([
            'username' => '',
            'email' => '',
            'password' => 'required',
            'new_password' => '',
            'password_confirmation' => '',
            'description' => '',
            'avatar_url' => 'image|mimes:jpeg,png,jpg,gif|max:15360',
            'banner_url' => 'image|mimes:jpeg,png,jpg,gif|max:15360',
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
                    'description' => $request -> description,
                ]);

                return redirect()->back();
            } else {
                $user->update([
                    'username' => $request->username,
                    'email' => $request->email,
                    'avatar_url' => $avatar_url,
                    'banner_url' => $banner_url,
                    'description' => $request -> description,
                ]);

                return redirect()->back();
            }

        }else{

            return redirect()->back()->with('error', 'Incorrect current password');
            
        }
    }

    /**
   * delete user account
   */
    public function destroy($crypt_user, Request $request)
    {
        try {
            $user_id = Crypt::decrypt($crypt_user);
        } catch (DecryptException $e) {
            abort(404);
        }
        
        $user = User::find($user_id);

        $request->validate([
            'password' => 'required',
        ]);

        if (Hash::check($request->password, $user->password)){
            $user->delete();
            return redirect('/');
        }else{
            return redirect()->back()->with('error_genre', 'Incorrect current password');
        }
    }

    public function dashboard()
    {
            $artists = DB::table('artists')->get();
            $albums = DB::table('albums')->get();
            $tracks = DB::table('tracks')->get();
            return view('admin_views.dashboard', compact('artists', 'albums', 'tracks'));
    }
}