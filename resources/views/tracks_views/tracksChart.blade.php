@extends ('layouts.app', ['title' => 'Tracks Chart'])

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
    <div class="Header-Charts">
        <p>TRACKS CHART</p>
    </div>

    <div class="w-100">
        @php
            $i = ($tracks->currentPage() - 1) * $tracks->perPage() + 1;
        @endphp
        <table class="w-100">
        @foreach ($tracks as $track)

        @php
            $album = \App\Models\Album::find($track->album_id); 
            $artist = \App\Models\Artist::find($album->artist_id);
            $track_likes = DB::table('like_tracks')
                            ->where('like_tracks.track_id', $track->id)
                            ->count();
            $crypt_track = Crypt::encrypt($track->id);
            $crypt_artist = Crypt::encrypt($artist->id);
        @endphp
            <tr style="border-bottom: white solid 1px" >
                <td style="width: 6%;" class="table-separete">
                    <div class="number w-100">
                        <span class="numbers w-100">{{$i}}.</span>
                    </div>
                </td>
                <td style="width: 8%;" class="table-separete">
                    <div class="chart-pic">
                        <a href="/track/{{$crypt_track}}">
                            <div class="chart-pic w-100">
                                <img src="{{url ($album -> cover_url)}}" alt="" style="width: 75px; height: 75; object-fit: cover;">
                            </div>
                        </a>
                    </div>
                </td>
                <td style="width:40%;" class="table-separete">
                    <div class="chart-big">
                        <a href="/track/{{$crypt_track}}" class="text-decoration-none">
                            <div class="chart-big">
                                <span class="chart-text-big">{{$track -> name}}</span>
                            </div>
                        </a>
                    </div>
                </td>
                <td style="width:40%;" class="table-separete">
                    <a class="text-decoration-none" href="/artist/{{$crypt_artist}}">
                        <div class="chart-small w-100">
                            <span class="chart-small-text">{{$artist -> name}}</span>
                        </div>
                    </a>
                </td>
                <td style="width:8%;" class="table-separete">
                    <div class="chart-like w-100 d-flex">
                        <img src="{{asset('images/like.png')}}" alt="" style="width: 22px; height: 22px; margin-right: 6px;">
                        <span class="chart-like-text">{{$track_likes}}</span>
                    </div>
                </td>
            </tr>
            @php
            $i++;
            @endphp

        @endforeach
        </table>
    </div>
    <div class="d-flex w-100 justify-content-center align-content-center mt-5">
        {!! $tracks->links() !!}
    </div>
</div>

<script>
    const currentUrl = window.location.href;
    
    let id = {{$id}};
    const username ="{{$username}}";
    // Check if the URL contains a specific string (e.g. "user-albums")
    if (currentUrl.includes("liked-tracks")) {
        if (id != 0) {
            document.querySelector(".Header-Charts p").innerHTML = `Tracks Liked by <a href="/user/${id}" class="Header-List-1">${username}</a>`;
            document.title = `${userName}'s liked tracks`;
        }
    }
    </script>
@endsection