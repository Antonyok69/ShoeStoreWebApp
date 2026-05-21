
@extends('admin.adminlayout')

@section('content')





<div class="container">
        <h1>Men's Shoes</h1>

        <div class="row">
        @foreach ($menShoes as $shoe)
    <div class="col-lg-3 mb-4 text-center">
        <div class="product-entry border">
            <a href="{{ Auth::check() ? route('shoes.show', $shoe->id) : route('login') }}" class="prod-img">
                <img src="{{ asset('storage/' . $shoe->image) }}" alt="Shoe Image" class="img-fluid">
            </a>

            <div class="desc">
                <h2><a href="{{ Auth::check() ? route('shoes.show', $shoe->id) : route('login') }}">{{ $shoe->name }}</a></h2>
                <span class="price">₱{{ $shoe->price }}</span>
            </div>

            <form action="{{ route('shoes.show', $shoe->id) }}" method="POST">
                @csrf
                @method('GET')

                @if (Auth::check())
                    <button type="submit" class="btn btn-primary">Add to Cart</button>

                @else
                    <a href="{{ route('login') }}" class="btn btn-primary">Add to Cart</a>
                @endif
            </form>
        </div>
    </div>
@endforeach

        </div>
    </div>



    @endsection