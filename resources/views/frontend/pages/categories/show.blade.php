@extends('frontend.layouts.master')

@section('content')

  <!-- Start Sidebar + Content -->
  <div class='container product-wrapper'>
    <div class="row">
      <div class="col-md-4">

        @include('frontend.partials.product-sidebar')

      </div>

      <div class="col-md-8">
        <div class="widget">
          <h3>All Products in <span class="badge badge-info font-italic">{{ $category->name }}</span>  Category</h3>
          @php
            $products = $category->products()->paginate(9);
          @endphp

          @if($products->count() > 0)
            @include('frontend.pages.product.partials.all_products')
          @else 

          <div class="alert alert-warning">
            No Products has been added yet
          </div>

          @endif

            
        <div class="widget">

        </div>
    </div>


    </div>
  </div>

  <!-- End Sidebar + Content -->
@endsection
