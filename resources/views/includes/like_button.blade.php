@if ($post->has_a_like_from_logged_user())
    <a class="fas fa-heart like-button" href="{{ route('image.like_toggle', ['post' => $post, 'current_page' => $page]) }}"></a>
@else
    <a class="far fa-heart like-button" href="{{ route('image.like_toggle', ['post' => $post, 'current_page' => $page]) }}"></a>
@endif