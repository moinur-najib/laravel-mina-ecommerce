<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>
        @yield('title', 'laravel ecommerce project')
    </title>

    @include('frontend.partials.styles')
</head>

<body>

    <div class="wrapper">
        @include('frontend.partials.nav')
        @include('frontend.partials.messages')
        <!-- <canvas></canvas>

        <script src="{{ asset('js/canvas.js') }}"></script> -->
        @yield('content')

        @include('frontend.partials.footer')



    </div>

    @include('frontend.partials.scripts')
    @yield('scripts')

</body>

</html>
