@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>增加產品 | ADD Product</h4>
        </div>
        <div class="card-body">
            <!--enctype: form-data encode before transfer to server for image fields -->
            <form action="{{ url('admin/insert-product') }}" method="POST" enctype="multipart/form-data">   
                @csrf
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <select class="form-select" name="category_id" >
                            <option value="">選擇一個產品類別</option>
                            @foreach ($category as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                         
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">產品名稱</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">品牌/廠牌</label>
                        <input type="text" class="form-control" name="slug">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">商品簡述</label>
                        <textarea name="short_description" rows="3" class="form-control"></textarea>
                    </div>
                    <!--<div class="col-md-12 mb-3">
                        <label for="">產品描述</label>
                        <textarea name="description" rows="3" class="form-control"></textarea>
                    </div> -->

                    <div class="col-md-6 mb-3">
                        <label for="">金額</label>
                        <input type="number" name="original_price" class="form-control" >
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">特價</label>
                        <input type="number" name="selling_price" class="form-control" >
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">稅金</label>
                        <input type="number" name="tax" class="form-control" >
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">數量</label>
                        <input type="number" name="quantity" class="form-control" >
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">產品狀態</label>
                        <input type="checkbox" name="status">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">熱門</label>
                        <input type="checkbox"  name="popular">
                    </div>
                    <div class="col-md-12">
                        <label for="">Meta Title</label>
                        <input type="text" class="form-control" name="meta_title">
                    </div>
                    <div class="col-md-6">
                        <label for="">關鍵字</label>
                        <textarea name="meta_keywords" rows="3" class="form-control"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label for="">商品描述</label>
                        <textarea name="description" rows="3" class="form-control"></textarea>
                    </div>
                    <div class="col-md-12">
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="col-md-12 mb-3">
                        <button type="submit" class="btn btn-primary float-end">送出 </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection