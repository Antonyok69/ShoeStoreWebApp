@extends('FrontEnd.headerFouter')

@section('content')
    <div class="container">
        <h1>Payment</h1>

        <form action="{{ route('processPayment') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="full_name">Full Name</label>
                <input type="text" name="full_name" id="full_name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="card_number">Card Number</label>
                <input type="text" name="card_number" id="card_number" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="card_code">Card Code</label>
                <input type="text" name="card_code" id="card_code" class="form-control" required>
            </div>


            <div class="form-group">
    <label>Delivery Address</label>

    <textarea
        name="address"
        class="form-control"
        rows="3"
        required></textarea>
</div>


            <button type="submit" class="btn btn-primary">Confirm Payment</button>
        </form>
    </div>
@endsection
