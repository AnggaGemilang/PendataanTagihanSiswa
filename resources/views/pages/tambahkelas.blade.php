@extends('layouts.layout')

@if ($status=='tambah')
@section('title','Tambah Kelas')
@else
@section('title','Perbaharui Kelas')
@endif

@section('content')

<div id="main-content">
    @if ($status=='tambah')
    <h1>Tambah Kelas</h1>
    @else
    <h1>Perbaharui Kelas</h1>
    @endif
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{url('/')}}">Beranda</a>
        <a class="breadcrumb-item" href="{{url('data/kelas/')}}">Data Kelas</a>
        @if ($status=='tambah')
        <a class="breadcrumb-item" href="{{url('data/kelas/tambah')}}">Tambah Kelas</a>
        @else
        <a class="breadcrumb-item" href="{{url('data/kelas/perbaharui/' . $kelas->slug )}}">Perbaharui Kelas</a>
        <a class="breadcrumb-item" href="{{url('data/kelas/perbaharui/' . $kelas->slug )}}">{{$kelas->nama_kelas}}</a>
        @endif
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

    <div class="col-md-12 mt-4 pb-2" style="background: #FFFFFF; box-shadow: 1px 1px 12px rgba(0,0,0,0.1);">
        <div class="row" style="background: #1A9B96 !important; height: 65px; align-content: center;">
            @if ($status=='tambah')
            <p class="text-light m-0 pl-4" style="font-weight: 500;">Tambah Data Kelas</p>
            @else
            <p class="text-light m-0 pl-4" style="font-weight: 500;">Perbaharui Data Kelas</p>
            @endif
        </div>

    <form @if($status=="tambah") action="{{ url('/data/kelas/tambah/store') }}" @else action="{{ url('/data/kelas/perbaharui/' . $kelas->slug . '/store') }}" @endif method="POST">

        {{ csrf_field() }}

            <div class="row m-3 mt-4 pt-2">
                <div class="form-group w-100">
                    <label for="nama_kelas">Nama Kelas</label>
                    <input type="text" class="form-control greylight-bg" name="nama_kelas" id="nama_kelas" aria-describedby="helpId"
                        placeholder="Masukkan Nama Kelas" @if($status=='update' ) value="{{$kelas->nama_kelas}}" @endif
                        style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);">
                </div>
            </div>

            <div class="row m-3">
                <div class="form-group w-100">
                    <label for="jurusan">Jurusan</label>
                    <input type="text" class="form-control greylight-bg" name="jurusan" id="jurusan" aria-describedby="helpId"
                        placeholder="Masukkan Jurusan Kelas" @if($status=='update' ) value="{{$kelas->jurusan}}" @endif
                        style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);">
                </div>
            </div>

            <div class="row m-3">
                <div class="form-group w-100">
                    <label for="wali_kelas">Wali Kelas</label>
                    <input type="text" class="form-control greylight-bg" name="wali_kelas" id="wali_kelas" aria-describedby="helpId"
                        placeholder="Masukkan Nama Wali Kelas" @if($status=='update' ) value="{{$kelas->wali_kelas}}"
                        @endif style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);">
                </div>
            </div>

            <div class="row m-3 pb-4 pt-2">
                <button type="submit" class="btn w-100 text-light" style="background: #1A9B96 !important;">
                    @if ($status=='tambah')
                    Tambah Kelas
                    @else
                    Perbaharui Kelas
                    @endif
                </button>
            </div>
        </form>

    </div>
</div>

@include('partials.footer')
@endsection