@extends ('layouts.app', ['title' => 'Albums Chart'])

@section('content')
<div class="container">
    <div class="Header-Charts">
        <p>ALBUMS CHART</p>
    </div>

    <div class="w-100">
        @php
            $i = ($albums->currentPage() - 1) * $albums->perPage() + 1;
        @endphp

        @foreach ($albums as $album)

        @php
            $artist = \App\Models\Artist::find($album->artist_id);
            $album_likes = DB::table('like_albums')
                            ->where('like_albums.album_id', $album->id)
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
                    <span class="chart-text-big">{{$album -> name}}</span>
                </div>
                <div class="chart-small">
                    <span class="chart-small-text">{{$artist -> name}}</span>
                </div>
                <div class="chart-like">
                    <img src="{{asset('images/like.png')}}" alt="" style="width: 22px; height: 22px; margin-right: 6px;">
                    <span class="chart-like-text">{{$album_likes}}</span>
                </div>
            </div>
            <hr style="border: 1px white solid; margin-top: 8px">
            @php
            $i++;
            @endphp

        @endforeach
    </div>
    <div class="d-flex w-100 justify-content-center align-content-center mt-5">
        {!! $albums->links() !!}
    </div>
</div>
@endsection