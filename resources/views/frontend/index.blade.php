@extends('layouts.front')

@section('title')
    Welcome to MY E-SHOP
@endsection

@section('content')
    @include('layouts.inc.slide')
    <br>
    <div class="row">
        <div class="col-md-3 py-3" style="padding-left: 50px;">
            <h2>Filter</h2>
            <form method="GET" action="">
                <div class="card" style="width: 18rem;">
                    <div class="card-header">
                        <h4>Brands
                            <button type="submit" class="btn btn-primary btn-sm float-right">Filter</button>
                        </h4>
                    </div>
                    <div class="card-body">
                        @foreach ($category as $items)
                            <div class="mb-1">
                                <input type="checkbox" name="filter_product" value="{{ $items->id }}" id="select_category"
                                />
                                <label for="select_category">
                                    {{ $items->slug }}
                                </label>
                            </div>
                        @endforeach
                        
                    </div>
                    
                </div>
            </form>
        </div>
        <div class="col-md-9">
            <h2> 特價熱門商品 </h2>
            <div class="owl-carousel owl-theme featured-carousel">
                @foreach ($featured_products as $prod)
                    <div class="item">
                        <div class="card prod-image">
                            <a href="{{ url('category/' . $prod->category->slug . '/' . $prod->slug) }}">
                                <img src="{{ asset('assets/uploads/product/' . $prod->image) }}"" alt="Product image">
                                <div class="card-body" alt="product-image">
                                    <h3> {{ $prod->name }} </h3>
                                    @if ($prod->selling_price == $prod->original_price)
                                        <span class="float-start">NT $ {{ $prod->original_price }} </span>
                                    @else
                                        <span class="float-start">NT $ {{ $prod->selling_price }} </span>
                                        <span class="float-end"><s>NT $ {{ $prod->original_price }} </s></span>
                                    @endif
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
        <div class="container">
            <div class="row">
                <h2> 熱門目錄 </h2>
                <div class="owl-carousel owl-theme featured-carousel">
                    @foreach ($trending_category as $trencate)
                        <div class="item">
                            <a href=" {{ url('category/' . $trencate->slug) }}">
                                <div class="card cate-image">
                                    <img src="{{ asset('assets/uploads/category/' . $trencate->image) }}""
                                        alt="Product image">
                                    <div class="card-body" alt="product-image">
                                        <h2> {{ $trencate->name }} </h2>
                                        <p>
                                            {{ $trencate->description }}
                                        </p>
                                    </div>
                                </div>
                            </a>
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
            loop: true,
            margin: 10,
            nav: true,
            dots: false,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 3
                }
            }
        })
    </script>
@endsection
