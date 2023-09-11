@extends('layouts.admin')

@section('content')
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Product Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form wire:submit>
                    <div class="modal-body">
                        <h4>您是否要刪除這筆資料?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">關閉</button>
                        <button type="button" class="btn btn-primary delete-product">是，我要刪除</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
                        <div class="row product_admindata">
                            <input type="hidden" class="prod_id" value=" {{ $item->id }}">
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
                                        <a href="{{ url('admin/edit-product/'.$item->id) }}" class="btn btn-primary"> 編輯  </a>
                                        {{-- <a href="#" data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn btn-danger"> 刪除 </a> --}}
                                        {{-- {{ url('admin/delete-product/'.$item->id) }} --}}
                                        <a href="{{ url('admin/delete-product/'.$item->id) }}"class="btn btn-danger"> 刪除  </a>
                                    </td>
                                </tr>
                        </div>
                        @endforeach
                    </tbody>
                </thead>
            </table>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-5">

                    </div>
                    <div class="col-md-5">
                        <br>
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
@endsection