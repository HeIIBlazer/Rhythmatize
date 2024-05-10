@extends ('layouts.app', ['title' => 'Albums List'])

@section('content')
<div class="container">
    @php
        if ($user != null) {
            $crypt_user = Crypt::encrypt($user -> id);
            $username = $user -> username;
        }else {
            $crypt_user = 0;
            $username = "";
        }

        @endphp
    <div class="Header-List">
        <p>ALBUMS</p>
    </div>

    <div class="row">
        @foreach ($albums as $album)
            @php
                $artist = \App\Models\Artist::find($album->artist_id);
                $crypt_album = Crypt::encrypt($album->id);
                $crypt_artist = Crypt::encrypt($artist->id);
            @endphp
            <div class="col-12 col-sm-6 col-md-4 col-lg-2 mb-4">
                <div class="card">
                    <a href="/album/{{$crypt_album}}" class="text-decoration-none">
                    <div class="mt-2 mb-4 d-flex justify-content-center">
                        <img src="{{secure_url ($album -> cover_url)}}" alt="" style="width: 90%; height: 90%; border-radius: 5px;" class="mt-2">
                    </div>
                    <div style="margin-left: 10px; max-width: 100%;" class="mb-3">
                        <p class="card-text-bigger">{{$album -> name}}</p>
                        <a class="text-decoration-none" href="/artist/{{$crypt_artist}}">
                            <p class="card-text w-100">{{$album -> release_date}} | {{$artist->name}}</p>
                        </a>
                    </div>
                    </a>

                    </div>
                </div>
                @if ($loop->iteration % 6 == 0 && $loop->iteration!= $loop->count)
                </div>
                <div class="row">
                @endif
        @endforeach
    </div>
    <div class="d-flex w-100 justify-content-center align-content-center mt-3">
        {!! $albums->links() !!}
    </div>
</div>

<script>
    // Get the current URL
// Get the current URL
const currentUrl = window.location.href;
const crypt = "{{$crypt_user}}";
const username ="{{$username}}";

// Check if the URL contains a specific string (e.g. "user-albums")
if (currentUrl.includes("liked-albums")) {
// Change the Header-Charts
    if (crypt != 0) {
        document.querySelector(".Header-List p").innerHTML = `Albums Liked by <a href="/user/${crypt}" class="Header-List-1">${username}</a>`;
        document.title = `${userName} liked albums`;
    }
} else {
// Default Header-Charts
    document.querySelector(".Header-List p").innerHTML = "ALBUMS";
    document.title = "ALBUMS";
}
</script>
    
@endsection
