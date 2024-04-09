@extends ('layouts.app')

@section('content')
<h1 class="Header-text text-center">SEARCH</h1>
<div class="container">
    <div class="h2-header d-flex justify-content-evenly flex-column">
        <h2 class="h2-text w-100">Albums</h2>
        <div class="d-flex flex-row w-100">
            @foreach ($albums as $album)
            @php
                $artist = \App\Models\Artist::find($album->artist_id);
            @endphp
            <div class="card">
                <div class="mt-2 mb-4 d-flex justify-content-center">
                    <img src="{{url ($album -> cover_url)}}" alt="" style="width: 185px; height: 185px; border-radius: 5px; ">
                </div>
                <div style="margin-left: 10px;max-width: 100%;">
                    <p class="card-text-bigger">{{ $album -> name }}</p>
                    <p class="card-text">{{ $album -> release_date }} | {{ $artist -> name }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="h2-header d-flex justify-content-evenly flex-column">
        <h2 class="h2-text w-100">Artists</h2>
        <div class="d-flex flex-row w-100">
            @foreach ($artists as $artist)
            <div class="card">
                <div class="mt-2 mb-4 d-flex justify-content-center">
                    <img src="{{url ($artist -> picture_url)}}" alt="" style="width: 185px; height: 185px; border-radius: 5px; object-fit: cover;">
                </div>
                <div style="margin-left: 10px; max-width: 100%;">
                    <p class="card-text-bigger-artist">{{$artist -> name}}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="h2-header d-flex justify-content-evenly flex-wrap">
        <h2 class="h2-text w-100 justify-content-start">Tracks</h2>
        <div class="track-list d-flex flex-wrap">
            <div class="tracks-container" style="display: flex; flex-wrap: wrap;">
                @for ($i = 0; $i < $tracks->count(); $i += 2)
                    <div class="column" style="display: flex; flex-direction: column; flex-basis: 50%;">
                        @for ($j = $i; $j < $i + 2; $j += 1)
                            @if ($j < $tracks->count())
                                @php
                                    $track = $tracks[$j];
                                    $album = \App\Models\Album::find($track->album_id); 
                                    $artist = \App\Models\Artist::find($album->artist_id);
                                @endphp
                                <div class="track-item">
                                    <div class="track-image">
                                        <img src="{{url ($album->cover_url)}}" alt="" style="width: 185px; height: 185px; border-radius: 5px; object-fit: cover;">
                                    </div>
                                    <div class="track-info">
                                        <p class="track-name">{{ $track -> name }}</p>
                                        <p class="track-artist">{{ $artist -> name }}</p>
                                    </div>
                                </div>
                            @endif
                        @endfor
                    </div>
                @endfor
            </div>
        </div>
    </div>
</div>
@endsection