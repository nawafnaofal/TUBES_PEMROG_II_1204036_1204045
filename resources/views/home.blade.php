@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">

        <!-- navbar logo -->
        <div class="col-md-12 mb-3">
            <img src="{{ url('logo/logo.png')}}" width="400" class="rounded mx-auto d-block" alt="">
        </div>
        <!-- navbar logo -->

        <div class="col-md-12 mb-4 d-flex justify-content-center">
            <div class="dropdown">
                <a class="btn btn-warning dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                    Tampilkan Berdasarkan Kategori
                </a>

                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    @foreach($kategori as $k)
                    <li><a class="dropdown-item" href="{{ url('display') }}/{{ $k->categories_id }}" value="{{ $k->categories_id}}">{{ $k->nama }}</a></li>
                    @endforeach
                </ul>
            </div>

            <a href="{{ url('/home') }}" class="btn btn-secondary ml-2">Reset Filter</a>
        </div>

        <!-- carousel -->
        <!-- <div id="carouselExampleControls" class="carousel slide mb-4" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="<?= url('uploads/sofa.jpg') ?>" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="<?= url('uploads/meja.jpg') ?>" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="<?= url('uploads/sofa2.jpg') ?>" alt="Third slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div> -->
        <!-- end carousel -->

        <!--display produk-->
        @if(!empty($barangs))
        @foreach($barangs as $barang)
        <div class="col-md-4">
            <div class="card mb-5">
                <img class="card-img-top" src="{{ url('uploads') }}/{{ $barang -> gambar }}" alt="...">
                <div class="card-body">
                    <h4 class="card-title">{{ $barang -> nama_barang }}</h4>
                    <p class="card-text h5 mb-2">
                        Harga :<strong> Rp. {{ number_format($barang -> harga) }}</strong> <br>

                    </p>
                    <p class="card-text h5">
                        Stok :
                        @if($barang->stok == 0)
                        <span class="badge bg-danger">Stok Habis</span>
                        @else
                        <span class="badge bg-warning text-dark">{{ $barang -> stok }}</span> <br>
                        @endif
                    </p>
                    @if($barang->stok != 0)
                    <hr>
                    <a href="{{ url('pesan') }}/{{ $barang->barang_id }}" class="btn btn-warning"> <i class="fa fa-info-circle mr-2"></i>Lihat Detail</a>
                    @endif
                </div>
            </div>
        </div>

        @endforeach

        @else
        <div class="d-flex justify-content-center">
            <img src="{{ url('img/undraw_posting_photo1.svg') }}" width="75%" alt="Belum ada produk">
        </div>

        @endif
        <!--display produk-->

    </div>

</div>
<!-- Footer -->
<footer class="footer footer-light bg-white sticky-bottom text-center text-lg-start mt-3">

    <!-- Copyright -->
    <div class="text-center p-4">
        <span class="text-reset fw-bold">© 2022 Copyright: E-Fazastore</span>
    </div>
    <!-- Copyright -->
</footer>
<!-- Footer -->
@endsection