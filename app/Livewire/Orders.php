<?php

namespace App\Livewire;

use App\Models\order;
use App\Models\order_detail;
use App\Models\product;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class Orders extends Component
{

    public $total;
    public $order_id;
    public $product_id;
    public $qty = 1;
    public $uang;
    public $kembali;

    public function render()
    {

        $order = order::select('*')->where('user_id', '=', Auth::user()->id)->orderBy('id', 'desc')->first();

        $this->total = $order->total;
        $this->kembali = $this->uang - $this->total;
        return view('livewire.orders')
            ->with("data", $order)
            ->with("dataProduk", product::where('stock', '>', '0')->get())
            ->with("dataOrderDetail", order_detail::where('order_id', '=', $order->id)->get());
    }
    public function store()
    {
        $this->validate([

            'product_id' => 'required'
        ]);
        $order = order::select('*')->where('user_id', '=', Auth::user()->id)->orderBy('id', 'desc')->first();
        $this->order_id = $order->id;
        $produk = product::where('id', '=', $this->product_id)->get();
        $harga = $produk[0]->price;
        order_detail::create([
            'order_id' => $this->order_id,
            'product_id' => $this->product_id,
            'qty' => $this->qty,
            'price' => $harga
        ]);


        $total = $order->total;
        $total = $total + ($harga * $this->qty);
        order::where('id', '=', $this->order_id)->update([
            'total' => $total
        ]);
        $this->product_id = NULL;
        $this->qty = 1;
    }

    public function delete($order_detail_id)
    {
        $order_detail = order_detail::find($order_detail_id);
        $order_detail->delete();

        //update total
        $order_detail = order_detail::select('*')->where('order_id', '=', $this->order_id)->get();
        $total = 0;
        foreach ($order_detail as $od) {
            $total += $od->qty * $od->price;
        }

        try {
            order::where('id', '=', $this->order_id)->update([
                'total' => $total
            ]);
        } catch (Exception $e) {
            dd($e);
        }
    }

    public function receipt($id){
        $order_detail=order_detail::select('*')->where('order_id','=',$id)->get();
        foreach($order_detail as $od){
            $stocklama=product::select('stock')->where('id','=',$od->product_id)->sum('stock');
            $stock=$stocklama-$od->qty;
            try{
                product::where('id','=',$od->product_id)->update([
                    'stock' => $stock
                ]);
            }catch(Exception $e){
                dd($e);
            }
        }return Redirect::route('cetakReceipt')->with(['id'=>$id]);
    }


}
