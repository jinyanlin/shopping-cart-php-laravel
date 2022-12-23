@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>修改產品 | Edit Product</h4>
        </div>
        <div class="card-body">
            <!--enctype: form-data encode before transfer to server for image fields -->
            <form action="{{ url('admin/update-product/'.$products->id) }}" method="POST" enctype="multipart/form-data">   
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="">類別名稱</label>
                        <select class="form-select">
                            <option value=""> {{ $products->category->name }} </option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">產品名稱</label>
                        <input type="text" value="{{ $products->name }}" class="form-control" name="name">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">品牌/廠牌</label>
                        <input type="text" value="{{ $products->slug }}" class="form-control" name="slug">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">商品簡述</label>
                        <textarea name="short_description" rows="3" class="form-control">{{ $products->short_description }}</textarea>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">金額</label>
                        <input type="number" value="{{ $products->original_price }}" name="original_price" class="form-control" >
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">特價</label>
                        <input type="number" value="{{ $products->selling_price }}" name="selling_price" class="form-control" >
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">稅金</label>
                        <input type="number" value="{{ $products->tax }}" name="tax" class="form-control" >
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">數量</label>
                        <input type="number" value="{{ $products->quantity }}" name="quantity" class="form-control" >
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="">產品狀態</label>
                        <input type="checkbox" {{ $products->status == "1" ? 'checked':'' }} name="status">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">熱門</label>
                        <input type="checkbox" {{ $products->trending == "1" ? 'checked':'' }} name="trending">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Meta Title</label>
                        <input type="text" value="{{ $products->meta_title }}" class="form-control" name="meta_title">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">關鍵字</label>
                        <textarea name="meta_keywords" rows="3" class="form-control">{{ $products->meta_keywords }}</textarea>
                    </div>
                    <div class="col-md-12">
                        <label for="">商品描述</label>
                        <textarea name="description" rows="3" class="form-control">{{ $products->description}}</textarea>
                    </div>
                    @if($products->image)
                        <div class="edit-prod">
                            <img src="{{ asset('assets/uploads/product/'.$products->image) }}" alt="Category">
                        </div>   
                    @endif
                    <div class="col-md-12">
                        <input type="file"  name="image" class="form-control">
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary float-end">送出更改</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection