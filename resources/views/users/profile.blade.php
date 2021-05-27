@extends('layouts.main')

@section('main')
    @include('includes.get_image', ['filename' => session()->get('user')->image, 'disk' => 'users', 'class_name' => 'avatar-profile'])    
    {{-- <h3>{{ json_encode($user->image) }}</h3> --}}
    <h2>{{ $user->nickname }}</h2>
    
    @if ($logged_in)

        <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="link">User Settings</a>
        <a href="{{ route('home.logout') }}" class="link">Log Out</a>
        
    @endif

    @if (Session::has('success'))
    
        <h3>{{ Session::get('success') }}</h3>

    @endif
@endsection