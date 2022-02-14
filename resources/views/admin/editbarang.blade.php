@extends('admin/layout.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="{{ url('barang') }}" class="btn btn-info"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="col-md-12 mt-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('barang') }}">Data Barang</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Update Barang</li>
                </ol>
            </nav>
        </div>

        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="col-md-12 mt-2">
            <div class="card">
                <div class="card-header mb-3">
                    <h4><i class="fas fa-edit"></i> Edit Informasi Barang</h4>
                </div>
                <div class="card-body">
                    <form action="{{ url('ubahbarang', $update->barang_id) }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-grup">
                            <label for="inputState" class="form-label">Pilih Kategori Barang</label>
                            <select id="inputState" class="form-select" name="categories_id" required>
                                @foreach($kategori as $k)
                                <option selected value="{{ $k->categories_id }}">{{ $k->nama}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-grup">
                            <label for="nama_barang" class="form-label mt-3">Nama Barang</label>
                            <input type="text" value="{{ $update -> nama_barang }}" name="nama_barang" class="form-control text-black" id="nama_barang" placeholder="Masukkan nama barang" required>
                        </div>

                        <div class="form-grup">
                            <img width="100px" class="mt-3" src="{{ url('uploads') }}/{{ $update -> gambar }}">
                        </div>

                        <div class="form-grup">
                            <label for="formFile" class="form-label mt-3">Pilih Gambar</label>
                            <input class="form-control" @error('gambar') is-invalid @enderror name="gambar" type="file" id="formFile">
                        </div>

                        <div class="form-grup">
                            <label for="harga" class="form-label mt-3">Harga</label>
                            <input type="number" value="{{ $update -> harga }}" name="harga" class="form-control text-black" id="harga" placeholder="Tentukan harga barang" required>
                        </div>

                        <div class="form-grup">
                            <label for="stok" class="form-label mt-3">Stok</label>
                            <input type="number" value="{{ $update -> stok }}" name="stok" class="form-control text-black" id="stok" placeholder="Masukkan jumlah stok barang" required>
                        </div>

                        <div class="form-grup">
                            <label for="exampleFormControlTextarea1" class="form-label mt-3">Deskripsi Barang</label>
                            <textarea name="keterangan" value="{{ $update -> keterangan }}" class="form-control" id="exampleFormControlTextarea1" rows="3" required></textarea>
                        </div>

                        <div class="form-grup mt-3">
                            <button type="submit" class="btn btn-primary">Ubah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Footer -->
<footer class="footer footer-expand-md footer-light bg-white sticky-bottom text-center text-lg-start">

    <!-- Copyright -->
    <div class="text-center p-4">
        <span class="text-reset fw-bold">© 2022 Copyright: E-Fazastore</span>
    </div>
    <!-- Copyright -->
</footer>
<!-- Footer -->
@endsection