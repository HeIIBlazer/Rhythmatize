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

        <table class="w-100">
        @foreach ($albums as $album)

        @php
            $artist = \App\Models\Artist::find($album->artist_id);
            $album_likes = DB::table('like_albums')
                            ->where('like_albums.album_id', $album->id)
                            ->count();
            $crypt = Crypt::encrypt($album->id);
            $crypt_artist = Crypt::encrypt($artist->id);
        @endphp
            <tr style="border-bottom: white solid 1px" >
                <td style="width: 6%;" class="table-separete">
                    <div class="number w-100">
                        <span class="numbers w-100">{{$i}}.</span>
                    </div>
                </td>
                <td style="width: 8%;" class="table-separete">
                    <a href="/album/{{$crypt}}">
                        <div class="chart-pic w-100">
                            <img src="{{url ($album -> cover_url)}}" alt="" style="width: 75px; height: 75; object-fit: cover;">
                        </div>
                    </a>
                </td>
                <td style="width:40%;" class="table-separete">
                    <a href="/album/{{$crypt}}" class="text-decoration-none">
                        <div class="chart-big">
                            <span class="chart-text-big">{{$album -> name}}</span>
                        </div>
                    </a>
                </td>
                <td style="width:40%;" class="table-separete">
                    <div class="chart-small w-100 ">
                        <a class="text-decoration-none" href="/artist/{{$crypt_artist}}"><span class="chart-small-text">{{$artist -> name}}</span></a>
                    </div>
                </td>
                <td style="width:8%;" class="table-separete">
                    <div class="chart-like w-100 d-flex">
                        <img src="{{asset('images/like.png')}}" alt="" style="width: 22px; height: 22px; margin-right: 6px;">
                        <span class="chart-like-text">{{$album_likes}}</span>
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
        {!! $albums->links() !!}
    </div>
</div>

@endsection