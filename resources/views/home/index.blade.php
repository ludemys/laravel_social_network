@extends('layouts.main')

@section('main') 

    @foreach ($posts as $i => $post)
        <div class="post">
            @include('includes.get_image', ['filename' => $post->user->image, 'disk' => 'users', 'class_name' => 'user-image'])
            <p class="user-nickname">{{ $post->user->nickname }}</p>
            
            @include('includes.get_image', ['filename' => $post->path, 'disk' => 'images', 'alt' => $post->path, 'class_name' => 'image'])
            
            @include('includes.like_button', ['post' => $post, 'page' => $page])
            <p class="likes">{{ $post->get_amount_of_likes() }} Likes</p>
            
            <section class="comments">
                @if($post->description !== null)
                <p><strong>{{ $post->user->nickname }}:</strong> {{ $post->description }}</p>
                @endif

                @include('includes.get_comments', ['post' => $post, 'page' => $page])
            </section>

            <form action="{{ route('comment.create', ['post' => $post, 'current_page' => $page]) }}" method="post" class="comment-form">
                @csrf
                @method('post')

                <input type="text" name="content" class="comment-input" placeholder="Comment as {{ session()->get('user')->nickname }}">
                <input type="submit" class="comment-input-submit" value="Comment">
            </form>

            <p class="date">{{ $post->date }}</p>
            <p class="location">{{ $post->location }}</p>
        </div>
    @endforeach

    @if ($page > 1)
        <a href="{{ route('home.index', ['page' => $page - 1]) }}" class="link">Previous</a>
    @endif

    @if (!$this_is_the_last_page)
        <a href="{{ route('home.index', ['page' => $page + 1]) }}" class="link">Next</a>
    @endif

@endsection
