@extends('frontend.layouts.master')

@section('content')

<!-- Start Sidebar + Content -->
<div class='products-wrapper'>
    <div class="row">

        <div class="col-md-2 page-product-sidebar">
            @include('frontend.partials.product-sidebar')
        </div>

        <div class="col-md-10">
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
