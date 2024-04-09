@extends('layouts.app', ['title' => $artist -> name])

@section('content')
    @php
    $artist_likes = DB::table('like_artists')
                ->where('like_artists.artist_id', $artist->id)
                ->count();

    if (Auth::user() != null) {
        $like = DB::table('like_artists')
            ->where('like_artists.artist_id', $artist->id)
            ->where('like_artists.user_id', Auth::user()->id)
            ->count();
    } else {
        $like = 2;
    }   
    @endphp

    <div style="width: 100%; height: 200px;">
        <img src="{{url ($artist -> banner_url)}}" alt="" style="width: 100%; height: 300px; object-fit:cover; object-position: 50% 50%;">
    </div>
    <div class="container">
    <div class="w-25">
        <div>
            <div class="border rounded border-light artist-img">
                <img src="{{url ($artist -> picture_url)}}" alt="" class="w-100 ">
            </div>
        </div>
        <div>
            <h1 style="font-family: 'Audiowide', sans-serif; color: white">{{$artist -> name}}</h1>
        </div>
        <div class="d-flex flex-row">
            @if ($like == 0) 
            <div class="d-flex flex-row">
                <a href="/like_artist/{{$artist -> id}}"><img src="{{asset('images/like.png')}}" alt="" style="width: 22px; height: 22px; margin-right: 6px;"></a>
            </div>
            <div class="white-text">
                <span style="color: white;">| {{$artist_likes}} </span>
            </div>      
            @elseif (Auth::user() == null)
            <div>
                <button class="login_button" data-toggle="modal" data-target="#loginModal"><img src="{{asset('images/like.png')}}" alt="" style="width: 22px; height: 22px; margin-right: 6px;"></button>
            </div>
            <div>
                <span>| {{$artist_likes}} </span>
            </div>    
            @else ($like == 1) 
            <div>
                <a href="/unlike_artist/{{$artist -> id}}"><img src="{{asset('images/liked.png')}}" alt="" style="width: 22px; height: 22px; margin-right: 6px;"></a>
            </div>
            <div>
                <span>| {{$artist_likes}} </span>
            </div>    
            @endif
        </div>
        <div>
            <div>
                <h2>About {{$artist -> name}}:</h2>
            </div>
            <div>
                <p>{{$artist -> description}}</p>
            </div>
        </div>
        <div>
            <div>
                <h1>Comments:</h1>
            </div>
            @foreach($comments as $comment)
            @php
                $user = DB::table('users')
                    ->where('users.id', $comment->user_id)
                    ->first();
            @endphp
            <div>
                <p>{{$user -> username}}</p>
            </div>
            <div>{{$comment -> content}}</div>
            @endforeach
        </div>
    </div>
</div>
    
    @endsection
    