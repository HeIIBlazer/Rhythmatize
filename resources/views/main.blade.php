@extends ('layouts.app')


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

                <div class="albums_3">
                @foreach ($lastAdded as $album)
                @php $artist = \App\Models\Artist::find($album->artist_id); @endphp
                @php $album_name = explode(" ", $album->name); $album_name = array_slice($album_name, 0, 5);  $album_name = implode(" ", $album_name); @endphp
                    <div class="hide-text" style="background-image: url({{url ($album->cover_url)}}); height: 230px; width: 30%; background-size: contain; background-repeat: no-repeat;">
                        <p style="font-size: 12px">{{ $artist-> name }}</p>
                        <p style="font-size: 15px">{{ $album_name }}</p>
                    </div>
                @endforeach
                </div>
                    
                <div class="w-100 d-flex justify-content-center">
                    <button class="see_more_button" type="submit">See more</button>
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
                        <div class="hide-text" style="background-image: url({{url ($album->cover_url)}}); height: 170px; width: 29%; background-size: cover; background-position: center center; background-repeat: no-repeat; margin-bottom: 10px;">
                            <p style="font-size: 12px">{{ $artist-> name }}</p>
                            <p style="font-size: 15px">{{ $album_name }}</p>
                        </div>
                    @endforeach
                </div>
                <div class="button-div">
                    <button class="see_more_button" type="submit">See more</button>
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
                        <div class="hide-text" style="background-image: url({{url ($artist->picture_url)}}); height: 170px; width: 29%; background-size: cover; background-repeat: no-repeat; margin-bottom: 10px;">
                            <p style="font-size: 19px">{{ $artist-> name }}</p>
                        </div>
                    @endforeach
                </div>
                <div class="button-div">
                    <button class="see_more_button" type="submit">See more</button>
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
                        $track_name = explode(" ", $track->name); $track_name = array_slice($track_name, 0, 5);  $track_name = implode(" ", $track_name); 
                    @endphp
                        <div class="hide-text" style="background-image: url({{url ($album->cover_url)}}); height: 170px; width: 29%; background-size: cover; background-position: center center; background-repeat: no-repeat; margin-bottom: 10px;">
                            <p style="font-size: 12px">{{ $artist-> name }}</p>
                            <p style="font-size: 15px">{{ $track_name }}</p>
                        </div>
                    @endforeach
                </div>
                <div class="button-div">
                    <button class="see_more_button" type="submit">See more</button>
                </div>
            </div>
        </div>
    </div>
@endsection