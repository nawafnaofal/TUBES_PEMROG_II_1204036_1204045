<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="theme-color" content="#6A0079">

    <title>Register - E-Fazastore</title>

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
</head>

<body>
    <div class="page-content page-auth">
        <section class="section-store-auth" data-aos="fade-up">
            <div class="container">
                <div class="row align-items-center row-login">
                    <div class="col-lg-12">
                        <h2 class="mb-4">Kode Unik Verifikasi</h2>
                        <h4>Berikut ini adalah kode unik verifikasi untuk email {{ $email }}</h4>
                        <div class="form-group">
                            <label>Kode Unik Verifikasi</label>
                            <h1>{{ $code }}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <p class="pt-4 pb-2">Pendaftaran akun pelanggan e-fazastore</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="/vendor/jquery/jquery.slim.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script src="script/navbar-scroll.js"></script>
</body>

</html>