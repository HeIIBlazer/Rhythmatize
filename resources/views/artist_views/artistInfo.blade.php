@extends('layouts.app')

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
    <div style="width: 100%; height: 300px;">
        <img src="{{url ($artist -> banner_url)}}" alt="" style="width: 100%; height: 300px; object-fit:cover;">
    </div>
    <div class="container">
        <div>
            <div>
                <img src="{{url ($artist -> picture_url)}}" alt="">
            </div>
        </div>
        <div>
            <h1>{{$artist -> name}}</h1>
        </div>
        <div>
        @if ($like == 0) {
            <div>
                <a href="/like_artist/{{$artist -> id}}"><img src="{{asset('images/like.png')}}" alt="" style="width: 22px; height: 22px; margin-right: 6px;"></a>
            </div>
            <div>
                <span>|{{$artist_likes}}</span>
            </div>      
        }
        @elseif (Auth::user() == null){
            <button class="login_button" data-toggle="modal" data-target="#loginModal"><img src="{{asset('images/like.png')}}" alt="" style="width: 22px; height: 22px; margin-right: 6px;"></button>
        }
        @else ($like == 1) {
            <a href="/unlike_artist/{{$artist -> id}}"><img src="{{asset('images/liked.png')}}" alt="" style="width: 22px; height: 22px; margin-right: 6px;"></a>
        }
        @endif
        </div>
    </div>

@endsection
