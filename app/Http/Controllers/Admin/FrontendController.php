<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    //
    public function index(){
        $lastorders = DB::table('orders')
                        ->latest()
                        ->get();            
        $orderdate = DB::table('orders')
                        ->select('created_at')
                        ->groupBy(DB::raw('DATE(created_at)'))
                        ->get();
        return view('admin.index',compact('lastorders','orderdate'));
    }
}
