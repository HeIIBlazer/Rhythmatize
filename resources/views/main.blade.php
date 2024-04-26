@extends ('layouts.app', ['title' => 'Rhythmatize'])



@section('content')
    <div class="container main-page">
        <div class="left_part">
            <div class="text-part">
                <div>
                    <h1 class="logo_text">Rhythmatize</h1>
                </div>

                <div class="welcome_p">
                    <p>Rhythmize is a music-centric website that serves as a hub for music enthusiasts and fans. It offers a comprehensive database of artists and their music, complete with links to various music streaming services. Visitors can access song lyrics, detailed artist information, and explore the rich world of music, all in one convenient platform.</p>
                </div>
            </div>
            <div class="Last_added_albums_part">
                <div>
                    <h1 class="Header-text">LAST ADDED ALBUMS</h1>
                </div>

                <div class="albums_3 mt-2 mb-2">
                @foreach ($lastAdded as $album)
                @php 
                    $artist = \App\Models\Artist::find($album->artist_id);
                    $album_name = explode(" ", $album->name); $album_name = array_slice($album_name, 0, 5);  $album_name = implode(" ", $album_name);
                    $crypt_album = Crypt::encrypt($album->id); 
                @endphp
                    <a href="/album/{{$crypt_album}}" class="album-cover" style="width: 31.5%; height:20%;">
                        <img src="{{url ($album->cover_url)}}" alt="Album Cover" class="w-100 h-100 alb">
                        <div class="album-info d-flex flex-column justify-content-center align-items-center h-100 w-100">
                            <h2 class="artist-name-main">{{ $artist-> name }}</h2>
                            <p class="album-name-main">{{ $album_name }}</p>
                        </div>
                    </a>
                @endforeach
                </div>
                    
                <div class="mb-2 mt-2">
                    <a href="/last-added-albums"><button class="see_more_button" type="submit">See more</button></a>
                </div>
            </div>
        </div>

        <div class="chart_block">
            <div>
                <h1 class="charts_header">CHARTS</h1>
            </div>
            <div class="w-100">
                <div class="h2-header">
                    <div class="line"></div>
                    <h2 class="h2-text">ALBUMS</h2>
                    <div class="line"></div>
                </div>
                <div class="albums_3">  
                    @foreach ($albums as $album)
                        @php
                            $artist = \App\Models\Artist::find($album->artist_id); 
                            $crypt_album = Crypt::encrypt($album->id);
                        @endphp
                    <a href="/album/{{$crypt_album}}" class="album-cover" style="width: 31.5%; height:20%;">
                        <img src="{{url ($album -> cover_url)}}" alt="Album Cover" class="w-100 h-100 alb">
                        <div class="album-info d-flex flex-column justify-content-center align-items-center h-100 w-100">
                            <h2 class="artist-name-main">{{ $artist-> name }}</h2>
                            <p class="album-name-main h-25">{{ $album -> name }}</p>
                        </div>
                    </a>
                    @endforeach
                </div>
                <div class="button-div">
                    <a href="{{url ('/album-chart')}}"><button class="see_more_button" type="submit">See more</button></a>
                </div>
            </div>

            <div class="w-100">
                <div class="h2-header">
                    <div class="line"></div>
                    <h2 class="h2-text">ARTISTS</h2>
                    <div class="line"></div>
                </div>
                <div class="albums_3">
                    @foreach ($artists as $artist)
                    @php
                        $crypt_artist = Crypt::encrypt($artist->id);
                    @endphp
                    <a href="/artist/{{$crypt_artist}}" class="album-cover" style=" height: 180px; width: 30%;">
                            <img src="{{url ($artist->picture_url)}}" alt="Album Cover" class="alb">
                        <div class="album-info d-flex flex-column justify-content-center align-items-center text-center h-100 w-100">
                            <h2 class="album-name-main">{{ $artist-> name }}</h2>
                        </div>
                    </a>
                    @endforeach
                </div>
                <div class="button-div">
                    <a href="{{url ('/artist-chart')}}"><button class="see_more_button" type="submit">See more</button></a>
                </div>
            </div>

                <div class="w-100">
                    <div class="h2-header">
                        <div class="line"></div>
                        <h2 class="h2-text">TRACKS</h2>
                        <div class="line"></div>
                    </div>
                    <div class="albums_3">
                        @foreach ($tracks as $track)
                        @php
                            $album = \App\Models\Album::find($track->album_id); 
                            $artist = \App\Models\Artist::find($album->artist_id);
                            $crypt_track = Crypt::encrypt($track->id);
                            // $spotify_link = $track -> spotify_link; USE FOR TRACK INFO PAGE!!!!!
                            // $modified_link = substr($spotify_link, 24);
                        @endphp
                        <a href="/track/{{$crypt_track}}" class="album-cover" style=" height: 180px; width: 30%;">
                            <img src="{{url ($album->cover_url)}}" alt="Album Cover" class="alb">
                        <div class="album-info d-flex flex-column justify-content-center align-items-center text-center h-100 w-100">
                            <h2 class="artist-name-main">{{ $artist-> name }}</h2>
                            <p class="album-name-main">{{$track -> name}}</p>
                        </div>
                        </a>
                        @endforeach
                    </div>

                    <div class="button-div">
                        <a href="{{ url ('/track-chart') }}"><button class="see_more_button" type="submit">See more</button></a>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection