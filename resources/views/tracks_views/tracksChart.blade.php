@extends ('layouts.app', ['title' => 'Tracks Chart'])

@section('content')
<div class="container">
    <div class="Header-Charts">
        <p>TRACKS CHART</p>
    </div>

    <div class="w-100">
        @php
            $i = ($tracks->currentPage() - 1) * $tracks->perPage() + 1;
        @endphp

        @foreach ($tracks as $track)

        @php
            $album = \App\Models\Album::find($track->album_id); 
            $artist = \App\Models\Artist::find($album->artist_id);
            $tracks_likes = DB::table('like_tracks')
                            ->where('like_tracks.track_id', $track->id)
                            ->count();
        @endphp
        
            <div class="chart-line">
                <div class="number">
                    <span class="numbers w-100">{{$i}}.</span>
                </div>
                <div class="chart-pic">
                    <img src="{{url ($album -> cover_url)}}" alt="" style="width: 75px; height: 75; object-fit: cover;">
                </div>
                <div class="chart-big">
                    <span class="chart-text-big">{{$track -> name}}</span>
                </div>
                <div class="chart-small">
                    <a class="text-decoration-none" href="/artist/{{$artist -> id}}"><span class="chart-small-text">{{$artist -> name}}</span></a>
                </div>
                <div class="chart-like">
                    <img src="{{asset('images/like.png')}}" alt="" style="width: 22px; height: 22px; margin-right: 6px;">
                    <span class="chart-like-text">{{$tracks_likes}}</span>
                </div>
            </div>
            <hr style="border: 1px white solid; margin-top: 8px">
            @php
            $i++;
            @endphp

        @endforeach
    </div>
    <div class="d-flex w-100 justify-content-center align-content-center mt-5">
        {!! $tracks->links() !!}
    </div>
</div>
@endsection