@extends('layouts.app')

@section('content')
    <div>
        <div>

        </div>
        <div>
            <p>SIGN UP</p>
        </div>
        @if (session()->has('error'))
        <div class="alert alert-danger">
            {{session()->get('error')}}
        </div>
        @endif
        <div>
            <form action="{{url('/register')}}" method="POST">
                @csrf
                <div>
                    <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
                </div>
                <div>
                    <input type="email" class="form-control" name="email" placeholder="Email" required>
                </div>
                <div>
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                </div>
                <div>
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                </div>
                <div type="submit" class="btn btn-default submit" name="login">
                    <button>Sign up</button>
                </div>
            </form>
        </div>
    </div>
@endsection