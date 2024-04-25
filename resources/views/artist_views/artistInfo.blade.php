@extends('layouts.app', ['title' => $artist -> name])

@section('content')
    @php
    $artist_likes = DB::table('like_artists')
                ->where('like_artists.artist_id', $artist->id)
                ->count();

    $crypt_artist = Crypt::encrypt($artist->id);

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
<div class="container d-flex flex-row justify-content-between mb-5">
    <div class="w-25 d-flex flex-column  align-items-center">
        <div>
            <div class="artist-img w-100 d-flex justify-content-center align-items-center">
                <img src="{{url ($artist -> picture_url)}}" alt="" class="Info-Image">
            </div>
        </div>
        <div>
            <h1 class="info-header">{{$artist -> name}}</h1>
        </div>
        <div class="d-flex flex-row justify-content-center align-content-center mb-3">
            @if ($like == 0) 
            <div class="d-flex flex-row">
                <a href="/like-artist/{{$artist -> id}}"><img src="{{asset('images/like.png')}}" alt="" style="width: 22px; height: 22px; margin-right: 6px;"></a>
            </div>
            <div class="white-text">
                <span style="color: white; font-size:20px;"> {{$artist_likes}}</span>
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
                <a href="/unlike-artist/{{$artist -> id}}"><img src="{{asset('images/liked.png')}}" alt="" style="width: 22px; height: 22px; margin-right: 6px;"></a>
            </div>
            <div>
                <span style="color: white; font-size:20px;"> {{$artist_likes}} </span>
            </div>    
            @endif
        </div>

        <div class="w-100 d-flex flex-row justify-content-center mb-4">
            <div class="w-25 h-25 d-flex justify-content-center">           
                <a href="{{$artist-> spotify_link}}" target=”_blank”>
                    <img src="{{asset('images/links_images/spotify.png')}}" alt="" style="width: 36px; height:36px;">
                </a>
            </div>

            <div class="w-25 h-25 d-flex justify-content-center">           
                <a href="{{$artist-> apple_music_link}}" target=”_blank”>
                    <img src="{{asset('images/links_images/apple.png')}}" alt="" style="width: 36px; height:36px;">
                </a>
            </div>

            <div class="w-25 h-25 d-flex justify-content-center">           
                <a href="{{$artist-> youtube_link}}" target=”_blank”>
                    <img src="{{asset('images/links_images/youtube.png')}}" alt="" style="width: 36px; height:36px;">
                </a>
            </div>
        </div>

        <div class="background-block">
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


        <div class="background-block mt-4 mb-4">
            <div >
                <h1 class="comments-header">Comments:</h1>
                <hr>
            </div>
            @if (count($comments) == 0)
                <div class="w-100 d-flex flex-column justify-content-center">
                    <p class="w-100 text-center text-Montserrat">THIS ARTIST HAS NO COMMENTS</p>
                    <hr>
                </div>
            @else
            <div style="max-height: 460px; min-height: 200px; overflow-y:auto; max-width:450px;">
                @foreach($comments as $comment)
                @php
                    $user = DB::table('users')
                        ->where('users.id', $comment->user_id)
                        ->first();
                    $crypt = Crypt::encrypt($user->id);
                @endphp
                <div class=" w-100 d-flex flex-column">
                    <div class="d-flex flex-row align-items-center mb-3" style="height: 35px">
                        <img src=" {{url ($user -> avatar_url)}}" alt="" style="width: 35px; height: 35px; margin-right: 5px; border-radius:200px;">
                        <a href="/user/{{$crypt}}" class="comment-user">{{$user -> username}}</a>
                    </div>
                    <div  class="w-100">
                        <p class="text-Montserrat">{{$comment -> content}}</p>
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
            <form data-mdb-input-init class="mt-3" action="/save-comment-artist" method="post">
                @csrf
                <input type="hidden" name="artist_id" value="{{$artist->id}}">
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
                    <h2 class="artist-tracks-header">POPULAR {{$artist -> name}} TRACKS</h2>
                </div>
                <div class="artist-header-line"></div>
            </div>
        </div>

        @if (count($tracks) == 0)
            <div class="w-100 d-flex flex-column justify-content-center m-5">
                <h1 class="w-100 text-center white-text text-Montserrat text-">THIS ARTIST HAS NO TRACKS</h1>
            </div>
        @else

        <div class="w-94 d-flex flex-column justify-content-between align-items-center mt-3">
            @foreach ($tracks->chunk(2) as $chunk)
                <div class=" d-flex flex-row justify-content-between align-items-center mb-4 w-100">
                    @foreach ($chunk as $track)
                        @php
                            $album = DB::table('albums')
                                        ->where('albums.id', $track->album_id)
                                        ->first();
                            $crypt_track = Crypt::encrypt($track->id);
                            $crypt_album = Crypt::encrypt($album->id);

                            $track_liked = DB::table('like_tracks')
                                        ->where('like_tracks.track_id', $track->id)
                                        ->where('like_tracks.user_id', Auth::id())
                                        ->count();
                        @endphp
                        <a href="/track/{{$crypt_track}}" class="text-decoration-none">
                        <div class="d-flex flex-row track-artist">

                            <div class="d-flex justify-content-center align-items-center h-100">
                                <img src="{{url ($album -> cover_url)}}" alt="" class="track-cover">
                            </div>

                            <div class="w-100">
                                <div class="w-100 d-flex flex-column justify-content-evenly">
                                    <p class="artist-track-name">{{$track -> name}}</p>

                                    <a href="/album/{{$crypt_album}}" class="text-decoration-none"><p class="artist-track-album">{{$album -> name}}</p></a>
                                </div>
                                <div class="d-flex flex-row flex-wrap align-content-end" style="padding: 10px 10px; height:45%;">
                                    <div class="d-flex flex-column justify-content-around">
                                        @if ($track_liked == 1)
                                            <img src="{{asset('images/liked.png')}}" alt="" style="width: 25px; height: 25px; margin-right: 6px;">
                                        @else
                                            <img src="{{asset('images/like.png')}}" alt="" style="width: 25px; height: 25px; margin-right: 6px;">
                                        @endif
                                    </div>
                                    <div>
                                        <span style="color: white; font-size:25px; vertical-align: bottom;"> {{$track -> likes_count}} </span>
                                    </div>  
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            @endforeach
        </div>
        <a class="artist-button flex-wrap" href="/all-tracks/{{$crypt_artist}}">Show all tracks by {{$artist -> name}}</a>
        @endif

        <div class="w-100 d-flex flex-row justify-content-evenly align-content-center">
            <div class="artist-tracks-headers-2 mt-4 w-94">
                <div class="artist-header-line"></div>
                <div>
                    <h2 class="artist-tracks-header">POPULAR {{$artist -> name}} ALBUMS</h2>
                </div>
                <div class="artist-header-line"></div>
            </div>
        </div>

        @if (count($albums) == 0)
            <div class="w-100 d-flex flex-column justify-content-center m-5">
                <h1 class="w-100 text-center white-text text-Montserrat text-">THIS ARTIST HAS NO ALBUMS</h1>
            </div>
        @else
        <div class=" row justify-content-around mt-3 w-94 mb-4">
            @foreach ($albums as $album)
            @php
                $crypt_album = Crypt::encrypt($album->id);
            @endphp
                <div class="col-auto artist-album-card">
                    <a href="/album/{{$crypt_album}}" class="text-decoration-none">
                        <div>
                            <img src="{{url ($album -> cover_url)}}" alt="" style="width: 250px; height: 250px; border-radius: 5px; margin-top:10px; padding: 10px 10px;">
                        </div>
                        <div class="w-100 d-flex justify-content-center text-center white-text">
                            <p class="text-truncate text-Montserrat-album">{{$album -> name}}</p>
                        </div>
                        <div class="w-100 d-flex justify-content-center text-center white-text">
                            <p class="text-truncate text-Montserrat-light">{{$album -> type}} | {{$album -> release_date}}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <a class="artist-button-album flex-wrap" href="/all-albums/{{$crypt_artist}}">Show all albums by {{$artist -> name}}</a>
    </div>
        @endif
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

// Get the text with the `desc-text` class
let descText = document.querySelector('.desc-text').textContent;

// Use the `addLineBreaks` function to replace "\n" with "<br>"
let textWithLineBreaks = addLineBreaks(descText);

// Set the innerHTML of the `desc-text` element to the new text with line breaks
document.querySelector('.desc-text').innerHTML = textWithLineBreaks;

</script>
    
@endsection
    