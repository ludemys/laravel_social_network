@extends('layouts.main')

@section('main')
<ul>
    @foreach ($users as $user)
        <li>{{ $user->id }} | {{ $user->nickname }} || {{ $user->email }} || {{ $user->password }} || {{ $user->created_at }} @if($user->isAdmin) <strong>Admin</strong> @endif</li><br/>
    @endforeach
</ul>

<a href="{{ route('home.index') }}">INDEX</a>
@endsection
