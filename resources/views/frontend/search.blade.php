@extends('layouts.front')

@section('title','Search Products')
   

@section('content')
    
    <div class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h4>Search Results</h4>
                    <div class="underline mb-4"></div>

                    @forelse ($searchProduct as $productItem)
                    <div class="col-md-10">
                        <div class="product-card card">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="prod-image">
                                        <label class="stock bg-danger">New</label>
                                        
                                        <a href="{{ url('category/'.$productItem->category->slug.'/'.$productItem->slug) }}">
                                            <img src="{{ asset('assets/uploads/product/'.$productItem->image) }}" alt="">
                                        </a>
                                            
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="productcard-body card-body">
                                        <h5 class="product-name">
                                            <a href="{{ url('category/'.$productItem->category->slug.'/'.$productItem->slug) }}">
                                               {{ $productItem->name }}
                                            </a>
                                        </h5>
                                        <div>
                                            @if ($productItem->selling_price == $productItem->original_price)
                                            <span class="">NT $ {{ $productItem->original_price }} </span>
                                            @else
                                            <span class="color:red;"><h3>NT $ {{ $productItem->selling_price }} </h3></span>
                                            <span class=""><s>NT $ {{ $productItem->original_price }} </s></span>
                                            @endif
                                        </div>
                                        <p style="height: 20%; overflow:hidden">
                                            <b> Description : </b> {{ $productItem->short_description}}
                                        </p>
                                        <br>
                                        <a href="{{ url('category/'.$productItem->category->slug.'/'.$productItem->slug) }}"
                                            class="btn btn-outline-primary">View
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                    @empty
                        <div class="col-md-12 p-2">
                            <h4>No Products Available</h4>
                        </div>
                    @endforelse
                    
                    <div class="col-md-10">
                        {{ $searchProduct->appends(request()->input())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection