@extends('layouts.master')
@section('main')
    @if ($logged_user)
        @if ($logged_user->isAdmin)
            <h1>Welcome Admin</h1>
        @else
            <h1>Welcome user</h1>
        @endif
    @else
        <h1>FALSE</h1>
        <a href="{{ route('home.login') }}">LOGIN</a>
    @endif
@endsection