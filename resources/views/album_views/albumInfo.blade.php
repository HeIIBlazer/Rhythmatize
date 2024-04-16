@extends('layouts.app', ['title' =>  $album -> name ])

@section('content')
    @php
    $album_likes = DB::table('like_albums')
                ->where('like_albums.album_id', $album->id)
                ->count();

    $artist = \App\Models\Artist::find($album->artist_id);
    
    if (Auth::user() != null) {
        $like = DB::table('like_albums')
            ->where('like_albumss.album_id', $album->id)
            ->where('like_albums.user_id', Auth::user()->id)
            ->count();
    } else {
        $like = 2;
    }   
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
        <div>
            <h1 class="info-header">{{$album -> name}}</h1>
        </div>
        <div class="mb-3">
            <h3 class="artists-lower-text">{{$genre -> name}} | <a href="/artist/{{$artist -> id}}" class="white-text text-decoration-none">{{$artist -> name}}</a></h3>
        </div>
        <div class="d-flex flex-row justify-content-center align-content-center mb-3">
            @if ($like == 0) 
            <div class="d-flex flex-row">
                <a href="/like_album/{{$album -> id}}"><img src="{{asset('images/like.png')}}" alt="" style="width: 22px; height: 22px; margin-right: 6px;"></a>
            </div>
            <div class="white-text">
                <span style="color: white; font-size:20px;"> {{$album_likes}}</span>
            </div>      
            @elseif (Auth::user() == null)
            <div>
                <button class="login_button" data-toggle="modal" data-target="#loginModal"><img src="{{asset('images/like.png')}}" alt="" style="width: 22px; height: 22px; margin-right: 6px;"></button>
            </div>
            <div>
                <span style="color: white; font-size:20px;"> {{$album_likes}}</span>
            </div>    
            @else ($like == 1) 
            <div>
                <a href="/unlike_album/{{$album -> id}}"><img src="{{asset('images/liked.png')}}" alt="" style="width: 22px; height: 22px; margin-right: 6px;"></a>
            </div>
            <div>
                <span style="color: white; font-size:20px;"> {{$$album_likes}} </span>
            </div>    
            @endif
        </div>

        <div class="w-100 d-flex flex-row justify-content-center mb-4">
            <div class="w-25 h-25 d-flex justify-content-center">           
                <a href="{{$album -> spotify_link}}">
                    <img src="{{asset('images/links_images/spotify.png')}}" alt="" style="width: 36px; height:36px;">
                </a>
            </div>

            <div class="w-25 h-25 d-flex justify-content-center">           
                <a href="{{$album -> apple_music_link}}">
                    <img src="{{asset('images/links_images/apple.png')}}" alt="" style="width: 36px; height:36px;">
                </a>
            </div>

            <div class="w-25 h-25 d-flex justify-content-center">           
                <a href="{{$album -> youtube_link}}">
                    <img src="{{asset('images/links_images/youtube.png')}}" alt="" style="width: 36px; height:36px;">
                </a>
            </div>
        </div>

        <div class="background-block">
            <div>
                <h2 class="desc-header">About {{$album -> name}}:</h2>
                <hr>
            </div>
            <div>
                <p class="desc-text" id="desc-text">{{$album -> description}}</p>
            </div>
            <button class="read-more-button m-0 p-0" data-target="#desc-text" >
                Read more...
            </button>
        </div>

        <div class="background-block mt-4">
            <div>
                <h2 class="desc-header">Other {{$artist -> name}} albums:</h2>
                <hr>
            </div>
            <div>
                @foreach ($albums as $artist_album)
                    <div class="d-flex flex-column justify-content-between align-items-center">
                        <a href="/album/{{$artist_album -> id}}" class="white-text text-decoration-none">{{$artist_album -> name}}</a>
                        <a href="/album/{{$artist_album -> id}}"><img src="{{url ($artist_album -> cover_url)}}" alt="" style="width: 50px; height: 50px; object-fit:cover; object-position: 50% 50%;"></a>
                    </div>
                    <hr>
                @endforeach
            </div>
        </div>


        <div class="background-block mt-4 mb-4">
            <div >
                <h1 class="comments-header">Comments:</h1>
                <hr>
            </div>
            @if (count($comments) == 0)
                <div class="w-100 d-flex flex-column justify-content-center">
                    <p class="w-100 text-center text-Montserrat">THIS ALBUM HAS NO COMMENTS</p>
                    <hr>
                </div>
            @else
            <div style="max-height: 460px; min-height: 60px; overflow-y:auto">
                @foreach($comments as $comment)
                @php
                    $user = DB::table('users')
                        ->where('users.id', $comment->user_id)
                        ->first();
                @endphp
                <div class="d-flex flex-column">
                    <div class="d-flex flex-row align-items-center mb-3" style="height: 35px">
                        <img src=" {{url ($user -> avatar_url)}}" alt="" style="width: 20px; height: 20px; margin-right: 5px; border-radius:200px;">
                        <a href="/user/{{$user -> id}}" style="height: 10px">{{$user -> username}}</a>
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
            <form data-mdb-input-init class="mt-3" action="/save_comment" method="post">
                @csrf
                <input type="hidden" name="album_id" value="{{$album->id}}">
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                <textarea required id="textareaId" name="content" placeholder="Add comment" rows="4" wrap="hard" class="comment-input"></textarea>
                {{-- <button type="submit" class="btn btn-primary">Save comment</button> --}}
            </form>
            @endif
        </div>
    </div>

    <div class="w-65 d-flex flex-column align-items-center">
        <div class="w-100 d-flex flex-row justify-content-evenly align-content-center">
            <div class="artist-tracks-headers w-94">
                <div class="artist-header-line"></div>
                <div>
                    <h2 class="artist-tracks-header">{{$album -> name}} Trackslist</h2>
                </div>
                <div class="artist-header-line"></div>
            </div>
        </div>
        <div class="w-100 d-flex flex-column">
            @foreach ($tracks as $track)
                
            @endforeach
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

document.addEventListener('DOMContentLoaded', function() {
    var descText = document.querySelector('.desc-text');
    var readMoreButton = document.querySelector('.read-more-button');

    if (descText.offsetHeight < 199) {
        readMoreButton.style.display = 'none';
    }
});
function addLineBreaks(text) {
    return text.replace(/\n/g, '<br>');
}
let descText = document.querySelector('.desc-text').textContent;
let textWithLineBreaks = addLineBreaks(descText);
document.querySelector('.desc-text').innerHTML = textWithLineBreaks;
</script>
@endsection