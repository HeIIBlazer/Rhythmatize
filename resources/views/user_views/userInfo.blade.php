@extends('layouts.app', ['title' => $user -> username])

@section('content')

@php
    $crypt_user = Crypt::encrypt($user -> id);
@endphp

<div style="width: 100%; height: 180px;">
    <img src="{{url ($user -> banner_url)}}" alt="" style="width: 100%; height: 300px; object-fit:cover; object-position: 50% 50%;">
</div>
<div class="container d-flex flex-lg-row flex-column justify-content-between mb-5">
    <div class="w-lg-25 w-100 d-flex flex-column  align-items-center">
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
                <button class="edit-button" data-toggle="modal" data-target="#editModal">EDIT</button>
            </div>
        @endif

        <div class="background-block">
            <div>
                <h2 class="desc-header">About {{$user -> username}}:</h2>
                <hr>
            </div>
            @if ($user -> description == null)
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


    <div class="w-lg-65 w-100  d-flex flex-column align-items-center">

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
            @php
                $crypt_artist = Crypt::encrypt($artist -> id);
            @endphp
                <a href="/artist/{{$crypt_artist}}" class=" text-decoration-none col-auto artist-album-card pb-3 mt-4 mt-lg-0">
                    <div class="mb-3">
                        <img src="{{url ($artist -> picture_url)}}" alt="" style="width: 250px; height: 250px; border-radius: 5px; margin-top:10px; padding: 10px 10px; object-fit:cover;">
                    </div>
                    <div class="w-100 d-flex justify-content-center  text-center white-text">
                        <p class="text-truncate text-Montserrat-album">{{$artist -> name}}</p>
                    </div>
                </a>
            @endforeach
        </div>
        <a class="artist-button-album flex-wrap" href="/liked-artists/{{$crypt_user}}">Show all liked artists</a>
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
        <div class="row justify-content-evenly mt-3 w-94 mb-4 ">
            @foreach ($albums as $album)
            @php
            $artist = DB::table('artists')
                        ->where('artists.id', $album->artist_id)
                        ->first();
            $crypt_album = Crypt::encrypt($album-> id);
            $crypt_artist = Crypt::encrypt($artist -> id);
            @endphp
            <div class="col-auto mt-3 mt-lg-0 artist-album-card" style="width: 250px;">
                <a href="/album/{{$crypt_album}}" class="text-decoration-none">
                    <div>
                        <img src="{{url ($album -> cover_url)}}" alt="" style="width: 100%; height: 250px; border-radius: 5px; margin-top:10px; padding: 10px 10px;">
                    </div>
                    <div class="w-100 d-flex justify-content-center text-center white-text overflow-hidden">
                        <p class="text-Montserrat-album">{{$album -> name}}</p>
                    </div>
                    <div class="w-100 d-flex justify-content-center text-center white-text mb-3 mb-lg-0 overflow-hidden">
                        <a href="/artist/{{$crypt_artist}}" class="artist-track-album">
                            {{$album -> type}} | {{$album -> release_date}} | {{$artist -> name}}
                        </a>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        <a class="artist-button-album flex-wrap" href="/liked-albums/{{$crypt_user}}">Show all liked albums</a>
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
                <h1 class="w-100 text-center white-text text-Montserrat text-">THIS USER DID NOT LIKED A TRACK YET</h1>
            </div>
        @else
        <div class="w-94 d-flex flex-column justify-content-between align-items-center mt-3">
            @foreach ($tracks->chunk(2) as $chunk)
                <div class=" d-flex flex-lg-row justify-content-between align-items-center mb-4 w-100 flex-column">
                    @foreach ($chunk as $track)

                        @php
                            $album = DB::table('albums')
                                        ->where('albums.id', $track->album_id)
                                        ->first();
                            $artist = DB::table('artists')
                                        ->where('artists.id', $album->artist_id)
                                        ->first();

                            $crypt_track = Crypt::encrypt($track -> id);
                        @endphp

                        <div class="d-flex flex-row track-artist mr-2 mt-lg-0 mt-5">
                            <a href="/track/{{$crypt_track}}" class="text-decoration-none">
                                <div class="d-flex  align-items-center h-100">
                                    <img src="{{url ($album -> cover_url)}}" alt="" class="track-cover">
                                </div>

                                <div class="w-100">
                                    <div class="w-100 d-flex flex-column justify-content-evenly">
                                        <p class="artist-track-name">{{$track -> name}}</p>

                                        <p class="artist-track-album">{{$album -> name}}</p>
                                    </div>
                                    <div class="d-flex flex-row flex-wrap align-content-end pb-3 h-50">
                                        <a href="/artist/{{$artist -> id}}" class="artist-track-album">{{$artist -> name}}</a>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
        <a class="artist-button flex-wrap" href="/liked-tracks/{{$crypt_user}}">Show all liked tracks</a>
        @endif
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content border-b">
                <div class="edit">
                    <div class="w-100">
                        <div>
                            <h1 class="edit-header mt-3">EDIT YOUR PROFILE</h1>
                        </div>
                    </div>
                        @if (session()->has('error'))
                            <div class="alert error-login-2">
                                {{session()->get('error')}}
                            </div>
                        @endif
                        <div class="d-flex w-100 flex-column justify-content-between">
                            <form action="/update/{{$user -> id}}" method="POST" class="form" enctype="multipart/form-data" id="edit">
                                @csrf
                                <div class="w-100">
                                    <div class=" w-100 h-100 d-flex flex-column flex-lg-row justify-content-center align-items-lg-none align-items-center">
                                        <div class="d-flex flex-column align-items-center align-content-center justify-content-center w-100 w-lg-50">
                                            <div class="d-flex h-50 align-items-center justify-content-center flex-column align-content-center" >
                                                <div class="d-flex justify-content-center" style="border:3px solid #808080;border-radius: 5px; height: 200px;">
                                                    <img id="imagePreview" src="{{$user -> avatar_url}}" alt="Image preview" style="width:100%; height: 100%;  object-fit:fill" class="mb-2"/>
                                                </div>
                                                <input type="file" id="imageInput" name="avatar_url" class="img-input" value="{{$user -> avatar_url}}">
                                                <label for="imageInput"  id="imageInputLabel" class="edit-change-button m-0">CHANGE AVATAR</label>
                                            </div>

                                            <div class="d-flex w-100 h-50 align-items-center flex-column align-center mt-3" style="padding: 10px">
                                                <div class="d-flex w-100 justify-content-center" style="border:3px solid #808080;border-radius: 5px; height: 200px; width: 100%;">
                                                    <img id="bannerPreview" src="{{$user -> banner_url}}" alt="banner preview" style="object-fit:contain" class="mb-2 w-100 h-100"/>
                                                </div>
                                                <input type="file" id="bannerInput" name="banner_url" class="img-input" value="{{$user -> banner_url}}">
                                                <label for="bannerInput"  id="bannerInputLabel" class="edit-change-button m-0">CHANGE BANNER</label>
                                            </div>
                                        </div>

                                        <div class="w-100 w-lg-50 d-flex flex-column align-items-lg-baseline align-items-center ">
                                            <div class="w-100 d-flex justify-content-center align-items-center align-items-lg-none mt-2 flex-column">
                                                <label class="label-edit" for="username">USERNAME</label>
                                                <input type="text" class="edit-input" name="username" id="username" placeholder="Username" value="{{$user -> username}}">
                                            </div>

                                            <div class="w-100 d-flex flex-column mt-2 align-items-center align-items-lg-none">
                                                <label class="label-edit" for="description">BIO</label>
                                                <textarea name="description" id="description" placeholder="Add description" rows="4" wrap="hard" class="edit-input" style="height: 210px">{{$user -> description}}</textarea>
                                            </div>

                                            <div class="w-100 d-flex flex-column mt-2 align-items-center align-items-lg-none">
                                                <label class="label-edit" for="email">EMAIL</label>
                                                <input type="email" id="email" placeholder="Email" class="edit-input" name="email" value="{{$user -> email}}">
                                            </div>

                                            <div class="w-100 d-flex flex-column justify-content-center align-center mt-2 align-items-center align-items-lg-none">
                                                <label class="label-edit" for="password">ENTER YOUR PASSWORD TO CONFIRM</label>
                                                <input type="password" class="edit-input" name="password" placeholder="Current Password" minlength="6" required>
                                            </div>
                                            
                                            <div class="w-100 d-flex flex-column justify-content-center  mt-2 align-items-center align-items-lg-none">
                                                <label class="label-edit" for="new_password">NEW PASSWORD</label>
                                                <input type="password" class="edit-input" name="new_password" placeholder="New Password" minlength="6">
                                            </div>
                                            
                                            <div class="w-100 d-flex flex-column justify-content-center align-items-center align-items-lg-none mt-2 mb-3">
                                                <label class="label-edit" for="password_confirmation">CONFIRM PASSWORD</label>
                                                <input type="password" class="edit-input" name="password_confirmation" placeholder=" Confirm Password" minlength="6">
                                            </div>

                                        </div>
                                    </div>

                                    <div class="d-flex flex-lg-row flex-column w-100 mt-2 mb-3 justify-content-evenly align-items-lg-none align-items-center">
                                        <div class=" mb-lg-0 mb-3">
                                            <button type="submit" class="save-button">SAVE</button>
                                        </div>
                                        <div class="">
                                            <button data-dismiss="modal" form aria-label="Close" class="cancel-button" id="cancel">CANCEL</button>
                                        </div>
                                    </div>
                                </div>
                                    
                            </form>
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

const bannerInput = document.getElementById('bannerInput');
const bannerPreview = document.getElementById('bannerPreview');
const bannerInputLabel = document.getElementById('bannerInputLabel');

bannerInput.addEventListener('change', function(event1) {
    const file_banner = event1.target.files[0];
    const reader_banner = new FileReader();
    const fileName_banner = event1.target.files[0].name;

    reader_banner.onload = function(event1) {
    bannerPreview.src = event1.target.result;
    bannerInputLabel.textContent = fileName_banner;
    };
    reader_banner.readAsDataURL(file_banner);
});


const cancel = document.getElementById("cancel");

cancel.addEventListener('click',() => {
    bannerPreview.src = '{{$user -> banner_url}}';
    bannerInputLabel.textContent = 'CHANGE BANNER';
    imagePreview.src = '{{$user -> avatar_url}}';
    imageInputLabel.textContent = 'CHANGE AVATAR';

    document.getElementById("edit").reset();
}); 

</script>
    
@endsection
    