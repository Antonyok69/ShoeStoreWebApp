@extends('FrontEnd.headerFouter')

<style>
    .shoe-items {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}

.shoe-item {
    width: 25%;
    padding: 10px;
    box-sizing: border-box;
}

</style>
@section('content')
<h1 class="text-center" style="color: lightcyan; text-shadow: 2px 2px 4px black;">Search Results</h1>
    <div class="container">
    <div class="shoe-items">
        @foreach ($shoes as $shoe)
            <div class="shoe-item text-center">
                <div class="product-entry border">
                    <a href="{{ route('shoes.show', $shoe->id) }}" class="prod-img">
                        <img src="{{ asset('storage/' . $shoe->image) }}" alt="Shoe Image" class="img-fluid">
                    </a>
                    <div class="desc">
                        <h2><a href="#">{{ $shoe->name }}</a></h2>
                        <span class="price">₱{{ $shoe->price }}</span>
                    </div>
                    <form action="{{ route('cart.add', $shoe->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">Add to Cart</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
