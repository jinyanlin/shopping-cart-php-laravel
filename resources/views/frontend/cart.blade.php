@extends('layouts.front')

@section('title')
    購物車內容
@endsection

@section('content')

    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h6 class="mb-0">
                <a href="{{ url('/') }}">
                    Home 
                </a> /
                <a href="{{ url('cart') }}">
                    Cart
                </a> /
            </h6>
        </div>
    </div>

    <div class="container my-5">
        <div class="card shadow ">
            <div class="card-body">
                @php
                    $total = 0;
                @endphp
                @foreach ($cartitems as $item)
                    
                
                <div class="row product_data">
                    <div class="col-md-2 my-auto show_cart_image">
                        <img src="{{ asset('assets/uploads/product/'.$item->products->image)}}" height="70px" width="70px" alt="Image here">
                    </div>
                    <div class="col-md-3 my-auto">
                        <h6> {{ $item->products->name }} </h6>
                    </div>
                    <div class="col-md-2 my-auto">
                        <h6> NT ${{ $item->products->selling_price }} </h6>
                    </div>
                    <div class="col-md-3 my-auto">
                        <input type="hidden" class="prod_id" value=" {{ $item->prod_id }}">
                        <label for="Quantity">數量</label>
                        <div class="input-group text-center mb-3" style="width: 130px;">
                            <button class="input-group-text changeQty decre-btn">-</button>
                            <input type="text" name="quantity" class="form-control qty-input text-center" value=" {{ $item->prod_qty }}">
                            <button class="input-group-text changeQty incre-btn">+</button>
                        </div>
                    </div>
                    <div class="col-md-2 my-auto">
                        <h6></h6>
                        <button class="btn btn-danger delete-cart-item">
                            <i class="fa fa-trash"></i>Remove
                        </button>
                    </div>
                </div>
                @php
                    $total += $item->products->selling_price * $item->prod_qty;
                @endphp
                @endforeach
            </div>
            <div class="card-footer">
                <h4>總價格: NT ${{ $total }}
                <button class="btn btn-outline-success float-end">結帳</button>
                </h4>
            </div>
        </div>
    </div>

@endsection