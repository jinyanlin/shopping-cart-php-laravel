<?php

namespace App\Http\Controllers\Frontend;
use Session;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\facades\Auth;
use Illuminate\Support\Facades\DB;
use ECPay_PaymentMethod as ECPayMethod;
use ECPay_AllInOne as ECPay;

// use TsaiYiHua\ECPay\Checkout;

class CheckoutController extends Controller
{
    //
    protected $checkout;

    // public function __construct(Checkout $checkout)
    // {
    //     $this->checkout = $checkout;
    //     $this->checkout->setReturnUrl(url('ec-order/callback'));
    // }

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

        return view('frontend.checkout1',compact('cartitems'));
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

        $order->payment_mode = $request->input('payment_mode');
        $order->payment_id = $request->input('payment_id');
        

        //total
        $total = 0;
        $cartitems_total = Cart::where('user_id',Auth::id())->get();
        foreach ($cartitems_total as $prod) {
            # code...
            $total += ($prod->products->selling_price * $prod->prod_qty);
        }
        $order->total_price = $total;

        $order->tracking_no = 'paypal'.rand(1111,9999);
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

        if($request->input('payment_mode') == 'Paid by Paypal'){
            return response()->json(['status'=>"您已使用Paypal下訂單"]);
        }
        return redirect('/')->with('status',"您已下訂單");
    }

    public function razorpaycheck(Request $request){

        $cartitems = Cart::where('user_id', Auth::id())->get();
        $total_price = 0;
        foreach ($cartitems as $item) {
            # code...
            $total_price += $item->products->selling_price * $item->prod_qty;
        }

        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $address = $request->input('address');
        $city = $request->input('city');
        $country = $request->input('country');
        $pincode = $request->input('pincode');

        return response()->json([
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'city' => $city,
            'country' => $country,
            'pincode' => $pincode,
            'total_price' => $total_price
        ]);
    }

    public function checkout(Request $request)
    {
        //DB::beginTransaction();
        try {
            // 1. 確認購物車是否有商品
            $cartItems = Cart::where('user_id', Auth::id())->get();
            if ($cartItems->isEmpty()) {
                return redirect()->route('cart.index')->with('error', '購物車為空，請選擇商品再進行結帳。');
            }

            // 2. 檢查是否已有相同的訂單（防止重複訂單）
            // $existingOrder = Order::where('user_id', Auth::id())
            //           ->where('payment_mode', '尚未付款')
            //           ->where('created_at', '<', now()->subMinutes(5)) // 只檢查 5 分鐘前的訂單
            //           ->exists();

            // if ($existingOrder) {
            //     //return redirect()->route('order.details', ['order_id' => $existingOrder->id])
            //     return redirect()->route('checkout')
            //                     ->with('error', '您已經有未付款的訂單，請先付款或取消該訂單。');
            // }
            // 3. 創建訂單但不馬上更新支付狀態
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
            $order->payment_mode = '尚未付款'; // 初始為尚未付款
            $order->total_price = 0;  // 先不設定 total_price
            $order->tracking_no = 'jin' . preg_replace('/[^a-zA-Z0-9]/', '', substr(time(), 0, 16));  // 確保只有數字和字母，長度不超過 20
            $order_trackno = $order->tracking_no;
            $order->save(); // 儲存訂單

            // 4. 計算總金額並創建訂單明細
            $total = 0;
            foreach ($cartItems as $item) {
                $total += $item->products->selling_price * $item->prod_qty;

                // 訂單明細
                OrderItem::create([
                    'order_id' => $order->id,
                    'prod_id' => $item->prod_id,
                    'quantity' => $item->prod_qty,
                    'price' => $item->products->selling_price,
                ]);

                // 更新商品庫存
                $prod = Product::find($item->prod_id);
                $prod->quantity -= $item->prod_qty;
                $prod->save();
            }

            // 更新訂單總金額
            $order->total_price = $total;
            $order->save(); // 儲存更新後的總金額

            //DB::commit(); 

            // 5. 導向付款頁面，傳遞訂單資訊
            return redirect()->route('ecpay.payment');
        } catch (Exception $e) {
            DB::rollBack(); 
            return redirect()->route('cart.index')->with('error', $e->getMessage());
        }
    }
    
    


    //綠界付完款轉址路由方法
    public function eccallback(Request $request)
    {
        $order = Order::where('tracking_no', $request('MerchantTradeNo'))->firstOrFail();
        if ($order){
            $order->status = !$order->status;
            //$order->total_price = $request('TradeAmt');
            $order->update();
            return response()->json(['status'=>'使用ECPAY，' .'訂單編號' . $order->payment_id . '付款成功']);
        }
        // Log::info('訂單編號' . $order->payment_id . '付款成功');
       
    }
    public function redirectfromec(Request $request){
        $request->session()->flash('success','order success');
        return redirect('/'); //返回首頁
    }
}
