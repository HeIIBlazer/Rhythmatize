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
                @foreach ($albums as $album)
                @php $artist = \App\Models\Artist::find($album->artist_id); @endphp
                @php $album_name = explode(" ", $album->name); $album_name = array_slice($album_name, 0, 5);  $album_name = implode(" ", $album_name); @endphp
                    <div class="hide-text" style="background-image: url({{url ($album->cover_url)}}); height: 230px; width: 30%; background-size: contain; background-repeat: no-repeat;">
                        <p>{{ $artist-> name }}</p>
                        <p>{{ $album_name }}</p>
                    </div>
                @endforeach
                </div>
                        
                <div style="width: 25%">
                    <button class="search_button" type="submit">See more</button>
                </div>
            </div>
        </div>

        <div class="chart_block">

        </div>

    </div>
@endsection