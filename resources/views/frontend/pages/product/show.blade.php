@extends('frontend.layouts.master')

@section('title')
  {{ $product->title }}
@endsection
@section('content')

  <!-- Start Sidebar + Content -->
  <div class='container margin-top-20'>
    <div class="row">
      <div class="col-md-4">

        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">

            @php $i = 1; @endphp
              @foreach ($product->images as $image)
                
                  <div class="product-item carousel-item {{ $i == 1 ? 'active': '' }}">
                    <img src="{{ asset('images/products/'.$image->image) }}" class="d-inline w-100" alt="{{ asset('images/products/.') }}">
                  </div>
                  @php $i++; @endphp
              @endforeach
         

            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
      </div>

      <div class="col-md-8">
        <div class="widget">
          <h3>{{ $product->title }}</h3>
          <h3>{{ $product->price }} $ 
          <br>
            <span class="badge badge-warning">
              {{ $product->quantity < 1 ? 'No Item is available' : $product->quantity . ' item in stock'}}
            </span>
          </h3>
          <hr>
          <div class="product-desc">
            {{ $product->description }}
          </div>
        </div>
        <div class="widget">

        </div>
      </div>


    </div>
  </div>

  <!-- End Sidebar + Content -->
@endsection


 