<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield("title")</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles & Scripts -->
        @vite([
{{--            'resources/css/app.css',--}}
            'resources/js/app.js',
            'resources/css/dashboard.css',
        ])

        @yield("header")
    </head>
    <body class="bg-white">
        <!-- Page Heading -->
        @include('layouts.header')

        <div class="container-fluid">
            <div class="row">

                <!-- Page Navigation -->
                @include('layouts.navigation')

                <!-- Page Content -->
                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    @yield('content')
                </main>

            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
        <script>
            feather.replace({ 'aria-hidden': 'true' })
        </script>

        @yield("footer")
    </body>

</html>
