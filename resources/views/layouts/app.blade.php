<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="">
                    <img src="{{ url('logo/logo.png') }}" width="200" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        <!--End Authentication Links -->

                        @else
                        <li class="nav-item">
                            <?php
                            if (Auth::user()) {
                                $pesanan_utama = \App\Pesanan::where('user_id', Auth::user()->user_id)->where('status', 0)->first();
                                if (!empty($pesanan_utama)) {
                                    $notif = \App\PesananDetail::where('pesanan_id', $pesanan_utama->pesanan_id)->count();
                                }
                            }
                            ?>
                            <a class="nav-link" href="{{ url('check-out') }}"><i class="fa fa-shopping-cart"></i>
                                @if(!empty($notif))
                                <span class="badge badge-pill badge-danger">{{ $notif }}</span>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item" href="{{ url('profile') }}">
                                    <i class="fa fa-user mr-2"></i>
                                    Profile
                                </a>

                                <a class="dropdown-item" href="{{ url('history') }}">
                                    <i class="fa fa-shopping-bag mr-2"></i>
                                    Pesanan Saya
                                </a>
                                <hr>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="fa fa-power-off mr-2"></i>
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @include('sweet::alert')

    <!-- konfirmasi checkout -->
    <script>
        function checkConfirm(user_id) {
            var idDel = "checkForm" + user_id
            swal({
                title: 'Lanjut Checkout?',
                text: 'Dengan checkout, kamu dianggap akan membeli barang',
                icon: 'warning',
                buttons: ["Batal", "Check Out"],
            }).then(function(value) {
                if (value == true) {
                    document.getElementById(idDel).submit();
                }
                return false
            });
        }
    </script>
    <!-- akhir konfirmasi checkout -->

    <script>
        $(function() {
            $('.pop').on('click', function() {
                $('.imagepreview').attr('src', $(this).find('img').attr('src'));
                $('#imagemodal').modal('show');
            });
        });
    </script>

    <!-- konfirmasi hapus keranjang -->
    <script>
        function hapusConfirm(detail_id) {
            var idDel = "deleteForm" + detail_id
            swal({
                title: 'Hapus Pesanan?',
                text: 'Kamu yakin ingin menghapus pesanan ini dari keranjang?',
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
    <!-- akhir konfirmasi hapus keranjang -->

    <!-- konfirmasi pesanan sampai -->
    <script>
        function konfirmasi(pesanan_id) {
            var idDel = "confirm" + pesanan_id
            swal({
                title: 'Pesanan sudah sampai?',
                text: 'Pastikan pesanan sudah ditangan kamu !',
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
    <!-- akhir konfirmasi pesanan sampai -->

    <script>
        function cekjumlahpesanan() {
            var jumlah_pesan = document.getElementById('jumlah_pesan').value;
            var stok = document.getElementById('stok').innerHTML;

            if (jumlah_pesan > 0) {
                if (jumlah_pesan > Number(stok)) {
                    swal("Ups", "Stok kurang dari jumlah yang kamu pesan!", 'warning');
                    return false;
                }
                console.log("Jalan true")
                return true;
            } else {
                console.log("Jalan false")
                swal("Ups", "Harap masukkan jumlah pesanan dengan benar!", 'warning');
                return false;
            }

        }
    </script>

    <!-- konfirmasi batal pesanan -->
    <script>
        function batal(pesanan_id) {
            var idDel = "confirm" + pesanan_id
            swal({
                title: 'Ajukan Pembatalan Pesanan?',
                text: 'Kamu harus menunggu konfirmasi admin untuk membatalkan pesanan ini !',
                icon: 'warning',
                buttons: ["Tutup", "Batalkan Pesanan"],
            }).then(function(value) {
                if (value == true) {
                    document.getElementById(idDel).submit();
                }
                return false
            });
        }
    </script>
    <!-- akhir konfirmasi batal pesanan -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


</body>

</html>