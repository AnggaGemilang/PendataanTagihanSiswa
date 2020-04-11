@extends('layouts.layout')

@if ($status=='tambah')
@section('title','Tambah Tagihan')
@else
@section('title','Perbaharui Tagihan')
@endif

@section('content')

<div id="main-content">
    @if ($status=='tambah')
    <h1>Tambah Jenis Tagihan</h1>
    @else
    <h1>Perbaharui Jenis Tagihan</h1>
    @endif
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{url('/')}}">Beranda</a>
        <a class="breadcrumb-item" href="{{url('data/tipetagihan/')}}">Data Jenis Tagihan</a>
        @if ($status=='tambah')
        <a class="breadcrumb-item" href="{{url('data/tipetagihan/tambah')}}">Tambah Jenis Tagihan</a>
        @else
        <a class="breadcrumb-item" href="{{url('data/tipetagihan/perbaharui/' . $tipetagihan->slug )}}">Perbaharui
            Jenis Tagihan</a>
        <a class="breadcrumb-item"
            href="{{url('data/tipetagihan/perbaharui/' . $tipetagihan->slug )}}">{{ $tipetagihan->nama_tagihan }}</a>
        @endif
        <span class="breadcrumb-item active"></span>
    </nav>

    <div style="background: #EDE6F7; border-radius: 20px;" class="p-2 mt-4">
        <p class="mb-1 ml-2 pl-1 mt-2 text-dark" style="font-weight: 500;">Hal Yang Harus Diperhatikan</p>
        <ol style="opacity: 0.7;">
            <li>Pastikan data yang telah anda masukkan valid</li>
            <li>Tagihan wajib (SPP & uang bangunan) akan muncul otomatis ketika penambahkan data siswa</li>
            <li>Kolom "Untuk Siswa Kelas" berfungsi untuk menentukan tujuan tagihan akan diberlakukan untuk siswa kelas berapa</li>
            <li>Contoh: ketika menambahkan tagihan "Uang PKL" maka pilih option kelas 12 pada kolom Untuk Siswa Kelas</li>
            <li>Ketika semua data sudah terisi, maka klik tombol tambah tagihan</li>
        </ol>
    </div>

    <div class="col-md-12 mt-4 pb-2" style="background: #FFFFFF; box-shadow: 1px 1px 12px rgba(0,0,0,0.1);">
        <div class="row" style="background: #24143F !important; height: 65px; align-content: center;">
            @if($status=='tambah')
            <p class="text-light m-0 pl-4" style="font-weight: 500;">Tambah Data Jenis Tagihan</p>
            @else
            <p class="text-light m-0 pl-4" style="font-weight: 500;">Perbaharui Data Jenis Tagihan</p>
            @endif
        </div>

        <form id="form-tambah-tagihan" 
        @if($status=='tambah') 
        action="" 
        @else
        action="{{ url('data/tipetagihan/perbaharui/' . $tipetagihan->slug . '/store') }}" 
        @endif method="post">

            {{ csrf_field() }}

            <div class="row m-3 mt-4 pt-2">
                <div class="form-group w-100">
                    <label for="nama_tagihan" @if($status=="tambah" ) data-idtipetagihan="{{ $last_id->id+1 }}" @endif
                        id="label_tipetagihan_id">Nama Jenis Tagihan</label>
                    <input type="text" class="form-control greylight-bg" name="nama_tagihan" id="nama_tagihan" required="required"
                        aria-describedby="helpId" placeholder="Masukkan Nama Jenis Tagihan" @if($status=='update' )
                        value="{{ $tipetagihan->nama_tagihan }}" @endif
                        style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);">
                </div>
            </div>

            <div class="row m-3">
                <div class="form-group w-100">
                    <label for="nominal">Nominal Biaya</label>
                    <input type="text" class="form-control greylight-bg" name="nominal" id="nominal" required="required"
                        aria-describedby="helpId" placeholder="Masukkan Nominal Biaya " @if($status=='update' )
                        value="{{ $tipetagihan->nominal }}" @endif
                        style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);">
                </div>
            </div>

            @if($status=="tambah")
            <div class="row m-3">
                <div class="form-group w-100 mb-2">
                    <label for="id_kelas">Untuk Siswa Kelas</label><br>
                    <select class="select-move" id="tipekelas" name="tipekelas[]" multiple required="required">
                        @foreach ($tipekelas as $tp)
                        <option value="{{ $tp->id }}">{{ $tp->nama_tipekelas }} ({{ $tp->desc }})</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @endif

            <div class="row m-3 pb-4 pt-2">
                <button type="submit" class="btn w-100 text-light" style="background: #24143F !important;">@if($status=='tambah')Tambah Jenis
                    Tagihan @else Perbaharui Jenis Tagihan @endif<i class="fas fa-save pl-2"></i></button>
            </div>
        </form>

    </div>
</div>

@include('partials.footer')
@endsection

@push('extras-js')
<script>
    $('#tipekelas').on('change', function () {
        var kelas_id = $(this).val();
        var tipetagihanid = $("#label_tipetagihan_id").data('idtipetagihan');
        $('#form-tambah-tagihan').attr("action", "tambah/store/" + kelas_id + "/" + tipetagihanid);
    });
</script>
@endpush