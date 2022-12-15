@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <H2>已註冊 | User
                            <a href="{{ url('admin/users') }}" class="btn btn-primary float-right">Back</a>
                        </H2>
                    </div>
                    <hr>
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-4">
                            <label for="">職位</label>
                            <div class="p-2 border mt-3">{{ $users->role_as =='0'? 'users':'Admin' }}</div>
                        </div>

                        <div class="col-md-4">
                            <label for="">名稱</label>
                            <div class="p-2 border mt-3">{{ $users->name}}</div>
                        </div>
                        <div class="col-md-4">
                            <label for="">姓氏</label>
                            <div class="p-2 border mt-3">{{ $users->lastname}}</div>
                        </div>
                        <div class="col-md-4">
                            <label for="">信箱</label>
                            <div class="p-2 border mt-3">{{ $users->email}}</div>
                        </div>

                        <div class="col-md-4">
                            <label for="">電話</label>
                            <div class="p-2 border mt-3">{{ $users->phone}}</div>
                        </div>
                        <div class="col-md-4">
                            <label for="">地址</label>
                            <div class="p-2 border mt-3">{{ $users->address}}</div>
                        </div>
                        <div class="col-md-4">
                            <label for="">城市</label>
                            <div class="p-2 border mt-3">{{ $users->city}}</div>
                        </div>

                        <div class="col-md-4">
                            <label for="">國家</label>
                            <div class="p-2 border mt-3">{{ $users->country}}</div>
                        </div>
                        <div class="col-md-4">
                            <label for="">邀請碼</label>
                            <div class="p-2 border mt-3">{{ $users->pincode}}</div>
                        </div>
                        

                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection