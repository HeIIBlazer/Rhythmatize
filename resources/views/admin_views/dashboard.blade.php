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
                <div style="width: 15%; cursor: pointer;" class="me-5">
                    <div id="add_artist" class="dashboard-button ">
                        <p class="w-100 h-100 pt-1">ADD</p>
                    </div>
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
                            <div>
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
    $('input[list="artist-list"]').on('change', function() {
        var artistName = $(this).val();
        var artistOption = $('option[value="' + artistName + '"]', this.list);
        var artistId = artistOption.data('hidden-value');
        document.querySelector("#edit_artist").innerHTML = `<a href="/edit_artist/${artistId}" id="edit_artist" class="dashboard-button me-5"><p class="w-100 h-100 pt-1">EDIT</p></a>`;
        document.querySelector("#delete_artist").innerHTML = `<a data-toggle="modal" data-target="#artistDeleteModal" id="delete_artist" class="dashboard-button"><p class="w-100 h-100 pt-1">DELETE</p></a>`;
        document.querySelector("#confirmation_text").innerHTML = `<p class="confirmation-text">Are you sure you want to delete <br>"${artistName}"?</p>`
        document.querySelector("#submit_delete_artist").innerHTML = `<a href="/delete_artist/${artistId}" class="save-button-confirmation"><button type="submit" class="buttons-inside-confirm">DELETE</button></a>`;
    });
});
</script>
@endsection
{{-- 
<div class="d-flex flex-column justify-content-center mt-2 mb-3">
    <div class="Header-List">
        ALBUMS
    </div>
    <div class="d-flex justify-content-center mb-3 w-100">
        <input type="text" name="album_name" id="album" list="albums-list" class="dashboard-input">
        <datalist id="albums-list">
            @foreach ($albums as $album)
            @php
                $crypt_album = Crypt::encrypt($album -> id);
            @endphp
                <option value="{{$album -> name}}" data-hidden-value="{{$crypt_album}}"></option>
            @endforeach
        </datalist>
    </div>
    <div class="d-flex flex-row justify-content-center">
        <a href="" id="add_album" class="dashboard-button me-5">
            <p class="w-100 h-100 pt-1">ADD</p>
        </a>
        <a href="" id="edit_album" class="dashboard-button me-5">
            <p class="w-100 h-100 pt-1">EDIT</p>
        </a>
        <a href="" id="delete_album" class="dashboard-button">
            <p class="w-100 h-100 pt-1">DELETE</p>
        </a>
    </div>
</div>

<div class="d-flex flex-column justify-content-center mt-3 mb-5">
    <div class="Header-List">
        TRACKS
    </div>
    <div class="d-flex justify-content-center mb-3 w-100">
        <input type="text" name="tracks_name" id="tracks" list="track-list" class="dashboard-input">
        <datalist id="track-list">
            @foreach ($tracks as $track)
            @php
                $crypt_track = Crypt::encrypt($track -> id);
            @endphp
                <option value="{{$track -> name}}" data-hidden-value="{{$crypt_track}}"></option>
            @endforeach
        </datalist>
    </div>
    <div class="d-flex flex-row justify-content-center">
        <a href="" id="add_track" class="dashboard-button me-5">
            <p class="w-100 h-100 pt-1">ADD</p>
        </a>
        <a href="" id="edit_track" class="dashboard-button me-5">
            <p class="w-100 h-100 pt-1">EDIT</p>
        </a>
        <a href="" id="delete_track" class="dashboard-button">
            <p class="w-100 h-100 pt-1">DELETE</p>
        </a>
    </div>
</div> --}}