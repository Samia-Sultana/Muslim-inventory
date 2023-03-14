<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Queue\Middleware\ThrottlesExceptionsWithRedis;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function sale(){
        $sales = Purchase::all();
        return view('sale_report', compact('sales'));

    }
    public function purchase(){
        $purchases = Purchase::all();
        return view('purchase_report', compact('purchases'));
        
    }
    public function inventory(){
        $purchases = Purchase::all();
        return view('inventory_report', compact('purchases'));
        
    }
    public function range(){
        $orders = array();
        $total_sales = 0;
        return view('range_report', compact('orders','total_sales'));
        
    }

    public function rangeOutput(Request $request){
        $start = $request->range_start;
        $end = $request->range_end;
        
        $orders = DB::table('orders')->whereBetween('date', [$start, $end])->get();
        $total_sales = 0;
        foreach($orders as $order){
            $total_sales = $total_sales + $order->total_amount;
        }
       
        return view('range_report', compact('orders' ,'total_sales'));
        
    }
}
