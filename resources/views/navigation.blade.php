@extends('layout')

@section('navigation')
    <div class="flex-center position-ref full-height">
        @if (Route::has('user.login'))
            <div class="top-right links">
                @auth
                    <a href="{{ url('/home') }}">Home</a>
                @else
                    <a href="{{ route('auth.login') }}">Login</a>

                    <a href="{{ route('user.register') }}">Register</a>
                @endauth
            </div>
    @endif
@endsection
