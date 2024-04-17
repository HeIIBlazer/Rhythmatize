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
        <table class="w-100">


        @foreach ($artists as $artist)

        @php
            $artist_likes = DB::table('like_artists')
                            ->where('like_artists.artist_id', $artist->id)
                            ->count();
        @endphp

            <tr style="margin-bottom: 10px; border-bottom: white solid 1px" >
                <td style="width: 6%;" class="table-separete">
                    <div class="number w-100">
                        <span class="numbers w-100">{{$i}}.</span>
                    </div>
                </td>
                <td style="width: 8%;" class="table-separete">
                    <a href="/artist/{{$artist -> id}}" class="text-decoration-none">
                        <div class="chart-pic w-100">
                            <img src="{{url ($artist -> picture_url)}}" alt="" style="width: 75px; height: 75px; object-fit: cover;">
                        </div>
                    </a>
                </td>
                <td style="width:80%;">
                    <a href="/artist/{{$artist -> id}}" class="text-decoration-none">
                        <div class="chart-big">
                            <span class="chart-text-big">{{$artist -> name}}</span>
                        </div>
                    </a>
                </td>
                <td style="width:8%;" class="table-separete">
                    <div class="chart-like w-100 d-flex">
                        <img src="{{asset('images/like.png')}}" alt="" style="width: 22px; height: 22px; margin-right: 6px;">
                        <span class="chart-like-text">{{$artist_likes}}</span>
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
        {!! $artists->links() !!}
    </div>
</div>
@endsection
