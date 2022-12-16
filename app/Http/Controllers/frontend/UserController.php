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
        $orders = Order::where('id',$id)->where('user_id', Auth::id())->first();
        return view('frontend.orders.view',compact('orders'));
    }
    
    public function viewuser(Request $request){
        /*$request->validate([
            'name' =>'required|min:4|string|max:255',
            'email'=>'required|email|string|max:255'
        ]);
        $user =Auth::user();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->lastname = $request->input('lastname');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        $user->city = $request->input('city');
        $user->country = $request->input('country');
        $user->pincode = $request->input('pincode');

        $user->save();
        return view('frontend.users',compact('user'));*/
        //return back()->with('status','Profile Updated');
        $user =Auth::user();
        return view('frontend.userss',compact('user'));
    }

    public function edituser(Request $request){
        $request->validate([
                    'name' =>'required|min:4|string|max:255',
                    'email'=>'required|email|string|max:255'
                ]);

        if(Auth::check()){
            $user =Auth::user();
            $user->name = $request['name'];
            $user->email = $request['email'];
            $user->lastname = $request->input('lastname');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
            $user->address = $request->input('address');
            $user->city = $request->input('city');
            $user->country = $request->input('country');
            $user->pincode = $request->input('pincode');
    
            $user->update();
            return redirect('view-user')->with('status','Profile Updated');
        }
        
    }
}
