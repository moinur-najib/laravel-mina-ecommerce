@extends('frontend.layouts.master')

@section('content')
<div class='container card card-body margin-top-20'>
    <div class="card card-body">
        <h2>Confirm items</h2>
        <hr>

        <div class="row">
            <div class="col-md-7">
                @foreach(App\Models\Cart::totalCarts() as $cart)

                <p>{{ $cart->product->title }} -
                    <strong>{{ $cart->product->price }}</strong> -
                    {{ $cart->product_quantity }} item
                </p>

                @endforeach
            </div>
            <div class="col-md-5">

                @php
                $total_price = 0;
                @endphp

                @foreach(App\Models\Cart::totalCarts() as $cart)
                @php

                $total_price += $cart->product->price * $cart->product_quantity;

                @endphp
                @endforeach
                <p>Total Price : <strong> {{ $total_price }}$ </strong></p>
                <p>Total Price + Shipping: <strong> {{ $total_price + App\models\Setting::first()->shipping_cost }}$
                    </strong></p>
            </div>
        </div>
        <p><a href="{{ route('carts') }}">Change Cart Items</a></p>
    </div>

    <div class="card card-body mt-5">
        <h2>Shipping Adress</h2>

        <form method="POST" action="{{ route('checkouts.store') }}" class="d-block">
            @csrf
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">Reciever Name</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                        value="{{ Auth::check() ? Auth::user()->first_name . ' ' . Auth::user()->last_name : '' }}"
                        required autocomplete="name" autofocus>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">E-mail Adress</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ Auth::check() ? Auth::user()->email : '' }}" required
                        autocomplete="email" autofocus>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="phone_no" class="col-md-4 col-form-label text-md-right">Phone Number</label>

                <div class="col-md-6">
                    <input id="phone_no" type="phone_no" class="form-control @error('phone_no') is-invalid @enderror"
                        name="phone_no" value="{{ Auth::check() ? Auth::user()->phone_no : '' }}" required
                        autocomplete="phone_no" autofocus>

                    @error('phone_no')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="shipping_adress" class="col-md-4 col-form-label text-md-right">Shipping adress (*)</label>

                <div class="col-md-6">
                    <textarea id="shipping_adress" type="text"
                        class="form-control @error('shipping_adress') is-invalid @enderror" name="shipping_adress"
                        rows="4" autocomplete="shipping_adress" autofocus>
                    {{ Auth::check() ? Auth::user()->shipping_adress : '' }}
                    </textarea>

                    @error('shipping_adress')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="message" class="col-md-4 col-form-label text-md-right">Additional Message (optional)</label>

                <div class="col-md-6">
                    <textarea id="message" type="text" class="form-control @error('message') is-invalid @enderror"
                        name="message" rows="4" autocomplete="message" autofocus>
                    </textarea>

                    @error('message')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="payment_method" class="col-md-4 col-form-label text-md-right">Payment Method</label>

                <div class="col-md-6">
                    <select class="form-control" name="payment_method_id" required id="payments">
                        <option value="">Select a payment method please</option>
                        @foreach($payments as $payment)
                        <option value="{{ $payment->short_name }}"> {{ $payment->name }} </option>
                        @endforeach
                    </select>
                    @foreach ($payments as $payment)

                    @if ($payment->short_name == "cash_in")
                    <div id="payment_{{ $payment->short_name }}" class="alert alert-success text-center hidden">
                        <h3>
                            For Cash in there is nothing necessary.Just click Finish Order
                            <br>
                            <small>You will get your product in two or three days</small>
                        </h3>
                    </div>
                    @else
                    <div id="payment_{{ $payment->short_name }}" class="alert alert-success text-center hidden">
                        <h3> {{ $payment->name }} Payment</h3>
                        <p>
                            <strong> {{ $payment->name }} No: {{ $payment->no }} </strong>
                            <br>
                            <strong>Account Type: {{ $payment->type }} </strong>
                        </p>
                        <div class="alert alerf-success">
                            Please send the above money to this Bkash no and write your transaction code below there
                        </div>


                    </div>
                    @endif
                    @endforeach
                    <input type="text" id="transaction_id" name="transaction_id" class="form-control hidden"
                        placeholder="Enter trasaction code">
                </div>



            </div>
            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        Order Now
                    </button>
                </div>
            </div>
    </div>
    </form>
</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $("#payments").change(function () {
        $payment_method = $("#payments").val();
        if ($payment_method == "cash_in") {

            $("#payment_cash_in").removeClass('hidden');
            $("#payment_bkash").addClass('hidden');
            $("#payment_rocket").addClass('hidden');

        } else if ($payment_method == "bkash") {

            $("#payment_bkash").removeClass('hidden');
            $("#transaction_id").removeClass('hidden');
            $("#payment_cash_in").addClass('hidden');
            $("#payment_rocket").addClass('hidden');

        } else if ($payment_method == "rocket") {

            $("#transaction_id").removeClass('hidden');
            $("#payment_rocket").removeClass('hidden');
            $("#payment_cash_in").addClass('hidden');
            $("#payment_bkash").addClass('hidden');
        }
    })

</script>
@endsection
