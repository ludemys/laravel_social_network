@extends('layouts.main')

@section('main') 

    @foreach ($posts as $post)
        <div class="post">
            @include('includes.get_image', ['filename' => $post->user->image, 'disk' => 'users', 'class_name' => 'user-image'])
            <p class="user-nickname">{{ $post->user->nickname }}</p>
            <p class="date">{{ $post->date }}</p>

            @include('includes.get_image', ['filename' => $post->path, 'disk' => 'images', 'alt' => $post->path, 'class_name' => 'image'])

            <i class="far fa-heart like-button"></i>
            <p class="likes">{{ $post->get_amount_of_likes() }} Likes</p>

            <p class="comments">reghbuergherh</p>
        </div>
    @endforeach

@endsection

