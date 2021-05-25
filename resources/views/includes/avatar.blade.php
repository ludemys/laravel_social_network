@if (session()->has('user'))
    <img class="{{ $class_name ?? 'avatar-image' }}" src="{{ route('users.avatar', ['filename' => session()->get('user')->image]) }}" alt="User Profile">
@endif