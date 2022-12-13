<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use App\Models\Rating;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    //
    public function add(Request $request)
    {
        # code...
        $stars_rate = $request->input('product_rate');
        $product_id = $request->input('product_id');

        $product_check = Product::where('id', $product_id)->where('status','1')->first();
        if($product_check){
            $verified_purchase = Order::where('orders.user_id', Auth::id())
            ->join('order_items','orders.id','order_items.order_id')
            ->where('order_items.prod_id', $product_id)->get();

            if($verified_purchase){
                $exist_rating = Rating::where('user_id', Auth::id())->where('prod_id' , $product_id)->first();
                if($exist_rating){
                    $exist_rating->stars_rate = $$exist_rating;
                    $exist_rating->update();
                }else{
                    if(Auth::id()){
                        Rating::create([
                            'user_id' => Auth::id(),
                            'prod_id' => $product_id,
                            'stars_rate' => $stars_rate
                        ]);
                    }else{
                        return redirect('login')->with('status','請登入帳號');
                    }
                    
                }
                return redirect()->back()->with('status','Thank You for Rating this product');
            }else{
                return redirect()->back()->with('status','You can not rate this product without purchase');
            }
        }else{
            return redirect()->back()->with('status','The link you followed was broken');
        }
    }
}
