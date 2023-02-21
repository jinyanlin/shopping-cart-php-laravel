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

    public function checkout(Request $request){
        //建立訂單&明細
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

        $order->tracking_no = 'jin'.time() ;;
        $order_trackno = $order->tracking_no;
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
        

       
        //串接綠界金流做付款
        
        try {
            include('ECPay.Payment.Integration.php');
            $obj = new ECPay();
       
            //服務參數
            $obj->ServiceURL  = "https://payment-stage.ecpay.com.tw/Cashier/AioCheckOut/V5";   //服務位置
            $obj->HashKey     = '5294y06JbISpM5x9' ;                                           //測試用Hashkey，請自行帶入ECPay提供的HashKey
            $obj->HashIV      = 'v77hoKGq4kWxNNIS' ;                                           //測試用HashIV，請自行帶入ECPay提供的HashIV
            $obj->MerchantID  = '2000132';                                                     //測試用MerchantID，請自行帶入ECPay提供的MerchantID
            $obj->EncryptType = '1';                                                           //CheckMacValue加密類型，請固定填入1，使用SHA256加密
    
            //基本參數(請依系統規劃自行調整)
            //$MerchantTradeNo = "Test".time() ;
            $obj->Send['ReturnURL']         = "https://8e6d-36-235-153-229.jp.ngrok.io/callback" ;    //付款完成通知回傳的網址
            $obj->Send['ClientBackURL']      = "https://8e6d-36-235-153-229.jp.ngrok.io/"; //Client 返回網頁
            $obj->Send['MerchantTradeNo']   = $order_trackno ;                         //訂單編號
            $obj->Send['MerchantTradeDate'] = date('Y/m/d H:i:s');                       //交易時間
            $obj->Send['TotalAmount']       = $total;                                      //交易金額
            $obj->Send['TradeDesc']         = "good to drink" ;                          //交易描述
            $obj->Send['ChoosePayment']     = ECPayMethod::ALL ;                 //付款方式:ATM
            $obj->Send['CustomField1']      = $order->id; //自定義欄位1
            $obj->Send['CustomField2']      = Auth::user()->id;//自定義欄位2
            
            //訂單的商品資料
            foreach ($cartitems as $item) {
                array_push($obj->Send['Items'], 
                array('Name' => $item->products->name, 'Price' => $item->products->selling_price , 'Currency' => "元", 'Quantity' => $item->prod_qty, 'URL' => "test"));
            }
            //ATM 延伸參數(可依系統需求選擇是否代入)
            $obj->SendExtend['ExpireDate'] = 3 ;     //繳費期限 (預設3天，最長60天，最短1天)
            $obj->SendExtend['PaymentInfoURL'] = ""; //伺服器端回傳付款相關資訊。
    
            
            //產生訂單(auto submit至ECPay)
                        
            //$orderpaid = Order::where('user_id', Auth::id())->get();
            $order->update([
                'payment_id'        => $order_trackno,
                'payment_mode'      => 'ECPAY credit',
                'total_price' => $total
            ]);
            $cartitems = Cart::where('user_id', Auth::id())->get();
            Cart::destroy($cartitems);
            
            $html = $obj->CheckOut();
            echo $html;
    
        } catch (Exception $e) {
            echo $e->getMessage();
        } 
    }
    

    //綠界付完款轉址路由方法
    public function eccallback(Request $request)
    {
        $order = Order::where('tracking_no', $request('MerchantTradeNo'))->first();
        if ($order){
            $order->status = !$order->status;
            //$order->total_price = $request('TradeAmt');
            $order->update();
            return response()->json(['status'=>'使用ECPAY，' .'訂單編號' . $order->payment_id . '付款成功']);
        }
        // Log::info('訂單編號' . $order->payment_id . '付款成功');
        return redirect('/'); //返回首頁
    }
}
