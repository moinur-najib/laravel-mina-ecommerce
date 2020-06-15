<div class="row">

    @foreach ($products as $products)

        <div class="col-md-6 col-lg-3">
            <div class="card product-card">
        
                @php $i = 1; @endphp

                @foreach ($products->images as $image)
                    @if ($i > 0)
                        <a href=" {{ route('products.show', $products->slug) }} ">
                            <img style="max-height: 200px;" class="card-img-top feature-img" src="{{ asset('images/products/'. $image->image) }}" alt="{{ $products->title }}" >
                        </a>
                    @endif

                    @php $i--; @endphp
                @endforeach



                    <div class="card-body text-center">
                        <h4 class="card-title">
                          <a class="product-card-title" href=" {{ route('products.show', $products->slug) }} ">{{ $products->title }}</a>
                        </h4>
                        <p class="card-text">{{ $products->price }}$</p>

                            <a href="#" class="product-card-btn btn btn-outline-warning">Add to cart</a>

                      </div>
                </div>
            </div>

    @endforeach

</div>