<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin E-Fazastore</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center mb-3" href="{{ url('dashboard') }}">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-chair"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Admin <br>E-Fazastore</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{ url('dashboard') }}">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Beranda</span></a>
            </li>

            <!-- Heading -->
            <div class="sidebar-heading mt-2">
                Kelola
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-couch"></i>
                    <span>Informasi Barang</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ url('kategori') }}">Data Kategori</a>

                        @if(!empty($kategori))
                        <a class="collapse-item" href="{{ url('barang') }}">Data Barang</a>
                        @endif
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-clipboard-list"></i>
                    <span>Informasi Pesanan</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ url('pesananmasuk') }}">Pesanan Masuk</a>
                        <a class="collapse-item" href="{{ url('historipesanan') }}">Riwayat Pesanan</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ url('pelanggan') }}">
                    <i class="fas fa-users fa-chart-area"></i>
                    <span>Pelanggan</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>


        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{Auth::user()->name}}</span>
                                <img class="img-profile rounded-circle" src="{{ url('img/undraw_profile.svg') }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Data Pesanan Masuk</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Jumlah barang Card -->
                        <div class="col-md-12">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <div>
                                        @if(!empty($pesanans))
                                        <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                                            <thead class="thead-dark">
                                                <tr align="center">
                                                    <th>No.</th>
                                                    <th>Pelanggan</th>
                                                    <th>Tanggal</th>
                                                    <th>Total Harga</th>
                                                    <th>Kode</th>
                                                    <th>Status</th>
                                                    <th>Aksi</th>
                                                    <th>Kelola</th>
                                                </tr>
                                            </thead>

                                            <tbody align="center">
                                                <?php $no = 1; ?>
                                                @foreach($pesanan as $p)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $p->user->name }}</td>
                                                    <td>{{ $p->tanggal }}</td>
                                                    <td>{{ number_format($p->jumlah_harga) }}</td>
                                                    <td>{{ $p->kode }}</td>
                                                    <td>
                                                        @if($p->status == 1)
                                                        <div class="badge bg-danger text-white">Belum dikirim</div>
                                                        @elseif($p->status == 5)
                                                        <div class="badge bg-info text-white">{{$p->user->name}} mengajukan pembatalan pesanan</div>
                                                        @else
                                                        <div class="badge bg-warning text-white">Dikirim</div>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ url('detailpesanan', $p->pesanan_id) }}" class="btn btn-info ">
                                                            <i class="fas fa-info-circle"></i>
                                                        </a>
                                                        @if($p->status == 1)

                                                        <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#modalbatalpesan">
                                                            <i class="fas fa-window-close mr-2"></i>Batalkan Pesanan
                                                        </button>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="modalbatalpesan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title text-black" id="exampleModalLabel">Masukkan Pesan</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="{{ url('batalpesanan') }}/{{ $p->pesanan_id }}" method="post">
                                                                            @csrf
                                                                            <label for="ket" class="text-black">Kirim pesan untuk pelanggan agar mereka tau kenapa pesanannya dibatalkan</label>
                                                                            <input id="ket" class="form-control mb-3" name="keterangan" type="text" required>
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                                            <button type="submit" class="btn btn-danger">Batalkan Pesanan</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <form action="{{ url('antarpesanan', $p->pesanan_id) }}" method="get" id="confirm{{  $p->pesanan_id }}" onsubmit="konfirmasi({{  $p->pesanan_id }}); return false;">
                                                            <button type="submit" class="btn btn-success">
                                                                <i class="fas fa-truck"></i>
                                                                Antar
                                                            </button>
                                                        </form>
                                                        @endif
                                                    </td>
                                                    @if($p->status == 2)
                                                    <td>
                                                        <form action="{{ url('selesai', $p->pesanan_id) }}" method="get" id="confirm{{  $p->pesanan_id }}" onsubmit="selesai({{  $p->pesanan_id }}); return false;">
                                                            @csrf
                                                            <button type="submit" class="btn btn-success">
                                                                <i class="fas fa-check"></i>
                                                                Selesaikan
                                                            </button>
                                                        </form>
                                                    </td>
                                                    @elseif($p->status == 5)
                                                    <td>
                                                        <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#modalbatalpesan">
                                                            <i class="fas fa-check mr-2"></i>Terima Pengajuan
                                                        </button>

                                                        <form action="{{ url('antarpesanan', $p->pesanan_id) }}" method="get" id="confirm{{  $p->pesanan_id }}" onsubmit="tolakajuan({{  $p->pesanan_id }}); return false;">
                                                            <button type="submit" class="btn btn-danger mt-2 ">
                                                                <i class="fas fa-times mr-2"></i>Tolak Pengajuan
                                                            </button>
                                                        </form>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="modalbatalpesan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title text-black" id="exampleModalLabel">Masukkan Pesan</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="{{ url('batalpesanan') }}/{{ $p->pesanan_id }}" method="post">
                                                                            @csrf
                                                                            <label for="ket" class="text-black">Kirim pesan untuk pelanggan agar mereka tau kenapa pesanannya dibatalkan</label>
                                                                            <input readonly id="ket" class="form-control mb-3" name="keterangan" value="Pengajuan telah dikonfirmasi admin" type="text" required>
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                                            <button type="submit" class="btn btn-success">Terima pembatalan pesanan</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    @endif
                                                </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                        @else
                                        <div class="d-flex justify-content-center">
                                            <h4><strong>Belum ada pesanan terbaru</strong></h4>
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <img src="{{ url('img/3973481.jpg') }}" width="75%" alt="Belum ada produk">
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- End of Main Content -->

                        </div>
                        <!-- End of Content Wrapper -->



                    </div>

                    <!-- End of Page Wrapper -->

                    <!-- Scroll to Top Button-->
                    <a class="scroll-to-top rounded" href="#page-top">
                        <i class="fas fa-angle-up"></i>
                    </a>

                    <!-- Logout Modal-->
                    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Yakin Logout?</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">Pastikan semua pekerjaan telah selesai</div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                    <a class="btn btn-primary" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bootstrap core JavaScript-->
                    <script src="vendor/jquery/jquery.min.js"></script>
                    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

                    <!-- Core plugin JavaScript-->
                    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

                    <!-- Custom scripts for all pages-->
                    <script src="js/sb-admin-2.min.js"></script>

                    <!-- Page level plugins -->
                    <script src="vendor/chart.js/Chart.min.js"></script>

                    <!-- Page level custom scripts -->
                    <script src="js/demo/chart-area-demo.js"></script>
                    <script src="js/demo/chart-pie-demo.js"></script>
                    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
                    @include('sweet::alert')

                    <!-- konfirmasi antar pesanan -->
                    <script>
                        function konfirmasi(pesanan_id) {
                            var idDel = "confirm" + pesanan_id
                            swal({
                                title: 'Kirim Pesanan?',
                                text: 'Pastikan pesanan telah siap antar !',
                                icon: 'warning',
                                buttons: ["Batal", "Konfirmasi"],
                            }).then(function(value) {
                                if (value == true) {
                                    document.getElementById(idDel).submit();
                                }
                                return false
                            });
                        }
                    </script>
                    <!-- akhir konfirmasi antar pesanan -->


                    <!-- konfirmasi antar pesanan -->
                    <script>
                        function selesai(pesanan_id) {
                            var idDel = "confirm" + pesanan_id
                            swal({
                                title: 'Selesaikan Pesanan?',
                                text: 'Pastikan pesanan telah ada di tangan pelanggan !',
                                icon: 'warning',
                                buttons: ["Batal", "Konfirmasi"],
                            }).then(function(value) {
                                if (value == true) {
                                    document.getElementById(idDel).submit();
                                }
                                return false
                            });
                        }
                    </script>
                    <!-- akhir konfirmasi antar pesanan -->

                    <!-- konfirmasi hapus pesanan -->
                    <script>
                        function hapusConfirm(detail_id) {
                            var idDel = "deleteForm" + detail_id
                            swal({
                                title: 'Batalkan Pesanan?',
                                text: 'Kamu yakin ingin membatalkan pesanan ini?',
                                icon: 'warning',
                                buttons: ["Batal", "Batalkan"],
                            }).then(function(value) {
                                if (value == true) {
                                    document.getElementById(idDel).submit();
                                }
                                return false
                            });
                        }
                    </script>
                    <!-- akhir konfirmasi hapus pesanan -->

                    <!-- konfirmasi antar pesanan -->
                    <script>
                        function tolakajuan(pesanan_id) {
                            var idDel = "confirm" + pesanan_id
                            swal({
                                title: 'Tolak Pengajuan Pembatalan?',
                                text: 'Dengan ini maka pesanan akan dianggap telah dikirim !',
                                icon: 'warning',
                                buttons: ["Batal", "Konfirmasi"],
                            }).then(function(value) {
                                if (value == true) {
                                    document.getElementById(idDel).submit();
                                }
                                return false
                            });
                        }
                    </script>
                    <!-- akhir konfirmasi antar pesanan -->
                </div>
            </div>

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; E-Fazastore 2022</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>

    </div>
</body>

</html>