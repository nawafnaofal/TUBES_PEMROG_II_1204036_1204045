@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">


        <!-- button kembali -->
        <div class="col-md-12">
            <a href="{{ url('home') }}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
        <!-- button kembali -->

        <!-- breadcumb -->
        <div class="col-md-12 mt-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Check Out</li>
                </ol>
            </nav>
        </div>
        <!-- breadcumb -->
        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <!-- tabel -->
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-body">

                    @if (!empty($pesanan))
                    <h3><i class="fa fa-shopping-cart"></i> Check Out</h3>
                    <div class="alert alert-warning mt-3">
                        <p>Kamu {{ Auth::user()->name }}, pesanan kamu akan dikirim ke {{ Auth::user()->alamat }}</p>
                        <p>Waktu memesan : {{ $pesanan->tanggal }}</p>
                        <p>Harap melakukan transfer(minimal setengah dari total yang harus kamu bayar) sebelum check out, ke rekening : <strong>{{$admin->rekening}}</strong> atas nama <strong>{{$admin->name}}</strong></p>
                    </div>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Gambar Barang</th>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Jumlah Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($pesanan_details as $pd)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>
                                    <img src="{{ url('uploads') }}/{{ $pd->barang -> gambar }}" width="100" alt="">
                                </td>
                                <td>{{ $pd->barang->nama_barang }}</td>
                                <td>{{ $pd->jumlah }} barang</td>
                                <td align="left">Rp. {{ number_format($pd->barang->harga) }}</td>
                                <td align="left">Rp. {{ number_format($pd->jumlah_harga) }}</td>
                                <td align="left">
                                    <form action="{{ url('check-out') }}/{{ $pd->detail_id }}" method="post" id="deleteForm{{ $pd->detail_id }}" onsubmit="hapusConfirm({{ $pd->detail_id }}); return false;">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger">
                                            <i class=" fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <div class="h5" colspan="5" align="left"><strong>Total yang harus kamu bayar : Rp. {{ number_format($pesanan->jumlah_harga) }}</strong> </div>

                    <form action="{{ url('konfirmasi-check-out') }}/{{ $pesanan->pesanan_id }}" method="post" enctype="multipart/form-data" id="checkForm{{ $pesanan->user_id }}" onsubmit="checkConfirm({{ $pesanan->user_id }}); return false;">
                        @csrf
                        <div class="form-grup">
                            <label for="formFile" class="form-label mt-3">Upload Bukti Transfer</label>

                            <input class="form-control" @error('bukti') is-invalid @enderror name="bukti" type="file" id="formFile" onchange="previewImage()" required>

                            @error('bukti')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <button class="btn btn-success mt-3" type="submit"><i class="fa fa-shopping-cart"> Check Out</i></button>

                    </form>

                    @else
                    <div class="d-flex justify-content-center">
                        <h4><strong>Kamu belum memesan apapun</strong></h4>
                    </div>
                    <div class="d-flex justify-content-center">
                        <img src="{{ url('img/3973481.jpg') }}" width="75%" alt="Belum ada produk">
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <!-- tabel -->

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