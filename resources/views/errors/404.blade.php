@extends('layouts.app', ['title' => 'Error 404'])

@section('content')
    <div class="container">
        <div class="w-100 h-100 d-flex justify-center">
            <div class="d-flex flex-column justify-center w-100 h-100 align-items-center mt-5">
                <h1 style="font-family: 'audiowide', sans-serif; font-size:75px; color:white;">Error 404</h1>
                <p class="mt-5 w-50 text-center" style="font-family: 'Montserrat', sans-serif; font-size:40px; color:white; font-weight: 600;">YOU DON'T HAVE ACCESS TO THIS PAGE, OR THIS PAGE DOESN'T EXIST!</p>
            </div>
        </div>
    </div>
@endsection