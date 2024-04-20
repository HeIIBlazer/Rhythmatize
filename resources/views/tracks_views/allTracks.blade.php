@extends('layouts.app', ['title' => 'All Tracks By'])

@section('content')
    @php
        $crypt_artist = Crypt::encrypt($artist -> id);
    @endphp
    <div class="container">
        <div class="w-100">
            <h2 class="w-100 all-header text-uppercase">{{$artist -> name}} TRACKS</h2>
        </div>

        <div class="w-100 d-flex flex-row justify-content-center mb-3 mt-3">
            <div class="me-4 all-button-unpressed">
                <a href="/all_albums/{{$crypt_artist}}" class="text-decoration-none white-text">All Albums</a>
            </div>
            <div class="all-button-pressed">
                <span>All Tracks</span>
            </div>
        </div>

        <div>
            <div class="d-flex flex-row justify-content-center align-items-center">
                <div class="artist-header-line"></div>
                <div class="ms-2 me-2">
                    <span class="all-header-2 text-uppercase">MOST POPULAR {{$artist -> name}} TRACKS</span>
                </div>
                <div class="artist-header-line"></div>
            </div>
        </div>
    </div>
@endsection