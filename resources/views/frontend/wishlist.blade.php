@extends('layouts.front')

@section('title')
    希望清單
@endsection

@section('content')

    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h6 class="mb-0">
                <a href="{{ url('/') }}">
                    Home 
                </a> /
                <b>
                    <a href="{{ url('cart') }}">
                    Wishlist
                    </a> /
                </b>
            </h6>
        </div>
    </div>

    <div class="container my-5">
        <div class="card shadow ">
            <div class="card-body">
                @if ($wishlist->count() > 0)
                    <div class="card-body">
                        @foreach ($wishlist as $item)
                            <div class="row product_data">
                                <div class="col-md-2 my-auto show_cart_image">
                                    <img src="{{ asset('assets/uploads/product/'.$item->products->image)}}" height="70px" width="70px" alt="Image here">
                                </div>
                                <div class="col-md-2 my-auto">
                                    <h6> {{ $item->products->name }} </h6>
                                </div>
                                <div class="col-md-2 my-auto">
                                    <h6> NT ${{ $item->products->selling_price }} </h6>
                                </div>
                                <div class="col-md-2 my-auto">
                                    <input type="hidden" class="prod_id" value=" {{ $item->prod_id }}">
                                    @if ($item->products->quantity >= $item->prod_qty)
                                        <label for="Quantity">數量</label>
                                        <div class="input-group text-center mb-3" style="width: 130px;">
                                            <button class="input-group-text decre-btn">-</button>
                                            <input type="text" name="quantity" class="form-control qty-input text-center" value="1">
                                            <button class="input-group-text incre-btn">+</button>
                                        </div>
                                    @else
                                        <h6>補貨中</h6>
                                    @endif
                                </div>
                                @if ($item->products->quantity >= $item->prod_qty)
                                    <div class="col-md-2 my-auto">
                                        <h6></h6>
                                        <button class="btn btn-success addCartBtn">
                                            <i class="fa fa-shopping-cart"></i>Add to Cart
                                        </button>
                                    </div>
                                @endif
                                <div class="col-md-2 my-auto">
                                    <button class="btn btn-danger remove-wishlist-item">
                                        <i class="fa fa-trash"></i>Remove
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <h4>您目前沒有希望清單</h4>
                @endif
            </div>
        </div>
    </div>

@endsection