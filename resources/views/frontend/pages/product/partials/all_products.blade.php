@foreach ($products as $product)

<div class="card product-card align-items-center">

    @php $i = 1; @endphp

    @foreach ($product->images as $image)
    @if ($i > 0)
    <a href=" {{ route('products.show', $product->slug) }} ">
        <img style="max-height: 200px;" class="card-img-top feature-img"
            src="{{ asset('images/products/'. $image->image) }}" alt="{{ $product->title }}">
    </a>
    @endif

    @php $i--; @endphp
    @endforeach
    <div class="card-block text-center">
        <h4 class="card-title">
            <a class="product-card-title"
                href=" {{ route('products.show', $product->slug) }} ">{{ $product->title }}</a>
        </h4>
        <p class="card-text mb-1">{{ $product->price }}$</p>
    </div>

    <div class="mb-3">
        @include('frontend.pages.product.partials.cart-button')
    </div>

</div>
@endforeach
