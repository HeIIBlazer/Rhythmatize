@extends ('layouts.app', ['title' => 'Last Added Artists'])

@section('content')
<div class="container">
    <div class="Header-List">
        <p>LAST ADDED ARTISTS</p>
    </div>

    <div class="row">
        @foreach ($artists as $artist)
        @php
            $crypt_artist = Crypt::encrypt($artist->id);
        @endphp
        <div class="col-12 col-sm-6 col-md-4 col-lg-2 mb-4">
                <a href="/artist/{{$crypt_artist}}" class="card">
                    <div class="mt-2 mb-3 d-flex justify-content-center align-items-center" style="width: 100%; padding-top: 90%; position: relative;">
                        <img src="{{secure_url ($artist -> picture_url)}}" alt="" class="mt-1 image_artist_list">
                    </div>
                    <div style="margin-left: 10px; max-width: 100%;">
                        <p class="card-text-bigger-artist">{{$artist -> name}}</p>
                    </div>
                </a>
        </div>
            @if ($loop->iteration % 6 == 0 && $loop->iteration!= $loop->count)
                </div>
                <div class="row">
            @endif
        @endforeach
    </div>
    <div class="d-flex w-100 justify-content-center align-content-center mt-3">
        {!! $artists->links() !!}
    </div>
</div>
    
@endsection