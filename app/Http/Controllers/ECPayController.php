<?php
namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;

class ECPayController extends Controller
{
    //
    public function paymentCallback(Request $request){
        $order = Order::where('tracking_no', $request->MerchantTradeNo)->first();
        if ($order && $request->RtnCode == 1) { // 付款成功
            $order->update([
                'status' => 'paid',
                'payment_mode' => 'ECPAY credit'
            ]);
        }
        return response()->json(['message' => '付款狀態更新成功']);
    }
}
