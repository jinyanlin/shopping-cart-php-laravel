@extends('layouts.front')
    
@section('title')
    Checkout
@endsection

@section('content')
<h1>確認訂單</h1>

<p>訂單號碼: {{ $order->id }}</p>
<p>總金額: {{ $order->total_price }}</p>
<p>收貨地址: {{ $order->address }}</p>
<p>聯繫電話: {{ $order->phone }}</p>

<form action="{{ route('ecpay.payment') }}" method="POST">
    @csrf
    <input type="hidden" name="order_id" value="{{ $order->id }}">
    <button type="submit">前往支付</button>
</form>

@endsection
