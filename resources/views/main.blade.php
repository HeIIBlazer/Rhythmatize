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
                @endphp
                    <div class="album-cover" style="width: 31.5%; height:20%;">
                        <img src="{{url ($album->cover_url)}}" alt="Album Cover" class="w-100 h-100 alb">
                        <div class="album-info d-flex flex-column justify-content-center align-items-center text-center">
                            <h2 class="album-name">{{ $artist-> name }}</h2>
                            <p class="album-name">{{ $album_name }}</p>
                        </div>
                    </div>
                @endforeach
                </div>
                    
                <div class="mb-2 mt-2">
                    <a href="/last_added_albums"><button class="see_more_button" type="submit">See more</button></a>
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
                            $album_name = explode(" ", $album->name); $album_name = array_slice($album_name, 0, 5);  $album_name = implode(" ", $album_name); 
                        @endphp
                    <div class="album-cover" style="width: 31.5%; height:20%;">
                        <img src="{{url ($album -> cover_url)}}" alt="Album Cover" class="w-100 h-100 alb">
                        <div class="album-info d-flex flex-column justify-content-center align-items-center text-center">
                            <h2 class="album-name">{{ $artist-> name }}</h2>
                            <p class="album-name">{{ $album_name }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="button-div">
                    <a href="{{url ('/album_chart')}}"><button class="see_more_button" type="submit">See more</button></a>
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
                    <div class="album-cover" style="width: 31.5%; height:20%;">
                        <img src="{{url ($artist->picture_url)}}" alt="Album Cover" class="w-100 h-100 alb">
                        <div class="album-info d-flex flex-column justify-content-center align-items-center text-center">
                            <h2 class="album-name">{{ $artist-> name }}</h2>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="button-div">
                    <a href="{{url ('/artist_chart')}}"><button class="see_more_button" type="submit">See more</button></a>
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
                            // $spotify_link = $track -> spotify_link; USE FOR TRACK INFO PAGE!!!!!
                            // $modified_link = substr($spotify_link, 24);
                            $track_name = explode(" ", $track->name); $track_name = array_slice($track_name, 0, 5);  $track_name = implode(" ", $track_name); 
                        @endphp
                            <div class="hide-text" style="background-image: url({{url ($album->cover_url)}}); height: 170px; width: 29%; background-size: cover; background-position: center center; background-repeat: no-repeat; margin-bottom: 10px;">
                                <p style="font-size: 15px">{{ $artist-> name }}</p>
                                <p style="font-size: 18px">{{ $track_name }}</p>
                            </div>
                        @endforeach
                    </div>

                    <div class="button-div">
                        <a href="{{ url ('/track_chart') }}"><button class="see_more_button" type="submit">See more</button></a>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection