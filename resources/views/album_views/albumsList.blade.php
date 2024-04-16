@extends ('layouts.app', ['title' => 'Albums List'])

@section('content')
<div class="container">
    @php
        if ($user != null) {
            $id = $user->id;
            $username = $user -> username;
        }else {
            $id = 0;
            $username = "";
        }
    @endphp
    <div class="Header-List">
        <p>ALBUMS</p>
    </div>

    <div class="d-flex justify-content-evenly">
        @foreach ($albums as $album)
            @php
                $artist = \App\Models\Artist::find($album->artist_id);
            @endphp
            @if ($loop->iteration <= 12)
                <div class="card">
                    <div class="mt-2 mb-4 d-flex justify-content-center">
                        <img src="{{url ($album -> cover_url)}}" alt="" style="width: 185px; height: 185px; border-radius: 5px; ">
                    </div>
                    <div style="margin-left: 10px; max-width: 100%;">
                        <p class="card-text-bigger">{{$album -> name}}</p>
                        <a class="text-decoration-none" href="/artist/{{$artist -> id}}"><p class="card-text w-100">{{$album -> release_date}} | {{$artist->name}}</p></a>
                    </div>
                </div>
            @endif
            @if ($loop->iteration % 6 == 0 && $loop->iteration!= $loop->count)
                </div>
                <div class="d-flex justify-content-evenly">
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
const id = {{$id}};
const username ="{{$username}}";

// Check if the URL contains a specific string (e.g. "user-albums")
if (currentUrl.includes("liked-albums")) {
// Change the Header-Charts
    if (id != 0) {
        document.querySelector(".Header-List p").innerHTML = `Albums Liked by <a href="/user/${id}" class="Header-List-1">${username}</a>`;
        document.title = `${userName} liked albums`;
    }
} else {
// Default Header-Charts
    document.querySelector(".Header-List p").innerHTML = "Albums";
    document.title = "Albums";
}
</script>
    
@endsection
