@extends('layouts.main')
@section('main')
    <form action="{{ route('home.verificate') }}" method="post" class="form">
        @csrf
        @method('post')

        @error('email')
            <small>*{{ $message }}</small><br>
        @enderror

        @if (Session::has('email_unfound'))
            <small>*{{ Session::get('email_unfound') }}</small><br>
        @endif
        <input type="mail" name="email" placeholder="Email"><br><br>

        @error('password')
            <small>*{{ $message }}</small>
        @enderror

        @if (Session::has('password_incorrect'))
            <small>*{{ Session::get('password_incorrect') }}</small><br>
        @endif
        <input type="password" name="password" placeholder="Password"><br><br>

        <input type="submit" value="Login">
    </form>

    <a href="{{ route('users.create') }}" class="link">Don't have an account? Register</a>
    <a href="{{ route('home.index') }}" class="link">Return to Home</a>
@endsection