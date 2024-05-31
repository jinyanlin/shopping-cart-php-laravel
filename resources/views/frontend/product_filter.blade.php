@extends('layouts.front')

@section('title')
    Welcome to MY E-SHOP
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <br>
        </div>
        <div class="col-md-3 py-3" style="padding-left: 50px;">
            <h2>Filter</h2>
             <form method="GET" action="{{ route('products.filter') }}">
                <div class="card" style="width: 18rem;">
                    <div class="card-header">
                        <h4>Categories
                            <button type="submit" class="btn btn-primary btn-sm float-right">Filter</button>
                        </h4>
                    </div>
                    <div class="card-body">
                        @foreach ($categorys as $category)
                            <div class="mb-1">
                                <input type="checkbox" name="filter_product[]" value="{{ $category->id }}"
                                       id="category_{{ $category->id }}"  {{ is_array(request('filter_product')) && in_array($category->id, request('filter_product')) ? 'checked' : '' }}/>
                                <label for="category_{{ $category->id }}">
                                    {{ $category->slug }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-9">
            <h2>所有商品</h2>
            <div class="row">
                @foreach ($products as $prod)
                    <div class="col-4 mb-4">
                        <div class="card prod-image">
                            <a href="{{ url('category/' . $prod->category->slug . '/' . $prod->slug) }}">
                                <img src="{{ asset('assets/uploads/product/' . $prod->image) }}" class="card-img-top" alt="Product image">
                                <div class="card-body">
                                    <h3 class="card-title">{{ $prod->name }}</h3>
                                    <p class="card-text">
                                        @if ($prod->selling_price == $prod->original_price)
                                            <span class="float-start">NT $ {{ $prod->original_price }}</span>
                                        @else
                                            <span class="float-start">NT $ {{ $prod->selling_price }}</span>
                                            <span class="float-end"><s>NT $ {{ $prod->original_price }}</s></span>
                                        @endif
                                    </p>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>



    </div>
@endsection
