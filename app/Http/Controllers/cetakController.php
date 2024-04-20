<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Models\order_detail;
use Illuminate\Http\Request;
use Illuminate\View\View;

class cetakController extends Controller
{
    //
    public function receipt():View{
        $id=session()->get('id');
        $order=order::find($id);
        $orderDetail=order_detail::where('order_id',$id)->get();
        return view('penjualan.receipt')->with([
            'dataOrder'=>$order,
            'dataOrderDetail'=>$orderDetail
        ]);
    }
}
