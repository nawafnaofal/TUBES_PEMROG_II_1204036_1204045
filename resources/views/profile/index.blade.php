@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="{{ url('home') }}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="col-md-12 mt-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                </ol>
            </nav>
        </div>

        <!-- Profile -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4><i class="fa fa-user"></i> My Profile</h4>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td><strong>Nama</strong></td>
                                <td width="5">:</td>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Email</strong></td>
                                <td>:</td>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <td><strong>No HP</strong></td>
                                <td>:</td>
                                <td>{{ $user->no_hp }}</td>
                            </tr>
                            <tr>
                                <td><strong>Alamat</strong></td>
                                <td>:</td>
                                <td>{{ $user->alamat }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Profile -->

            <!-- edit Profile -->
            <div class="col-md-12 mt-2">
                <div class="card mb-3">
                    <div class="card-body">
                        <h4><i class="fa fa-pencil-alt mb-3"></i> Edit Profile</h4>
                        <form method="POST" action="{{ url('profile') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-2 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="no_hp" class="col-md-2 col-form-label text-md-right">No. HP</label>

                                <div class="col-md-6">
                                    <input id="no_hp" type="number" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" value="{{ $user->no_hp }}" required autocomplete="no_hp" autofocus>

                                    @error('no_hp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="alamat" class="col-md-2 col-form-label text-md-right">Alamat</label>

                                <div class="col-md-6">
                                    <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" required="">{{ $user->alamat }}</textarea>

                                    @error('alamat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-2 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-2 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-2">
                                    <button type="submit" class="btn btn-primary">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- edit Profile -->

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