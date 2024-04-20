<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\customer;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CustomerControler extends Controller
{
    //
    public function index(){
        return view('customer.tabel',[
            "title" => "Customer",
            "data" => customer::all()
        ]);
    }

    public function create():View{
return view('customer.tambah')->with((["title"=> "Tambah data Customer"]));
    }

    public function store(Request$request):RedirectResponse{
        $request->validate([
            "name"=>"required",
            "email"=>"required",
            "phone"=>"required",
            "address"=>"nullable"
        ]);
        customer::create($request->all());
        return redirect()->route('pelanggan.index')->with('succes','Data Customer berhasil ditambahkan');
    }

    public function edit(customer $pelanggan):View{
        return view ('customer.edit',compact('pelanggan'))->with(["title"=>"Ubah Data Customer"]);
    }

public function update(Request $request, customer $pelanggan):RedirectResponse{
    $request->validate([
        "name"=>"required",
            "email"=>"required",
            "phone"=>"required",
            "address"=>"nullable"
    ]);
    $pelanggan->update($request->all());

    return redirect()->route('pelanggan.index')->with('updated','Data Pelanggan Berhasil Diubah');
}

public function show(customer $pelanggan):View{
    return view('customer.tampil',compact('pelanggan'))->with(["title" => "Data Customer"]);
}

}
