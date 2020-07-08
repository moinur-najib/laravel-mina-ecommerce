@extends('frontend.layouts.master')

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
            <div class="carousel-image">
                <img src="{{ asset('images/sliders/'. $slider->image) }}" class="d-block carousel-image"
                    alt="{{ $slider->title }}">
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
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <div class="carousel-control-prev-background-color">

            <!-- <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span> -->
            <i class="fa fa-angle-left fa-2x carousel-angle-left"></i>

        </div>
    </a>

    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <!-- <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span> -->
        <i class="fa fa-angle-right fa-2x carousel-angle-right"></i>

    </a>
</div>

<div class='products-wrapper'>
    <div class="row">

        <div class="col-md-2 page-product-sidebar">
            @include('frontend.partials.product-sidebar')
        </div>

        <div class="col-lg-8 col-md-10">
            <div class="widget">
                <h3>Products</h3>
                <div class="row">
                    @include('frontend.pages.product.partials.all_products')
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Sidebar + Content -->
@endsection
