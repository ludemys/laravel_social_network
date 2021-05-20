@extends('layouts.main')

@section('main')
    @if ($logged_user)
        @if ($logged_user->isAdmin)
            <h1>Welcome {{ $logged_user->nickname }}, you are an Admin.</h1>
        @else
            <h1>Welcome {{ $logged_user->nickname }}, you are a regular user.</h1>
        @endif
    @else
        <h1>Log in or Register to continue</h1>
    @endif
    <a href="{{ route('users.index') }}">USERS</a><br><br>
@endsection

