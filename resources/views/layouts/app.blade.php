<!-- Latest compiled and minified CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<link href="{{ URL::asset('css/main.css') }}" rel="stylesheet" type="text/css" >



<nav class="navbar navbar-expand-lg navbar-black bg-black">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      <a class="navbar-brand" href="#"><img src="{{ URL::asset('images/logo.png') }}" alt="Logo_Rhythmatize"></a>
      <ul class="navbar-nav me-auto justify-content-evenly w-25 mb-2 mb-lg-0">
        <li class="nav-item">
          <div class="dropdown">
            <a class="header_button" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">Charts</a>
            <ul class="dropdown-menu dropdown-menu-dark slim-dropdown-menu" aria-labelledby="dropdownMenuLink">
              <li><a class="dropdown-item" href="#">Artists</a></li>
              <li><a class="dropdown-item" href="#">Albums</a></li>
              <li><a class="dropdown-item" href="#">Tracks</a></li>
            </ul>
          </div>
        </li>
        </li> 
        <li class="nav-item">
          <a class="header_button" href="#">Artists</a>
        </li> 
        <li class="nav-item">
          <a class="header_button" href="#">Albums</a>
        </li>
      </ul>
      <form class="d-flex mt-3 ">
        <input class="form-control rounded-0 mr-5" type="search" placeholder="Search" aria-label="Search">
        <button class="search_button" type="submit">Search</button>
      </form>
      <div class="login_buttons">
        <div class="mb-2">
          <a href="#" class="login_button">LOG IN</a>
        </div>
        <div>
          <a href="#" class="login_button">SIGN UP</a>
        </div>
      </div>
    </div>
  </div>
</nav>


<div class="footer">
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
                <a href="#" class="links_button">Charts</a>
            </div>
            <div class="links_buttons">
                <a href="#" class="links_button">Last Added</a>
            </div>
            <div class="links_buttons">
                <a href="#" class="links_button">List</a>
            </div>
        </div>
        <div class="Artists_part">
            <div>
                <p class="links_header">ARTIST</p>
            </div>
            <div class="links_buttons">
                <a href="#" class="links_button">Charts</a>
            </div>
            <div class="links_buttons">
                <a href="#" class="links_button">Last Added</a>
            </div>
            <div class="links_buttons">
                <a href="#" class="links_button">List</a>
            </div>
        </div>
        <div class="Songs_part">
            <div>
                <p class="links_header">SONG</p>
            </div>
            <div class="links_buttons">
                <a href="#" class="links_button">Charts</a>
            </div>
            <div class="links_buttons">
                <a href="#" class="links_button">Last Added</a>
            </div>
        </div>
    </div>

    <div class="vertical_line">
    </div>

    <div class="Copyright_part">
        <div class="copyright_text">
            <p>@ 2024 Copyright: <br>Rhythmatize.com</p>
        </div>
    </div>
</div>
