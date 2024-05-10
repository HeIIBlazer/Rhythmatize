@extends('layouts.app', ['title' => $album -> name])

@section('content')
    @php
    $album_likes = DB::table('like_albums')
                ->where('like_albums.album_id', $album->id)
                ->count();
    $i = 1;
    $artist = \App\Models\Artist::find($album->artist_id);
    
    if (Auth::user() != null) {
        $like = DB::table('like_albums')
            ->where('like_albums.album_id', $album->id)
            ->where('like_albums.user_id', Auth::user()->id)
            ->count();
    } else {
        $like = 2;
    }   

    $crypt_artist = Crypt::encrypt($album->artist_id);
    @endphp

    <div style="width: 100%; height: 180px;">
        <img src="{{secure_url ($artist -> banner_url)}}" alt="" style="width: 100%; height: 300px; object-fit:cover; object-position: 50% 50%;">
    </div>
<div class="container d-flex flex-column flex-lg-row justify-content-between align-items-center align-items-lg-none mb-5">
    <div class="w-95 w-lg-25 d-flex flex-column align-items-center">
        <div>
            <div class="artist-img w-100 d-flex justify-content-center align-items-center">
                <img src="{{secure_url ($album -> cover_url)}}" alt="" class="Info-Image">
            </div>
        </div>
        <div>
            <h1 class="info-header">{{$album -> name}}</h1>
        </div>
        <div class="mb-0">
            <p class="artists-lower-text ">
                {{$album -> type}} | {{$genre -> name}} | {{$album -> release_date}} 
            </p>
        </div>
        <div class="mb-3 mt-0">
            <a href="/artist/{{$crypt_artist}}" class="white-text text-decoration-none"><h3 class="artists-lower-text">{{$artist -> name}}</a></h3>
        </div>
        <div class="d-flex flex-row justify-content-center align-content-center mb-3">
            @if ($like == 0) 
            <div class="d-flex flex-row">
                <a href="/like-album/{{$album -> id}}">
                    <img src="{{asset('images/like.png')}}" alt="" style="width: 22px; height: 22px; margin-right: 6px;">
                </a>
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
                <a href="/unlike-album/{{$album -> id}}"><img src="{{asset('images/liked.png')}}" alt="" style="width: 22px; height: 22px; margin-right: 6px;"></a>
            </div>
            <div>
                <span style="color: white; font-size:20px;"> {{$album_likes}} </span>
            </div>    
            @endif
        </div>

        <div class="w-100 d-flex flex-row justify-content-center mb-4">
            <div class="w-25 h-25 d-flex justify-content-center">           
                <a href="{{$album -> spotify_link}}" target=”_blank”>
                    <img src="{{asset('images/links_images/Spotify.png')}}" alt="" style="width: 36px; height:36px;">
                </a>
            </div>

            <div class="w-25 h-25 d-flex justify-content-center">           
                <a href="{{$album -> apple_music_link}}" target=”_blank”>
                    <img src="{{asset('images/links_images/apple.png')}}" alt="" style="width: 36px; height:36px;">
                </a>
            </div>

            <div class="w-25 h-25 d-flex justify-content-center">           
                <a href="{{$album -> youtube_link}}" target=”_blank”>
                    <img src="{{asset('images/links_images/youtube.png')}}" alt="" style="width: 36px; height:36px;">
                </a>
            </div>
        </div>

        <div class="background-block">
            @if ($album -> description == 'NO INFO')
                <div>
                    <h2 class="desc-header">About {{$album -> name}}:</h2>
                    <hr>
                </div>
                <div>
                    <p class="w-100 found-nothing">THERE IS NO INFO ABOUT THIS ALBUM</p>
                </div>
            @else
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
            @endif

        </div>

        <div class=" w-100 background-block mt-4 p-2">
            <div>
                <h2 class="desc-header ">Other {{$artist -> name}} albums:</h2>
                <hr>
            </div>
            @if ( $albums->count() == 0)
            <div>
                <p class="w-100 found-nothing">THERE IS NO OTHER ALBUMS</p>
                <hr>
            </div>
            <div class="w-100">
                <p class="text-center mb-3">
                    <a href="/artist/{{$crypt_artist}}" class="all-button">Return to artist</a>
                </p>
            </div>
            @else
            <div class=" w-100 d-flex flex-row justify-content-evenly mb-3">
                @foreach ($albums as $artist_album)
                @php
                    $crypt_album = Crypt::encrypt($artist_album->id);
                @endphp
                    <div class="d-flex flex-column justify-content-between align-items-center w-100 h-100">
                        <a href="/album/{{$crypt_album}}">
                            <div class="album-cover w-100 h-100 d-flex flex-row align-items-center justify-content-center">
                                <img src="{{secure_url($artist_album -> cover_url)}}" alt="Album Cover" class="img-fluid alb" style="width: 90%; height: 90%;">
                                <div class="album-info d-flex flex-column justify-content-center align-items-center text-center">
                                    <h2 class="album-name-main h-25">{{$artist_album -> name}}</h2>
                                    <p class="album-year">{{$artist_album -> release_date}}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <hr>
            <div class="w-100 d-flex justify-content-center align-content-center">
                <a href="/all-albums/{{$crypt_artist}}" class="all-button text-center">View all {{$artist -> name}} albums</a>
            </div>
            @endif
        </div>


        <div class="background-block mt-4 mb-lg-4 ">
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
            <div style="max-height: 460px; min-height: 60px; overflow-y:auto; max-width:600px;">
                @foreach($comments as $comment)
                @php
                    $user = DB::table('users')
                        ->where('users.id', $comment->user_id)
                        ->first();
                    $crypt_user = Crypt::encrypt($user->id);


                @endphp
                <div class="d-flex flex-column">
                    <div class="d-flex flex-row justify-content-between align-items-center">
                        <div class="d-flex flex-row align-items-center mb-3" style="height: 35px">
                            <img src=" {{secure_url ($user -> avatar_url)}}" alt="" style="width: 35px; height: 35px; margin-right: 5px; border-radius:200px;">
                            <a href="/user/{{$crypt_user}}" class="comment-user">{{$user -> username}}</a>
                        </div>
                        @if ($like != 2)
                            @if(Auth::user()->role == 'admin' || Auth::user()->id == $comment -> user_id)
                            <a data-toggle="modal" data-target="#deleteCommentModal" class="text-decoration-none mb-3 cursor-pointer">
                                <span aria-hidden="true" style="font-size:30px;" class="white-text">&times;</span>
                            </a>
                            @endif
                        @endif
                    </div>
                    <div  class="w-100">
                        <p>{{$comment -> content}}</p>
                    </div>
                </div>
                <hr>
                <div class="modal fade" id="deleteCommentModal" tabindex="-1" role="dialog" aria-labelledby="deleteCommentLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content border-b">
                            <div class="login">
                                <div class="w-100">
                                    <div cl>
                                        <h1 class="confirmation-header mt-3 mb-3">CONFIRMATION</h1>
                                    </div>
                                    
                                    <div id="confirmation_text_track" class="d-flex w-100 flex-column justify-content-center align-items-center mt-5 mb-5">
                                        <p class="confirmation-text">
                                            Are you sure you want to delete this comment?
                                        </p>
                                    </div>
        
                                    <div class="d-flex flex-row w-100 mt-2 mb-3 justify-content-evenly">
                                        <div id="submit_delete_track" class="w-50">
                                            <a href="/delete-album-comment/{{$comment -> id}}" class="save-button-confirmation text-decoration-none">
                                                <button type="submit" class="buttons-inside-confirm">DELETE</button>
                                            </a>
                                        </div>
                                        <div class="cancel-button-confirmation">
                                            <button data-dismiss="modal" form aria-label="Close" class="buttons-inside-cancel" id="cancel">CANCEL</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif

            @if ($like == 2)
                <form data-mdb-input-init class="mt-3">
                    <textarea required placeholder="Add comment" rows="4" wrap="hard" class="comment-input" readonly></textarea>
                </form>
            @else 
            <form data-mdb-input-init class="mt-3" action="/save-comment-album" method="post">
                @csrf
                <input type="hidden" name="album_id" value="{{$album->id}}">
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                <textarea required id="textareaId" name="content" placeholder="Add comment" rows="4" wrap="hard" class="comment-input"></textarea>
                {{-- <button type="submit" class="btn btn-primary">Save comment</button> --}}
            </form>
            @endif
        </div>
    </div>

    <div class="w-95 w-lg-65 d-flex flex-column align-items-center">
        <div class="w-100 d-flex flex-row justify-content-evenly align-content-center">
            <div class="artist-tracks-headers w-94">
                <div class="artist-header-line"></div>
                <div>
                    <h2 class="artist-tracks-header">{{$album -> name}} Trackslist</h2>
                </div>
                <div class="artist-header-line"></div>
            </div>
        </div>
        @if (count($tracks) == 0)
            <div class="w-100 d-flex flex-column justify-content-center">
                <h1 class="w-100 text-center white-text text-Montserrat mt-2">THIS ALBUM HAS NO TRACKS FOR NOW</h1>
            </div>
        @else
        <div class="w-100 mt-3">
            <table class="w-100">
            @foreach ($tracks as $track)
                @php
                    $track_likes = DB::table('like_tracks')
                        ->where('like_tracks.track_id', $track->id)
                        ->count();
                    $crypt_track = Crypt::encrypt($track->id);

                    $liked_tracks = DB::table('like_tracks')
                        ->where('like_tracks.track_id', $track->id)
                        ->where('like_tracks.user_id', Auth::id())
                        ->count();
                @endphp
                <tr href="/track/{{$crypt_track}}" style="border-bottom: white solid 1px">
                        <td style="width: 5%;" class="table-separete">
                            <a href="/track/{{$crypt_track}}" class="text-decoration-none">    
                                <div class="number w-100">
                                    <span class="number-album w-100">{{$i}}.</span>
                                </div>
                            </a>
                        </td>
                        <td style="width: 50%;" class="table-separete">
                            <a href="/track/{{$crypt_track}}" class="text-decoration-none">  
                                <div class="w-100">
                                    <span class="album-track w-100">{{$track -> name}}</span>
                                </div>
                            </a>
                        </td>
                        <td style="width: 15%;" class="table-separete">
                            <a href="/track/{{$crypt_track}}" class="text-decoration-none">
                            @if($track -> explicit != 'NO')
                                <img src="{{asset('images/explicit.svg')}}" alt="" style="width:25px; height:25px; margin-left: 5px;">
                            @endif
                            </a>
                        </td>
                        <td style="width: 15%;" class="table-separete">
                            <a href="/track/{{$crypt_track}}" class="text-decoration-none">
                            @if ($track -> lyrics != null)
                                <span class="number-album">Lyrics</span>
                            @else
                                <span class="number-album">No Lyrics</span>
                            @endif
                            </a>
                        </td>
                        <td style="width: 10%;" class="table-separete">
                            <a href="/track/{{$crypt_track}}" class="text-decoration-none">
                                <div class="d-flex flex-row justify-content-end">
                                    <div class="d-flex flex-row justify-content-center align-content-center align-items-center w-50">
                                        @if ($liked_tracks == 1)
                                            <img src="{{asset('images/liked.png')}}" alt="" style="width: 22px; height: 22px; margin-right: 6px;">
                                        @else
                                            <img src="{{asset('images/like.png')}}" alt="" style="width: 22px; height: 22px; margin-right: 6px;">
                                        @endif
                                    </div>
                                    <div class="white-text d-flex flex-row w-25">
                                        <span style="color: white; font-size:25px;"> {{$track_likes}}</span>
                                    </div>
                                </div>
                            </a>
                        </td>
                    </tr>
                @php
                    $i++;
                    $liked_tracks = 0;
                @endphp
            @endforeach
            </table>
        @endif
        
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