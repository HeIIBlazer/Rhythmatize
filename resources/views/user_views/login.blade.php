@extends('layouts.app')

@section('content')
    <div>
        <div>

        </div>
        <div>
            <p>LOG IN</p>
        </div>
        @if (session()->has('error'))
        <div class="alert alert-danger">
            {{session()->get('error')}}
        </div>
        @endif
        <div>
            <form action="{{url('/login_auth')}}" method="POST">
                @csrf
                <div>
                    <input type="email" class="form-control" name="email" placeholder="Email" required autofocus>
                </div>
                <div>
                    <input type="password" class="form-control" name="password" placeholder="Password" required autofocus>
                </div>
                <div>
                    <button type="submit" class="" name="login">Log in</button>
                </div>
            </form>
            <hr>
            <div>
                <p>You don't have an account? <a>Create account here.</a></p>
            </div>
        </div>
    </div>
@endsection