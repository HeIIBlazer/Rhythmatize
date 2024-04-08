@extends ('layouts.app', ['title' => 'Artists List'])

@section('content')
<div class="container">
    <div class="Header-List">
        <p>ARTISTS</p>
    </div>

    <div class="d-flex">
        @foreach ($artists as $artist)
                <div class="card">
                    <div class="mt-2 mb-3 d-flex justify-content-center">
                        <img src="{{url ($artist -> picture_url)}}" alt="" style="width: 185px; height: 185px; border-radius: 5px; object-fit: cover;">
                    </div>
                    <div style="margin-left: 10px; max-width: 100%;">
                        <p class="card-text-bigger-artist">{{$artist -> name}}</p>
                    </div>
                </div>
            @if ($loop->iteration % 6 == 0 && $loop->iteration!= $loop->count)
                </div>
                <div class="d-flex">
            @endif
        @endforeach
    </div>
    <div class="d-flex w-100 justify-content-center align-content-center mt-3">
        {!! $artists->links() !!}
    </div>
</div>
    
@endsection