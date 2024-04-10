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
    <div class="container d-flex flex-row justify-content-between">
    <div class="w-25 d-flex flex-column justify-content-center">
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
                <a href="/like_artist/{{$artist -> id}}"><img src="{{asset('images/like.png')}}" alt="" style="width: 22px; height: 22px; margin-right: 6px;"></a>
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
                <a href="/unlike_artist/{{$artist -> id}}"><img src="{{asset('images/liked.png')}}" alt="" style="width: 22px; height: 22px; margin-right: 6px;"></a>
            </div>
            <div>
                <span style="color: white; font-size:20px;"> {{$artist_likes}} </span>
            </div>    
            @endif
        </div>

        <div class="w-100 d-flex flex-row justify-content-center mb-4">
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


        <div class="background-block mt-4 mb-4">
            <div >
                <h1 class="comments-header">Comments:</h1>
                <hr>
            </div>
            @if ($comments == 'NO COMMENTS')
                <div class="w-100 d-flex flex-column justify-content-center">
                    <p class="w-100 text-center text-Montserrat">NO COMMENTS</p>
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
                    <div class="d-flex flex-row align-items-center mb-3" style="height: 35px">
                        <img src=" {{url ($user -> avatar_url)}}" alt="" style="width: 20px; height: 20px; margin-right: 5px; border-radius:200px;">
                        <p style="height: 10px">{{$user -> username}}</p>
                    </div>
                    <div  class="w-100" style="height: 25px">
                        <p>{{$comment -> content}}</p>
                    </div>
                </div>
                <hr>
                @endforeach
            </div>
            @endif

            @if ($like == 2)
                <form data-mdb-input-init>
                    <textarea required placeholder="Add comment" rows="4" wrap="hard" class="comment-input" readonly></textarea>
                </form>
            @else 
            <form data-mdb-input-init action="/save_comment" method="post">
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
            <div class="artist-tracks-headers">
                <div class="line"></div>
                <div>
                    <h2 class="artist-tracks-header">POPULAR {{$artist -> name}} TRACKS</h2>
                </div>
                <div class="line"></div>
            </div>
        </div>


        <div class="w-100 d-flex flex-column justify-content-evenly align-items-center mt-3">
            @foreach ($tracks->chunk(2) as $chunk)
                <div class=" d-flex flex-row justify-content-evenly align-items-center mb-4 w-100">
                    @foreach ($chunk as $track)

                        @php
                            $album = DB::table('albums')
                                        ->where('albums.id', $track->album_id)
                                        ->first();
                        @endphp

                        <div class="d-flex flex-row track-artist">

                            <div class="d-flex justify-content-center align-items-center">
                                <img src="{{url ($album -> cover_url)}}" alt="" class="track-cover">
                            </div>

                            <div class="w-100">
                                <div class="w-100 d-flex flex-column justify-content-evenly">
                                    <p class="artist-track-name">{{$track -> name}}</p>

                                    <p class="artist-track-album">{{$album -> name}}</p>
                                </div>
                                <div class="d-flex flex-row flex-wrap align-content-end" style="padding: 10px 10px; height:45%;">
                                    <div class="d-flex flex-column justify-content-around">
                                        <img src="{{asset('images/like.png')}}" alt="" style="width: 25px; height: 25px; margin-right: 6px;">
                                    </div>
                                    <div>
                                        <span style="color: white; font-size:25px; vertical-align: bottom;"> {{$track -> likes_count}} </span>
                                    </div>  
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
                <a class="artist-button flex-wrap" href="">Show all tracks by {{$artist -> name}}</a>

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

</script>
    
@endsection
    