<?php

namespace App\Livewire;

use App\Models\customer;
use App\Models\order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Penjualan extends Component
{
    public $customer_id;
    public function render()
    {
        return view('livewire.penjualan',[
            'data'=>customer::orderBy('id','desc')->get()
        ]);
    }

    public function store(){
        $this->validate(['customer_id'=>'required']);

    order::create([
        'invoice'=>$this->invoice(),
        'customer_id'=>$this->customer_id,
        'user_id'=>Auth::user()->id,
        'total'=>'0'
    ]);
    $this->customer_id=NULL;
    return redirect()->to('orders');
    }

    public function invoice(){
        $order=order::orderBy('created_at','DESC');
        if($order->count()>0){
            $order=$order->first();
            $explode=explode('-',$order->invoice);
            return 'INV-'.$explode[1]+1;
        }
        return 'INV-1';
    }
}
