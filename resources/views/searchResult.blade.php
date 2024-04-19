@extends ('layouts.app', ['title' => 'Search - ' . $search])

@section('content')
<h1 class="Header-text text-center">SEARCH</h1>
<div class="container">
    <div class="h2-header d-flex justify-content-evenly flex-column">
        <h2 class="h2-text w-100">Albums</h2>
        @if ($albums == null || $albums->count() == 0)
    
            <div class="d-flex justify-content-center align-items-center" style="height: 150px;">
                <p class="no-info">NO ALBUMS FOUND</p>
            </div>
        
        @else
        <div class="d-flex flex-row w-100 justify-content-evenly mb-5">
            @foreach ($albums as $album)
            @php
                $artist = \App\Models\Artist::find($album->artist_id);
                $crypt_album = Crypt::encrypt($album->id);
                $crypt_artist = Crypt::encrypt($artist->id);
            @endphp
            <div class="card">
                <a href="/album/{{$crypt_album}}" class="text-decoration-none">
                    <div class="mt-2 mb-4 d-flex justify-content-center">
                        <img src="{{url ($album -> cover_url)}}" alt="" style="width: 185px; height: 185px; border-radius: 5px; ">
                    </div>
                    <div style="margin-left: 10px;max-width: 100%;">
                        <p class="card-text-bigger">{{ $album -> name }}</p>
                        <a href="/artist/{{$crypt_artist}}" class="text-decoration-none">
                            <p class="card-text">
                                {{ $album -> release_date }} | {{ $artist -> name }}
                            </p>
                        </a>
                    </div>
                </a>
            </div>
            
            @endforeach
            
        </div>
        @endif
    </div>
    <div class="h2-header d-flex justify-content-evenly flex-column mb-5">
        <h2 class="h2-text w-100">Artists</h2>
        @if ($artists == null || $artists->count() == 0)
    
        <div class="d-flex justify-content-center align-items-center" style="height: 150px;">
            <p class="no-info">NO ARTISTS FOUND</p>
        </div>
    
        @else
        <div class="d-flex flex-row w-100 justify-content-evenly">
            @foreach ($artists as $artist)
            @php
                $crypt_artist = Crypt::encrypt($artist->id);
            @endphp
            <div class="card">
                <a href="/artist/{{$crypt_artist}}" class="text-decoration-none">
                    <div class="mt-2 mb-4 d-flex justify-content-center">
                        <img src="{{url ($artist -> picture_url)}}" alt="" style="width: 185px; height: 185px; border-radius: 5px; object-fit: cover;">
                    </div>
                    <div style="margin-left: 10px; max-width: 100%;">
                        <p class="card-text-bigger-artist">{{$artist -> name}}</p>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        @endif
    </div>
    <div class="h2-header d-flex justify-content-evenly flex-wrap mb-5">
        <h2 class="h2-text w-100 justify-content-start">Tracks</h2>
        @if ($tracks == null || $tracks->count() == 0)
    
        <div class="d-flex justify-content-center align-items-center" style="height: 150px;">
            <p class="no-info">NO TRACKS FOUND</p>
        </div>
    
        @else   
        <div class="track-list d-flex flex-wrap w-100">
            <div class="tracks-container w-100" style="display: flex; flex-wrap: wrap;">
                @for ($i = 0; $i < $tracks->count(); $i += 2)
                    <div class="column">
                        @for ($j = $i; $j < $i + 2; $j += 1)
                            @if ($j < $tracks->count())
                                @php
                                    $track = $tracks[$j];
                                    $album = \App\Models\Album::find($track->album_id); 
                                    $artist = \App\Models\Artist::find($album->artist_id);
                                    $crypt_track = Crypt::encrypt($track->id);
                                    $crypt_artist = Crypt::encrypt($artist->id);
                                @endphp
                                <div class="track-item">
                                    <div>
                                        <img src="{{url ($album->cover_url)}}" alt="" style="width: 100px; height: 100px; border-radius: 5px; object-fit: cover;">
                                    </div>
                                    <div class="track-info w-50 pt-4">
                                        <a href="/track/{{$crypt_track}}" class="text-decoration-none"><span class="chart-text-big">{{ $track -> name }}</span></a>
                                    </div>
                                    <div class="w-25 pt-4">
                                        <a href="/artist/{{$crypt_artist}}" class="text-decoration-none"><span class="chart-small-text">{{ $artist -> name }}</span></a>
                                    </div>
                                </div>
                                <hr class="me-3">
                            @endif
                        @endfor
                    </div>
                @endfor
            </div>
        </div>
        @endif
    </div>
</div>
@endsection