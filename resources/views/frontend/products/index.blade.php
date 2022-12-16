@extends('layouts.front')

@section('title')
    {{ $category->name }}
@endsection

@section('content')

<div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container">
        <h6 class="mb-0">
            <a href="{{ url('category') }}">
            目錄
            </a> /
            <b><a href="{{ url('category/'.$category->slug )}}">
                {{ $category->name }}
            </a>  / </b>
           
        </h6>
    </div>
</div>



<div class="py-5">
    <div class="container">
        <div class="row">
            <h2> {{ $category->name }} </h2>
                @foreach ($products as $prod)
                <div class="col-md-3 mb-3">
                    <div class="card prod-image">
                        <a href="{{ url('category/'.$category->slug.'/'.$prod->slug) }}">
                        <img src="{{ asset('assets/uploads/product/'.$prod->image )}}" alt="Product image">
                        <div class="card-body" alt="product-image">
                            <h3> {{ $prod->name }} </h3>
                            @if ($prod->selling_price == $prod->original_price)
                                <span class="float-end">NT ${{ $prod->original_price }} </span>
                                
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
</div>
@endsection