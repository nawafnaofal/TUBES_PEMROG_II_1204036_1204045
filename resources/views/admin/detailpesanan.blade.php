@extends('admin/layout.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            @if($pesanan->status == 1)
            <a href="{{ url('pesananmasuk') }}" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
            @elseif($pesanan->status == 2)
            <a href="{{ url('pesananmasuk') }}" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
            @else
            <a href="{{ url('historipesanan') }}" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Kembali</a>
            @endif
        </div>
        <div class="col-md-12 mt-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    @if($pesanan->status == 1)
                    <li class="breadcrumb-item"><a href="{{ url('pesananmasuk') }}">Pesanan Masuk</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail Pesanan</li>
                    @elseif($pesanan->status == 2)
                    <li class="breadcrumb-item"><a href="{{ url('pesananmasuk') }}">Pesanan Masuk</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail Pesanan</li>
                    @else
                    <li class="breadcrumb-item"><a href="{{ url('historipesanan') }}">Riwayat Pesanan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail Pesanan</li>
                    @endif
                </ol>
            </nav>
        </div>

        <div class="col-md-12 mt-2">

            <div class="card">

                <div class="card-header mb-3">
                    <h4><i class="fas fa-info-circle mr-2"></i>Detail Pesanan
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

                        @else
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                            Selesai
                            <span class="visually-hidden">unread messages</span>
                        </span>
                        @endif

                    </h4>
                </div>



                <div class="card-body">
                    @if($pesanan->status == 3)
                    @if(empty($alert->penerima))
                    <div class="alert alert-danger">
                        <div class="mb-3">
                            <form action="{{ url('tambahpenerima') }}/{{ $pesanan->pesanan_id }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-grup">
                                    <label for="formFile" class="form-label h5">Data penerima belum ditambahkan, tambahkan foto penerima disini</label>
                                    <input name="penerima" class="form-control" type="file" id="formFile" required>
                                    @error('penerima')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    <button class="btn btn-success mt-3" type="submit"><i class="fas fa-upload mr-2"></i> Unggah</button>
                                </div>
                            </form>

                        </div>
                    </div>
                    @endif
                    @endif
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <i class="fas fa-user mr-2"></i><strong>Pemesan</strong>
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body accordion-custom-bg">
                                    {{$pesanan->user->name}}, {{$pesanan->user->no_hp}}
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    <i class="fas fa-map-marker-alt mr-2"></i> <strong>Alamat Pengiriman</strong>
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body accordion-custom-bg">
                                    {{$pesanan->user->alamat}}
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    <i class="fas fa-clock mr-2"></i> <strong>Waktu memesan</strong>
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body accordion-custom-bg">
                                    {{$pesanan->tanggal}}
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                    <i class="fas fa-comment-dollar mr-2"></i> <strong>Bukti Transfer Pelanggan</strong>
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                <div class="accordion-body accordion-custom-bg">
                                    <img class="img-fluid rounded img-thumbnail" src="{{ url('transfer') }}/{{ $pesanan->bukti }}" width="300" alt="...">
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingFive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                    <i class="fas fa-clipboard-check mr-2"></i> <strong>Data Penerima</strong>
                                </button>
                            </h2>
                            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                <div class="accordion-body accordion-custom-bg">
                                    @if(!empty($pesanan->penerima))
                                    <img class="img-fluid rounded" src="{{ url('penerima') }}/{{ $pesanan->penerima }}" width="300" alt="...">
                                    @else
                                    Data penerima belum ada
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingSix">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                    <i class="fas fa-couch mr-2"></i> <strong> Data Pesanan</strong>
                                </button>
                            </h2>
                            <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                                <div class="accordion-body accordion-custom-bg">

                                    <table class="table table-stripped table-dark mt-2" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr align="left">
                                                <th>No.</th>
                                                <th>Barang Yang Dipesan</th>
                                            </tr>
                                        </thead>

                                        <tbody align="left">
                                            @if(!empty($detail))
                                            <?php $no = 1; ?>
                                            @foreach($detail as $d)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $d->jumlah }} unit {{ $d->barang->nama_barang }}</td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>

                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>

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