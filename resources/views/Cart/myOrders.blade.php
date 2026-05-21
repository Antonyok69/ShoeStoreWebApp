@extends('FrontEnd.headerFouter')

@section('content')
<div class="container mt-5">
    <h1>My Orders</h1>

    @if($orders->isEmpty())
        <p>You have no orders yet.</p>
    @else
        <table class="table table-bordered mt-3">
            <thead class="thead-dark">
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Address</th>
                    <th>Date</th>
                </tr>
            </thead>

            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->product_name }}</td>
                        <td>{{ $order->quantity }}</td>
                        
                        {{-- PRICE IN PESO --}}
                        <td>₱{{ number_format($order->price, 2) }}</td>

                        {{-- TOTAL IN PESO --}}
                        <td>₱{{ number_format($order->total, 2) }}</td>

                        <td>{{ $order->address }}</td>

                        {{-- SAFE DATE FORMAT --}}
                        <td>
                            {{ \Carbon\Carbon::parse($order->created_at)->format('M d, Y h:i A') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection