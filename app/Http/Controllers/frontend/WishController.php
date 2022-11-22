<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Wishlist;
use App\Models\Product;

class WishController extends Controller
{
    //
    public function index(){
        $wishlist = Wishlist::where('user_id', Auth::id())->get();
        return view('frontend.wishlist',compact('wishlist'));
    }

    public function add(Request $request)
    {
        # code...
        if(Auth::check()){
            $prod_id = $request->input('product_id');
            if(Product::find($prod_id)){
                $wish = new Wishlist();
                $wish->prod_id =  $prod_id;
                $wish->user_id = Auth::id();
                $wish->save();
                return response()->json(['status' => "商品已加入至購物清單。"]);
            }else{
                return response()->json(['status' =>  " 商品不存在。"]);
            }
        }
        else{
            return response()->json(['status' => "請登入帳號"]);
        }
    }

    public function deletewishlist(Request $request){
        if(Auth::check()){
            $prod_id = $request->input('prod_id');
            if(Wishlist::where('prod_id',$prod_id)->where('user_id',Auth::id())->exists()){
                $wish = Wishlist::where('prod_id',$prod_id)->where('user_id',Auth::id())->first();
                $wish->delete();
                return response()->json(['status' => "您所選的產品已從希望清單移除"]);
            }
        }else{
            return response()->json(['status' => "請登入帳號"]);
        }
    }

    public function wishcount(){
        $wishcount = Wishlist::where('user_id', Auth::id())->count();
        return response()->json(['count' => $wishcount]);
    }
}
