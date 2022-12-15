@extends('layouts.front')

@section('title',$products->name)

@section('content')
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">對 {{$products->name}} 評價</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                    <form action="{{ url('/add-rating') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $products->id }}">
                        <div class="row">
                            <div class="col-sm-12">
                                <label for="recipient-name" class="col-form-label">幾顆星:</label>
                                <div class="row">
                                    <div class="col-8 col-sm-9">
                                        <div class="rate">
                                            <input type="radio" id="star5" name="product_rate" value="5" />
                                            <label for="star5" title="text">5 stars</label>
                                            <input type="radio" id="star4" name="product_rate" value="4" />
                                            <label for="star4" title="text">4 stars</label>
                                            <input type="radio" id="star3" name="product_rate" value="3" />
                                            <label for="star3" title="text">3 stars</label>
                                            <input type="radio" id="star2" name="product_rate" value="2" />
                                            <label for="star2" title="text">2 stars</label>
                                            <input type="radio" id="star1" name="product_rate" value="1" />
                                            <label for="star1" title="text">1 star</label><br>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="" class="col-form-label">評論:</label>
                            <textarea class="form-control" name="comment_text" placeholder="歡迎顧客回應產品使用狀況..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">送出</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h6 class="mb-0">
                <a href="{{ url('category') }}">
                目錄 
                </a> /
                <a href="{{ url('category/'.$products->category->slug )}}">
                    {{ $products->category->name }}
                </a>  /
                <b><a href="{{ url('category/'.$products->category->slug.'/'.$products->slug) }}">
                    {{ $products->name }}
                </a>  </b>
            </h6>
        </div>
    </div>

    <div class="container">
        <div class="card shadow product_data">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 prod-image">
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
                        @if ($products->original_price == $products->selling_price)
                            <label class="me-3">原價: NT $ {{ $products->original_price}} </label>
                        @else
                            <label class="me-3">原價: <s>NT $ {{ $products->original_price}} </s></label>
                            <label class="fw-bold">特價: NT $ {{ $products->selling_price}}</label>
                        @endif
                        
                        @php
                            $ratenum = number_format($ratings_value)
                        @endphp
                        <div class="rating">
                            @for ($i = 1; $i <= $ratenum; $i++)
                                <i class="fa fa-star checked"> </i>
                            @endfor
                            @for ($j = $ratenum+1; $i <= 5 ; $i++)
                                <i class="fa fa-star"> </i>
                            @endfor

                            <span>
                                @if ($ratings->count() >0)
                                {{ $ratings->count() }}則評論
                                @else
                                    沒有評論
                                @endif
                            </span>   
                        </div>
                        <p class="mt-3">
                            {!! $products->short_description !!}
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
                            <div class="col-md-9">
                                <br/>
                                <button type="button" class="btn btn-success me-3 float-start addToWishlist">加入希望清單</button>
                                @if ($products->quantity > '0')
                                    <button type="button" class="btn btn-primary me-3 float-start addCartBtn">加入到購物車</button>                
                                @endif
                                    
                                
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
        
            <div class="card text-center" style="width: ;">
                <div class="card-body">
                    
                    @if (!$user_rating)
                        <button type="button" class="btn btn-secondary btn-lg" data-bs-toggle="modal" data-bs-target="#exampleModal" ata-bs-whatever="@comment">
                            <i class="bi bi-chat-square-dots">按此評價</i>

                        </button><hr>
                    @else
                        <div class="row row-cols-1 row-cols-md-1 g-4">
                            <h5 class="card-title">您的評論：<p class="card-text">
                                @if ($user_rating)
                                        @for ($i = 1; $i <= $user_rating->stars_rate; $i++)
                                                <i class="fa fa-star checked"> </i>
                                            @endfor
                                            @for ($j = $ratenum+1; $i <= 5 ; $i++)
                                                <i class="fa fa-star"> </i>
                                        @endfor
                                        {{ $user_rating->comment_text }}
                            
                                @endif
                                    
                                </p>
                            </h5><br>
                        </div>
                    @endif
                    <br><h3 class="card-title">評論區： </h3>

                    @if ($ratings->count() >0)
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        @foreach ($ratings as $item)
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    @if ($item->count()>0)
                                        @for ($i = 1; $i <= $item->stars_rate; $i++)
                                            <i class="fa fa-star checked"> </i>
                                        @endfor
                                        @for ($j = $ratenum+1; $i <= 5 ; $i++)
                                            <i class="fa fa-star"> </i>
                                        @endfor
                                    @endif 
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title"></h5>
                                    <p class="card-text">
                                        @if ($item->comment_text)
                                            {{ $item->comment_text }}
                                        @else
                                            無
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
