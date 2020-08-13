<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>
        @yield('title', 'laravel ecommerce project')
    </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    @include('frontend.partials.styles')
</head>

<body>

    <div class="wrapper">
        @include('frontend.partials.nav')
        @include('frontend.partials.messages')
        @yield('content')
    </div>

    @include('frontend.partials.scripts')

    @yield('scripts')

</body>

</html>
