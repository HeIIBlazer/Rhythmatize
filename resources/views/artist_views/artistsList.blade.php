@extends ('layouts.app', ['title' => 'Artists List'])

@section('content')
    <div class="container">
        @php
            if ($user != null) {
                $id = $user->id;
                $username = $user -> username;
            }else{
                $id = 0;
                $username = "";
            }
        @endphp
    <div class="Header-List">
        <p>ARTISTS</p>
    </div>

    <div class="d-flex justify-content-evenly">
        @foreach ($artists as $artist)
                <a href="/artist/{{$artist -> id}}" class="card">
                    <div class="mt-2 mb-3 d-flex justify-content-center">
                        <img src="{{url ($artist -> picture_url)}}" alt="" style="width: 185px; height: 185px; border-radius: 5px; object-fit: cover;">
                    </div>
                    <div style="margin-left: 10px; max-width: 100%;">
                        <p class="card-text-bigger-artist">{{$artist -> name}}</p>
                    </div>
                </a>
            @if ($loop->iteration % 6 == 0 && $loop->iteration!= $loop->count)
                </div>
                <div class="d-flex">
            @endif
        @endforeach
    </div>
    <div class="d-flex w-100 justify-content-center align-content-center mt-3">
        {!! $artists->links() !!}
    </div>
</div>

<script>
const currentUrl = window.location.href;

let id = {{$id}};
const username ="{{$username}}";
// Check if the URL contains a specific string (e.g. "user-albums")
if (currentUrl.includes("liked-artists")) {
    if (id != 0) {
        document.querySelector(".Header-List p").innerHTML = `Artists Liked by <a href="/user/${id}" class="Header-List-1">${username}</a>`;
        document.title = `${userName}'s liked artists`;
    }
}
</script>
    
    
@endsection