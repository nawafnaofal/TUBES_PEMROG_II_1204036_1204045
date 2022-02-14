@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="{{ url('history') }}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali
            </a>
        </div>
        <div class="col-md-12 mt-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('history') }}">Pesanan Saya</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail Pemesanan</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-body">
                    <div class="mb-3">
                        <i class=" fas fa-info-circle fa-2x mr-2"></i>
                        <span class="h4 font-weight-bold">Rincian Pemesanan</span>
                    </div>

                    @if($pesanan->status == 1)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        Belum dikirim
                        <span class="visually-hidden">unread messages</span>
                    </span>

                    @elseif($pesanan->status == 2)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning text-black">
                        Masih dikirm
                        <span class="visually-hidden">unread messages</span>
                    </span>
                    @elseif($pesanan->status == 5)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning text-black">
                        Pesanan yang <br>
                        diajukan pembatalan
                        <span class="visually-hidden">unread messages</span>
                    </span>
                    @elseif($pesanan->status == 4)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning text-black">
                        Pesanan yang <br>
                        telah dibatalkan
                        <span class="visually-hidden">unread messages</span>
                    </span>
                    @else
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                        Selesai
                        <span class="visually-hidden">unread messages</span>
                    </span>
                    @endif
                    </h3>
                    <div class="alert alert-info">
                        <p align="left"><strong> Tanggal Pesan : {{ $pesanan->tanggal}}</strong></p>
                        <p align="left"><strong> Bukti transfer :</strong></p>
                        <img class="img-fluid img-thumbnail rounded" src="{{ url('transfer') }}/{{ $pesanan->bukti }}" width="300" alt="...">

                        <div class="mt-4">
                            @if(!empty($pesanan->penerima))
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <i class="fas fa-user-check mr-2"></i> <strong>Bukti penerimaan barang</strong>
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <img class="img-fluid rounded" src="{{ url('penerima') }}/{{ $pesanan->penerima }}" width="300" alt="...">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>

                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nomor</th>
                                <th>Gambar</th>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Total Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($pesanan_details)
                            @if($pesanan_details->count() > 0)
                            <?php $no = 1; ?>
                            @foreach ($pesanan_details as $pesanan_detail)
                            <tr>
                                <td> {{ $no++ }} </td>
                                <td>
                                    <img class=" img-fluid rounded" src=" {{ url('uploads') }}/{{ $pesanan_detail->barang->gambar }}" width="100" alt="...">
                                </td>
                                <td> {{ $pesanan_detail->barang->nama_barang }} </td>
                                <td> {{ $pesanan_detail->jumlah }}</td>
                                <td align="left">Rp. {{ number_format($pesanan_detail->barang->harga) }}</td>
                                <td align="left">Rp. {{ number_format($pesanan_detail->jumlah_harga) }}</td>

                            </tr>
                            @endforeach

                            <tr>
                                <td colspan="5" align="right"><strong> Total Harga : </strong></td>
                                <td><strong> Rp. {{ number_format($pesanan->jumlah_harga) }} </strong></td>

                            </tr>

                            <tr>
                                <td colspan="5" align="right"><strong> Kode Pesanan : </strong></td>
                                <td><strong> {{ number_format($pesanan->kode) }} </strong></td>

                            </tr>
                            @endif
                            @endif
                        </tbody>
                    </table>

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