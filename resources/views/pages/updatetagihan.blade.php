@extends('layouts.layout')
@section('title','Perbaharui Tagihan')

@section('content')

<div id="main-content">
    <h1>Perbaharui Tagihan</h1>
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{url('/')}}">Beranda</a>
        <a class="breadcrumb-item" href="{{url('data/tagihan/')}}">Data Jenis Tagihan</a>
        <a class="breadcrumb-item" href="{{url('data/tagihan/perbaharui/' . $tagihan->id  )}}">Perbaharui
            Tagihan</a>
        <span class="breadcrumb-item active"></span>
    </nav>

    <div style="background: #EDE6F7; border-radius: 20px;" class="p-2 mt-4">
        <p class="mb-1 ml-2 pl-1 mt-2 text-dark" style="font-weight: 500;">Hal Yang Harus Diperhatikan</p>
        <ol style="opacity: 0.7;">
            <li>Petugas hanya dapat mengubah data "sudah dibayar" dari suatu tagihan</li>
            <li>Fitur ini harap digunakan hany dalam keadaan terdesak saja</li>
            <li>Contohnya seperti ketika petugas salah input pembayaran siswa</li>
            <li>Jangan gunakan fitur ini ketika tidak terdesak</li>
        </ol>
    </div>

    <div class="col-md-12 mt-4 pb-2" style="background: #FFFFFF; box-shadow: 1px 1px 12px rgba(0,0,0,0.1);">
        <div class="row" style="background: #24143F !important; height: 65px; align-content: center;">
            <p class="text-light m-0 pl-4" style="font-weight: 500;">Perbaharui Tagihan</p>
        </div>

        <form id="form-tambah-tagihan" action="{{ url('data/tagihan/perbaharui/' . $tagihan->id  . '/store') }}" method="post">

            {{ csrf_field() }}

            <div class="row m-3 mt-4 pt-2">
                <div class="form-group w-100">
                    <label for="sudah_dibayar">Sudah Dibayar</label>
                    <input type="number" class="form-control greylight-bg" name="sudah_dibayar" id="sudah_dibayar" required="required"
                        placeholder="Masukkan Jumlah Sudah Dibayar" @if($status=="update") value="{{ $tagihan->sudah_dibayar }}" @endif value="{{ old('sudah_dibayar') }}"
                        style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);">
                </div>
            </div>

            <div class="row m-3 pb-4 pt-2">
                <button type="submit" class="btn w-100 text-light" style="background: #24143F !important;">Perbaharui Tagihan<i class="fas fa-save pl-2"></i></button>
            </div>
        </form>

    </div>
</div>
@include('partials.footer')
@endsection