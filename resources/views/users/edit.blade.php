@extends('layouts.main')

@section('main')
    <form method="POST" class="form" action="{{ route('users.update', ['user' => $logged_user->id]) }}" enctype="multipart/form-data">
        @csrf
        @method('put')

        @error('nickname')
            <small>{{ $message }}</small>
        @enderror
        <div class="edit-label">
            <h2>Username: {{ $logged_user->nickname }}</h2>
            <input class="input" type="text" name="nickname" placeholder="Username">
        </div>

        <hr class="line">

        @error('name')
            <small>{{ $message }}</small>
        @enderror
        <div class="edit-label">
            <h2>Name: {{ $logged_user->name }}</h2>
            <input class="input" type="text" name="name" placeholder="Name">
        </div>

        <hr class="line">

        @error('email')
            <small>{{ $message }}</small>
        @enderror
        <div class="edit-label">
            <h2>Email address: {{ $logged_user->email }}</h2>
            <input class="input" type="email" name="email" placeholder="Email address">
        </div>

        <hr class="line">

        @error('new_password')
            <small>{{ $message }}</small>
        @enderror
        @error('new_password_confirm')
            <small>{{ $message }}</small>
        @enderror
        <div class="edit-label">
            <h2>Change password: </h2>
            <input class="input" type="password" name="new_password" placeholder="New password">
            <input class="input" type="password" name="new_password_confirm" placeholder="Confirm new password">
        </div>

        <hr class="line">

        @error('image_path')
            <small>{{ $message }}</small>
        @enderror
        <div class="edit-label">
            <h2>Profile Image: </h2>
            <input class="input" type="file" name="image_path">
        </div>

        <hr class="line">

        @error('password')
            <small>{{ $message }}</small>
        @enderror
        @error('password_confirm')
            <small>{{ $message }}</small>
        @enderror
        @if (Session::has('password_incorrect'))
    
            <small>{{ Session::get('password_incorrect') }}</small>

        @endif
        <div class="edit-label">
            <h2>* Current password: </h2>
            <input class="input" type="password" name="password" placeholder="Password" required>
            <input class="input" type="password" name="password_confirm" placeholder="Confirm password" required>
        </div>

        <hr class="line">
        
        Fields with <strong>*</strong> are required

        <hr class="line">

        <button type="submit">Update</button>
    </form>
    {{-- <a href="{{ route('users.change_password') }}" class="link">
        <h3>Change password</h3>
    </a> --}}

    
@endsection