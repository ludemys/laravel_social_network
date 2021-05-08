@extends('layouts.master')
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

    <a href="{{ route('home.index') }}">Return to Home</a>
@endsection