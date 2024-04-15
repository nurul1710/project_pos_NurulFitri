@extends('layouts.template')
@section('judulh1','Admin - Product')

@section('konten')
<div class="col-md-6">
    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="card card-warning">
        <div class="card-header">
            <h3 class="card-title">Ubah Data Product</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('produk.update',$produk->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class=" card-body">
                <div class="form-group">
                    <label for="name">Nama Produk</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder=""
                        value="{{$produk->name}}">
                </div>
                <div class="form-group">
                    <label for="stock">Stok</label>
                    <input type="number" class="form-control" id="stock" name="stock" value="{{$produk->stock}}">
                </div>

                <div class="form-group">
                    <label>Kategori</label>
                    <select class="form-control" name="category_id">
                        @foreach($data as $dt )
                        <option value="{{ $dt->id }}" @if($dt->id===$produk->category_id) selected
                            @endif>{{ $dt->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="price">Harga</label>
                    <input type="number" class="form-control" id="price" name="price" value="{{$produk->price}}">
                </div>
                <div class=" form-group">
                    <label for="description">Deskripsi</label>
                    <textarea id="description" name="description" class=" form-control"
                        rows="4">{{ $produk->description }}</textarea>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-warning float-right">Ubah</button>
            </div>
        </form>
    </div>


</div>


@endsection
