@extends('FrontEnd.headerFouter')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Shoe Details</div>

                <div class="card-body">
                    <div class="text-center">
                        <img src="{{ asset('images/' . basename($shoe->image)) }}"
     alt="{{ $shoe->name }}"
     class="img-fluid"
     style="width:300px; height:300px; object-fit:contain;">
                    </div>
                    <h2 class="mt-4">{{ $shoe->name }}</h2>
                    <p><strong>Price:</strong> ${{ $shoe->price }}</p>
                    <p><strong>Category:</strong> {{ $shoe->category }}</p>

                    <form action="{{ route('cart.add', $shoe->id) }}" method="POST">
                        @csrf
                        @auth
                            <div class="form-group">
                                <!-- size of the shoes  -->
                                <label for="size">Size:</label>
                                <select name="size" id="size" class="form-control">
                                        <option value="36">36</option>
                                        <option value="37">37</option>
                                        <option value="38">38</option>
                                        <option value="39">39</option>
                                        <option value="40">40</option>
                                        <option value="41">41</option>
                                        <option value="42">42</option>
                                        <option value="43">43</option>
                                        <option value="44">44</option>
                                        <option value="45">45</option>
                                </select>
                            </div>
                           
                            <div class="form-group">
                                <label for="quantity">Quantity:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-outline-primary" id="minus-btn">-</button>
                                    </div>
                                    <input type="number" name="quantity" id="quantity" class="form-control" value="1" min="1">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-outline-primary" id="plus-btn">+</button>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Add to Cart</button>
                        @else
                        <p>Please <a href="{{ route('login') }}">login</a> to add this item to your cart.</p>
                            <a href="{{ route('login') }}" class="btn btn-primary">Login  </a>
                        @endauth
                    </form>
                    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById("plus-btn").addEventListener("click", function() {
        var quantityInput = document.getElementById("quantity");
        var currentQuantity = parseInt(quantityInput.value);
        var newQuantity = currentQuantity + 1;
        quantityInput.value = newQuantity;
    });

    document.getElementById("minus-btn").addEventListener("click", function() {
        var quantityInput = document.getElementById("quantity");
        var currentQuantity = parseInt(quantityInput.value);
        if (currentQuantity > 1) {
            var newQuantity = currentQuantity - 1;
            quantityInput.value = newQuantity;
        }
    });
</script>
@endsection
