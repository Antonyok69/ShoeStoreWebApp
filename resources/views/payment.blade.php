@extends('FrontEnd.headerFouter')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Payment</h1>

    <form action="{{ route('processPayment') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label for="full_name">Full Name</label>
            <input
                type="text"
                name="full_name"
                id="full_name"
                class="form-control"
                required>
        </div>

        <div class="form-group mb-3">
            <label for="card_number">Card Number</label>
            <input
                type="text"
                name="card_number"
                id="card_number"
                class="form-control"
                placeholder="1234 5678 9012 3456"
                required>
        </div>

        <div class="form-group mb-3">
            <label for="card_code">Card Code</label>
            <input
                type="text"
                name="card_code"
                id="card_code"
                class="form-control"
                placeholder="CVV"
                required>
        </div>

        <div class="form-group mb-4">
            <label for="address">Delivery Address</label>

            <textarea
                name="address"
                id="address"
                class="form-control"
                rows="4"
                placeholder="Enter your complete delivery address"
                required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">
            Confirm Payment
        </button>
    </form>
</div>
@endsection