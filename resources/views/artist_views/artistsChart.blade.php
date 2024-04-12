@extends ('layouts.app', ['title' => 'Artists Chart'])

@section('content')
<div class="container">
    <div class="Header-Charts">
        <p>ARTISTS CHART</p>
    </div>

    <div class="w-100">
        @php
            $i = ($artists->currentPage() - 1) * $artists->perPage() + 1;
        @endphp

        @foreach ($artists as $artist)

        @php
            $artist_likes = DB::table('like_artists')
                            ->where('like_artists.artist_id', $artist->id)
                            ->count();
        @endphp
            <a href="/artist/{{$artist-> id}}" class="chart-line">
                <div class="number">
                    <span class="numbers w-100">{{$i}}.</span>
                </div>
                <div class="chart-pic">
                    <img src="{{url ($artist -> picture_url)}}"  style="object-fit: cover; width:75px; height: 75px;">
                </div>
                <div class="chart-big">
                    <span class="chart-text-big">{{$artist -> name}}</span>
                </div>
                <div class="chart-like-artist">
                    <img src="{{asset('images/like.png')}}" alt="" style="width: 22px; height: 22px; margin-right: 6px;">
                    <span class="chart-like-text-artist">{{$artist_likes}}</span>
                </div>
            </a>
            <hr style="border: 1px white solid; margin-top: 8px">
            @php
            $i++;
            @endphp

        @endforeach
    </div>
    <div class="d-flex w-100 justify-content-center align-content-center mt-5">
        {!! $artists->links() !!}
    </div>
</div>
@endsection
