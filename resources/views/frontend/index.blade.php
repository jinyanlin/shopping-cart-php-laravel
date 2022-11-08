@extends('layouts.front')

@section('title')
    Welcome to MY E-SHOP
@endsection

@section('content')
    @include('layouts.inc.slide')
    
    <div class="py-5">
        <div class="container">
            <div class="row">
                <h2> 特價商品 </h2>
                <div class="owl-carousel owl-theme featured-carousel">
                    @foreach ($featured_products as $prod)
                    <div class="item">
                        <div class="card">
                            <img src="{{ asset('assets/uploads/product/'.$prod->image )}}"" alt="Product image">
                            <div class="card-body" alt="product-image">
                                <h5> {{ $prod->name }} </h5>
                                <span class="float-start">{{ $prod->selling_price }} </span>
                                <span class="float-end"><s>{{ $prod->original_price }} </s></span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
               
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
    $('.featured-carousel').owlCarousel({
        loop:true,
        margin:10,
        nav:true,
        dots:false,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:3
            }
        }
    })
    </script>
@endsection