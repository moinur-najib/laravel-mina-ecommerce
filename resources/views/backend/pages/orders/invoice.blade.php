<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - {{ $order->id }} </title>
    <!-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> -->
    <!-- <link rel="stylesheet" href="{{asset('css/admin_style.css')}}"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: rgb(252, 252, 252);
        }

        .content-wrapper {
            background-color: #fff;
        }

        .invoice-header {
            background: #f7f7f7;
            padding: 10px solid grey;
            border-bottom: 1px solid grey
        }

        .invoice-rigth-top h3 {
            padding-right: 20px;
            margin-top: 20px;
            color: #ec5d01;
            font-size: 50px;
            font-family: serif;
        }

        .invoice-left-top {
            border-left: 4px solid #ec5d00;
            padding-left: 20px;
            padding-top: 20px;
        }

        .hidden {
            display: none;
        }

        thead {
            background: #ec5d01;
            color: #fff;

        }

        .authority h5 {
            margin-top: -10px;
            color: #ec5d01;
            border-top: 1px solid black;
            /* text-align: center; */
        }

        .thanks h4 {
            color: #ec5d01;
            font-size: 25px;
            font-weight: normal;
            font-family: serif;
            margin-top: 20px;
        }

        .site-adress p {
            line-height: 6px;
            font-weight: 300;
        }

    </style>
</head>

<body>
    @php
    ini_set('max_execution_time', '300');
    @endphp
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="invoice-header">
                <div class="float-left site-logo mt-3">
                    <img src="file:///C:/Users/NixonOK/Desktop/Najib/laravel/mina-ecom/public/images/favicon.png"
                        alt="">
                    <!-- <img src="{{ asset('images/favicon.png') }}" alt=""> -->
                </div>

                <div class="float-right site-adress mt-2">
                    <h4>Lara Ecommerce</h4>
                    <p>31/1, Purana Platan, Dhaka-1200</p>
                    <p>Phone: <a href="">01830692649</a></p>
                    <p>Email: <a href="mailto:info@laraecommerce.com">info@laraecommerce.com</a></p>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="invoice-description">
                <div class="invoice-left-top float-left">
                    <h6>Invoice to</h6>
                    <h3>{{ $order->name }}</h3>
                    <div class="adress">
                        <p>
                            <strong>Adress: </strong>
                            {{ $order->shipping_adress }}
                        </p>
                        <p>Phone: {{ $order->phone_no }} </p>
                        <p>Email: {{ $order->email }} </p>
                    </div>
                </div>

                <div class="invoice-rigth-top float-right">
                    <h3>Invoice #{{$order->id}} </h3>
                    <p>
                        {{ $order->created_at }}
                    </p>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="">
                <div class="card-header">
                    View Order #LE{{ $order->id }}
                </div>
                <h3>Products</h3>

                @if ($order->carts->count() > 0)
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product Title</th>
                            <th>Product Quantity</th>
                            <th>Unit Price</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <p class="hidden">
                            {{ $sub_total_price = 0 }}
                            {{ $total_price = 0 }}
                        </p>

                        @foreach($order->carts as $cart)
                        <tr>
                            <td> {{ $loop->index + 1 }} </td>
                            <td>
                                <a href="{{ route('products.show', $cart->product->slug) }}">
                                    {{ $cart->product->title }} </a>
                            </td>
                            <td>
                                {{ $cart->product_quantity }}
                            </td>
                            <td>
                                {{ $cart->product->price }}$
                            </td>
                            @php
                            $total_price = $cart->product->price * $cart->product_quantity;
                            @endphp
                            <td>
                                {{ $total_price }}$
                            </td>

                        </tr>
                        @php
                        $sub_total_price += $total_price;
                        @endphp
                        @endforeach
                        <tr>
                            <td colspan="3"></td>
                            <td>
                                Discount
                            </td>

                            <td colspan="2">
                                <strong>{{ $order->custom_discount }}$</strong>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="3"></td>
                            <td>
                                Shipping Cost
                            </td>

                            <td>
                                <strong>{{ $order->shipping_charge }}$</strong>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="3"></td>
                            <td>
                                Total Amount:
                            </td>

                            <td>
                                <strong>{{ $total_price + $order->shipping_charge - $order->custom_discount }}$</strong>
                            </td>
                        </tr>
                    </tbody>
                </table>
                @endif
                <div class="thyanks mt-3">
                    <h4>Thank you for your business!</h4>
                </div>

                <div class="authority float-right mt-5">
                    <!-- <p>---------------------------</p> -->
                    <h5>Authority Signature</h5>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

</body>

</html>
