@extends('layouts.front')

@section('title',$products->name)


@section('content')

    <div class="py-3 mb-4 shadow-sm bg-waring border-top">
        <div class="container">
            <h6 class="mb-0">Collections / {{ $products->category->name }}/ {{ $products->name }} </h6>
        </div>
    </div>

    <div class="container">
        <div class="card shadow product_data">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <img src="{{ asset('assets/uploads/product/'.$products->image)}}">
                    </div>
                    <div class="col-md-8">
                        <h2 class="mb-0">
                            {{ $products->name }}
                            @if ($products->trending == '1')
                                <label style="font-size: 16px;" class="float-end badge bg-danger trending_tag">熱門</label>
                            @endif
                            
                        </h2>

                        <hr>
                        <label class="me-3">原價: <s>NT $ {{ $products->original_price}} </s></label>
                        <label class="fw-bold">特價: NT $ {{ $products->selling_price}}</label>
                        <p class="mt-3">
                            {!! $products->short_descripton !!}
                        </p>
                        <hr>
                        @if ($products->quantity>0)
                            <label class="badge bg-info">有貨</label>
                        @else
                            <label class="badge bg-danger">已售完</label>
                        @endif
                        <div class="row mt-2">
                            <div class="col-md-3">
                                <input type="hidden" value="{{ $products->id }}" class="prod_id">
                                <label for="Quantity">數量</label>
                                <div class="input-group text-center mb-3" style="width:130px">
                                    <span class="input-group-text decre-btn">-</span>
                                    <input type="text"  name="quan "value="1"  class="form-control qty-input text-center" />
                                    <span class="input-group-text incre-btn">+</span>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <br/>
                                <button type="button" class="btn btn-success me-3 float-start ">增加到希望清單</button>
                                <button type="button" class="btn btn-primary me-3 float-start addCartBtn">增加到購物車</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <hr>
                    <h3>商品描述</h3>
                    <p class="mt-3">
                        {!! $products->description !!}
                    </p>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function(){
            $('.addCartBtn').click(function(e){
                e.preventDefault();

                var product_id = $(this).closest('.product_data').find('.prod_id').val();
                var product_qty = $(this).closest('.product_data').find('.qty-input').val();


                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    method: "POST",
                    url: "/add-to-cart",
                    data: {
                        'product_id':product_id,
                        'product_qty':product_qty,
                    },
                    success: function(response){
                        swal(response.status);
                    }
                });
            });

            $('.incre-btn').click(function(e){
                e.preventDefault();

                var inc_value = $('.qty-input').val();
                var value = parseInt(inc_value,10);
                value = isNaN(value)? 0 : value;
                if(value<10){
                    value++;
                    $('.qty-input').val(value);
                }
            })

            $('.decre-btn').click(function(e){
                e.preventDefault();

                var inc_value = $('.qty-input').val();
                var value = parseInt(inc_value,10);
                value = isNaN(value)? 0 : value;
                if(value>1){
                    value--;
                    $('.qty-input').val(value);
                }
            })
        });

    </script>
@endsection