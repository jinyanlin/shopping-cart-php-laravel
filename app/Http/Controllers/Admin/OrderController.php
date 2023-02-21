<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function index()
    {
        # code...
        $orders = Order::where('status','0')->orderBy('created_at','desc')->paginate(5);
        return view('admin.orders.index',compact('orders'));
    }

    public function view($id)
    {
        # code...
        $orders = Order::where('id',$id)->first();
        return view('admin.orders.view',compact('orders'));
    }

    public function update(Request $request, $id){
        $orders = Order::find($id);
        $orders->status = $request->input('order_status');
        $orders->update();
        return redirect('admin/orders')->with('status', "訂單已完成更新");
    }
    public function history(){
        $orders = Order::where('status','1')->paginate(5);
        return view('admin.orders.history',compact('orders'));
    }
}
