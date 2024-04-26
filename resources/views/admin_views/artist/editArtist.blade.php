@extends('layouts.app', ['title' => 'Edit - '.$artist -> name])

@section('content')
    <div class="container">

        @php
            $crypt_artist = Crypt::encrypt($artist -> id);
        @endphp

        <div class="Header-List">
            <p class="text-uppercase">EDIT {{$artist -> name}}</p>
        </div>

        @if (session()->has('error'))
        <div class="alert error-login-1">
            {{session()->get('error')}}
        </div>
        @endif

        <div>
            <form method="POST" action="{{url('/save-edited-artist')}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$crypt_artist}}">
                <div class="d-flex flex-row justify-content-evenly mt-2 mb-5">
                    <div class="w-50 d-flex justify-content-center align-items-center flex-column align-center mt-3">
                        <input type="file" id="photoInput" name="picture_url" class="img-input">
                        <label for="photoInput"  id="photoInputLabel" class="edit-change-button m-0">
                            <img id="photoPreview" src="{{url ($artist -> picture_url)}}" alt="Image preview" style=" width: 230px; height: 230px; border:3px solid #BDBDBD; border-radius: 10px;" class="mb-3 mt-0"/>
                            <p id="photoInputText" class="text-center">
                                EDIT PHOTO
                            </p> 
                        </label>
                    </div>

                    <div class="w-50 d-flex justify-content-center align-items-center flex-column align-center mt-3">
                        <input type="file" id="coverInput" name="banner_url" class="img-input">
                        <label for="coverInput"  id="coverInputLabel" class="edit-change-button m-0">
                            <img id="coverPreview" src="{{url ($artist -> banner_url)}}" alt="Image preview" style=" width: 230px; height: 230px; border:3px solid #BDBDBD; border-radius: 10px;" class="mb-3 mt-0"/>
                            <p id="coverInputText" class="text-center">
                                EDIT BANNER
                            </p> 
                        </label>
                    </div>
                </div>

                <div class="d-flex justify-content-evenly h-100 mb-5">
                    <div class="w-50">
                        <div>  
                            <div>
                                <label for="name" class="mb-0 mt-2 add_input_label">EDIT ARTIST NAME</label>
                                <input type="text" class="add-input" id="name" name="name" value="{{$artist -> name}}" required>
                            </div>
    
                            <div>
                                <label for="description" class="mb-0 mt-2 add_input_label">EDIT SPOTIFY LINK</label>
                                <input type="text" class="add-input" id="sporify_link" name="spotify_link" value="{{$artist -> spotify_link}}" required>
                            </div>
    
                            <div>
                                <label for="description" class="mb-0 mt-2 add_input_label">EDIT APPLE MUSIC LINK</label>
                                <input type="text" class="add-input" id="apple_music_link" name="apple_music_link" value="{{$artist -> apple_music_link}}" required>
                            </div>
    
                            <div>
                                <label for="description" class="mb-0 mt-2 add_input_label">EDIT YOUTUBE MUSIC LINK</label>
                                <input type="text" class="add-input" id="youtube_link" name="youtube_link" value="{{$artist -> youtube_link}}" required>
                            </div>
                        </div>
                    </div>

                    <div class="w-50 h-100 d-flex flex-column justify-content-end">
                        <div class="h-100 w-100">
                            <label for="description" class="mb-0 mt-2 add_input_label">EDIT DESCRIPTION</label>
                            <textarea class="add_textarea" id="description" name="description">{{$artist -> description}}</textarea>
                        </div>
                    </div>
                </div>

                <div class="d-flex w-100 flex-row justify-content-evenly mb-5">
                    <button type="submit" class="add-save-button me-3">SAVE</button>
                    <a href="/admin-panel" class="add-cancel-button text-decoration-none">CANCEL</a>
                </div>
            </form>
        </div>

    </div>

    <script>
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