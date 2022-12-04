@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <H4>產品清單 | Product</H4>
        </div>
        <div class="card-body">
            <table class="table  table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Original Price</th>
                        <th>Selling Price</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                    <tbody>
                        @foreach ($products as $item)
                            <tr>
                                <td> {{ $item->id }} </td>
                                <td> {{ $item->category->name }} </td>
                                <td> {{ $item->name }} </td>
                                <td> {{ $item->short_description }} </td>
                                <td> {{ $item->original_price }} </td>
                                <td> {{ $item->selling_price }} </td>
                                <td> 
                                    <img src="{{ asset('assets/uploads/product/'.$item->image)}}" class="cate-image" alt="Image here"> 
                                </td>
                                <td> 
                                    <a href="{{ url('edit-product/'.$item->id) }}" class="btn btn-primary"> 編輯  </a>
                                    <a href="{{ url('delete-product/'.$item->id) }}" class="btn btn-danger"> 刪除 </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </thead>
            </table>
        </div>
@endsection