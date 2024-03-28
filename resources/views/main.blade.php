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
                    <h1>LAST ADDED ALBUMS</h1>
                </div>
                <div class="albums_3">
                @foreach ($albums as $album)
                    <div style="background-image: url({{url ($album->cover_url)}}); height: 300px; width: 100%; background-size: contain; background-repeat: no-repeat;">

                    </div>
                @endforeach
                </div>

                <div>
                </div>
            </div>
        </div>

        <div class="chart_block">

        </div>

    </div>
@endsection