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
        <div class="d-flex flex-row w-100 justify-content-evenly">
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
    <div class="h2-header d-flex justify-content-evenly flex-column">
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
    <div class="h2-header d-flex justify-content-evenly flex-wrap">
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
                                @endphp
                                <div class="track-item">
                                    <div>
                                        <img src="{{url ($album->cover_url)}}" alt="" style="width: 100px; height: 100px; border-radius: 5px; object-fit: cover;">
                                    </div>
                                    <div class="track-info d-flex flex-row w-100 justify-content-between">
                                        <p class="d-inline-block text-truncate m-3" style="min-width: 100px; max-width: 200px; font-weight: 700;">{{ $track -> name }}</p>
                                        <p class="d-inline-block text-truncate m-3" style="min-width: 50px;">{{ $artist -> name }}</p>
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