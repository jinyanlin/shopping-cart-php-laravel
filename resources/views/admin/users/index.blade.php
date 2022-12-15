@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            <H2>已註冊 | User</H2>
        </div>
        <hr>
        <div class="card-body">
            <table class="table  table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Action</th>
                    </tr>
                    <tbody>
                        @foreach ($users as $item)
                            <tr>
                                <td> {{ $item->id }} </td>
                                <td> {{ $item->name.' '.$item->lastname}} </td>
                                <td> {{ $item->email }} </td>
                                <td> {{ $item->phone }} </td>
                                <td> 
                                    <a href="{{ url('admin/view-users/'.$item->id) }}" class="btn btn-primary"> 查看  </a>
                                   <!--<a href="{{ url('admin/edit-users/'.$item->id) }}" class="btn btn-primary"> 編輯  </a>
                                    <a href="{{ url('admin/delete-users/'.$item->id) }}" class="btn btn-danger"> 刪除 </a> 
                                -->
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </thead>
            </table>
        </div>
@endsection