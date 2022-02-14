@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="{{ url('home') }}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali
            </a>
        </div>
        <div class="col-md-12 mt-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pesanan Saya</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-12">
            <div class="card mb-5">

                @if(!empty($pesanans))
                <div class="card-body">
                    <h3 class="mb-4"><i class="fa fa-shopping-bag mr-2 "></i>Pesanan Saya</h3>

                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item bg-info">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <i class="fas fa-spinner mr-2"></i>
                                    Diproses
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    @if(!empty($p1))
                                    <table class="table table-dark table-striped">
                                        <thead align="center">
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Harga</th>
                                                <th>Kode Pesanan</th>
                                                <th>Lihat Rincian</th>
                                                <th>Status</th>
                                                <th>Batal Pesan</th>
                                            </tr>
                                        </thead>
                                        <tbody align="center">
                                            <?php $no = 1; ?>
                                            @foreach($jp1 as $p1)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $p1->tanggal }}</td>
                                                <td>Rp. {{number_format($p1->jumlah_harga)}}</td>
                                                <td>{{$p1->kode}}</td>
                                                <td>
                                                    <a href="{{ url('history') }}/{{$p1->pesanan_id}}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                                </td>
                                                <td>
                                                    @if($p1->status==1)
                                                    <div class="badge bg-info text-black">Pesanan masih diproses admin</div>
                                                    @elseif($p1->status==5)
                                                    <div class="badge bg-warning text-black">Pesanan menunggu dibatalkan oleh admin</div>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($p1->status==1)
                                                    <form action="{{ url('batal', $p1->pesanan_id) }}" method="post" id="confirm{{  $p1->pesanan_id }}" onsubmit="batal({{  $p1->pesanan_id }}); return false;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger"><i class="fas fa-window-close"></i></button>
                                                    </form>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @else
                                    Belum ada pesanan
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item bg-warning">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <i class="fas fa-shipping-fast mr-2"></i>Dikirim
                                    @if(!empty($p2))
                                    <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
                                        <span class="visually-hidden"></span>
                                    </span>
                                    @endif
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    @if(!empty($p2))
                                    <table class="table table-dark table-striped">
                                        <thead align="center">
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Harga</th>
                                                <th>Kode Pesanan</th>
                                                <th>Lihat Rincian</th>
                                                <th>Konfirmasi Pesanan</th>
                                            </tr>
                                        </thead>
                                        <tbody align="center">
                                            <?php $no = 1; ?>
                                            @foreach($jp2 as $p2)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $p2->tanggal }}</td>
                                                <td>Rp. {{number_format($p2->jumlah_harga)}}</td>
                                                <td>{{$p2->kode}}</td>
                                                <td>
                                                    <a href="{{ url('history') }}/{{$p2->pesanan_id}}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                                </td>
                                                <td>
                                                    <form action="{{ url('konfirmasipesanan', $p2->pesanan_id) }}" method="get" id="confirm{{  $p2->pesanan_id }}" onsubmit="konfirmasi({{  $p2->pesanan_id }}); return false;">
                                                        <button type="submit" class="btn btn-success">
                                                            <i class="fas fa-check"></i>

                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @else
                                    Belum ada pesanan
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item bg-success">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <i class="fas fa-check-circle mr-2"></i>Selesai
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    @if(!empty($p3))
                                    <table class="table table-dark table-striped">
                                        <thead align="center">
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Harga</th>
                                                <th>Kode Pesanan</th>
                                                <th>Lihat Rincian</th>
                                            </tr>
                                        </thead>
                                        <tbody align="center">
                                            <?php $no = 1; ?>
                                            @foreach($jp3 as $p3)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $p3->tanggal }}</td>
                                                <td>Rp. {{number_format($p3->jumlah_harga)}}</td>
                                                <td>{{$p3->kode}}</td>
                                                <td>
                                                    <a href="{{ url('history') }}/{{$p3->pesanan_id}}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @else
                                    Belum ada pesanan
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item bg-secondary">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    <i class="fas fa-window-close mr-2"></i>Pesanan Batal
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    @if(!empty($p4))
                                    <table class="table table-dark table-striped">
                                        <thead align="center">
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal</th>
                                                <th>Harga</th>
                                                <th>Kode Pesanan</th>
                                                <th>Lihat Rincian</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody align="center">
                                            <?php $no = 1; ?>
                                            @foreach($jp4 as $p4)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $p4->tanggal }}</td>
                                                <td>Rp. {{number_format($p4->jumlah_harga)}}</td>
                                                <td>{{$p4->kode}}</td>
                                                <td>
                                                    <a href="{{ url('history') }}/{{$p4->pesanan_id}}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                                </td>
                                                <td>
                                                    @if($p4->status==4)
                                                    <div class="badge bg-danger text-white">Pesanan dibatalkan admin karena {{$p4->keterangan}}</div>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @else
                                    Belum ada pesanan
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>


                    @else
                    <div class="d-flex justify-content-center">
                        <h4><strong>Kamu belum memesan apapun</strong></h4>
                    </div>
                    <div class="d-flex justify-content-center">
                        <img src="{{ url('img/3973481.jpg') }}" width="75%" alt="Belum ada produk">
                    </div>
                </div>
                @endif

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