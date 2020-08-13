@extends('frontend.layouts.master')

@section('content')

<!-- Start Sidebar + Content -->
<div class='products-wrapper'>
    <div class="row">

        <div class="page-product-sidebar">
            @include('frontend.partials.product-sidebar')
        </div>

        <div class="widget">
            <h3 class="text-center h2" style="font-family: 'Roboto', sans-serif;">Products</h3>
            <div class="row">
                @include('frontend.pages.product.partials.all_products')
            </div>
        </div>
    </div>
</div>
<!-- End Sidebar + Content -->
@endsection
