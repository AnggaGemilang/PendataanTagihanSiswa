@extends('layouts.layout')
@section('title','Ubah Password')

@section('content')

<div id="main-content">
    <h1>Ubah Password</h1>
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{url('/')}}">Beranda</a>
        <a class="breadcrumb-item" href="{{url('ubahpassword')}}">Ubah Password</a>
        <span class="breadcrumb-item active"></span>
    </nav>

    <div style="background: #E5F3F3; border-radius: 20px;" class="p-2 mt-4">
        <p class="mb-1 ml-2 pl-1 mt-2 text-dark" style="font-weight: 500;">Cara Mengentri Pembayaran</p>
        <ol style="opacity: 0.7;">
            <li>Pertama, pilih terlebih dahulu jenis pembayaran</li>
            <li>Kemudian, pilih kelas siswa tersebut</li>
            <li>Lalu, pilih nama siswa yang ingin membayar</li>
            <li>Masukkan nominal uang yang akan siswa bayar</li>
            <li>Terakhir, submit pembayaran dan data akan otomatis terupdate</li>
        </ol>
    </div>

    <div class="col-md-12 mt-4" style="background: white; box-shadow: 1px 1px 12px rgba(0,0,0,0.1);">
        <div class="row" style="background: #1A9B96 !important; height: 65px; align-content: center;">
            <p class="text-light m-0 pl-4" style="font-weight: 500;">Ubah Password</p>
        </div>
        <div class="row m-3 mt-4">
            <div class="form-group w-100 position-relative">
                <label for="password">Password Lama</label>
                <input type="password" class="form-pwd form-control greylight-bg" name="password" id="password"
                    aria-describedby="helpId" placeholder="Masukkan Password Lama Anda"
                    style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);">
                <button class="btn-eye"><i class="fas fa-eye" style="color: #6C757D;"></i></button>
            </div>
        </div>

        <div class="row m-3">
            <div class="form-group w-100 position-relative">
                <label for="password">Password Baru</label>
                <input type="password" class="form-pwd form-control greylight-bg" name="password" id="password"
                    aria-describedby="helpId" placeholder="Masukkan Password Baru Anda"
                    style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);">
                <button class="btn-eye"><i class="fas fa-eye" style="color: #6C757D;"></i></button>
            </div>
        </div>

        <div class="row m-3">
            <div class="form-group w-100 position-relative">
                <label for="password">Konfirmasi Password</label>
                <input type="password" class="form-pwd form-control greylight-bg" name="password" id="password"
                    aria-describedby="helpId" placeholder="Konfirmasi Password Baru Anda"
                    style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);">
                <button class="btn-eye"><i class="fas fa-eye" style="color: #6C757D;"></i></button>
            </div>
        </div>

        <div class="row m-3" style="padding-bottom: 40px;">
            <button type="submit" class="btn w-100 text-light"
                style="background: #1A9B96 !important;">Ubah Password</button>
        </div>
    </div>

</div>

@include('partials.footer')
@endsection