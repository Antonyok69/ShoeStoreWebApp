@extends('FrontEnd.headerFouter')

@section('content')

    <!-- Content specific to the home page -->
	<div class="container">
    <aside id="colorlib-hero">
        <div class="flexslider">
            <ul class="slides">
                <li style="background-image: url({{ asset('web/images/img_bg_1.jpg') }});">
                    <div class="overlay"></div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6 offset-sm-3 text-center slider-text">
                                <div class="slider-text-inner">
                                    <div class="desc">
                                        <h1 class="head-1">Men's</h1>
                                        <h2 class="head-2">Shoes</h2>
                                        <h2 class="head-3">Collection</h2>
                                        <p class="category"><span>New trending shoes</span></p>
                                        <p><a href="#collection-section" class="btn btn-primary">Shop Collection</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li style="background-image: url({{ asset('web/images/img_bg_2.jpg') }});">
                    <div class="overlay"></div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6 offset-sm-3 text-center slider-text">
                                <div class="slider-text-inner">
                                    <div class="desc">
                                        <h1 class="head-1">Huge</h1>
                                        <h2 class="head-2">Sale</h2>
                                        <h2 class="head-3"><strong class="font-weight-bold">50%</strong> Off</h2>
                                        <p class="category"><span>Big sale sandals</span></p>
                                        <p><a href="#collection-section" class="btn btn-primary">Shop Collection</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li style="background-image: url({{ asset('web/images/img_bg_3.jpg') }});">
                    <div class="overlay"></div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6 offset-sm-3 text-center slider-text">
                                <div class="slider-text-inner">
                                    <div class="desc">
                                        <h1 class="head-1">New</h1>
                                        <h2 class="head-2">Arrival</h2>
                                        <h2 class="head-3">up to <strong class="font-weight-bold">30%</strong> off</h2>
                                        <p class="category"><span>New stylish shoes for men</span></p>
                                        <p><a href="#collection-section" class="btn btn-primary">Shop Collection</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </aside>
    <div class="colorlib-intro">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h2 class="intro">It started with a simple idea: Create quality, well-designed products that I wanted myself.</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="colorlib-product">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 text-center">
                    <div class="featured">
                        <a href="{{ route('shoes.men') }}" class="featured-img" style="background-image: url({{ asset('web/images/men.jpg') }});"></a>
                        <div class="desc">
                            <h2><a href="{{ route('shoes.men') }}">Shop Men's Collection</a></h2>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 text-center">
                    <div class="featured">
                        <a href="{{ route('shoes.women') }}" class="featured-img" style="background-image: url({{ asset('web/images/women.jpg') }});"></a>
                        <div class="desc">
                            <h2><a href="{{ route('shoes.women') }}">Shop Women's Collection</a></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




    <!-- ELEMENTS -->
    <h1 id="collection-section" class="text-center mb-4" style="font-size: 32px; font-weight: bold; color: #333;">Best Deals</h1>



    <div class="row justify-content-center" >
    @foreach ($mainShoes as $shoe)
    <div class="col-lg-3 mb-4 text-center">
        <div class="product-entry border">
            <a href="{{ Auth::check() ? route('shoes.show', $shoe->id) : route('login') }}" class="prod-img">
                <img src="{{ asset('images/' . basename($shoe->image)) }}"
     alt="{{ $shoe->name }}"
     style="width:200px;height:200px;object-fit:contain;">
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
