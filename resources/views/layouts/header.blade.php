@section('header')        
    <header class="header">
        <a href="{{ route('home.index') }}" class="link">
            <h2 class="header-title">Laracture</h2>
        </a>
        
        <div class="user-links">

            @if (session()->has('user'))

                <a class="user-link " href="{{ route('image.create') }}"><i class="fas fa-upload"></i></a>
                @if(session()->get('user')->image === null)
                    <a class="user-link " href="{{ route('users.show', ['user' => session()->get('user')->id]) }}"><i class="far fa-user-circle"></i></a>
                @else
                    <a class="user-link " href="{{ route('users.show', ['user' => session()->get('user')->id]) }}">
                        @include('includes.get_image', ['filename' => session()->get('user')->image, 'disk' => 'users', 'class_name' => 'header-profile-image'])
                    </a>
                @endif

            @else

                <a class="link" href="{{ route('home.login') }}">Login</a>
                <a class="link" href="{{ route('users.create') }}">Register</a>

            @endif

        </div>
    </header>
@endsection