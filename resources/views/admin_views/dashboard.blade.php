@extends('layouts.app', ['title' => ' Admin Dashboard'])

@section('content')

    <div class="container">

        <div>
            <div class="Header-List ">
                <p class="text-center">ADMIN DASHBOARD</p>
            </div>
        </div>



        <div class="d-flex flex-column justify-content-center mt-2 mb-3">
            <div class="Header-List">
                ARTIST
            </div>
            <div class="d-flex justify-content-center mb-3 w-100">
                <input type="text" name="artist_name" id="artist" list="artist-list" class="dashboard-input">
                <datalist id="artist-list">
                    @foreach ($artists as $artist)
                    @php
                        $crypt_artist = Crypt::encrypt($artist -> id);
                    @endphp
                        <option value="{{$artist -> name}}" data-hidden-value="{{$crypt_artist}}"></option>
                    @endforeach
                </datalist>
            </div>
            <div class="d-flex flex-column flex-lg-row justify-content-center align-items-lg-none align-items-center w-100">
                <div class="me-lg-5 w-lg-15 mb-3 mb-lg-0 w-lg-15">
                    <a href="/add-artist" class="dashboard-button">
                        <p class="w-100 h-100 pt-1">ADD</p>
                    </a>
                </div>
                <div id="edit_artist" class="me-lg-5 w-lg-15 mb-3 mb-lg-0 w-lg-15" >
                    <div class="dashboard-button">
                        <p class="w-100 h-100 pt-1">EDIT</p>
                    </div>
                </div>
                <div id="delete_artist" class="w-lg-15">
                    <a id="delete-artist" class="dashboard-button">
                        <p class="w-100 h-100 pt-1">DELETE</p>
                    </a>
                </div>
            </div>
        </div>

        <div class="modal fade" id="artistDeleteModal" tabindex="-1" role="dialog" aria-labelledby="artistDeleteLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content border-b">
                    <div class="login">
                        <div class="w-100">
                            <div cl>
                                <h1 class="confirmation-header mt-3 mb-3">CONFIRMATION</h1>
                            </div>
                            <div id="confirmation_text" class="d-flex w-100 flex-column justify-content-center align-items-center mt-5 mb-5">
                                <p class="confirmation-text">
                                    Are you sure you want to delete this artist?
                                </p>
                            </div>

                            <div class="d-flex flex-row w-100 mt-2 mb-3 justify-content-evenly">
                                <div id="submit_delete_artist" class="w-50">
                                    <a class="save-button-confirmation">
                                        <button class="buttons-inside-confirm">DELETE</button>
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

        <div class="d-flex flex-column justify-content-center mt-2 mb-3">
            <div class="Header-List">
                ALBUMS
            </div>
            <div class="d-flex justify-content-center mb-3 w-100">
                <input type="text" name="album_name" id="album" list="album-list" class="dashboard-input">
                <datalist id="album-list">
                    @foreach ($albums as $album)
                    @php
                        $crypt_album = Crypt::encrypt($album -> id);

                        $artist = \App\Models\Artist::find($album->artist_id);

                    @endphp
                        <option value="{{$album -> name}} - {{$artist -> name}}" data-hidden-value="{{$crypt_album}}"></option>
                    @endforeach
                </datalist>
            </div>
            <div class="d-flex flex-column flex-lg-row justify-content-center align-items-lg-none align-items-center w-100">
                <div class="me-lg-5 w-lg-15 mb-3 mb-lg-0 w-lg-15">
                    <a href="/add-album" id="add_album" class="dashboard-button">
                        <p class="w-100 h-100 pt-1">ADD</p>
                    </a>
                </div>
                <div id="edit_album" class="me-lg-5 w-lg-15 mb-3 mb-lg-0 w-lg-15" >
                    <div class="dashboard-button">
                        <p class="w-100 h-100 pt-1">EDIT</p>
                    </div>
                </div>
                <div id="delete_album" class="w-lg-15">
                    <a id="delete_album" class="dashboard-button">
                        <p class="w-100 h-100 pt-1">DELETE</p>
                    </a>
                </div>
            </div>
        </div>

        <div class="modal fade" id="albumDeleteModal" tabindex="-1" role="dialog" aria-labelledby="albumDeleteLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content border-b">
                    <div class="login">
                        <div class="w-100">
                            <div cl>
                                <h1 class="confirmation-header mt-3 mb-3">CONFIRMATION</h1>
                            </div>
                            <div id="confirmation_text_album" class="d-flex w-100 flex-column justify-content-center align-items-center mt-5 mb-5">
                                <p class="confirmation-text">
                                    Are you sure you want to delete this artist?
                                </p>
                            </div>

                            <div class="d-flex flex-row w-100 mt-2 mb-3 justify-content-evenly">
                                <div id="submit_delete_album" class="w-50">
                                    <a class="save-button-confirmation">
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

        <div class="d-flex flex-column justify-content-center mt-2 mb-5">
            <div class="Header-List">
                TRACKS
            </div>
            <div class="d-flex justify-content-center mb-3 w-100">
                <input type="text" name="track_name" id="track" list="track-list" class="dashboard-input">
                <datalist id="track-list">
                    @foreach ($tracks as $track)
                    @php
                        $crypt_track = Crypt::encrypt($track -> id);

                        $album = \App\Models\Album::find($track->album_id);

                    @endphp
                        <option value="{{$track -> name}} - {{$album -> name}}" data-hidden-value="{{$crypt_track}}"></option>
                    @endforeach
                </datalist>
            </div>
            <div class="d-flex flex-column flex-lg-row justify-content-center align-content-lg-none align-items-center w-100">
                <div class="me-lg-5 w-lg-15 mb-3 mb-lg-0">
                    <a href="/add-track" id="add_track" class="dashboard-button">
                        <p class="w-100 h-100 pt-1">ADD</p>
                    </a>
                </div>
                <div id="edit_track" class="me-lg-5 w-lg-15 mb-3 mb-lg-0">
                    <div class="dashboard-button">
                        <p class="w-100 h-100 pt-1">EDIT</p>
                    </div>
                </div>
                <div id="delete_track" class="w-lg-15">
                    <a id="delete_track" class="dashboard-button">
                        <p class="w-100 h-100 pt-1">DELETE</p>
                    </a>
                </div>
            </div>
        </div>

        <div class="modal fade" id="trackDeleteModal" tabindex="-1" role="dialog" aria-labelledby="trackDeleteLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content border-b">
                    <div class="login">
                        <div class="w-100">
                            <div cl>
                                <h1 class="confirmation-header mt-3 mb-3">CONFIRMATION</h1>
                            </div>
                            
                            <div id="confirmation_text_track" class="d-flex w-100 flex-column justify-content-center align-items-center mt-5 mb-5">
                                <p class="confirmation-text">
                                    Are you sure you want to delete this track?
                                </p>
                            </div>

                            <div class="d-flex flex-row w-100 mt-2 mb-3 justify-content-evenly">
                                <div id="submit_delete_track" class="w-50">
                                    <a class="save-button-confirmation">
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

        @if (session()->has('success-artist-added'))
            <script>
                $(document).ready(function(){
                    $('#artist-added').toast('show');
                });

                $(document).ready(function(){
                    $('.cross-button').on('click', function(){
                        $(this).closest('.toast').toast('hide');
                    });
                });
            </script>
            @php
                $artist_id = session()->get('artistId');
                $crypt_artist = Crypt::encrypt($artist_id);
            @endphp
            <!-- Then put toasts within -->
            <div class="w-100 d-flex justify-content-center align-items-center position-fixed top-0 start-50 translate-middle-x mt-3" style="z-index: 9999;">
                <div class="toast" id="artist-added" role="alert" aria-live="assertive" aria-atomic="true" data-delay="10000"  data-autohide="true" style="z-index: 10000;">
                    <div class="toast-header">
                        <img src="{{ URL::asset('images/logo_title.png') }}" class="rounded mr-2" alt="...">
                        <strong class="me-auto">Rhythmatize</strong>
                        <button type="button" class="ml-2 mb-1 cross-button " data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="toast-body">
                        Artist was added successfully! <br><a href="/artist/{{$crypt_artist}}" class="link-text">View Artist</a>
                    </div>
                </div>
            </div>
        @elseif (session()->has('success-artist-edited'))
            <script>
                $(document).ready(function(){
                    $('#artist-edited').toast('show');
                });

                $(document).ready(function(){
                    $('.cross-button').on('click', function(){
                        $(this).closest('.toast').toast('hide');
                    });
                });
            </script>
            @php
                $artist_id = session()->get('artistId');
                $crypt_artist = Crypt::encrypt($artist_id);
            @endphp
            <!-- Then put toasts within -->
            <div class="w-100 d-flex justify-content-center align-items-center position-fixed top-0 start-50 translate-middle-x mt-3" style="z-index: 9999;">
                <div class="toast" id="artist-edited" role="alert" aria-live="assertive" aria-atomic="true" data-delay="10000"  data-autohide="true">
                    <div class="toast-header">
                        <img src="{{ URL::asset('images/logo_title.png') }}" class="rounded mr-2" alt="...">
                        <strong class="me-auto">Rhythmatize</strong>
                        <button type="button" class="ml-2 mb-1 cross-button " data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="toast-body">
                        Artist was edited successfully! <br><a href="/artist/{{$crypt_artist}}" class="link-text">View Artist</a>
                    </div>
                </div>
            </div>
        @elseif (session()->has('success-artist-deleted'))
            <script>
                $(document).ready(function(){
                    $('#artist-deleted').toast('show');
                });

                $(document).ready(function(){
                    $('.cross-button').on('click', function(){
                        $(this).closest('.toast').toast('hide');
                    });
                });
            </script>
            <div class="w-100 d-flex justify-content-center align-items-center position-fixed top-0 start-50 translate-middle-x mt-3" style="z-index: 9999;">
                <div class="toast" id="artist-deleted" role="alert" aria-live="assertive" aria-atomic="true" data-delay="10000"  data-autohide="true">
                    <div class="toast-header">
                        <img src="{{ URL::asset('images/logo_title.png') }}" class="rounded mr-2" alt="...">
                        <strong class="me-auto">Rhythmatize</strong>
                        <button type="button" class="ml-2 mb-1 cross-button " data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="toast-body">
                        Artist was deleted successfully!
                    </div>
                </div>
            </div>
        @elseif (session()->has('success-album-added'))
            <script>
                $(document).ready(function(){
                    $('#album-added').toast('show');
                });

                $(document).ready(function(){
                    $('.cross-button').on('click', function(){
                        $(this).closest('.toast').toast('hide');
                    });
                });
            </script>
            @php
                $album_id = session()->get('albumId');
                $crypt_album = Crypt::encrypt($album_id);
            @endphp
            <!-- Then put toasts within -->
            <div class="w-100 d-flex justify-content-center align-items-center position-fixed top-0 start-50 translate-middle-x mt-3" style="z-index: 9999;">
                <div class="toast" id="album-added" role="alert" aria-live="assertive" aria-atomic="true" data-delay="10000"  data-autohide="true">
                    <div class="toast-header">
                        <img src="{{ URL::asset('images/logo_title.png') }}" class="rounded mr-2" alt="...">
                        <strong class="me-auto">Rhythmatize</strong>
                        <button type="button" class="ml-2 mb-1 cross-button " data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="toast-body">
                        Album was added successfully! <br><a href="/album/{{$crypt_album}}" class="link-text">View Album</a>
                    </div>
                </div>
            </div>
        @elseif (session()->has('success-album-edited'))
            <script>
                $(document).ready(function(){
                    $('#album-edited').toast('show');
                });

                $(document).ready(function(){
                    $('.cross-button').on('click', function(){
                        $(this).closest('.toast').toast('hide');
                    });
                });
            </script>
            @php
                $album_id = session()->get('albumId');
                $crypt_album = Crypt::encrypt($album_id);
            @endphp
            <!-- Then put toasts within -->
            <div class="w-100 d-flex justify-content-center align-items-center position-fixed top-0 start-50 translate-middle-x mt-3" style="z-index: 9999;">
                <div class="toast" id="album-edited" role="alert" aria-live="assertive" aria-atomic="true" data-delay="10000"  data-autohide="true">
                    <div class="toast-header">
                        <img src="{{ URL::asset('images/logo_title.png') }}" class="rounded mr-2" alt="...">
                        <strong class="me-auto">Rhythmatize</strong>
                        <button type="button" class="ml-2 mb-1 cross-button " data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="toast-body">
                        Album was edited successfully! <br><a href="/album/{{$crypt_album}}" class="link-text">View Album</a>
                    </div>
                </div>
            </div>
        @elseif (session()->has('success-album-deleted'))
            <script>
                $(document).ready(function(){
                    $('#album-deleted').toast('show');

                    
                });

                $(document).ready(function(){
                    $('.cross-button').on('click', function(){
                        $(this).closest('.toast').toast('hide');
                    });
                });
            </script>
            <div class="w-100 d-flex justify-content-center align-items-center position-fixed top-0 start-50 translate-middle-x mt-3" style="z-index: 9999;">
                <div class="toast" id="album-deleted" role="alert" aria-live="assertive" aria-atomic="true" data-delay="10000"  data-autohide="true">
                    <div class="toast-header">
                        <img src="{{ URL::asset('images/logo_title.png') }}" class="rounded mr-2" alt="...">
                        <strong class="me-auto">Rhythmatize</strong>
                        <button type="button" class="ml-2 mb-1 cross-button " data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="toast-body">
                        Album was deleted successfully!
                    </div>
                </div>
            </div>
        @elseif (session()->has('success-track-added'))
            <script>
                $(document).ready(function(){
                    $('#track-added').toast('show');
                });

                $(document).ready(function(){
                    $('.cross-button').on('click', function(){
                        $(this).closest('.toast').toast('hide');
                    });
                });
            </script>
            @php
                $track_id = session()->get('trackId');
                $crypt_track = Crypt::encrypt($track_id);
            @endphp
            <!-- Then put toasts within -->
            <div class="w-100 d-flex justify-content-center align-items-center position-fixed top-0 start-50 translate-middle-x mt-3" style="z-index: 9999;">
                <div class="toast" id="track-added" role="alert" aria-live="assertive" aria-atomic="true" data-delay="1000"  data-autohide="true">
                    <div class="toast-header">
                        <img src="{{ URL::asset('images/logo_title.png') }}" class="rounded mr-2" alt="...">
                        <strong class="me-auto">Rhythmatize</strong>
                        <button type="button" class="ml-2 mb-1 cross-button " data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="toast-body">
                        Track was added successfully! <br><a href="/track/{{$crypt_track}}" class="link-text">View Track</a>
                    </div>
                </div>
            </div>
        @elseif (session()->has('success-track-edited'))
            <script>
                $(document).ready(function(){
                    $('#track-edited').toast('show');
                });

                $(document).ready(function(){
                    $('.cross-button').on('click', function(){
                        $(this).closest('.toast').toast('hide');
                    });
                });
            </script>
            @php
                $track_id = session()->get('trackId');
                $crypt_track = Crypt::encrypt($track_id);
            @endphp
            <!-- Then put toasts within -->
            <div class="w-100 d-flex justify-content-center align-items-center position-fixed top-0 start-50 translate-middle-x mt-3" style="z-index: 9999;">
                <div class="toast" id="track-edited" role="alert" aria-live="assertive" aria-atomic="true" data-delay="10000"  data-autohide="true">
                    <div class="toast-header">
                        <img src="{{ URL::asset('images/logo_title.png') }}" class="rounded mr-2" alt="...">
                        <strong class="me-auto">Rhythmatize</strong>
                        <button type="button" class="ml-2 mb-1 cross-button " data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="toast-body">
                        Track was edited successfully! <br><a href="/track/{{$crypt_track}}" class="link-text">View Track</a>
                    </div>
                </div>
            </div>
        @elseif (session()->has('success-track-deleted'))
            <script>
                $(document).ready(function(){
                    $('#track-deleted').toast('show');
                });

                $(document).ready(function(){
                    $('.cross-button').on('click', function(){
                        $(this).closest('.toast').toast('hide');
                    });
                });
            </script>
            <div class="w-100 d-flex justify-content-center align-items-center position-fixed top-0 start-50 translate-middle-x mt-3" style="z-index: 9999;">
                <div class="toast" id="track-deleted" role="alert" aria-live="assertive" aria-atomic="true" data-delay="10000"  data-autohide="true">
                    <div class="toast-header">
                        <img src="{{ URL::asset('images/logo_title.png') }}" class="rounded mr-2" alt="...">
                        <strong class="me-auto">Rhythmatize</strong>
                        <button type="button" class="ml-2 mb-1 cross-button " data-dismiss="toast" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="toast-body">
                        Track was deleted successfully!
                    </div>
                </div>
            </div>
        @endif

        </div>
        
<script>

    $(document).ready(function() {
        $('input[list="track-list"]').on('change', function() {
            var trackName = $(this).val();
            var trackOption = $('option[value="' + trackName + '"]', this.list);
            var trackId = trackOption.data('hidden-value');
            document.querySelector("#edit_track").innerHTML = `<a href="/edit-track/${trackId}" id="edit_track" class="dashboard-button me-5"><p class="w-100 h-100 pt-1">EDIT</p></a>`;
            document.querySelector("#delete_track").innerHTML = `<a data-toggle="modal" data-target="#trackDeleteModal" id="delete_track" class="dashboard-button"><p class="w-100 h-100 pt-1">DELETE</p></a>`;
            document.querySelector("#confirmation_text_track").innerHTML = `<p class="confirmation-text">Are you sure you want to delete <br>"${trackName}"?</p>`
            document.querySelector("#submit_delete_track").innerHTML = `<a href="/delete-track/${trackId}" class="save-button-confirmation text-decoration-none"><button type="submit" class="buttons-inside-confirm">DELETE</button></a>`;
        });
    });
    
    $(document).ready(function() {
        $('input[list="artist-list"]').on('change', function() {
            var artistName = $(this).val();
            var artistOption = $('option[value="' + artistName + '"]', this.list);
            var artistId = artistOption.data('hidden-value');
            document.querySelector("#edit_artist").innerHTML = `<a href="/edit-artist/${artistId}" id="edit_artist" class="dashboard-button me-5"><p class="w-100 h-100 pt-1">EDIT</p></a>`;
            document.querySelector("#delete_artist").innerHTML = `<a data-toggle="modal" data-target="#artistDeleteModal" id="delete_artist" class="dashboard-button"><p class="w-100 h-100 pt-1">DELETE</p></a>`;
            document.querySelector("#confirmation_text").innerHTML = `<p class="confirmation-text">Are you sure you want to delete <br>"${artistName}"?</p>`
            document.querySelector("#submit_delete_artist").innerHTML = `<a href="/delete-artist/${artistId}" class="save-button-confirmation text-decoration-none"><button type="submit" class="buttons-inside-confirm">DELETE</button></a>`;
        });
    });

    

    $(document).ready(function() {
        $('input[list="album-list"]').on('change', function() {
            var albumName = $(this).val();
            var albumOption = $('option[value="' + albumName + '"]', this.list);
            var albumId = albumOption.data('hidden-value');
            document.querySelector("#edit_album").innerHTML = `<a href="/edit-album/${albumId}" id="edit_album" class="dashboard-button me-5"><p class="w-100 h-100 pt-1">EDIT</p></a>`;
            document.querySelector("#delete_album").innerHTML = `<a data-toggle="modal" data-target="#albumDeleteModal" id="delete_album" class="dashboard-button"><p class="w-100 h-100 pt-1">DELETE</p></a>`;
            document.querySelector("#confirmation_text_album").innerHTML = `<p class="confirmation-text">Are you sure you want to delete <br>"${albumName}"?</p>`
            document.querySelector("#submit_delete_album").innerHTML = `<a href="/delete-album/${albumId}" class="save-button-confirmation text-decoration-none"><button type="submit" class="buttons-inside-confirm">DELETE</button></a>`;
        });
    });



</script>
@endsection