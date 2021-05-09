@extends('layouts.master')
@section('main')
    @if ($logged_user)
        @if ($logged_user->isAdmin)
            <h1>Welcome Admin</h1>
        @else
            <h1>Welcome user</h1>
        @endif
        {{-- <a href={{ route('home.logout') }}><h4>Log Out</h4></a> --}}
        <form action="{{ route('home.logout') }}" method="post">@csrf <button type="submit">Log Out</button></form>
    @else
        <h1>Log in or Register to continue</h1>
    @endif
    <a href="{{ route('users.index') }}">USERS</a><br><br>

    <a href="{{ route('home.login') }}">LOGIN</a><br><br>
    <a href="{{ route('users.create') }}">REGISTER</a>
@endsection