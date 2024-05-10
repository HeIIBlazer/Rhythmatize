@extends('layouts.app', ['title' => 'All Tracks By '.$artist -> name])

@section('content')
    @php
        $crypt_artist = Crypt::encrypt($artist -> id);

    @endphp
    <div class="container">
        <div class="w-100">
            <a href="/artist/{{$crypt_artist}}" class="text-decoration-none"><h2 class="w-100 all-header text-uppercase">{{$artist -> name}} TRACKS</h2></a>
        </div>

        <div class="w-100 d-flex flex-row justify-content-center mb-3 mt-3">
            <div class="me-4 all-button-unpressed">
                <a href="/all-albums/{{$crypt_artist}}" class="text-decoration-none white-text">All Albums</a>
            </div>
            <div class="all-button-pressed">
                <span>All Tracks</span>
            </div>
        </div>

        <div>
            <div class="d-flex flex-row justify-content-center align-items-center">
                <div class="artist-header-line flex-grow-1"></div>
                <div class="ms-2 me-2 d-flex justify-content-center">
                    <span class="all-header-2 text-uppercase">MOST POPULAR {{$artist -> name}} TRACKS</span>
                </div>
                <div class="artist-header-line flex-grow-1"></div>
            </div>
        </div>

        <div class="w-100 d-flex flex-lg-row flex-column justify-content-evenly mt-4 mb-4">
            @foreach ($tracks as $track)
                @php
                    $crypt_track = Crypt::encrypt($track -> id);

                    $track_likes = DB::table('like_tracks')
                            ->where('like_tracks.track_id', $track->id)
                            ->count();
                    
                    $album = \App\Models\Album::find($track -> album_id);
                    $crypt_album = Crypt::encrypt($album -> id);

                    $track_liked = DB::table('like_tracks')
                            ->where('like_tracks.track_id', $track->id)
                            ->where('like_tracks.user_id', Auth::id())
                            ->count();

                    $number_tracks = $all_tracks -> count() + 3;
                @endphp

                <a href="/track/{{$crypt_track}}" class="text-decoration-none">
                    <div class="d-flex flex-row all-tracks-3 w-100 w-lg-30 mt-lg-0 mt-4">

                        <div class="d-flex justify-content-center align-items-center h-100">
                            <img src="{{secure_url ($album -> cover_url)}}" alt="" class="track-cover">
                        </div>

                        <div class="w-100">
                            <div class="w-100 d-flex flex-column justify-content-evenly">
                                <p class="artist-track-name">{{$track -> name}}</p>

                                <a href="/album/{{$crypt_album}}" class="text-decoration-none"><p class="artist-track-album">{{$album -> name}}</p></a>
                            </div>
                            <div class="d-flex flex-row flex-wrap align-content-end" style="padding: 10px 10px; height:45%;">
                                @if ($track_liked == 1)
                                <div class="d-flex flex-column justify-content-around">
                                    <img src="{{asset('images/liked.png')}}" alt="" style="width: 25px; height: 25px; margin-right: 6px;">
                                </div>
                                @else
                                <div class="d-flex flex-column justify-content-around">
                                    <img src="{{asset('images/like.png')}}" alt="" style="width: 25px; height: 25px; margin-right: 6px;">
                                </div>
                                @endif
                                <div>
                                    <span style="color: white; font-size:25px; vertical-align: bottom;"> {{$track -> likes_count}} </span>
                                </div>  
                            </div>
                        </div>
                    </div>
                </a>
                @php
                    $track_liked = 0;
                @endphp
            @endforeach
        </div>

        <div class="w-100 d-flex flex-column justify-content-center">
            <div class="d-flex flex-row justify-content-center align-items-center">
                <div class="all-line-2 flex-grow-1"></div>
                <div class="ms-2 me-2 d-flex justify-content-center">
                    <span class="all-header-2 text-uppercase">ALL {{$artist -> name}} TRACKS</span>
                </div>
                <div class="all-line-2 flex-grow-1"></div>
            </div>
            <div>
                <p class="all-header-3 mt-2 mb-3">{{$artist -> name}} discography includes {{$number_tracks}} songs</p>
            </div>
        </div>

        <div class="w-100 mb-5">
            @php
                $i = 4;
            @endphp
            <table class="w-100">
            @foreach ($all_tracks as $track)
                
            @php
                $album = \App\Models\Album::find($track->album_id); 
                $artist = \App\Models\Artist::find($album->artist_id);
                $track_likes = DB::table('like_tracks')
                                ->where('like_tracks.track_id', $track->id)
                                ->count();
                $crypt_track = Crypt::encrypt($track->id);
                $crypt_album = Crypt::encrypt($album->id);

                $track_liked = DB::table('like_tracks')
                            ->where('like_tracks.track_id', $track->id)
                            ->where('like_tracks.user_id', Auth::id())
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
                            <a href="/track/{{$crypt_track}}">
                                <div class="chart-pic w-100">
                                    <img src="{{secure_url ($album -> cover_url)}}" alt="" style="width: 75px; height: 75; object-fit: cover;">
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
                        <a class="text-decoration-none" href="/album/{{$crypt_album}}">
                            <div class="chart-small w-100">
                                <span class="chart-small-text">{{$album -> name}}</span>
                            </div>
                        </a>
                    </td>
                    <td style="width:8%;" class="table-separete">
                        <div class="chart-like w-100 d-flex">
                            @if ($track_liked ==1)
                                <img src="{{asset('images/liked.png')}}" alt="" style="width: 22px; height: 22px; margin-right: 6px;">
                            @else
                                <img src="{{asset('images/like.png')}}" alt="" style="width: 22px; height: 22px; margin-right: 6px;">
                            @endif
                            <span class="chart-like-text">{{$track_likes}}</span>
                        </div>
                    </td>
                </tr>
                @php
                $i++;
                $track_liked = 0;
                @endphp
    
            @endforeach
            </table>
        </div>
    </div>
@endsection