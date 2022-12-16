@extends('layouts.front')

@section('title')
    Category
@endsection

@section('content')
<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                <h2>全部項目</h2>
                    @foreach ($category as $cate)
                        <div class="col-md-4 mb-3">
                            <a href=" {{ url('category/'.$cate->slug ) }}">
                            <div class="card cate-image">
                                <img src="{{ asset('assets/uploads/category/'.$cate->image )}}"" alt="Category image">
                                <div class="card-body">
                                    <h2> {{ $cate->name }} </h2>
                                    <p>
                                        {{ $cate->description }}
                                    </p>
                                </div>
                            </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection