@extends('layouts.app', ['title' => 'All Albums By '.$artist -> name])

@section('content')
    @php
        $crypt_artist = Crypt::encrypt($artist -> id);
    @endphp
    <div class="container">
        <div class="w-100">
            <a href="/artist/{{$crypt_artist}}" class="text-decoration-none"><h2 class="w-100 all-header text-uppercase">{{$artist -> name}} ALBUMS</h2></a>
        </div>

        <div class="w-100 d-flex flex-row justify-content-center mb-3 mt-3">
            <div class="me-4 all-button-pressed">
                <span>All Albums</a>
            </div>
            <div class="all-button-unpressed">
                <a href="/all-tracks/{{$crypt_artist}}" class="text-decoration-none white-text">All Tracks</a>
            </div>
        </div>

        <div>
            <div class="d-flex flex-row justify-content-center align-items-center">
                <div class="artist-header-line"></div>
                <div class="ms-2 me-2 d-flex justify-content-center">
                    <span class="all-header-2 text-uppercase">MOST POPULAR {{$artist -> name}} albums</span>
                </div>
                <div class="artist-header-line"></div>
            </div>
        </div>

        <div class="d-flex flex-row justify-content-evenly w-100 mt-3 mb-3">
            @foreach ($albums as $album)
                @php
                    $crypt_album = Crypt::encrypt($album -> id);

                    $album_likes = DB::table('like_albums')
                            ->where('like_albums.album_id', $album->id)
                            ->count();

                    $album_liked = DB::table('like_albums')
                            ->where('like_albums.album_id', $album->id)
                            ->where('like_albums.user_id', Auth::id())
                            ->count();

                    $number_albums = 0;

                    if($all_albums -> count() == 0)
                        $number_albums = $albums -> count();
                    else
                        $number_albums = $all_albums -> count() + 3;
                @endphp

                    <a href="/album/{{$crypt_album}}"  class="d-flex flex-row all-tracks-3 text-decoration-none">
                        <div class="d-flex justify-content-center align-items-center h-100">
                            <img src="{{url ($album -> cover_url)}}" alt="" class="track-cover">
                        </div>

                        <div class="w-100">
                            <div class="w-100 d-flex flex-column justify-content-evenly">
                                <p class="artist-track-name">{{$album -> name}}</p>

                                <p class="artist-track-album">{{$album -> type}} | {{$album -> release_date}}</p>
                            </div>
                            <div class="d-flex flex-row flex-wrap align-content-end" style="padding: 10px 10px; height:45%;">
                                @if ($album_liked == 1)
                                <div class="d-flex flex-column justify-content-around">
                                    <img src="{{asset('images/liked.png')}}" alt="" style="width: 25px; height: 25px; margin-right: 6px;">
                                </div>
                                @else
                                <div class="d-flex flex-column justify-content-around">
                                    <img src="{{asset('images/like.png')}}" alt="" style="width: 25px; height: 25px; margin-right: 6px;">
                                </div>
                                @endif
                                <div>
                                    <span style="color: white; font-size:25px; vertical-align: bottom;"> {{$album -> likes_count}} </span>
                                </div>  
                            </div>
                        </div>
                    </a>
                @php
                    $album_liked = 0;
                @endphp
            @endforeach
        </div>

        <div class="w-100 d-flex flex-column justify-content-center">
            <div class="d-flex flex-row justify-content-center align-items-center">
                <div class="all-line-2"></div>
                <div class="ms-2 me-2 d-flex justify-content-center">
                    <span class="all-header-2 text-uppercase">ALL {{$artist -> name}} ALBUMS</span>
                </div>
                <div class="all-line-2"></div>
            </div>
            <div>
                <p class="all-header-3 mt-2 mb-3">{{$artist -> name}} discography includes {{$number_albums}} albums</p>
            </div>
        </div>

        

        <div class="w-100 mb-5">
            @if ($all_albums -> count() == 0)
                <div class="d-flex justify-content-center align-items-center" style="height: 150px;">
                    <p class="no-info">ARTIST HAS NO OTHER ALBUMS</p>
                </div>
                
            @else
            @php
                $i = 4;
            @endphp
            <table class="w-100">
            @foreach ($all_albums as $album)
                
            @php
                $artist = \App\Models\Artist::find($album->artist_id);
                $crypt_album = Crypt::encrypt($album->id);

                $album_likes = DB::table('like_albums')
                            ->where('like_albums.album_id', $album->id)
                            ->count();

                $album_liked = DB::table('like_albums')
                        ->where('like_albums.album_id', $album->id)
                        ->where('like_albums.user_id', Auth::id())
                        ->count();
            @endphp
                <tr style="border-bottom: white solid 1px" >
                    <td style="width: 6%;" class="table-separete">
                        <div class="number w-100">
                            <span class="numbers w-100">{{$i}}.</span>
                        </div>
                    </td>
                    <td style="width: 8%;" class="table-separete">
                        <div class="chart-pic">
                            <a href="/album/{{$crypt_album}}">
                                <div class="chart-pic w-100">
                                    <img src="{{url ($album -> cover_url)}}" alt="" style="width: 75px; height: 75; object-fit: cover;">
                                </div>
                            </a>
                        </div>
                    </td>
                    <td style="width:80%;" class="table-separete">
                        <div class="chart-big">
                            <a href="/album/{{$crypt_album}}" class="text-decoration-none">
                                <div class="chart-big">
                                    <span class="chart-text-big">{{$album -> name}}</span>
                                </div>
                            </a>
                        </div>
                    </td>
                    <td style="width:8%;" class="table-separete">
                        <div class="chart-like w-100 d-flex">
                            @if ($album_liked ==1)
                                <img src="{{asset('images/liked.png')}}" alt="" style="width: 22px; height: 22px; margin-right: 6px;">
                            @else
                                <img src="{{asset('images/like.png')}}" alt="" style="width: 22px; height: 22px; margin-right: 6px;">
                            @endif
                            <span class="chart-like-text">{{$album_likes}}</span>
                        </div>
                    </td>
                </tr>
                @php
                $i++;
                $album_liked = 0;
                @endphp
    
            @endforeach
            </table>
            @endif
        </div>
    </div>
@endsection
