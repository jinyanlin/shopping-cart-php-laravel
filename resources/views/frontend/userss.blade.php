@extends('layouts.front')

@section('content')
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
<link href="{{ asset('frontend/css/userprofile.css') }}" rel = "stylesheet">
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h2 class="modal-title" id="exampleModalLabel">編輯個人資料</h2>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
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
                        <input type="text" value="{{ $user->country }}" name="country" class="form-control mbsc-input" 
                        id="demo-country-picker" data-dropdown="true" data-input-style="box" data-label-style="stacked"
                          required>
                         
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
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>
  <div class="main-content">
    <!-- Top navbar -->
    
    <!-- Header -->
    <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="min-height: 600px; background-image: url(https://raw.githubusercontent.com/creativetimofficial/argon-dashboard/gh-pages/assets-old/img/theme/profile-cover.jpg); background-size: cover; background-position: center top;">
      <!-- Mask -->
      <span class="mask bg-gradient-default opacity-8"></span>
      <!-- Header container -->
      <div class="container-fluid d-flex align-items-center">
        <div class="row">
          <div class="col-lg-7 col-md-10">
            <h1 class="display-2 text-white">Hello {{ $user->name }}</h1>
            <p class="text-white mt-0 mb-5">This is your profile page. You can see the progress you've made with your work and manage your projects or assigned tasks</p>
             <a href="{{ url('my-order')}}" class="btn btn-danger">我的訂單</a> 
             
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--7">
      <div class="row">
        <div class="col-xl-4 order-xl-2 mb-5 mb-xl-0">
          <div class="card card-profile shadow">
            <div class="row justify-content-center">
              <div class="col-lg-3 order-lg-2">
                <div class="card-profile-image">
                  <a href="#">
                    <img src="https://static.fotor.com.cn/assets/stickers/18531/77a12b1f-90d4-41ff-92d3-e134a081e18c_medium_thumb.jpg" class="rounded-circle">
                  </a>
                </div>
              </div>
            </div>
            <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
              <div class="d-flex justify-content-between">
                <a href="#" class="btn btn-sm btn-info mr-4">
                    @php
                        if($user->role_as == '1'){
                            echo 'ADMIN';
                        }
                        else{
                            echo 'Customer';
                        }
                    @endphp
                </a>
                <a href="#" class="btn btn-sm btn-default float-right">Message</a>
              </div>
            </div>
            <div class="card-body pt-0 pt-md-4">
              <div class="row">
                <div class="col">
                  <div class="card-profile-stats d-flex justify-content-center mt-md-5">
                    <div>
                      <span class="heading">22</span>
                      <span class="description">Friends</span>
                    </div>
                    <div>
                      <span class="heading">10</span>
                      <span class="description">Photos</span>
                    </div>
                    <div>
                      <span class="heading">89</span>
                      <span class="description">Comments</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="text-center">
                <h3>
                  {{ $user->name .' '. $user->lastname}}<span class="font-weight-light">, 27</span>
                </h3>
                <div class="h5 font-weight-300">
                  <i class="ni location_pin mr-2"></i>Bucharest, Romania
                </div>
                <div class="h5 mt-4">
                  <i class="ni business_briefcase-24 mr-2"></i>Solution Manager - Creative Tim Officer
                </div>
                <div>
                  <i class="ni education_hat mr-2"></i>University of Computer Science
                </div>
                <hr class="my-4">
                
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-8 order-xl-1">
          <div class="card bg-secondary shadow">
            <div class="card-header bg-white border-0">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">My account</h3>
                </div>
                <div class="col-4 text-right">
                  <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    編輯個人檔案
                </button>
                </div>
              </div>
            </div>
            <div class="card-body">
                <form action="{{ url('edit-user') }}" method="POST" enctype="multipart/form-data">   
                    @csrf
                    <h6 class="heading-small text-muted mb-4">User information</h6>
                    <div class="pl-lg-4">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group focused">
                                <label class="form-control-label" for="input-username">Username</label>
                                <input type="text" id="input-username" class="form-control form-control-alternative" 
                                placeholder="Username" value="" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="input-email">Email address</label>
                                <input type="email" id="input-email" 
                                class="form-control form-control-alternative" value="{{ $user->email }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group focused">
                                <label class="form-control-label" for="input-first-name">First name</label>
                                <input type="text" id="input-first-name" name="name" readonly
                                class="form-control form-control-alternative" placeholder="First name" value="{{ $user->name }}" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group focused">
                                <label class="form-control-label" for="input-last-name">Last name</label>
                                <input type="text" id="input-last-name" name="lastname" readonly
                                class="form-control form-control-alternative" placeholder="Last name" value="{{ $user->lastname }}" required>
                            </div>
                        </div>
                    </div>
                    </div>
                    <hr class="my-4">
                    <!-- Address -->
                    <h6 class="heading-small text-muted mb-4">Contact information</h6>
                    <div class="pl-lg-4">
                    <div class="row">
                        <div class="col-md-6">
                        <div class="form-group focused">
                            <label class="form-control-label" for="input-address">Address</label>
                            <input id="input-address" class="form-control form-control-alternative" readonly
                            placeholder="Home Address" value="{{ $user->address }}" type="text" name="address" required>
                        </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group focused">
                                <label class="form-control-label" for="input-address">Phone</label>
                                <input id="input-address" class="form-control form-control-alternative" name="phone" readonly
                                placeholder="Home Address" value="{{ $user->phone }}" type="text" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                        <div class="form-group focused">
                            <label class="form-control-label" for="input-city">City</label>
                            <input type="text" id="input-city" class="form-control form-control-alternative" name="city" readonly
                            placeholder="City" value="{{ $user->city }}" required>
                        </div>
                        </div>
                        <div class="col-lg-4">
                        <div class="form-group focused">
                            <label class="form-control-label" for="input-country">Country</label>
                            <input type="text" id="input-country" class="form-control form-control-alternative" name="country" readonly
                            placeholder="Country" value="{{ $user->country }}" required>
                        </div>
                        </div>
                        <div class="col-lg-4">
                        <div class="form-group">
                            <label class="form-control-label" for="input-country">Pin code</label>
                            <input type="number" id="input-postal-code" class="form-control form-control-alternative" 
                            placeholder="Postal code" value="{{ $user->pincode }}" readonly>
                        </div>
                        </div>
                    </div>
                    </div>
                    <hr class="my-4">
                    <!-- Description -->
                    <h6 class="heading-small text-muted mb-4">About me</h6>
                    <div class="pl-lg-4">
                    <div class="form-group focused">
                        <label>About Me</label>
                        <textarea rows="4" class="form-control form-control-alternative" placeholder="A few words about you ...">A beautiful Dashboard for Bootstrap 4. It is Free and Open Source.</textarea>
                    </div>
                    </div>
                    <div class="col-md-12">
                        {{-- <button type="submit" class="btn btn-primary">送出更改</button> --}}
                        
                    </div>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  

@endsection 

@section('scripts')
    <script>
    mobiscroll.setOptions({
        theme: 'ios',
        themeVariant: 'light'
    });

    $(function () {
        var inst = $('#demo-country-picker').mobiscroll().select({
            display: 'anchored',
            filter: true,
            itemHeight: 40,
            renderItem: function (item) {
                return '<div class="md-country-picker-item">' +
                    '<img class="md-country-picker-flag" src="https://img.mobiscroll.com/demos/flags/' + item.data.value + '.png" />' +
                    item.display + '</div>';
            }
        }).mobiscroll('getInst');

        $.getJSON('https://trial.mobiscroll.com/content/countries.json', function (resp) {
            var countries = [];
            for (var i = 0; i < resp.length; ++i) {
                var country = resp[i];
                countries.push({ text: country.text, value: country.value });
            }
            inst.setOptions({ data: countries });
        });
    });
    </script>
@endsection