<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <link rel="stylesheet" href="{{ asset('/css/index.css') }}">
            <title>Laracture</title>

            <script defer src="https://kit.fontawesome.com/b99002054e.js" crossorigin="anonymous"></script>
        </head>
        <body>
            <div class="container">
                @yield('header')
                <main class="main">
                    @yield('main')
                </main>
                @yield('footer')
            </div>
        </body>
    </html>