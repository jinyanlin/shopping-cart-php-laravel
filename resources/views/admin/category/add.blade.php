@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>增加類別 | ADD Category'</h4>
        </div>
        <div class="card-body">
            <!--enctype: form-data encode before transfer to server for image fields -->
            <form action="{{ url('admin/insert-category') }}" method="POST" enctype="multipart/form-data">   
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="">類別名稱</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">品牌/廠牌</label>
                        <input type="text" class="form-control" name="slug">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">類別描述</label>
                        <textarea name="description" rows="3" class="form-control"></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">類別狀態</label>
                        <input type="checkbox" name="status">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">熱門</label>
                        <input type="checkbox"  name="popular">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Meta Title</label>
                        <input type="text" class="form-control" name="meta_title">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="">Meta Keywords</label>
                        <textarea name="meta_keywords" rows="3" class="form-control"></textarea>
                    </div>
                    <div class="col-md-12">
                        <label for="">Meta Description</label>
                        <textarea name="meta_descript" rows="3" class="form-control"></textarea>
                    </div>
                    <div class="col-md-12">
                        <input type="file" name="image" class="form-control">
                    </div>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary float-end">送出 </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection