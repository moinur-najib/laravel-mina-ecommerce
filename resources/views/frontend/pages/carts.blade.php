@extends('frontend.layouts.master')

@section('content')
  <div class='container margin-top-20'>
    <h2>My Cart Items</h2>
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>no.</th>
          <th>Product Title</th>
          <th>Product Image</th>
          <th>Product Quantity</th>
          <th>
            Delete
          </th>
        </tr>
      </thead>
      <tbody>
        @foreach(App\Models\Cart::totalCarts() as $cart)
        <tr>
          <td> {{ $loop->index + 1 }} </td>

          <td>
            <a href="{{ route('products.show', $cart->product->slug) }}"> {{ $cart->product->title }} </a>
          </td>

          <td>
           @if ($cart->product->images->count() > 0)
            <img src="{{ asset('images/products/'. $cart->product->images->first()->image) }}" style="width: 40px">
           @endif
          </td>

          <td>
            <form class="form-inline" action="" method="post">
                @csrf
                <input type="number" name="product_quantity" class="form-control">
                <button type="submit" class="btn btn-success">Update</button>
            </form>
          </td>

          <td>
            <form class="form-inline" action="" method="post">
                @csrf
                <input type="hidden" name="cart_id">
                <button type="submit" class="btn btn-success">Delete</button>
            </form>
          </td>

        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
