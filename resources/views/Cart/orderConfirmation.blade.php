@extends('FrontEnd.headerFouter')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header text-center">
            <h2>Order Confirmation</h2>
        </div>

        <div class="card-body">
            <div class="alert alert-success">
                Payment successful! Thank you for your purchase.
            </div>

            <a href="{{ route('orders.my') }}" class="btn btn-primary mt-3">
                View My Orders
            </a>
        </div>
    </div>
</div>
@endsection