@extends('layouts.main')

@section('main')
    <h2>{{ $user->nickname }}</h2>
    
    @if ($logged_in)

        <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="link">User Settings</a>
        <a href="{{ route('home.logout') }}" class="link">Log Out</a>
        
    @endif

    @if (Session::has('success'))
    
        <h3>{{ Session::get('success') }}</h3>

    @endif
@endsection