@extends('layouts.app')
@section('title','Login')

@section('content')

<header class="masthead">
    <div class="container pt-5 text-white masthead-content">
        <div class="row align-items-content justify-content-center my-5">
            <div class="col-6 illustrasi-wrapper">
                <img src="{{ asset('assets') }}/auth/images/illustration-login.png" alt="">
            </div>
            <div class="col-6 pt-5 content-header" style="flex: 0 0 42%;">
                <div class="row m-2">
                    <h2 style="font-weight: 600; font-size: 32px;">Welcome</h2>
                </div>

                <div class="row" style="margin-left: 10px; margin-top: -10px;">
                    <h4>Sign In to Tagihan Sekolah</h4>
                </div>

                <form method="POST" action="{{ route('login') }}">

                    {{ csrf_field() }}

                    <div class="row m-2 mt-3 pt-2">
                        <div class="form-group w-100">
                            <label for="login">Email atau Nomor induk</label>
                            <input id="login" type="login" name="login" id="login" value="{{ old('email') }}" required @if ($errors->has('email')) class="is-invalid form-pwd form-control greylight-bg pl-4 mt-1" @endif
                                autocomplete="email" autofocus class="@error('email') is-invalid @enderror form-control greylight-bg pl-4 mt-1"
                                aria-describedby="helpId" placeholder="Masukkan Email atau Nomor induk" >
                        </div>
                    </div>

                    <div class="row m-2 mt-2 wrapper-password-field">
                        <div class="form-group w-100 position-relative">
                            <label for="pwd">Password</label>
                            <input id="password" type="password" name="password" required @if ($errors->has('nomor_induk')) class="is-invalid form-pwd form-control greylight-bg pl-4 mt-1" @endif
                                autocomplete="current-password" class="@error('password') is-invalid @enderror form-pwd form-control greylight-bg pl-4 mt-1"
                                aria-describedby="helpId" placeholder="Masukkan Password Siswa" >
                            <button class="btn-eye"><i class="fas fa-eye" style="color: #6C757D;"></i></button>
                        </div>
                    </div>

                    <div class="row m-2 mt-3 pb-4">
                        <button type="submit" class="btn w-100 text-light"
                            style="background: #1EB5AD; outline: #B0A1FF !important;">Login</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</header>
@endsection