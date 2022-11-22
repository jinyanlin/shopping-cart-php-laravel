<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //
    public function addProduct(Request $request){
        $product_id = $request->input('product_id');
        $product_qty = $request->input('product_qty');

        if(Auth::check()){

            $prod_check = Product::where('id',$product_id)->first();

            if($prod_check){
                if(Cart::where('prod_id',$product_id)->where('user_id',Auth::id())->exists()){
                    return response()->json(['status' => $prod_check->name. "您已加入到購物車"]);
                }
                else{
                    $cartItem = new Cart();
                    $cartItem->prod_id = $product_id;
                    $cartItem->user_id = Auth::id();
                    $cartItem->prod_qty = $product_qty;
                    $cartItem->save();
                    return response()->json(['status' => $prod_check->name. " 已加入了購物車。"]);
                }
            }
        }else{
            return response()->json(['status' => "請登入帳號"]);
        }
    }

    public function viewcart(){
        $cartitems = Cart::where('user_id',Auth::id())->get();
        return view('frontend.cart',compact('cartitems'));
    }

    public function updateproduct(Request $request){
        $prod_id = $request->input('prod_id');
        $product_qty = $request->input('prod_qty');
        if(Auth::check()){

            if(Cart::where('prod_id',$prod_id)->where('user_id',Auth::id())->exists()){
                $cart = Cart::where('prod_id',$prod_id)->where('user_id',Auth::id())->first();
                $cart->prod_qty = $product_qty;
                $cart->update();
                return response()->json(['status' => "您已更改數量"]);
            }
        }
    }

    public function deleteproduct(Request $request){
        if(Auth::check()){
            $prod_id = $request->input('prod_id');
            if(Cart::where('prod_id',$prod_id)->where('user_id',Auth::id())->exists()){
                $cartItem = Cart::where('prod_id',$prod_id)->where('user_id',Auth::id())->first();
                $cartItem->delete();
                return response()->json(['status' => "您所選的產品已被刪除成功"]);
            }
        }else{
            return response()->json(['status' => "請登入帳號"]);
        }
        
    }

    public function cartcount(){
        $cartcount = Cart::where('user_id', Auth::id())->count();
        return response()->json(['count' => $cartcount]);
    }
}
