@extends('layouts.main')

@section('main')
    <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('post')

        @error('name')
            <h3>*{{ $message }}</h3>
        @enderror
        <input type="text" name="name" placeholder="Name"><br><br>

        @error('nickname')
            <h3>*{{ $message }}</h3>
        @enderror
        <input type="text" name="nickname" placeholder="Nickname"><br><br>

        @error('email')
            <h3>*{{ $message }}</h3>
        @enderror
        <input type="email" name="email" placeholder="Email"><br><br>

        @error('password')
        <h3>*{{ $message }}</h3>
        @enderror
        <input type="password" name="password" placeholder="Password"><br><br>
        
        @error('image_path')
            <h3>*{{ $message }}</h3>
        @enderror
        <label for="image_path">Profile Image</label>
        <input type="file" name="image_path"><br><br>

        <input type="submit" value="Submit">
    </form>

    <a href="{{ route('home.login') }}" class="link">Already have an account? Log in</a>
    <a href="{{ route('users.index') }}" class="link">Return to Home</a>
@endsection