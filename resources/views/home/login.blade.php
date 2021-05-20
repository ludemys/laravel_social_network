@extends('layouts.main')
@section('main')
    <form action="{{ route('home.verificate') }}" method="post">
        @csrf
        @method('post')

        @error('email')
            <h3>*{{ $message }}</h3>
        @enderror
        <input type="mail" name="email" placeholder="Email"><br><br>

        @error('password')
            <h3>*{{ $message }}</h3>
        @enderror
        <input type="password" name="password" placeholder="Password"><br><br>

        <input type="submit" value="Login">
    </form>

    <a href="{{ route('users.create') }}" class="link">Don't have an account? Register</a>
    <a href="{{ route('home.index') }}" class="link">Return to Home</a>
@endsection