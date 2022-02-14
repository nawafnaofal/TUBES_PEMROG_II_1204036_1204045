@extends('layouts.app')

@section('content')
<div class="col-lg-12">
    @if(session()->has('message'))
    <div class="alert alert-{{ session()->get('alert-class') }} alert-dismissible fade show" role="alert">
        {{ session()->get('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <div class="container col-md-4">
        <div class="card">
            <div class="card-body">
                <h2 class="mb-4 text-center font-weight-bold">Verifikasi Email</h2>
                <form action="{{ route('verify') }}" method="post" class="mt-4 form-single-submit">
                    @csrf
                    <input type="hidden" name="name" value="{{ $registerData['name'] }}">
                    <input type="hidden" name="email" value="{{ $registerData['email'] }}">
                    <input type="hidden" name="no_hp" value="{{ $registerData['no_hp'] }}">
                    <input type="hidden" name="alamat" value="{{ $registerData['alamat'] }}">
                    <input type="hidden" name="password" value="{{ $registerData['password'] }}">

                    <div class="form-group">
                        <label>Masukkan kode unik</label>
                        <input type="number" class="form-control w-100" name="vercode" required>
                    </div>
                    <button type="submit" class="btn btn-warning text-black btn-block w-100 mt-4 single-submit">
                        Verifikasi
                    </button>
                </form>
            </div>

        </div>

    </div>

</div>
<!-- Footer -->
<footer class="footer footer-expand-md footer-light bg-white fixed-bottom text-center text-lg-start">

    <!-- Copyright -->
    <div class="text-center p-4">
        <span class="text-reset fw-bold">© 2022 Copyright: E-Fazastore</span>
    </div>
    <!-- Copyright -->
</footer>
<!-- Footer -->
@endsection