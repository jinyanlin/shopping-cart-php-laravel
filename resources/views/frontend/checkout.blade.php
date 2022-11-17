@extends('layouts.front')
    
@section('title')
    Checkout
@endsection

@section('content')
    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h6 class="mb-0">
                <a href="{{ url('/') }}">
                    Home 
                </a> /
                <a href="{{ url('checkout') }}">
                    Checkout
                </a> /
            </h6>
        </div>
    </div>
    <div class="container mt-5">
        <form action="{{ url('place-order')}}" method="POST">
        {{ csrf_field() }}
        @method('POST')
            <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <h3>Basic detail</h3>
                        <hr>
                        <div class="row check-form">
                            <div class="col-md-6">
                                <label for="">名稱</label>
                                <input type="text" name="firstname" value="{{ Auth::user()->name }}" class="form-control" placeholder="輸入名稱">
                            </div>
                            <div class="col-md-6">
                                <label for="">姓氏</label>
                                <input type="text" name="lastname" value="{{ Auth::user()->lastname }}" class="form-control" placeholder="輸入姓氏">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">信箱</label>
                                <input type="text" name="email" value="{{ Auth::user()->email }}" class="form-control" placeholder="輸入信箱">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">電話號碼</label>
                                <input type="text" name="phone" value="{{ Auth::user()->phone }}" class="form-control" placeholder="輸入電話號碼">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">地址</label>
                                <input type="text" name="address" value="{{ Auth::user()->address }}" class="form-control" placeholder="輸入地址">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">城市</label>
                                <input type="text" name="city" value="{{ Auth::user()->city }}" class="form-control" placeholder="輸入城市">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">國家</label>
                                <input type="text" name="country" value="{{ Auth::user()->country }}" class="form-control" placeholder="輸入國家">
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">邀請碼</label>
                                <input type="text" name="pincode" value="{{ Auth::user()->pincode }}" class="form-control" placeholder="輸入邀請碼">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <h3>Order detail</h3>
                        <hr>
                        <table class="table table-striped table-bordered">
                            <thead>
                                <th>名稱</th>
                                <th>數量</th>
                                <th>價格</th>
                            </thead>
                            <tbody>
                                @foreach ($cartitems as $item)
                                <tr>
                                    <td>{{ $item->products->name }}</td>
                                    <td>{{ $item->prod_qty }}</td>
                                    <td>{{ $item->products->selling_price }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <hr>
                        <button type="submit" class="btn btn-primary w-100">下單</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
@endsection

