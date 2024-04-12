@extends ('layouts.app', ['title' => 'Albums List'])

@section('content')
<div class="container">
    <div class="Header-List">
        <p>ALBUMS</p>
    </div>

    <div class="d-flex">
        @foreach ($albums as $album)
            @php
                $artist = \App\Models\Artist::find($album->artist_id);
            @endphp
            @if ($loop->iteration <= 12)
                <div class="card">
                    <div class="mt-2 mb-4 d-flex justify-content-center">
                        <img src="{{url ($album -> cover_url)}}" alt="" style="width: 185px; height: 185px; border-radius: 5px; ">
                    </div>
                    <div style="margin-left: 10px; max-width: 100%;">
                        <p class="card-text-bigger">{{$album -> name}}</p>
                        <a class="text-decoration-none" href="/artist/{{$artist -> id}}"><p class="card-text w-100">{{$album -> release_date}} | {{$artist->name}}</p></a>
                    </div>
                </div>
            @endif
            @if ($loop->iteration % 6 == 0 && $loop->iteration!= $loop->count)
                </div>
                <div class="d-flex">
            @endif
        @endforeach
    </div>
    <div class="d-flex w-100 justify-content-center align-content-center mt-3">
        {!! $albums->links() !!}
    </div>
</div>
    
@endsection
