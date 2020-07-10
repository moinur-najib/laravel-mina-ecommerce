@extends('frontend.layouts.master')

@section('content')

<!-- Start Sidebar + Content -->
<div class='products-wrapper'>
    <div class="row">

        <div class="col-lg-4 col-md-2 page-product-sidebar">
            @include('frontend.partials.product-sidebar')
        </div>

        <div class="col-md-4 col-lg-10 col-12">
            <div class="widget">
                <h3 class="text-center h2" style="font-family: 'Roboto', sans-serif;">Products</h3>
                <div class="row" style="margin-left: 125px;">
                    @include('frontend.pages.product.partials.all_products')
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Sidebar + Content -->
@endsection
