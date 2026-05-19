@extends('FrontEnd.headerFouter')

@section('content')
    <div class="container">
        <h1>Cart</h1>

        @if ($cartItems->isEmpty())
            <p>Your cart is empty.</p>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Size</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartItems as $cartItem)
                            <tr>
                                <td>
                                    <img src="{{ asset('images/' . basename($cartItem->shoe->image)) }}"
     alt="{{ $cartItem->shoe->name }}"
     class="img-thumbnail"
     style="width: 100px; height: 100px; object-fit: contain;">
                                </td>
                                <td>{{ $cartItem->shoe->name }}</td>
                                <td>{{ $cartItem->size }}</td>
                                <td>{{ $cartItem->shoe->price }}</td>
                                <td>{{ $cartItem->quantity }}</td>
                                <td>{{ $cartItem->total_price }}</td>
                                <td>
                                    <form action="{{ route('cart.remove', $cartItem->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                <h4>Total: {{ $cartItems->sum('total_price') }}</h4>
            </div>

            <div class="mt-4">
            <a href="{{ route('payment') }}" class="btn btn-primary">Proceed to Payment</a>
            </div>
        @endif

    </div>
@endsection
