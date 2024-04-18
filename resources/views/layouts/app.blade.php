<!DOCTYPE html>
<html>

<head>

  <link rel="icon" style="width: 50px; height: 50px" type="image/x-icon" href="/images/logo_title.png">

  <title>
    @isset($title)
        {{ $title }} 
    @endisset
  </title>

<!-- Latest compiled and minified CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<link href="{{ URL::asset('css/main.css') }}" rel="stylesheet" type="text/css" >

</head>

  <nav class="navbar navbar-expand-lg navbar-black bg-black">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
        <a class="navbar-brand" href="/"><img src="{{ URL::asset('images/logo.png') }}" alt="Logo_Rhythmatize"></a>
        <ul class="navbar-nav me-auto justify-content-evenly w-25 mb-2 mb-lg-0">
          <li class="nav-item">
            <div class="dropdown">
              <a class="header_button" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">Charts</a>
              <ul class="dropdown-menu dropdown-menu-dark slim-dropdown-menu" aria-labelledby="dropdownMenuLink">
                <li><a class="dropdown-item" href="{{ url('/artist_chart')}}">Artists</a></li>
                <li><a class="dropdown-item" href="{{ url('/album_chart')}}">Albums</a></li>
                <li><a class="dropdown-item" href="{{url ('/track_chart')}}">Tracks</a></li>
              </ul>
            </div>
          </li>
          </li> 
          <li class="nav-item">
            <a class="header_button" href="{{ url ('/artist_list')}}">Artists</a>
          </li> 
          <li class="nav-item">
            <a class="header_button" href="{{ url ('/album_list')}}">Albums</a>
          </li>
        </ul>
        <form class="d-flex" method="GET" action="{{ url('/search') }}">
          <input class="form-control rounded-0 mr-5" name="search" type="search" placeholder="Search" aria-label="Search">
          <button class="search_button" type="submit">Search</button>
        </form>
        @if(Auth::guest())
        <div class="login_buttons">
          {{-- <div class="mb-2">
            <a class="login_button" href="{{url ('/login')}}">LOG IN</a>
          </div> --}}
        <div class="mb-2">
          <button class="login_button" data-toggle="modal" data-target="#loginModal">
          LOG IN
        </button>
      </div>
    
      <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content border-b">
                  <div class="login">
                      <div class="cross" data-dismiss="modal" aria-label="Close">
                          <button type="button" class="cross-button "> <span aria-hidden="true">&times;</span></button>
                      </div>
                      <div class="w-100">
                          <div>
                              <h1 class="login-header">LOG IN</h1>
                          </div>
                          
                          @if (session()->has('error_login'))
                              <div class="alert error-login">
                                  {{session()->get('error_login')}}
                              </div>
                          @endif
                          <div class="d-flex w-100 flex-column justify-content-center align-items-center">
                              <form action="{{url('/login_auth')}}" method="POST" class="form">
                                  @csrf
                                  <div class="w-100 d-flex justify-content-center align-center mt-2">
                                      <input type="email" class="login-input" name="email" placeholder="Email" required autofocus>
                                  </div>
                                  <div class="w-100 d-flex justify-content-center align-center mt-3 mb-4">
                                      <input type="password" class="login-input" name="password" placeholder="Password" minlength="6" required>
                                  </div>
                                  <div class="w-100 d-flex remember mb-3">
                                    <input type="checkbox" id="remember" name="remember" class="ms-5 form-check-input">
                                    <label for="remember" class="remember-me">
                                      Remember me
                                    </label>
                                  </div>
                                  <div class="w-100 d-flex justify-content-center mt-2 mb-4">
                                      <button type="submit" class="login-button" name="login">Log in</button>
                                  </div>
                              </form>
                              <hr style="border: 1px solid white; width:80%;">
                              <div class="mb-3">
                                  <p class="login-undertext">You don't have an account? <a data-toggle="modal" data-target="#signupModal" data-dismiss="modal" aria-label="Close" class="login-undertext-button">Create account here.</a></p>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
        <div class="mb-2">
          <button class="login_button" data-toggle="modal" data-target="#signupModal">
            SIGN UP
          </button>
        </div>

        <div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content border-b">
                  <div class="login">
                    <div class="cross" data-dismiss="modal" aria-label="Close">
                      <button type="button" class="cross-button "> <span aria-hidden="true">&times;</span></button>
                    </div>
                      <div class="w-100">
                          <div>
                              <p class="login-header">SIGN UP</p>
                          </div>
                          @if (session()->has('error_signup'))
                          <div class="alert error-login-1">
                              {{session()->get('error_signup')}}
                          </div>
                          @endif
                          <div class="d-flex w-100 flex-column justify-content-center align-items-center h-75 ">
                              <form action="{{url('/register')}}" method="POST" class="form" enctype="multipart/form-data">
                                  @csrf
                                  <div class="w-100 d-flex justify-content-center align-items-center flex-column align-center mt-3">
                                    <img id="imagePreview" src="#" alt="Image preview" style="display: none; width: 45%; height: 45%; border:3#808080px solid #808080; border-radius: 5px;" class="mb-3 mt-0"/>
                                    <input type="file" id="imageInput" name="avatar_url" class="img-input">
                                    <label for="imageInput"  id="imageInputLabel" class="edit-button m-0">Insert Avatar</label>
                                  </div>
                                  <div class="w-100 d-flex justify-content-center align-center mt-3">
                                      <input type="text" class="login-input" name="username" placeholder="Username" required autofocus>
                                  </div>
                                  <div class="w-100 d-flex justify-content-center align-center mt-3">
                                      <input type="email" class="login-input" name="email" placeholder="Email" required>
                                  </div>
                                  <div class="w-100 d-flex justify-content-center align-center mt-3">
                                      <input type="password" class="login-input" name="password" placeholder="Password" minlength="6" required>
                                  </div>
                                  <div class="w-100 d-flex justify-content-center align-center mt-3">
                                      <input type="password" class="login-input" name="password_confirmation" placeholder="Confirm Password" minlength="6" required>
                                  </div>
                                  <div class="w-100 d-flex justify-content-center mt-3 mb-3">
                                      <button type="submit" class="login-button" name="login">Sign up</button>
                                  </div>
                              </form>
                              <hr style="border: 1px solid white; width:80%; margin-top: 1px;">
                              <div class="mb-3">
                                  <p class="login-undertext">You already have an account? <a data-toggle="modal" data-target="#loginModal" data-dismiss="modal" aria-label="Close" class="login-undertext-button">Log in here.</a></p>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>

      </div>
        @else
        <li class="avatar-button">
          <div class="dropdown">
              <a class="header_button" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"><img src="{{url (Auth::user()-> avatar_url)}}" alt="" style="width: 45px; height: 45px; border-radius: 50px; object-fit: cover;"></a>
            <ul class="dropdown-menu dropdown-menu-dark slim-dropdown-menu" aria-labelledby="dropdownMenuLink">
              @php
                $crypt = Crypt::encrypt(Auth::user() -> id);
              @endphp
              <li><a class="dropdown-item" href="/user/{{$crypt}}">Profile</a></li>
              <li><a class="dropdown-item" href="{{url ('/logout')}}">Log out</a></li>
            </ul>
          </div>
        </li>
        @endif
      </div>
    </div>
  </nav>
  <div>
    @yield('content')
  </div>


<div class="footer mt-5">
    <div class="socials_part mt-4 ">
        <div>
            <img src="{{asset('images/logo.png')}}" alt="">
        </div>
        <div class="socials_text_block">
            <p class="socials_text">Reach us at <u>Rhythmatize@gmail.com</u> or through our socials.</p>
        </div>
        <div class="socials_logos">
            <div>
                <a href="https://www.instagram.com/"><img src="{{asset('images/socials_logos/instagram.png')}}" alt="" class="logo_button"></a>
            </div>
            <div>
                <a href="https://www.facebook.com/"><img src="{{asset('images/socials_logos/facebook.png')}}" alt="" class="logo_button"></a>
            </div> 
            <div>
                <a href="https://www.twitter.com/"><img src="{{asset('images/socials_logos/x.png')}}" alt="" class="logo_button"></a>
            </div>
        </div>
    </div>

    <div class="vertical_line">
    </div>

    <div class="links_part w-50 mr-5">
        <div class="albums_part">
            <div>
                <p class="links_header">ALBUM</p>
            </div>
            <div class="links_buttons">
                <a href="{{ url('/album_chart')}}" class="links_button">Charts</a>
            </div>
            <div class="links_buttons">
                <a href="{{ url('/last_added_albums')}}" class="links_button">Last Added</a>
            </div>
            <div class="links_buttons">
                <a href="{{ url('/album_list')}}" class="links_button">List</a>
            </div>
        </div>
        <div class="Artists_part">
            <div>
                <p class="links_header">ARTIST</p>
            </div>
            <div class="links_buttons">
                <a href="{{ url('/artist_chart')}}" class="links_button">Charts</a>
            </div>
            <div class="links_buttons">
                <a href="{{ url('/last_added_artists')}}" class="links_button">Last Added</a>
            </div>
            <div class="links_buttons">
                <a href="{{ url('/artist_list')}}" class="links_button">List</a>
            </div>
        </div>
        <div class="Songs_part">
            <div>
                <p class="links_header">TRACKS</p>
            </div>
            <div class="links_buttons">
                <a href="{{url ('/track_chart')}}" class="links_button">Charts</a>
            </div>
        </div>
          @if(Auth::check() && Auth::user()->role == 'admin')
          <div class="h-100 d-flex align-items-center justify-content-center">
            <a href="{{url ('/track_chart')}}" class="links_header">ADMIN</a>
          </div>
          @else
          @endif
    </div>

    <div class="vertical_line">
    </div>

    <div class="Copyright_part">
        <div class="copyright_text">
            <p>&copy; 2024 Copyright: <br>rhythmatize.com</p>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script>
  $(document).ready(function () {
      // Check if there is an error message in the session
      if ($('.error-login').length > 0) {
          // Open the modal window
          $('#loginModal').modal('show');
      }else if($('.error-login-1').length > 0){
          $('#signupModal').modal('show');
      }
      $('.cross').click(function () {
        // Close the modal window
        $(this).closest('.modal').modal('hide');
    });
    $('.login-undertext-button').click(function () {
        // Close the modal window
        $(this).closest('.modal').modal('hide');
    });
  });

  const imageInput = document.getElementById('imageInput');
  const imagePreview = document.getElementById('imagePreview');
  const imageInputLabel = document.getElementById('imageInputLabel');

  imageInput.addEventListener('change', function(event) {
    const file = event.target.files[0];
    const reader = new FileReader();
    const fileName = event.target.files[0].name;

    reader.onload = function(event) {
      imagePreview.src = event.target.result;
      imagePreview.style.display = 'block';
      imageInputLabel.textContent = fileName;
    };
    reader.readAsDataURL(file);
});
    

</script>


    <!-- Include the Bootstrap JavaScript file -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

  </html>