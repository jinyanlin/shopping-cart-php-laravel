@extends('layouts.front')

@section('title')
    MY Order
@endsection

@section('content')
    <div class="container py-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>我的訂單</h2>
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
                                        <td> NT${{ $item->total_price }}</td>
                                        <td> 
                                            @if ($item->status == '0')
                                            <a href="javascript:return false;" class="btn btn-secondary"> 準備中 </a>
                                            @else
                                            <a href="javascript:return false;" class="btn btn-danger" > 已完成 </a>
                                            @endif
                                        <td>
                                            <a href="{{ url('view-order/'.$item->id) }}" class="btn btn-info"> 詳細內容 </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
@endsection