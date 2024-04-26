@extends('layouts.app', ['title' => 'Add Artist'])

@section('content')
    <div class="container">

        <div class="Header-List">
            <p>ADD ARTIST</p>
        </div>

        @if (session()->has('error'))
        <div class="alert error-login-1">
            {{session()->get('error')}}
        </div>
        @endif

        <div>
            <form method="POST" action="{{url('/add-artist-to-database')}}" enctype="multipart/form-data">
                @csrf

                <div class="d-flex flex-row justify-content-evenly mt-2 mb-5">
                    <div class="w-50 d-flex justify-content-center align-items-center flex-column align-center mt-3">
                        <input type="file" id="photoInput" name="picture_url" class="img-input">
                        <label for="photoInput"  id="photoInputLabel" class="edit-change-button m-0 d-flex flex-column align-items-center">
                            <img id="photoPreview" src="{{ URL::asset('images/camera.svg') }}" alt="Image preview" style=" width: 230px; height: 230px; border:3px solid #BDBDBD; border-radius: 10px; padding: 50px" class="mb-3 mt-0"/>
                            <p id="photoInputText" class="text-center">
                                ADD PHOTO
                            </p> 
                        </label>
                    </div>

                    <div class="w-50 d-flex justify-content-center align-items-center flex-column align-center mt-3">
                        <input type="file" id="coverInput" name="banner_url" class="img-input">
                        <label for="coverInput"  id="coverInputLabel" class="edit-change-button m-0 d-flex flex-column align-items-center">
                            <img id="coverPreview" src="{{ URL::asset('images/camera.svg') }}" alt="Image preview" style=" width: 230px; height: 230px; border:3px solid #BDBDBD; border-radius: 10px; padding: 50px" class="mb-3 mt-0"/>
                            <p id="coverInputText" class="text-center">
                                ADD BANNER
                            </p> 
                        </label>
                    </div>
                </div>

                <div class="d-flex justify-content-evenly h-100 mb-5">
                    <div class="w-50">
                        <div>  
                            <div>
                                <label for="name" class="mb-0 mt-2 add_input_label">ADD ARTIST NAME</label>
                                <input type="text" class="add-input" id="name" name="name" required>
                            </div>
    
                            <div>
                                <label for="description" class="mb-0 mt-2 add_input_label">ADD SPOTIFY LINK</label>
                                <input type="text" class="add-input" id="spotify_link" name="spotify_link" required>
                            </div>
    
                            <div>
                                <label for="description" class="mb-0 mt-2 add_input_label">ADD APPLE MUSIC LINK</label>
                                <input type="text" class="add-input" id="apple_music_link" name="apple_music_link" required>
                            </div>
    
                            <div>
                                <label for="description" class="mb-0 mt-2 add_input_label">ADD YOUTUBE MUSIC LINK</label>
                                <input type="text" class="add-input" id="youtube_link" name="youtube_link" required>
                            </div>
                        </div>
                    </div>

                    <div class="w-50 h-100 d-flex flex-column justify-content-end">
                        <div class="h-100 w-100">
                            <label for="description" class="mb-0 mt-2 add_input_label">ADD DESCRIPTION</label>
                            <textarea class="add_textarea" id="description" name="description"></textarea>
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