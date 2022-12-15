<?php

namespace App\Http\Controllers\Pay;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use OpayAllInOne;
use OpayEncryptType;
use Exception;
use OpayPaymentMethod;

class OpayPaymentsController extends Controller
{
    //
    public function pay(Request $request) {

        //載入SDK(路徑可依系統規劃自行調整)
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
            return response()->json(['status'=>"您已使用歐付寶下訂單"]);
        }
        return redirect('/')->with('status',"您已下訂單");

        try {
    
            $obj = new OpayAllInOne();
    
            //服務參數
            $obj->ServiceURL  = "https://payment-stage.opay.tw/Cashier/AioCheckOut/V5";         //服務位置
            $obj->HashKey     = '5294y06JbISpM5x9' ;                                            //測試用Hashkey，請自行帶入OPay提供的HashKey
            $obj->HashIV      = 'v77hoKGq4kWxNNIS' ;                                            //測試用HashIV，請自行帶入OPay提供的HashIV
            $obj->MerchantID  = '2000132';                                                      //測試用MerchantID，請自行帶入OPay提供的MerchantID
            $obj->EncryptType = OpayEncryptType::ENC_SHA256;                                    //CheckMacValue加密類型，請固定填入1，使用SHA256加密
    
            //基本參數(請依系統規劃自行調整)
            $MerchantTradeNo = "Test".time();
    
            $obj->Send['ReturnURL']         = 'http://localhost/simple_ServerReplyPaymentStatus.php'; //付款完成通知回傳的網址
            $obj->Send['MerchantTradeNo']   = $order->tracking_no;                                       //訂單編號
            $obj->Send['MerchantTradeDate'] = date('Y/m/d H:i:s');                                    //交易時間
            $obj->Send['TotalAmount']       = $total;                                                   //交易金額
            $obj->Send['TradeDesc']         = "完成支付";                                        //交易描述
            $obj->Send['ChoosePayment']     = OpayPaymentMethod::ALL;                                 //付款方式:全功能
    
            //訂單的商品資料
            // array_push($obj->Send['Items'], array('Name' => "歐付寶黑芝麻豆漿", 'Price' => (int)"2000",
            //            'Currency' => "元", 'Quantity' => (int) "1", 'URL' => "dedwed"));
    
            //產生訂單(auto submit至OPay)
            $obj->CheckOut();
    

            //付款成功後insert to mysql


        }catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function receive(Request $request) {

        //載入SDK(路徑可依系統規劃自行調整)
        
        try {
    
                $obj = new OpayAllInOne();
    
                /* 服務參數 */
                $obj->HashKey     = '5294y06JbISpM5x9' ;
                $obj->HashIV      =  'v77hoKGq4kWxNNIS' ;
                $obj->MerchantID  = '2000132';
                $obj->EncryptType = OpayEncryptType::ENC_SHA256;
    
                /* 取得回傳參數 */
                $arFeedback = $obj->CheckOutFeedback();
    
                // 參數寫入檔案
                if(true)
                {
                    $sLog_Path  = __DIR__.'/sample_payment_return.log' ; // LOG路徑
                    $sLog = '+++++++++++++++++++++++++++++++++++++++ 接收回傳參數 ' . date('Y-m-d H:i:s') . ' ++++++++++++++++++++++++++++++++++++++++++++' . "\n";
                    $fp=fopen($sLog_Path, "a+");
                    fputs($fp, $sLog);
                    fclose($fp);
    
                    $sLog_File =  print_r($arFeedback, true). "\n";
                    $fp=fopen($sLog_Path, "a+");
                    fputs($fp, $sLog_File);
                    fclose($fp);
                }
    
                echo '1|OK' ;
    
        } catch (Exception $e) {
            if(true)
            {
                $sLog_Path  = __DIR__.'/sample_payment_return.log' ; // LOG路徑
                $sLog = '+++++++++++++++++++++++++++++++++++++++ 接收回傳參數(ERROR) ' . date('Y-m-d H:i:s') . ' ++++++++++++++++++++++++++++++++++++++++++++' . "\n";
                $fp=fopen($sLog_Path, "a+");
                fputs($fp, $sLog);
                fclose($fp);
    
                $sLog_File =  $e->getMessage(). "\n";
                $fp=fopen($sLog_Path, "a+");
                fputs($fp, $sLog_File);
                fclose($fp);
            }
         }
        }
}

