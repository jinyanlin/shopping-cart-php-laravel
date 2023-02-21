@extends('layouts.front')

@section('title')
    MY Order
@endsection

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h2 class="text-white">購買詳細資料
                            <a href="{{ url('my-order') }}" class="btn btn-warning text-white float-end">Back</a>
                        </h2>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 order-detail">
                                <h2>個人資料</h2>
                                <hr>
                                <label for="">名稱</label>
                                <div class="border p-2">{{ $orders->firstname }}</div>
                                <label for="">姓氏</label>
                                <div class="border p-2">{{ $orders->lastname }}</div>
                                <label for="">電子郵件</label>
                                <div class="border p-2">{{ $orders->email }}</div>
                                <label for="">電話</label>
                                <div class="border p-2">{{ $orders->phone }}</div>
                                <label for="">地址</label>
                                <div class="border p-2">
                                    {{ $orders->address }} ,<br>
                                    {{ $orders->city }} ,<br>
                                    {{ $orders->country }}<br>
                                </div>
                                <label for="">Zip Code</label>
                                <div class="border p-2">{{ $orders->pincode }}</div>
                            </div>
                            <div class="col-md-6">
                                <h2>購買資訊</h2>
                                <hr>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>名稱</th>
                                            <th>數量</th>
                                            <th>價格</th>
                                            <th>圖片</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders->orderitems as $item)
                                            <tr>
                                                <td> {{ $item->products->name }}</td>
                                                <td> {{ $item->quantity }}</td>
                                                <td> {{ $item->price }}</td>
                                                <td>
                                                    <img src="{{ asset('assets/uploads/product/'.$item->products->image) }}" width="50px" height="50px" alt="Product image">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <h3 class="px-2">總價格:  <span class="float-end">NT ${{ $orders->total_price }} </span></h3>
                                <h3 class="px-2">支付方式:  <span class="float-end">{{ $orders->payment_mode }} </span></h3>
                            </div>
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
@endsection