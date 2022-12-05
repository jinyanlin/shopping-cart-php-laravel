@extends('layouts.front')

@section('content')
    <div class="card">
        <div class="br"><br></div>
        <div class="card-header">
            <div class="edit">
                <h3>編輯個人檔案</h3>
            </div>
            
        </div>
        <div class="card-body">
            <!--enctype: form-data encode before transfer to server for image fields -->
            <form action="{{ url('edit-user') }}" method="POST" enctype="multipart/form-data">   
                @csrf
               
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="">firstname</label>
                        <input type="text" value="{{ $user->name }}" class="form-control" name="name" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">lastname</label>
                        <input type="text" value="{{ $user->lastname }}" class="form-control" name="lastname" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">email</label>
                        <input type="text" value="{{ $user->email }}" class="form-control" name="email" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">phone</label>
                        <input type="text" value="{{ $user->phone }}" class="form-control" name="phone" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="">address</label>
                        <input type="address" value="{{ $user->address }}" name="address" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">city</label>
                        <input type="text" value="{{ $user->city }}" name="city" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">country</label>
                        <input type="text" value="{{ $user->country }}" name="country" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">pincode</label>
                        <input type="number" value="{{ $user->pincode }}" name="pincode" class="form-control" readonly>
                    </div>
                    
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">送出更改</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection