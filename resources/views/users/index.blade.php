@extends('layouts.master')

@section('main')
<ul>
    @foreach ($users as $user)
        <li><strong>{{ $user->id }}</strong> || {{ $user->name }} || {{ $user->email }} || {{ $user->password }} || {{ $user->created_at }} @if($user->isAdmin) <strong>Admin</strong> @endif</li><br/>
    @endforeach
</ul>

<a href="{{ route('home.login') }}">LOGIN</a><br> 
<a href="{{ route('users.create') }}">Create new user</a>
@endsection
