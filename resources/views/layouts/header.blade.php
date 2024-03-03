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
          <a class="header_button" href="#">Charts</a>
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

