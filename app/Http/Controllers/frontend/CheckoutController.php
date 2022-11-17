<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\facades\Auth;

class CheckoutController extends Controller
{
    //
    public function index(){
        
        $old_cartitems = Cart::where('user_id', Auth::id())->get();
        //checkout quantity = 0;
        foreach ($old_cartitems as $item) {
            # code...
            /*if(!Product::where('id',$item->prod_id)->where('quantity','>=',$item->prod_qty)->exists()){
                $removeitem = Cart::where('user_id', Auth::id())->where('prod_id',$item->prod_id)->first();
                $removeitem->delete();
            }*/
           
        }
        $cartitems = Cart::where('user_id', Auth::id())->get();

        return view('frontend.checkout',compact('cartitems'));
    }

    public function placeorder(Request $request)
    {
        # code...
        $order = new Order();
        $order->user_id = Auth::id();
        $order->firstname = $request->input('firstname');
        $order->lastname = $request->input('lastname');
        $order->email = $request->input('email');
        $order->phone = $request->input('phone');
        $order->address = $request->input('address');
        $order->city = $request->input('city');
        $order->country = $request->input('country');
        $order->pincode = $request->input('pincode');
        
        

        //total
        $total = 0;
        $cartitems_total = Cart::where('user_id',Auth::id())->get();
        foreach ($cartitems_total as $prod) {
            # code...
            $total += ($prod->products->selling_price * $prod->prod_qty);
        }
        $order->total_price = $total;

        $order->tracking_no = 'jinyan'.rand(1111,9999);
        $order->save();

        $cartitems = Cart::where('user_id',Auth::id())->get();
        foreach ($cartitems as $item) {
            # code...
            OrderItem::create([
                'order_id' => $order->id,
                'prod_id' => $item->prod_id,
                'quantity' => $item->prod_qty,
                'price' => $item->products->selling_price,
            ]);

            $prod = Product::where('id',$item->prod_id)->first();
            $prod->quantity = $prod->quantity - $item->prod_qty;
            $prod->update();
        }
        
        //add that's user content after address is null 
        if (Auth::user()->address == NULL) {
            # code...
            $user = User::where('id',Auth::id())->first();
            $user->name = $request->input('firstname');
            $user->lastname = $request->input('lastname');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->address = $request->input('address');
            $user->city = $request->input('city');
            $user->country = $request->input('country');
            $user->pincode = $request->input('pincode');
            $user->update();
        }
        $cartitems = Cart::where('user_id', Auth::id())->get();
        Cart::destroy($cartitems);
        return redirect('/')->with('status',"您已下訂單");
    }
    
}
