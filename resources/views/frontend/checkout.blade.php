@extends('layouts.front')
    
@section('title')
    Checkout
@endsection

@section('content')
    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h6 class="mb-0">
                <a href="{{ url('/') }}">
                    Home 
                </a> /
                <a href="{{ url('checkout') }}">
                    Checkout
                </a> /
            </h6>
        </div>
    </div>
    <div class="container mt-5">
        <form action="{{ url('/ec-order')}}" method="POST">
        {{ csrf_field() }}
        @method('POST')
            <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <h3>Basic detail</h3>
                        <hr>
                        <div class="row check-form">
                            <div class="col-md-6">
                                <label for="">名稱</label>
                                <input type="text" name="firstname" value="{{ Auth::user()->name }}" 
                                 class="form-control firstname" placeholder="輸入名稱" required>
                                <span id="fname_error" class="text-danger"></span>
                            </div>
                            <div class="col-md-6">
                                <label for="">姓氏</label>
                                <input type="text" name="lastname" value="{{ Auth::user()->lastname }}" 
                                class="form-control lastname" placeholder="輸入姓氏" required>
                                <span id="lname_error" class="text-danger"></span>
                            </div> 
                            <div class="col-md-6 mt-3">
                                <label for="">信箱</label>
                                <input type="text" name="email" value="{{ Auth::user()->email }}" 
                                class="form-control email" placeholder="輸入信箱" readonly>
                                <span id="email_error" class="text-danger"></span>
                            </div> 
                            <div class="col-md-6 mt-3">
                                <label for="">電話號碼</label>
                                <input type="text" name="phone" value="{{ Auth::user()->phone }}" 
                                class="form-control phone" placeholder="輸入電話號碼" required>
                                <span id="phone_error" class="text-danger"></span>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">地址</label>
                                <input type="text" name="address" value="{{ Auth::user()->address }}" 
                                class="form-control address" placeholder="輸入地址" required>
                                <span id="address_error" class="text-danger"></span>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">城市</label>
                                <input type="text" name="city" value="{{ Auth::user()->city }}" 
                                class="form-control city" placeholder="輸入城市" required>
                                <span id="city_error" class="text-danger"></span>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">國家</label>
                                <input type="text" name="country" value="{{ Auth::user()->country }}" 
                                class="form-control country" placeholder="輸入國家" required>
                                <span id="country_error" class="text-danger"></span>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">邀請碼</label>
                                <input type="text" name="pincode" value="{{ Auth::user()->pincode }}" 
                                class="form-control pincode" placeholder="輸入邀請碼" readonly >
                                <span id="pincode_error" class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <h3>Order detail</h3>
                        <hr>
                        <table class="table table-striped table-bordered">
                            <thead>
                                <th>名稱</th>
                                <th>數量</th>
                                <th>價格</th>
                            </thead>
                            <tbody>
                                @php
                                     $total = 0;
                                @endphp
                                @foreach ($cartitems as $item)
                                <tr>
                                    @php
                                        $total += $item->products->selling_price * $item->prod_qty;
                                    @endphp
                                    <td>{{ $item->products->name }}</td>
                                    <td>{{ $item->prod_qty }}</td>
                                    <td>{{ $item->products->selling_price }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <br>
                        <h1 class="px-2">
                            總價格
                            <span class="float-end">NT $ {{ $total }}</span>
                        </h1>
                        <hr>
                        <input type="hidden" name="payment_mode" value="COD">
                        <button type="submit" class="btn btn-success w-100">下單</button>
                        {{-- <button type="button" class="btn btn-info opay_btn w-100 mt-3">歐付寶</button> --}}
                        {{-- <button type="button" class="btn btn-primary razorpay_btn w-100 mt-3 ">Pay with Razorpay</button> --}}
                        
                        <div id="paypal-button-container" class="paypal_btn"></div>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="https://www.paypal.com/sdk/js?client-id=AZt5KxxoIGV18ZX3jpnwx-_ak2CCsM0LHaWR95tE1B2CJvjkJdEq5PsE4pk1FCjqGjtasUfW_w6JSXDP&currency=TWD"></script>

    <script>
        const paypalButtonsComponent = paypal.Buttons({
            // optional styling for buttons
            // https://developer.paypal.com/docs/checkout/standard/customize/buttons-style-guide/
            style: {
              color: "gold",
              shape: "pill",
              layout: "vertical"
            },

            // set up the transaction
            createOrder: (data, actions) => {
                // pass in any options from the v2 orders create call:
                // https://developer.paypal.com/api/orders/v2/#orders-create-request-body
                const createOrderPayload = {
                    purchase_units: [
                        {
                            amount: {
                                value: '{{ $total }}'
                            }
                        }
                    ]
                };

                return actions.order.create(createOrderPayload);
            },

            // finalize the transaction
            onApprove: (data, actions) => {
                const captureOrderHandler = (details) => {
                    //const payerName = details.payer.name.given_name;
                    //console.log('Transaction completed');
                    const firstname = $('.firstname').val();
                    const lastname = $('.lastname').val();
                    const email = $('.email').val();
                    const phone = $('.phone').val();
                    const address = $('.address').val();
                    const city = $('.city').val();
                    const country = $('.country').val();
                    const pincode  = $('.pincode').val();
                    $.ajax({
                        method: "POST",
                        url: "/place-order",
                        data: {
                            'firstname': firstname,
                            'lastname': lastname,
                            'email': email,
                            'phone': phone,
                            'address': address,
                            'city': city,
                            'country': country,
                            'pincode': pincode,
                            'payment_mode':'Paid by Paypal',
                            'payment_id': details.id,
                        },
                        success: function (response){
                            swal(response.status)
                            windows.location.href = "/my-orders";
                        }
                    });
                };

                return actions.order.capture().then(captureOrderHandler);
            },

            // handle unrecoverable errors
            onError: (err) => {
                console.error('An error prevented the buyer from checking out with PayPal');
            }
        });

        paypalButtonsComponent
            .render("#paypal-button-container")
            .catch((err) => {
                console.error('PayPal Buttons failed to render');
            });
      </script>
   
    
@endsection
