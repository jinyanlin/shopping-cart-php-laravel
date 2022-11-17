<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function index(){
        $orders = Order::where('user_id',Auth::id())->get();
        return view('frontend.orders.index',compact('orders'));
    }

    public function view($id)
    {
        # code...
        $orders = Order::where('id',Auth::id())->where('user_id', Auth::id())->first();
        return view('frontend.orders.view',compact('orders'));
    }
}
