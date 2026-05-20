@extends('FrontEnd.headerFouter')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header text-center">
            <h2>Order Confirmation</h2>
        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <h4>Your Order Summary</h4>

            <table class="table table-bordered mt-3">
                <thead class="thead-dark">
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>Delivery Address</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($latestOrders as $order)
                        <tr>
                            <td>{{ $order['product_name'] }}</td>
                            <td>{{ $order['quantity'] }}</td>
                            <td>${{ number_format($order['price'], 2) }}</td>
                            <td>${{ number_format($order['total'], 2) }}</td>
                            <td>{{ $order['address'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <a href="{{ route('shop') }}" class="btn btn-primary mt-3">Continue Shopping</a>
        </div>
    </div>
</div>
@endsection