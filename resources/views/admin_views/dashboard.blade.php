@extends('layouts.app', ['title' => ' Admin Dashboard'])

@section('content')

    <div class="container">
        <div>
            <div class="Header-List">
                <p>ADMIN DASHBOARD</p>
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
            <div class="d-flex flex-row justify-content-center w-100">
                <div style="width: 15%;" class="me-5">
                    <a href="/add_artist" class="dashboard-button ">
                        <p class="w-100 h-100 pt-1">ADD</p>
                    </a>
                </div>
                <div id="edit_artist" style="width: 15%; cursor: pointer;" class="me-5" >
                    <div class="dashboard-button me-5">
                        <p class="w-100 h-100 pt-1">EDIT</p>
                    </div>
                </div>
                <div style="width: 15%; cursor: pointer;" id="delete_artist">
                    <a id="delete_artist" class="dashboard-button">
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
            <div class="d-flex flex-row justify-content-center w-100">
                <div style="width: 15%; cursor: pointer;" class="me-5">
                    <a href="/add_album" id="add_album" class="dashboard-button">
                        <p class="w-100 h-100 pt-1">ADD</p>
                    </a>
                </div>
                <div id="edit_album" style="width: 15%; cursor: pointer;" class="me-5" >
                    <div class="dashboard-button me-5">
                        <p class="w-100 h-100 pt-1">EDIT</p>
                    </div>
                </div>
                <div style="width: 15%; cursor: pointer;" id="delete_album">
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
            <div class="d-flex flex-row justify-content-center w-100">
                <div style="width: 15%; cursor: pointer;" class="me-5">
                    <a href="/add_track" id="add_track" class="dashboard-button">
                        <p class="w-100 h-100 pt-1">ADD</p>
                    </a>
                </div>
                <div id="edit_track" style="width: 15%; cursor: pointer;" class="me-5" >
                    <div class="dashboard-button me-5">
                        <p class="w-100 h-100 pt-1">EDIT</p>
                    </div>
                </div>
                <div style="width: 15%; cursor: pointer;" id="delete_track">
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

    </div>

<script>

    $(document).ready(function() {
        $('input[list="track-list"]').on('change', function() {
            var trackName = $(this).val();
            var trackOption = $('option[value="' + trackName + '"]', this.list);
            var trackId = trackOption.data('hidden-value');
            document.querySelector("#edit_track").innerHTML = `<a href="/edit_track/${trackId}" id="edit_track" class="dashboard-button me-5"><p class="w-100 h-100 pt-1">EDIT</p></a>`;
            document.querySelector("#delete_track").innerHTML = `<a data-toggle="modal" data-target="#trackDeleteModal" id="delete_track" class="dashboard-button"><p class="w-100 h-100 pt-1">DELETE</p></a>`;
            document.querySelector("#confirmation_text_track").innerHTML = `<p class="confirmation-text">Are you sure you want to delete <br>"${trackName}"?</p>`
            document.querySelector("#submit_delete_track").innerHTML = `<a href="/delete_track/${trackId}" class="save-button-confirmation text-decoration-none"><button type="submit" class="buttons-inside-confirm">DELETE</button></a>`;
        });
    });
    
    $(document).ready(function() {
        $('input[list="artist-list"]').on('change', function() {
            var artistName = $(this).val();
            var artistOption = $('option[value="' + artistName + '"]', this.list);
            var artistId = artistOption.data('hidden-value');
            document.querySelector("#edit_artist").innerHTML = `<a href="/edit_artist/${artistId}" id="edit_artist" class="dashboard-button me-5"><p class="w-100 h-100 pt-1">EDIT</p></a>`;
            document.querySelector("#delete_artist").innerHTML = `<a data-toggle="modal" data-target="#artistDeleteModal" id="delete_artist" class="dashboard-button"><p class="w-100 h-100 pt-1">DELETE</p></a>`;
            document.querySelector("#confirmation_text").innerHTML = `<p class="confirmation-text">Are you sure you want to delete <br>"${artistName}"?</p>`
            document.querySelector("#submit_delete_artist").innerHTML = `<a href="/delete_artist/${artistId}" class="save-button-confirmation text-decoration-none"><button type="submit" class="buttons-inside-confirm">DELETE</button></a>`;
        });
    });

    

    $(document).ready(function() {
        $('input[list="album-list"]').on('change', function() {
            var albumName = $(this).val();
            var albumOption = $('option[value="' + albumName + '"]', this.list);
            var albumId = albumOption.data('hidden-value');
            document.querySelector("#edit_album").innerHTML = `<a href="/edit_album/${albumId}" id="edit_album" class="dashboard-button me-5"><p class="w-100 h-100 pt-1">EDIT</p></a>`;
            document.querySelector("#delete_album").innerHTML = `<a data-toggle="modal" data-target="#albumDeleteModal" id="delete_album" class="dashboard-button"><p class="w-100 h-100 pt-1">DELETE</p></a>`;
            document.querySelector("#confirmation_text_album").innerHTML = `<p class="confirmation-text">Are you sure you want to delete <br>"${albumName}"?</p>`
            document.querySelector("#submit_delete_album").innerHTML = `<a href="/delete_album/${albumId}" class="save-button-confirmation text-decoration-none"><button type="submit" class="buttons-inside-confirm">DELETE</button></a>`;
        });
    });



</script>
@endsection