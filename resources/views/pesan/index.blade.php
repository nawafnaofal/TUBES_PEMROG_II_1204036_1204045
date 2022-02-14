@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="{{ url('home') }}" class="btn btn-warning"><i class="fa fa-arrow-left mr-2"></i>Kembali</a>
        </div>
        <div class="col-md-12 mt-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $barang->nama_barang}}</li>
                </ol>
            </nav>

        </div>
        <div class="col-md-12 mt-1">
            <div class="card mb-5">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="{{ url('uploads') }}/{{ $barang -> gambar }}" class="card-img-top" class="rounded mx-auto d-block" alt="...">
                        </div>
                        <div class="col-md-6 mt-5">
                            <h2> <strong>{{ $barang->nama_barang}}</strong></h2>
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td>Harga</td>
                                        <td>: </td>
                                        <td>Rp. {{ number_format($barang -> harga) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Stok</td>
                                        <td>: </td>
                                        <td id="stok">{{ $barang -> stok }}</td>
                                    </tr>
                                    <tr>
                                        <td>Keterangan</td>
                                        <td>: </td>
                                        <td>{{ $barang -> keterangan }}</td>
                                    </tr>

                                    <tr>
                                        <td>Jumlah</td>
                                        <td>: </td>
                                        <td>
                                            <form action="{{ url('pesan') }}/{{ $barang->barang_id }}" method="POST" onsubmit="return cekjumlahpesanan();">
                                                @csrf
                                                <input type="number" name="jumlah_pesan" id="jumlah_pesan" class="form-control" required>
                                                <button type="submit" class="btn btn-success mt-3"><i class="fa fa-shopping-cart"></i> Masukkan ke Keranjang</button>
                                            </form>
                                        </td>
                                    </tr>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Footer -->
<footer class="footer footer-light bg-white sticky-bottom text-center text-lg-start">

    <!-- Copyright -->
    <div class="text-center p-4">
        <span class="text-reset fw-bold">© 2022 Copyright: E-Fazastore</span>
    </div>
    <!-- Copyright -->
</footer>
<!-- Footer -->
@endsection