@extends('layouts.app', ['title' =>  $album -> name ])

@section('content')
    @php
    $track_likes = DB::table('like_tracks')
                ->where('like_tracks.track_id', $track->id)
                ->count();
    $i = 1;
    $album = \App\Models\Album::find($track->album_id);
    $artist = \App\Models\Artist::find($album->artist_id);
    
    if (Auth::user() != null) {
        $like = DB::table('like_tracks')
            ->where('like_tracks.track_id', $track->id)
            ->where('like_tracks.user_id', Auth::user()->id)
            ->count();
    } else {
        $like = 2;
    }
    
    $spotify_link = $track -> spotify_link;
    $modified_link = substr($spotify_link, 24);

    $crypt_artist = Crypt::encrypt($album->artist_id);
    $crypt_album = Crypt::encrypt($album->id);
    @endphp

    <div style="width: 100%; height: 180px;">
        <img src="{{url ($artist -> banner_url)}}" alt="" style="width: 100%; height: 300px; object-fit:cover; object-position: 50% 50%;">
    </div>
<div class="container d-flex flex-row justify-content-between mb-5">
    <div class="w-25 d-flex flex-column  align-items-center">
        <div>
            <div class="artist-img w-100 d-flex justify-content-center align-items-center">
                <img src="{{url ($album -> cover_url)}}" alt="" class="Info-Image">
            </div>
        </div>
        @if ($track -> explicit == 'YES')      
        <div class="d-flex flex-row align-items-center">
            <h1 class="info-header me-1">{{$track -> name}}</h1>
            <div class="">
                <img src="{{asset('images/explicit.svg')}}" alt="" style="width: 25px; height: 25px;">
            </div>
        </div>
        @else
        <div>
            <h1 class="info-header">{{$track -> name}}</h1>
        </div>
        @endif
        <div class="mb-3">
            <h3 class="artists-lower-text"><a href="/album/{{$album -> id}}">{{$album -> name}}</a> | <a href="/artist/{{$crypt_artist}}" class="white-text text-decoration-none">{{$artist -> name}}</a></h3>
        </div>
        <div class="d-flex flex-row justify-content-center align-content-center mb-3">
            @if ($like == 0) 
            <div class="d-flex flex-row">
                <a href="/like_track/{{$track -> id}}">
                    <img src="{{asset('images/like.png')}}" alt="" style="width: 22px; height: 22px; margin-right: 6px;">
                </a>
            </div>
            <div class="white-text">
                <span style="color: white; font-size:20px;"> {{$track_likes}}</span>
            </div>      
            @elseif (Auth::user() == null)
            <div>
                <button class="login_button" data-toggle="modal" data-target="#loginModal"><img src="{{asset('images/like.png')}}" alt="" style="width: 22px; height: 22px; margin-right: 6px;"></button>
            </div>
            <div>
                <span style="color: white; font-size:20px;"> {{$track_likes}}</span>
            </div>    
            @else ($like == 1) 
            <div>
                <a href="/unlike_track/{{$track -> id}}"><img src="{{asset('images/liked.png')}}" alt="" style="width: 22px; height: 22px; margin-right: 6px;"></a>
            </div>
            <div>
                <span style="color: white; font-size:20px;"> {{$track_likes}} </span>
            </div>    
            @endif
        </div>

        <div class="w-100 d-flex flex-row justify-content-center mb-4">
            <div class="w-25 h-25 d-flex justify-content-center">           
                <a href="{{$track -> spotify_link}}">
                    <img src="{{asset('images/links_images/spotify.png')}}" alt="" style="width: 36px; height:36px;">
                </a>
            </div>

            <div class="w-25 h-25 d-flex justify-content-center">           
                <a href="{{$track -> apple_music_link}}">
                    <img src="{{asset('images/links_images/apple.png')}}" alt="" style="width: 36px; height:36px;">
                </a>
            </div>

            <div class="w-25 h-25 d-flex justify-content-center">           
                <a href="{{$track -> youtube_link}}">
                    <img src="{{asset('images/links_images/youtube.png')}}" alt="" style="width: 36px; height:36px;">
                </a>
            </div>
        </div>

        <div class="background-block">

        </div>


        <div class="background-block mt-4 mb-4">
            <div >
                <h1 class="comments-header">Comments:</h1>
                <hr>
            </div>
            @if (count($comments) == 0)
                <div class="w-100 d-flex flex-column justify-content-center">
                    <p class="w-100 text-center text-Montserrat">THIS TRACK HAS NO COMMENTS</p>
                    <hr>
                </div>
            @else
            <div style="max-height: 460px; min-height: 60px; overflow-y:auto; max-width:600px;">
                @foreach($comments as $comment)
                @php
                    $user = DB::table('users')
                        ->where('users.id', $comment->user_id)
                        ->first();
                    $crypt_user = Crypt::encrypt($user->id);
                @endphp
                <div class="d-flex flex-column">
                    <div class="d-flex flex-row align-items-center mb-3" style="height: 35px">
                        <img src=" {{url ($user -> avatar_url)}}" alt="" style="width: 20px; height: 20px; margin-right: 5px; border-radius:200px;">
                        <a href="/user/{{$crypt_user}}" class="comment-user">{{$user -> username}}</a>
                    </div>
                    <div  class="w-100">
                        <p>{{$comment -> content}}</p>
                    </div>
                </div>
                <hr>
                @endforeach
            </div>
            @endif

            @if ($like == 2)
                <form data-mdb-input-init class="mt-3">
                    <textarea required placeholder="Add comment" rows="4" wrap="hard" class="comment-input" readonly></textarea>
                </form>
            @else 
            <form data-mdb-input-init class="mt-3" action="/save_comment_album" method="post">
                @csrf
                <input type="hidden" name="track_id" value="{{$track->id}}">
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                <textarea required id="textareaId" name="content" placeholder="Add comment" rows="4" wrap="hard" class="comment-input"></textarea>
                {{-- <button type="submit" class="btn btn-primary">Save comment</button> --}}
            </form>
            @endif
        </div>
        <div class="w-100">
            <iframe style="border-radius:12px" src="https://open.spotify.com/embed/{{$modified_link}}?utm_source=generator&theme=0" width="100%" height="150" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
        </div>
    </div>

    <div class="w-65 d-flex flex-column align-items-center">
        <div class="w-100 d-flex flex-row justify-content-evenly align-content-center">
            <div class="artist-tracks-headers w-94">
                <div class="artist-header-line"></div>
                <div>
                    <h2 class="artist-tracks-header">{{$track -> name}} LYRICS</h2>
                </div>
                <div class="artist-header-line"></div>
            </div>
        </div>
        <div class="w-100 mt-3">
            <p class="desc-text-1 white-text">
                {{$track -> lyrics}}
            </p>
        </div>
        
    </div>
</div>

<script>

const commentInput = document.querySelector('.comment-input');
const loginModal = document.querySelector('#loginModal');

commentInput.addEventListener('click', () => {
    if (commentInput.hasAttribute('readonly')) {
        $('#loginModal').modal('show');
    }
});

const textarea = document.querySelector('.comment-input');

textarea.addEventListener('keypress', (e) => {
    // Check if the enter key is pressed
    if (e.which === 13 && !e.shiftKey) {
        e.preventDefault();

        // Submit the form
        textarea.closest('form').submit();
    }
});

function addLineBreaks(text) {
    return text.replace(/\n/g, '<br>');
}
let descText = document.querySelector('.desc-text-1').textContent;
let textWithLineBreaks = addLineBreaks(descText);
document.querySelector('.desc-text-1').innerHTML = textWithLineBreaks;
</script>
@endsection