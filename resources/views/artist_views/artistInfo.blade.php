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

    <div style="width: 100%; height: 180px;">
        <img src="{{url ($artist -> banner_url)}}" alt="" style="width: 100%; height: 300px; object-fit:cover; object-position: 50% 50%;">
    </div>
    <div class="container">
    <div class="w-25 d-flex flex-column justify-content-center">
        <div>
            <div class="artist-img w-100 d-flex justify-content-center align-items-center">
                <img src="{{url ($artist -> picture_url)}}" alt="" class="Info-Image">
            </div>
        </div>
        <div>
            <h1 class="info-header">{{$artist -> name}}</h1>
        </div>
        <div class="d-flex flex-row justify-content-center align-content-center">
            @if ($like == 0) 
            <div class="d-flex flex-row">
                <a href="/like_artist/{{$artist -> id}}"><img src="{{asset('images/like.png')}}" alt="" style="width: 22px; height: 22px; margin-right: 6px;"></a>
            </div>
            <div class="white-text">
                <span style="color: white; font-size:20px;">| {{$artist_likes}}</span>
            </div>      
            @elseif (Auth::user() == null)
            <div>
                <button class="login_button" data-toggle="modal" data-target="#loginModal"><img src="{{asset('images/like.png')}}" alt="" style="width: 22px; height: 22px; margin-right: 6px;"></button>
            </div>
            <div>
                <span style="color: white; font-size:20px;"> {{$artist_likes}}</span>
            </div>    
            @else ($like == 1) 
            <div>
                <a href="/unlike_artist/{{$artist -> id}}"><img src="{{asset('images/liked.png')}}" alt="" style="width: 22px; height: 22px; margin-right: 6px;"></a>
            </div>
            <div>
                <span style="color: white; font-size:20px;"> {{$artist_likes}} </span>
            </div>    
            @endif
        </div>

        <div class="w-100 d-flex flex-row justify-content-center">
            <div class="w-25 h-25 d-flex justify-content-center">           
                <a href="{{$artist-> spotify_link}}">
                    <img src="{{asset('images/links_images/spotify.png')}}" alt="" style="width: 36px; height:36px;">
                </a>
            </div>

            <div class="w-25 h-25 d-flex justify-content-center">           
                <a href="{{$artist-> apple_music_link}}">
                    <img src="{{asset('images/links_images/apple.png')}}" alt="" style="width: 36px; height:36px;">
                </a>
            </div>

            <div class="w-25 h-25 d-flex justify-content-center">           
                <a href="{{$artist-> youtube_link}}">
                    <img src="{{asset('images/links_images/youtube.png')}}" alt="" style="width: 36px; height:36px;">
                </a>
            </div>
        </div>

        <div class="background-block ">
            <div>
                <h2 class="desc-header">About {{$artist -> name}}:</h2>
                <hr>
            </div>
            <div>
                <p class="desc-text" id="desc-text">{{$artist -> description}}</p>
            </div>
            <button class="read-more-button m-0 p-0" data-target="#desc-text" >
                Read more...
            </button>
        </div>
        <div class="background-block mt-5">
            <div >
                <h1 class="comments-header">Comments:</h1>
                <hr>
            </div>
            @if ($comments == 'NO COMMENTS')
                <div>
                    <p>NO COMMENTS</p>
                    <hr>
                </div>
            @else
            <div style="max-height: 500px; overflow-y:auto">
                @foreach($comments as $comment)
                @php
                    $user = DB::table('users')
                        ->where('users.id', $comment->user_id)
                        ->first();
                @endphp
                <div class="d-flex flex-column">
                    <div class="d-flex flex-row" style="height: 5px">
                        <img src="url {{$user -> avatar_url}}" alt="" style="width: 20px; height: 20px; margin-right: 5px; border-radius:200px;">
                        <p>{{$user -> username}}</p>
                    </div>
                    <div class="w-100" style="height: 10px">
                        <p>{{$comment -> content}}</p>
                    </div>
                </div>
                <hr>
                @endforeach
            </div>
            @endif
            <form action="">
                <textarea required placeholder="Add comment"  cols="100" rows="12" wrap="hard" class="comment-input"></textarea>
        </div>
    </div>
</div>

<script>
const readMoreButtons = document.querySelectorAll('.read-more-button');
    readMoreButtons.forEach((button) => {
        button.addEventListener('click', () => {
            const target = document.querySelector(button.dataset.target);
            target.classList.toggle('expanded');
            button.classList.toggle('expanded');

            if (button.classList.contains('expanded')) {
            // Clear the description text
            button.textContent = 'Read less...';
            } else {
            // Restore the description text
            button.textContent = 'Read more...';
    
        }
    });
});

</script>
    
@endsection
    