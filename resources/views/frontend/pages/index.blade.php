@extends('frontend.layouts.master')
<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/app.js"></script>
@section('content')

<!-- Start Sidebar + Content -->
<div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
    <ol class="carousel-indicators">

        @foreach($sliders as $slider)
        <li data-target="#carouselExampleIndicators" data-slide-to="{{$loop->index}}"
            class="{{ $loop->index == 0 ? 'active' : ''}}"></li>
        @endforeach

    </ol>
    <div class="carousel-inner">
        @foreach($sliders as $slider)
        <div class="carousel-item {{ $loop->index == 0 ? 'active' : ''}}">
            <div class="dark-overlay">
                <div class="carousel-image">
                    <img src="{{ asset('images/sliders/'. $slider->image) }}" class="d-block carousel-image"
                        alt="{{ $slider->title }}">
                </div>
            </div>

            <div class="carousel-caption text-center d-none d-md-block">
                <h2 class="carousel-title">{{ $slider->title }}</h2>
                @if ($slider->button_text)
                <p>
                    <a href=" {{ $slider->button_link }} " taget="_blank" class="btn carousel-btn">
                        {{ $slider->button_text }}</a>
                </p>
                @endif
            </div>
        </div>
        @endforeach
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <div class="carousel-control-prev-background-color">

                <i class="fa fa-angle-left fa-2x carousel-angle-left"></i>

            </div>
        </a>

        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">

            <i class="fa fa-angle-right fa-2x carousel-angle-right"></i>

        </a>
    </div>


</div>

<div class='wrapper'>
    <div class="row">

        @include('frontend.partials.product-sidebar')
        <div class="products-wrapper">
            <div class="h2" style="font-family: 'Roboto', sans-serif; margin-top: 2px;">Products</div>
            <div class="row">
                @include('frontend.pages.product.partials.all_products')
            </div>
        </div>

    </div>
</div>
<!-- End Sidebar + Content -->
<!-- <script>
    $(window).resize(function () {
        if ($(window).width() < 800) {
            console.log("width is 800")

            /* ------------- Product Sifebar --------------- */
            $(".product-sidebar").toggleClass("product-sidebar")
            $(".page-product-sidebar").toggleClass("hide-product-sidebar")
            $(".page-product-sidebar").removeClass("page-product-sidebar")
            $(".product-sidebar").css("position", "absolute")
            $(".product-sidebar").css("display", "none")
            $(".sidebar-product-parent-card").css("position", "absolute")
            $(".sidebar-product-parent-card").css("display", "none")
            $(".parent-img").css("width", "0px")

            /* ---------------------- Cards -------------------- */
            $(".products-wrapper").toggleClass("products-wrapper-sm")
            $(".products-wrapper").removeClass("products-wrapper")
        }
    });

</script> -->

@endsection

<!-- @section('scripts') -->

<!-- @endsection -->
