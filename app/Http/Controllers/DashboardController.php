<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Product;
use App\Models\Category;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    function DashboardPage(){
        return view('pages.dashboard.dashboard-page');
    }

    function Summary(Request $request){
        $user_id=Auth::id();

        

        $Product = Product::where('user_id', $user_id)->count();
        $Category = Category::where('user_id', $user_id)->count();
        $Customer = Customer::where('user_id', $user_id)->count();
        $Invoice = Invoice::where('user_id', $user_id)->count();

        $total = Invoice::where('user_id', $user_id)->sum('total');
        $vat = Invoice::where('user_id', $user_id)->sum('vat');
        $payable = Invoice::where('user_id', $user_id)->sum('payable');

        return array(
            'product'=>$Product,
            'category'=>$Category,
            'customer'=>$Customer,
            'invoice'=>$Invoice,
            'total'=>round($total,2),
            'vat'=>round($vat,2),
            'payable'=>round($payable,2)
            // 'user_id'=>$user_id
        );
    }
}
