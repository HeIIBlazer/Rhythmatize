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
            <a href="/artist/{{$crypt_artist}}" class="white-text text-decoration-none"><h3 class="artists-lower-text">Track length: {{$track -> time}} | {{$artist -> name}}</a></h3>
        </div>
        <div class="d-flex flex-row justify-content-center align-content-center mb-3">
            @if ($like == 0) 
            <div class="d-flex flex-row">
                <a href="/like-track/{{$track -> id}}">
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
                <a href="/unlike-track/{{$track -> id}}"><img src="{{asset('images/liked.png')}}" alt="" style="width: 22px; height: 22px; margin-right: 6px;"></a>
            </div>
            <div>
                <span style="color: white; font-size:20px;"> {{$track_likes}} </span>
            </div>    
            @endif
        </div>

        <div class="w-100 d-flex flex-row justify-content-center mb-4">
            <div class="w-25 h-25 d-flex justify-content-center">           
                <a href="{{$track -> spotify_link}}" target=”_blank”>
                    <img src="{{asset('images/links_images/spotify.png')}}" alt="" style="width: 36px; height:36px;">
                </a>
            </div>

            <div class="w-25 h-25 d-flex justify-content-center">           
                <a href="{{$track -> apple_music_link}}" target=”_blank”>
                    <img src="{{asset('images/links_images/apple.png')}}" alt="" style="width: 36px; height:36px;">
                </a>
            </div>

            <div class="w-25 h-25 d-flex justify-content-center">           
                <a href="{{$track -> youtube_link}}" target=”_blank”>
                    <img src="{{asset('images/links_images/youtube.png')}}" alt="" style="width: 36px; height:36px;">
                </a>
            </div>
        </div>

        <div class="w-100 mt-3 mb-0">
            <iframe style="border-radius:12px; margin-bottom: 0px; height: 80px; box-shadow: 10px 10px 4px #00000054;" src="https://open.spotify.com/embed/{{$modified_link}}?utm_source=generator&theme=0" width="100%" height="150" frameBorder="0" allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
        </div>

        <div class="background-block mt-3 pb-0">
            <div>
                <p class="other-tracks-heading">
                    OTHER TRACKS FROM {{$album -> name}}
                </p>
                <hr class="mt-0">
            </div>
            @if (count($other_tracks) == 0)
            <div>
                <p class="w-100 found-nothing">NO OTHER TRACKS FROM THIS ALBUM</p>
                <hr>
            </div>
            <div class="w-100">
                <p class="text-center mb-3">
                    <a href="/album/{{$crypt_album}}" class="all-button">Return to album</a>
                </p>
            </div>


            @else
            <table class="w-100">
            @foreach ($other_tracks as $tracks)
                @php
                    $tracks_likes = DB::table('like_tracks')
                        ->where('like_tracks.track_id', $tracks->id)
                        ->count();

                    $crypt_track = Crypt::encrypt($tracks->id);
                @endphp
                <tr style="border-bottom: white solid 1px">
                    <td style="width: 85%:" class="table-separete-tracks">
                        <a href="/track/{{$crypt_track}}" class="text-decoration-none"><span class="other-tracks">{{$tracks -> name}}</span></a>
                    </td>
                    <td style="width: 15%" class="table-separete-tracks">
                        <div class="chart-like w-100 d-flex justify-content-center">
                            <img src="{{asset('images/like.png')}}" alt="" style="width: 17px; height: 17px; margin-right: 4px;">
                    <span class="track-like-text">{{$tracks_likes}}</span>
                        </div>
                    </td>
                </tr>
            @endforeach
            </table>
            <div>
                <p class="text-center mb-3 mt-3">
                    <a href="/album/{{$crypt_album}}" class="all-button text-center">View all tracks from {{$album -> name}}</a>
                </p>
            </div>
            @endif
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
                    <div class="d-flex flex-row justify-content-between align-items-center">
                        <div class="d-flex flex-row align-items-center mb-3" style="height: 35px">
                            <img src=" {{url ($user -> avatar_url)}}" alt="" style="width: 35px; height: 35px; margin-right: 5px; border-radius:200px;">
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
                    <div class="w-100">
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
                                            <a href="/delete-track-comment/{{$comment -> id}}" class="save-button-confirmation text-decoration-none">
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
            <form data-mdb-input-init class="mt-3" action="/save-comment-track" method="post">
                @csrf
                <input type="hidden" name="track_id" value="{{$track->id}}">
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                <textarea required id="textareaId" name="content" placeholder="Add comment" rows="4" wrap="hard" class="comment-input"></textarea>
                {{-- <button type="submit" class="btn btn-primary">Save comment</button> --}}
            </form>
            @endif
        </div>

    </div>

    <div class="w-65 d-flex flex-column align-items-center pt-130 ">
        <div class="track-lyrics-background w-100">
            <div class="w-100 d-flex flex-row justify-content-evenly align-content-center">
                <div class="tracks-lyrics-headers w-94">
                    <div class="artist-header-line"></div>
                    <div>
                        <h2 class="artist-tracks-header">{{$track -> name}} LYRICS</h2>
                    </div>
                    <div class="artist-header-line"></div>
                </div>
            </div>
            @if ($track -> lyrics == null || $track -> lyrics == "NO LYRICS")
            <div>
                <p class="no-track-lyrics w-100 white-text mt-2">
                    THIS TRACK HAS NO LYRICS
                </p>
            </div>

            @else
                <div class="w-100 mt-3">
                    <p class="track-lyrics white-text">
                        {{$track -> lyrics}}
                    </p>
                </div>
            @endif

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
let descText = document.querySelector('.track-lyrics').textContent;
let textWithLineBreaks = addLineBreaks(descText);
document.querySelector('.track-lyrics').innerHTML = textWithLineBreaks;
</script>
@endsection