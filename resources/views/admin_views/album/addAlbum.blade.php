@extends('layouts.app', ['title' => 'Add Album'])

@section('content')
    <div class="container">

        <div class="Header-List">
            <p>ADD ALBUM</p>
        </div>

        @if (session()->has('error'))
        <div class="alert error-login-2">
            {{session()->get('error')}}
        </div>
        @endif

        <div>
            <form method="POST" action="{{url('/add-album-to-database')}}" enctype="multipart/form-data">
                @csrf

                <div class="mt-2 mb-5">
                    <div class="w-100 d-flex justify-content-center align-items-center flex-column align-center mt-3">
                        <input type="file" id="photoInput" name="cover_url" class="img-input">
                        <label for="photoInput"  id="photoInputLabel" class="edit-change-button m-0 d-flex flex-column align-items-center">
                            <img id="photoPreview" src="{{ asset('images/camera.svg') }}" alt="Image preview" style=" width: 230px; height: 230px; border:3px solid #BDBDBD; border-radius: 10px; padding: 50px" class="mb-3 mt-0"/>
                            <p id="photoInputText" class="text-center">
                                ADD COVER
                            </p> 
                        </label>
                    </div>
                </div>

                <div class="d-flex flex-column flex-lg-row justify-content-lg-evenly justify-content-center align-items-lg-none align-items-center h-100 mb-5 w-100">
                    <div class="w-lg-50 w-100">
                        <div>  
                            <div>
                                <label for="name" class="mb-0 mt-2 add_input_label">ADD ALBUM NAME</label>
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

                            <div>
                                <label for="release_date" class="mb-0 mt-2 add_input_label">ADD RELEASE YEAR</label>
                                <input type="text" class="add-input" id="release_date" name="release_date" required>
                            </div>
                        </div>
                    </div>

                    <div class="w-lg-50 mt-5 mt-lg-0 w-100 h-100 d-flex flex-column justify-content-end">
                        <div>
                            <label for="type" class="mb-0 mt-2 add_input_label">CHOOSE TYPE</label>
                            <select class="add-input" id="type" name="type" required>
                                <option value="ALBUM" selected>ALBUM</option>
                                <option value="EP">EP</option>
                                <option value="SINGLE">SINGLE</option>
                            </select>
                        </div>

                        <div class="w-100 d-flex flex-row">
                            <div class="w-95-genre">
                                <label for="description" class="mb-0 mt-2 add_input_label">CHOOSE GENRE</label>
                                <input type="text" class="add-input-genre" id="genre_name" list="genres-list" name="genre_name" required>
                            </div>

                                <a class="plus-button" data-toggle="modal" data-target="#addGenreModal">
                                    +
                                </a>
                        </div>
                        <datalist id="genres-list">
                            @foreach ($genres as $genre)
                                <option value="{{$genre -> name}}"></option>
                            @endforeach
                        </datalist>

                        <div class="w-100 d-flex flex-row">
                            <div class="w-95-genre">
                                <label for="description" class="mb-0 mt-2 add_input_label">CHOOSE ARTIST</label>
                                <input type="text" class="add-input-genre" id="artist_name" list="artists-list" name="artist_name" required>
                            </div>

                                <a href="/add-artist" class="plus-button">
                                    +
                                </a>
                        </div>
                        <datalist id="artists-list">
                            @foreach ($artists as $artist)
                                <option value="{{$artist -> name}}"></option>
                            @endforeach
                        </datalist>

                        <div class=" w-100">
                            <label for="description" class="mb-0 mt-2 add_input_label">ADD DESCRIPTION</label>
                            <textarea class="add_textarea-small" id="description" name="description"></textarea>
                        </div>
                    </div>
                </div>

                <div class="d-flex w-100 flex-lg-row flex-column  justify-content-evenly mb-5">
                    <button type="submit" class="add-save-button mb-lg-0 mb-3 me-3 w-100 w-lg-25">SAVE</button>
                    <a href="/admin-panel" class="add-cancel-button text-decoration-none w-100 w-lg-25">CANCEL</a>
                </div>
            </form>
        </div>

        <div class="modal fade" id="addGenreModal" tabindex="-1" role="dialog" aria-labelledby="addGenreLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content border-b">
                    <div class="login">
                        <div class="w-100">
                            <div cl>
                                <h1 class="confirmation-header mt-3 mb-3">ADD GENRE</h1>
                            </div>
                            @if (session()->has('error_genre'))
                                <div class="alert error-genre">
                                    {{session()->get('error_genre')}}
                                </div>
                            @endif
                            <form method="POST" action="{{url('/add-genre')}}">
                                @csrf
                                <div class="w-100 d-flex flex-column align-items-center">
                                    <label for="name_genre" class="mb-0 mt-2 add_input_label">ADD GENRE NAME</label>
                                    <input type="text" class="add-input" id="name_genre" name="name_genre" required>
                                </div>
                                <div class="d-flex w-100 flex-row justify-content-evenly mt-5 mb-3">
                                    <button type="submit" class="add-save-button w-25 me-3">SAVE</button>
                                    <button type="button" data-toggle="modal" data-target="#addGenreModal" data-dismiss="modal" id="modal-close-cancel" class="add-cancel-button w-25" >CANCEL</button>
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