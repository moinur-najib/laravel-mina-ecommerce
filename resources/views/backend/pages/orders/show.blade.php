@extends('backend.layouts.master')

@section('content')
<div class="main-panel">
    <div class="content-wrapper">

        <div class="card">
            <div class="card-header">
                View Order #LE{{ $order->id }}
            </div>
            <div class="card-body">
                @include('backend.partials.messages')
                <h3>Order Info</h3>
                <div class="row">
                    <div class="col-md-6 border-right">
                        <p><strong>Orderer Name -</strong> {{ $order->name }} </p>
                        <p><strong>Orderer Phone Number -</strong> {{ $order->phone_no }} </p>
                        <p><strong>Orderer Email -</strong> {{ $order->email }} </p>
                        <p><strong>Orderer Shipping Adress -</strong> {{ $order->shipping_adress }} </p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Orderer Payment Method -</strong> {{ $order->payment ? $order->payment->name : '' }}
                            <p><strong>Orderer Payment Method -</strong>{{ $order->transaction_id }}</p>
                    </div>
                </div>
                <hr>
                <h3>Ordered Items - </h3>
                @if ($order->carts->count() > 0)
                <table class="table table-bordered table-striped">

                </table>
                @endif

                <form action=" {{ route('admin.order.completed', $order->id) }} " class="form-inline d-inline"
                    method="POST">
                    @csrf
                    @if ($order->is_completed)
                    <input type="submit" value="Cancel Order" class="btn btn-danger">
                    @else
                    <input type="submit" value="Complete Order" class="btn btn-success">
                    @endif

                </form>

                <form action=" {{ route('admin.order.paid', $order->id) }} " class="form-inline d-inline" method="POST">
                    @csrf
                    @if ($order->is_paid)
                    <input type="submit" value="Cancel Payment" class="btn btn-danger">
                    @else
                    <input type="submit" value="Paid Order" class="btn btn-success">
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
<!-- main-panel ends -->
@endsection
