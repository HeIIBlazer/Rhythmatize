@extends('layouts.app')

@section('content')
    <div class="container h d-flex justify-content-center mt-5">
        <div class="login">
            <div class="cross">
                <a href="/"><img src="{{URL::asset('images/cross.png')}}" alt="" style="width: 30px; height: 30px;"></a>
            </div>
            <div class="w-100">
                <div>
                    <p class="login-header">SIGN UP</p>
                </div>
                @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{session()->get('error')}}
                </div>
                @endif
                <div class="d-flex w-100 flex-column justify-content-center align-items-center h-75">
                    <form action="{{url('/register')}}" method="POST" class="form">
                        @csrf
                        <div class="w-100 d-flex justify-content-center align-center mt-2">
                            <input type="text" class="login-input" name="username" placeholder="Username" required autofocus>
                        </div>
                        <div class="w-100 d-flex justify-content-center align-center mt-2">
                            <input type="email" class="login-input" name="email" placeholder="Email" required>
                        </div>
                        <div class="w-100 d-flex justify-content-center align-center mt-2">
                            <input type="password" class="login-input" name="password" placeholder="Password" required>
                        </div>
                        <div class="w-100 d-flex justify-content-center align-center mt-2">
                            <input type="password" class="login-input" name="password_confirmation" placeholder="Confirm Password" required>
                        </div>
                        <div class="w-100 d-flex justify-content-center mt-2 mb-0">
                            <button type="submit" class="login-button" name="login">Sign up</button>
                        </div>
                    </form>
                    <hr style="border: 1px solid white; width:80%;">
                    <div>
                        <p class="login-undertext">You already have an account? <a href="/login" class="login-undertext-button">Log in here.</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection