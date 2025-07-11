<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('pagename') - BookStudio</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body class="{{ Route::is('login') ? '' : 'is-flex' }}">
    @unless (Route::is('login'))
        @include('layouts.sidebar')
    @endunless

    <div class="{{ Route::is('login') ? 'container' : 'container is-half' }}">
        <section class="section">
            <div class="container">
                @unless (Route::is('login'))
                    <h1 class="title mb-6">@yield('pagename')</h1>
                @endunless

                @yield('content')
            </div>
        </section>
    </div>

    @yield('scripts')
</body>

</html>
