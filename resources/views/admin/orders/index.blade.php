@extends('layouts.admin')

@section('title')
    Orders
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h2 class="text-white "> 訂單
                        <a href="{{ 'order-history' }}" class="btn btn-warning  float-right">歷史訂單</a>
                    </h2>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>下訂時間</th>
                                <th>Tracking Number</th>
                                <th>總價</th>
                                <th>狀態</th>
                                <th>詳情</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $item)
                                <tr>
                                    <td> {{ date('Y-m-d',strtotime($item->created_at)) }}</td>
                                    <td> {{ $item->tracking_no }}</td>
                                    <td> {{ $item->total_price }}</td>
                                    <td> {{ $item->status == '0' ? '準備中' : '完成' }}</td>
                                    <td>
                                        <a href="{{ url('admin/view-order/'.$item->id) }}" class="btn btn-primary"> 詳細內容 </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-5">
    
                        </div>
                        <div class="col-md-5">
                            <br>
                            {{$orders->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection