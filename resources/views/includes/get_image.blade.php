@if (session()->has('user'))
    <img class="{{ $class_name ?? 'avatar-image' }}" src="{{ route('image.get', ['filename' => $filename ?? null, 'disk' => $disk ?? 'users']) }}" alt="{{ $alt ?? 'User Profile' }}">
@endif