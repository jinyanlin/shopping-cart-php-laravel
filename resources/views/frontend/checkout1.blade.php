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
<div class="container-fluid py-5">
    <div class="container py-5">
        <h1 class="mb-4">Billing details</h1>
        <form action="{{ url('/ec-order')}}" method="POST">
            {{ csrf_field() }}
            @method('POST')
            <div class="row g-5">
                <div class="col-md-12 col-lg-6 col-xl-7">
                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <div class="form-item w-100">
                                <label class="form-label my-3">First Name<sup>*</sup></label>
                                <input type="text" class="form-control"name="firstname" value= "{{ Auth::user()->name }}">
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-6">
                            <div class="form-item w-100">
                                <label class="form-label my-3">Last Name<sup>*</sup></label>
                                <input type="text" class="form-control" name="lastname" value= "{{ Auth::user()->lastname }}">
                            </div>
                        </div>
                    </div>
                
                    {{-- <div class="form-item">
                        <label class="form-label my-3">Company Name<sup>*</sup></label>
                        <input type="text" class="form-control">
                    </div> --}}
                    <div class="form-item">
                        <label class="form-label my-3">Address <sup>*</sup></label>
                        {{-- <select data-role="county" ></select>
                        <select data-role="district"></select>
                        <input type="hidden" data-role="zipcode" /> --}}
                        <input type="text" class="form-control" placeholder="House Number Street Name" name="address" value= "{{ Auth::user()->address }}">
                    </div>
                    {{-- <div id="twzipcode">
                        <div data-role="zipcode" data-style="addr-zip" data-name="元素名稱" data-value="預設值"></div>
                        <div data-role="county" data-style="addr-county" data-name="元素名稱" data-value="預設值"></div>
                        <div data-role="district" data-style="addr-district" data-name="元素名稱" data-value="預設值"></div>
                      </div> --}}
                    <div class="form-item">
                        <label class="form-label my-3">Town/City<sup>*</sup></label>
                        <input type="text" class="form-control" name="city" value= "{{ Auth::user()->city }}">
                    </div>
                    <div class="form-item">
                        <label class="form-label my-3">Country<sup>*</sup></label>
                       {{--  <select data-role="county" placeholder="請選擇縣市" value= "{{ Auth::user()->country }}"></select> --}}
                        <input type="text" class="form-control" name="country" value= "{{ Auth::user()->country }}">
                    </div>
                    <div class="form-item">
                        <label class="form-label my-3">Postcode/Zip<sup>*</sup></label>
                       {{--  <input class="js-demeter-tw-zipcode-selector" data-city="#city" data-dist="#dist" placeholder="請輸入郵遞區號" 
                        value= "{{ Auth::user()->pincode }}"/> --}}
                        <input type="text" class="form-control" name="pincode" value= "{{ Auth::user()->pincode }}">
                    </div>
                    <div class="form-item">
                        <label class="form-label my-3">Mobile<sup>*</sup></label>
                        <input type="tel" class="form-control" name="phone" value= "{{ Auth::user()->phone }}">
                    </div>
                    <div class="form-item">
                        <label class="form-label my-3">Email Address<sup>*</sup></label>
                        <input type="email" class="form-control" name="email" value= "{{ Auth::user()->email }}">
                    </div>
                    {{-- <div class="form-check my-3">
                        <input type="checkbox" class="form-check-input" id="Account-1" name="Accounts" value="Accounts">
                        <label class="form-check-label" for="Account-1">Create an account?</label>
                    </div> --}}
                    <hr>
                    {{-- <div class="form-check my-3">
                        <input class="form-check-input" type="checkbox" id="Address-1" name="Address" value="Address">
                        <label class="form-check-label" for="Address-1">Ship to a different address?</label>
                    </div>
                    <div class="form-item">
                        <textarea name="text" class="form-control" spellcheck="false" cols="30" rows="11" placeholder="Oreder Notes (Optional)"></textarea>
                    </div> --}}
                </div>
                <div class="col-md-12 col-lg-6 col-xl-5">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Products</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                </tr>
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
                                    <th scope="row">
                                        <div class="d-flex align-items-center mt-2">
                                            <img src="{{ asset('assets/uploads/product/'.$item->products->image)}}" class="img-fluid rounded-circle" style="width: 90px; height: 90px;" alt="">
                                        </div>
                                    </th>
                                    <td class="py-5">{{ $item->products->name }}</td>
                                    <td class="py-5">{{ $item->products->selling_price }}</td>
                                    <td class="py-5">{{ $item->prod_qty }}</td>
                                    <td class="py-5">${{ $item->prod_qty * $item->products->selling_price}}</td>
                                </tr>
                                @endforeach
                               {{--  <tr>
                                    <th scope="row">
                                    </th>
                                    <td class="py-5"></td>
                                    <td class="py-5"></td>
                                    <td class="py-5">
                                        <p class="mb-0 text-dark py-3">Subtotal</p>
                                    </td>
                                    <td class="py-5">
                                        <div class="py-3 border-bottom border-top">
                                            <p class="mb-0 text-dark">$414.00</p>
                                        </div>
                                    </td>
                                </tr> --}}
                              {{--   <tr>
                                    <th scope="row">
                                    </th>
                                    <td class="py-5">
                                        <p class="mb-0 text-dark py-4">Shipping</p>
                                    </td>
                                    <td colspan="3" class="py-5">
                                        <div class="form-check text-start">
                                            <input type="checkbox" class="form-check-input bg-primary border-0" id="Shipping-1" name="Shipping-1" value="Shipping">
                                            <label class="form-check-label" for="Shipping-1">Free Shipping</label>
                                        </div>
                                        <div class="form-check text-start">
                                            <input type="checkbox" class="form-check-input bg-primary border-0" id="Shipping-2" name="Shipping-1" value="Shipping">
                                            <label class="form-check-label" for="Shipping-2">Flat rate: $15.00</label>
                                        </div>
                                        <div class="form-check text-start">
                                            <input type="checkbox" class="form-check-input bg-primary border-0" id="Shipping-3" name="Shipping-1" value="Shipping">
                                            <label class="form-check-label" for="Shipping-3">Local Pickup: $8.00</label>
                                        </div>
                                    </td>
                                </tr> --}}
                                <tr>
                                    <th scope="row">
                                    </th>
                                    <td class="py-5">
                                        <p class="mb-0 text-dark text-uppercase py-3">TOTAL: NT $</p>
                                    </td>
                                    <td class="py-5"></td>
                                    <td class="py-5"></td>
                                    <td class="py-5">
                                        <div class="py-3 border-bottom border-top">
                                            <p class="mb-0 text-dark"> {{ $total }}</p>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                  
                    {{-- <div class="row g-4 text-center align-items-center justify-content-center border-bottom py-3">
                        <div class="col-12">
                            <div class="form-check text-start my-3">
                                <input type="checkbox" class="form-check-input bg-primary border-0" id="Paypal-1" name="Paypal" value="Paypal">
                                <label class="form-check-label" for="Paypal-1">Paypal</label>
                            </div>
                        </div>
                    </div> --}}
                    <div class="row g-4 text-center align-items-center justify-content-center pt-4">
                        <button type="submit" class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary">Place Order</button>
                    </div>
                    <hr>
                    <div id="paypal-button-container" class="paypal_btn"></div>
                </div>
            </div>
        </form>
    </div>
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
