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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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

                    <!-- Judul -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Data Barang</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif


                        <div class="col-md-3 mb-2">
                            <div class="card">

                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    <i class="fas fa-plus-square mr-3"></i>Tambah Data Barang
                                </button>

                                <!-- Modal tambah barang -->
                                <div class="modal fade text-black" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Barang</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <div class="container-fluid">
                                                <form action="{{ url('simpanbarang')}}" method="post" enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    <div class="modal-body">
                                                        <label for="inputState" class="form-label">Pilih Kategori Barang</label>
                                                        <select id="inputState" class="form-select" name="categories_id" required>
                                                            <option selected class="dropdown-item disabled"> --Pilih Kategori Barang-- </option>
                                                            @foreach($kategori as $k)
                                                            <option value="{{ $k->categories_id }}">{{ $k->nama}}</option>
                                                            @endforeach
                                                        </select>

                                                        <label for="nama" class="form-label mt-3">Nama Barang</label>
                                                        <input type="text" name="nama_barang" class="form-control text-black" id="nama" placeholder="Masukkan nama barang" required>

                                                        <label for="formFile" class="form-label mt-3">Pilih Gambar</label>
                                                        <input class="form-control" @error('gambar') is-invalid @enderror name="gambar" type="file" id="formFile" required>


                                                        <label for="harga" class="form-label mt-3">Harga</label>
                                                        <input type="number" name="harga" class="form-control text-black" id="harga" placeholder="Tentukan harga barang" required>

                                                        <label for="stok" class="form-label mt-3">Stok</label>
                                                        <input type="number" name="stok" class="form-control text-black" id="stok" placeholder="Masukkan jumlah stok barang" required>

                                                        <label for="exampleFormControlTextarea1" class="form-label mt-3">Deskripsi Barang</label>
                                                        <textarea name="keterangan" class="form-control" id="exampleFormControlTextarea1" rows="3" required></textarea>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Tambahkan</button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tabel barang -->
                        <div class="col-md-12">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr align="center">
                                                    <th>No.</th>
                                                    <th>Nama Barang</th>
                                                    <th>Gambar</th>
                                                    <th>Harga</th>
                                                    <th>Stok</th>
                                                    <th>Keterangan</th>
                                                    <th>Kategori</th>
                                                    <th>Edit</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(!empty($barangs))
                                                <?php $no = 1; ?>
                                                @foreach($barangs as $b)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $b->nama_barang }}</td>
                                                    <td><img width="100px" src="{{ url('uploads') }}/{{ $b -> gambar }}"></td>
                                                    <td>{{ number_format($b->harga)}}</td>
                                                    <td>
                                                        @if($b->stok == 0)
                                                        <div class="badge bg-danger text-white">Stok Habis</div>
                                                        @else
                                                        {{ number_format($b->stok) }}
                                                        @endif
                                                    </td>
                                                    <td>{{ $b->keterangan }}</td>
                                                    <td>{{ $b->category->nama }}</td>
                                                    <td align=" center">
                                                        <form action="{{ url('barang') }}/{{ $b->barang_id }}" method="post" id="deleteForm{{ $b->barang_id }}" onsubmit="hapusConfirm({{ $b->barang_id }}); return false;">
                                                            @csrf
                                                            {{ method_field('DELETE') }}
                                                            <button type="submit" class="btn btn-danger mb-1">
                                                                <i class=" fa fa-trash"></i>
                                                            </button>
                                                        </form>


                                                        <a href="{{ url('editbarang', $b->barang_id) }}" type="submit" class="btn btn-success">
                                                            <i class=" fas fa-edit"></i>
                                                        </a>

                                                    </td>
                                                </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
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
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

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

                <!-- konfirmasi hapus barang -->
                <script>
                    function hapusConfirm(barang_id) {
                        var idDel = "deleteForm" + barang_id
                        swal({
                            title: 'Hapus Barang?',
                            text: 'Kamu yakin ingin menghapus barang ini?',
                            icon: 'warning',
                            buttons: ["Batal", "Hapus"],
                        }).then(function(value) {
                            if (value == true) {
                                document.getElementById(idDel).submit();
                            }
                            return false
                        });
                    }
                </script>
                <!-- akhir konfirmasi hapus barang -->
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