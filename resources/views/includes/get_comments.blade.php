@foreach ($post->get_comments() as $comment)
    <p>
        <strong>{{ $comment->user->nickname }}:</strong>

        @if (strlen($comment->content) >= 35)
            {{ $comment->content }}
        @else
            {{ substr($comment->content, 0, 35) . '...' }}
        @endif
    </p>
@endforeach