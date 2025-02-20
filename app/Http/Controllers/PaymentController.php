<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Cart;
use App\Models\User;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use ECPay_PaymentMethod as ECPayMethod;
use ECPay_AllInOne as ECPay;



class PaymentController extends Controller
{
    public function ecpayPayment()
    {
        DB::beginTransaction();
        // 取得訂單
        $orderId = Order::where('user_id', Auth::id())->pluck('id')->first();
        $order = Order::findOrFail($orderId);
        if ($order->payment_mode == '尚未付款') {
            return redirect()->route('checkout', ['order_id' => $order->id])->with('error', '訂單已經處理過且付款。');
        }else{
            $response = Http::withOptions([
                'verify' => false, // 忽略 SSL 憑證驗證
            ])->post('https://localhost/ec-order/payment', [
                'order_id' => $order->id,
            ]);
            
            // // 如果需要處理回應
            // if ($response->successful()) {
            //     return $response->body();
            // } else {
            //     return back()->withErrors('付款請求失敗，請重試！');
            // }
        }
        $order_trackno = Order::select('tracking_no')->where('user_id', Auth::id())->get();

        $order = Order::where('user_id', Auth::id())->select('total_price')->first();
        $total = $order ? (int) $order->total_price : 0;
        // 確認購物車商品
        $cartItems = Cart::where('user_id', Auth::id())->get();
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', '購物車為空，請選擇商品再進行結帳。');
        }

        try {
            include_once(app_path('ECPay/ECPay.Payment.Integration.php'));
            $obj = new ECPay();

            // 綠界 API 參數
            $obj->ServiceURL = "https://payment-stage.ecpay.com.tw/Cashier/AioCheckOut/V5"; // 測試環境
            $obj->HashKey = env('ECPAY_HASH_KEY', '5294y06JbISpM5x9');
            $obj->HashIV = env('ECPAY_HASH_IV', 'v77hoKGq4kWxNNIS');
            $obj->MerchantID = env('ECPAY_MERCHANT_ID', '2000132');
            $obj->EncryptType = '1'; // 使用 SHA256 加密

            // 交易參數
            $obj->Send['ReturnURL']         = "https://c86a-36-234-49-239.ngrok-free.app/callback" ;    //付款完成通知回傳的網址
            $obj->Send['ClientBackURL']      = "https://c86a-36-234-49-239.ngrok-free.app/success"; //Client 返回網頁
            $obj->Send['MerchantTradeNo']   = 'jin' . preg_replace('/[^a-zA-Z0-9]/', '', substr(time(), 0, 16));                        //訂單編號
            $obj->Send['MerchantTradeDate'] = date('Y/m/d H:i:s');                       //交易時間
            $obj->Send['TotalAmount']       = $total;                                      //交易金額
            $obj->Send['TradeDesc']         = "good to drink" ;                          //交易描述
            $obj->Send['ChoosePayment']     = ECPayMethod::ALL ;                 //付款方式:ATM
            $obj->Send['CustomField1']      = $order->id; //自定義欄位1
            $obj->Send['CustomField2']      = Auth::user()->id;//自定義欄位2

            // 商品明細
            foreach ($cartItems as $item) {
                array_push($obj->Send['Items'], 
                array('Name' => $item->products->name, 'Price' => $item->products->selling_price , 'Currency' => "元", 'Quantity' => $item->prod_qty, 'URL' => "test"));
            }

            // 付款資訊
            $obj->SendExtend['ExpireDate'] = 3; // ATM 付款期限
            $obj->SendExtend['PaymentInfoURL'] = "";  //route('ecpay.payment.info');

            
            // 產生表單並送出
            DB::commit(); 
            $html = $obj->Checkout();
            dd($html);
            return response()->make($html);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', '綠界付款發生錯誤: ' . $e->getMessage());
        }
    }

     // ECPay 付款完成後的回調
     public function ecpayCallback(Request $request)
     {
        // 取得綠界回傳的資料
        $data = $request->all();
 
        if ($data['RtnCode'] == '1') { // 交易成功
            $order = Order::where('id', str_replace('Order', '', $data['MerchantTradeNo']))->first();
            if ($order) {
                $order->update(['status' => 'paid']); // 更新訂單狀態
            }
        }
 
        return 'OK'; // 必須回傳 'OK' 才能讓 ECPay 確認
    }
}



