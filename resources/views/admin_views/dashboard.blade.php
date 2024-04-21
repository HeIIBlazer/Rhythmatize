@extends('layouts.app', ['title' => ' Admin Dashboard'])

@section('content')

    <div class="container">
        <div>
            <div class="Header-List">
                <p>ADMIN DASHBOARD</p>
            </div>
        </div>

        <div>
            <div class="Header-List">
                ARTIST
            </div>
            <div>
                <input name="artist" id="artist" data-select2>
                <datalist id="artist-list">
                    @foreach ($artists as $artist)
                    @php
                        $crypt_artist = Crypt::encrypt($artist -> id);
                    @endphp
                        <option value="{{$crypt_artist}}">{{$artist -> name}}</option>
                    @endforeach
                </datalist>
            </div>
        </div>

    </div>

    <script>
        $(document).ready(function() {
            $('select[data-select2]').select2();
        });
    </script>
@endsection