@extends('layouts.app', ['title' => 'Add Track'])

@section('content')
    <div class="container">

        <div class="Header-List">
            <p>ADD TRACK</p>
        </div>

        @if (session()->has('error'))
        <div class="alert error-login-1">
            {{session()->get('error')}}
        </div>
        @endif

        <div>
            <form method="POST" action="{{url('/add-track-to-database')}}" enctype="multipart/form-data">
                @csrf

                <div class="d-flex flex-lg-row flex-column justify-content-evenly h-100 mb-5">
                    <div class="w-100 w-lg-50">
                        <div>  
                            <div>
                                <label for="name" class="mb-0 mt-2 add_input_label">ADD TRACK NAME</label>
                                <input type="text" class="add-input" id="name" name="name" required>
                            </div>
    
                            <div>
                                <label for="description" class="mb-0 mt-2 add_input_label">ADD SPOTIFY LINK</label>
                                <input type="text" class="add-input" id="spotify_link" name="spotify_link" required>
                            </div>
    
                            <div>
                                <label for="apple_music_link" class="mb-0 mt-2 add_input_label">ADD APPLE MUSIC LINK</label>
                                <input type="text" class="add-input" id="apple_music_link" name="apple_music_link" required>
                            </div>
    
                            <div>
                                <label for="youtube_link" class="mb-0 mt-2 add_input_label">ADD YOUTUBE MUSIC LINK</label>
                                <input type="text" class="add-input" id="youtube_link" name="youtube_link" required>
                            </div>
                        </div>
                    </div>

                    <div class="w-lg-50 w-100 h-100 d-flex flex-column justify-content-end mt-5 mt-lg-0">
                        <div class="w-100 d-flex flex-row">
                            <div class="w-75-length">
                                <label for="track_length" class="mb-0 mt-2 add_input_label ">ADD TRACK LENGTH</label>
                                <input type="text" class="add-input " id="track_length" name="time" required>
                            </div>

                            <div class="w-25 ms-3 ms-lg-0">
                                <label for="explicit" class="mb-0 mt-2 add_input_label">
                                    EXPLICIT
                                </label>
                                <div class="d-flex flex-row align-items-center">
                                    <input type="checkbox" id="explicit" name="explicit" class="form-check-input mt-3 mb-3">
                                    <label for="explicit" class="remember-me">YES</label>
                                </div>
                            </div>
                        </div>

                        <div class="w-100 d-flex flex-row ">
                            <div class="w-95-genre">
                                <label for="album_name" class="mb-0 mt-2 add_input_label">CHOOSE ALBUM</label>
                                <input type="text" class="add-input-genre" id="album_name" list="albums-list" name="album_name" required>
                            </div>

                            <a href="/add-album" class="plus-button">
                                +
                            </a>
                        </div>
                        <datalist id="albums-list">
                            @foreach ($albums as $album)
                                <option value="{{$album -> name}}"></option>
                            @endforeach
                        </datalist>

                        <div class=" w-100">
                            <label for="lyrics" class="mb-0 mt-2 add_input_label">ADD LYRICS</label>
                            <textarea class="add_textarea-small" id="description" name="lyrics"></textarea>
                        </div>
                    </div>
                </div>

                <div class="d-flex w-100 flex-row justify-content-evenly mb-5 flex-lg-row flex-column">
                    <button type="submit" class="add-save-button me-0 me-lg-3 mb-3 mb-lg-3 w-lg-25 w-100">SAVE</button>
                    <a href="/admin-panel" class="add-cancel-button text-decoration-none w-lg-25 w-100">CANCEL</a>
                </div>
            </form>
        </div>
        </div>

    </div>

    <script>

        $(document).ready(function () {
            if ($('.error-genre').length > 0) {
            // Open the modal window
                $('#addGenreModal').modal('show');
            }
        });
        
        document.getElementById('photoInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const reader = new FileReader();
            const fileName = event.target.files[0].name;

            reader.onload = function(event) {
                document.getElementById('photoPreview').src = event.target.result;
                document.getElementById('photoPreview').style.padding = '0';
                document.getElementById('photoInputText').textContent = fileName;
            };

            reader.readAsDataURL(file);
        });

        document.getElementById('coverInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const reader = new FileReader();
            const fileName = event.target.files[0].name;

            reader.onload = function(event) {
                document.getElementById('coverPreview').src = event.target.result;
                document.getElementById('coverPreview').style.padding = '0';
                document.getElementById('coverInputText').textContent = fileName;
            };

            reader.readAsDataURL(file);
        });

    </script>

@endsection