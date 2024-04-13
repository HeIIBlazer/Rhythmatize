@extends('layouts.app', ['title' => $user -> username])

@section('content')

<div style="width: 100%; height: 180px;">
    <img src="{{url ($user -> banner_url)}}" alt="" style="width: 100%; height: 300px; object-fit:cover; object-position: 50% 50%;">
</div>
<div class="container d-flex flex-row justify-content-between mb-5">
    <div class="w-25 d-flex flex-column  align-items-center">
        <div>
            <div class="artist-img w-100 d-flex justify-content-center align-items-center">
                <img src="{{url ($user -> avatar_url)}}" alt="" class="Info-Image">
            </div>
        </div>
        <div>
            <h1 class="info-header">{{$user -> username}}</h1>
        </div>
        @if (Auth::check() && Auth::user()->id == $user->id)
            <div class="d-flex flex-row justify-content-center align-items-center">
                <a class="edit-button">EDIT</a>
            </div>
        @else 
        @endif

        <div class="background-block">
            <div>
                <h2 class="desc-header">About {{$user -> username}}:</h2>
                <hr>
            </div>
            @if ($user -> description == "NO DESCRIPTION" || $user -> description == 0)
                <div>
                    <p class="desc-text text-center">THIS USER DOES NOT HAVE A DESCRIPTION</p>
                </div>
            @else
            <div>
                <p class="desc-text" id="desc-text">{{$user -> description}}</p>
            </div>
            <button class="read-more-button m-0 p-0" data-target="#desc-text" >
                Read more...
            </button>
            @endif
        </div>

    </div>


    <div class="w-65 d-flex flex-column align-items-center">

        <div class="w-100 artist-tracks-headers  d-flex flex-row justify-content-evenly align-content-center">
            <div class="artist-tracks-headers-2 mt-4 w-94">
                <div class="artist-header-line"></div>
                <div>
                    <h2 class="artist-tracks-header">artists liked by {{$user -> username}} </h2>
                </div>
                <div class="artist-header-line"></div>
            </div>
        </div>

        @if (count($artists) == 0)
            <div class="w-100 d-flex flex-column justify-content-center m-5">
                <h1 class="w-100 text-center white-text text-Montserrat text-">THIS USER DID NOT LIKED AN ARTIST YET</h1>
            </div>
        @else
        <div class="row justify-content-evenly mt-3 w-94 mb-4">
            @foreach ($artists as $artist)
                <a href="/artist/{{$artist -> id}}" class=" text-decoration-none col-auto artist-album-card pb-3">
                    <div class="mb-3">
                        <img src="{{url ($artist -> picture_url)}}" alt="" style="width: 250px; height: 250px; border-radius: 5px; margin-top:10px; padding: 10px 10px; object-fit:cover;">
                    </div>
                    <div class="w-100 d-flex justify-content-center  text-center white-text">
                        <p class="text-truncate  text-Montserrat-album">{{$artist -> name}}</p>
                    </div>
                </a>
            @endforeach
        </div>
        <a class="artist-button-album flex-wrap" href="">Show all liked artists</a>
        @endif

        <div class="w-100 d-flex flex-row justify-content-evenly align-content-center">
            <div class="artist-tracks-headers-2 mt-4 w-94">
                <div class="artist-header-line"></div>
                <div>
                    <h2 class="artist-tracks-header">artists liked by {{$user -> username}} </h2>
                </div>
                <div class="artist-header-line"></div>
            </div>
        </div>

        @php
            $artist = DB::table('artists')
                        ->where('artists.id', $user->id)
                        ->first();  
        @endphp

        @if (count($albums) == 0)
            <div class="w-100 d-flex flex-column justify-content-center m-5">
                <h1 class="w-100 text-center white-text text-Montserrat text-">THIS USER DID NOT LIKED AN ALBUM YET</h1>
            </div>
        @else
        <div class="row justify-content-evenly mt-3 w-94 mb-4">
            @foreach ($albums as $album)
            @php
            $artist = DB::table('artists')
                        ->where('artists.id', $album->artist_id)
                        ->first();  
            @endphp
                <div class="col-auto artist-album-card pb-3">
                    <div >
                        <img src="{{url ($album -> cover_url)}}" alt="" style="width: 250px; height: 250px; border-radius: 5px; margin-top:10px; padding: 10px 10px;">
                    </div>
                    <div class="w-100 d-flex justify-content-center text-center white-text">
                        <p class="text-truncate text-Montserrat-album">{{$album -> name}}</p>
                    </div>
                    <div class="w-100 d-flex justify-content-center text-center white-text">
                        <a href="/artist/{{$artist -> id}}" class="text-truncate artist-track-album ">{{$album -> type}} | {{$album -> release_date}} | {{$artist -> name}}</a>
                    </div>
                </div>
            @endforeach
        </div>
        <a class="artist-button-album flex-wrap" href="">Show all liked albums</a>
        @endif

        <div class="w-100 d-flex flex-row justify-content-evenly align-content-center">
            <div class="d-flex justify-content-center align-items-center w-94 mt-5">
                <div class="artist-header-line"></div>
                <div>
                    <h2 class="artist-tracks-header">Tracks Liked By {{$user -> username}}</h2>
                </div>
                <div class="artist-header-line"></div>
            </div>
        </div>

        @if (count($tracks) == 0)
            <div class="w-100 d-flex flex-column justify-content-center m-5">
                <h1 class="w-100 text-center white-text text-Montserrat text-">THIS USER DID NOT LIKED A TRACK YET/h1>
            </div>
        @else
        <div class="w-94 d-flex flex-column mt-3">
            @foreach ($tracks->chunk(2) as $chunk)
                <div class=" d-flex flex-row justify-content-around mb-4  w-100">
                    @foreach ($chunk as $track)

                        @php
                            $album = DB::table('albums')
                                        ->where('albums.id', $track->album_id)
                                        ->first();
                            $artist = DB::table('artists')
                                        ->where('artists.id', $album->artist_id)
                                        ->first();
                        @endphp

                        <div class="d-flex flex-row track-artist mr-2">

                            <div class="d-flex  align-items-center">
                                <img src="{{url ($album -> cover_url)}}" alt="" class="track-cover">
                            </div>

                            <div class="w-100">
                                <div class="w-100 d-flex flex-column justify-content-evenly">
                                    <p class="artist-track-name">{{$track -> name}}</p>

                                    <p class="artist-track-album">{{$album -> name}}</p>
                                </div>
                                <div class="d-flex flex-row flex-wrap align-content-end pb-3 h-50">
                                    <a href="/artist/{{$artist -> id}}" class="artist-track-album ">{{$artist -> name}}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
        <a class="artist-button flex-wrap" href="">Show all liked tracks</a>
        @endif
    </div>

    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-b">
                <div class="login">
                    <div class="w-100">
                        <div>
                            <h1 class="login-header">EDIT YOUR PROFILE</h1>
                        </div>
                        
                        @if (session()->has('error_login'))
                            <div class="alert error-login">
                                {{session()->get('error_login')}}
                            </div>
                        @endif
                        <div class="d-flex w-100 flex-column justify-content-center align-items-center">
                            <form action="{{url('/login_auth')}}" method="POST" class="form">
                                @csrf
                                <div class="w-100 d-flex justify-content-center align-center mt-2">
                                    <input type="email" class="login-input" name="email" placeholder="Email" required autofocus>
                                </div>
                                <div class="w-100 d-flex justify-content-center align-center mt-3 mb-4">
                                    <input type="password" class="login-input" name="password" placeholder="Password" minlength="6" required>
                                </div>
                                <div class="w-100 d-flex justify-content-center mt-2 mb-4">
                                    <button type="submit" class="login-button" name="login">Log in</button>
                                </div>
                            </form>
                            <hr style="border: 1px solid white; width:80%;">
                            <div class="mb-3">
                                <p class="login-undertext">You don't have an account? <a data-toggle="modal" data-target="#signupModal" data-dismiss="modal" aria-label="Close" class="login-undertext-button">Create account here.</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

// Get the text with the `desc-text` class
let descText = document.querySelector('.desc-text').textContent;

// Use the `addLineBreaks` function to replace "\n" with "<br>"
let textWithLineBreaks = addLineBreaks(descText);

// Set the innerHTML of the `desc-text` element to the new text with line breaks
document.querySelector('.desc-text').innerHTML = textWithLineBreaks;

</script>
    
@endsection
    