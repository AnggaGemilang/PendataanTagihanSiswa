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
            <li>Kolom "Untuk Siswa Kelas" berfungsi untuk menentukan tujuan tagihan akan diberlakukan untuk siswa kelas
                berapa</li>
            <li>Contoh: ketika menambahkan tagihan "Uang PKL" maka pilih option kelas 12 pada kolom Untuk Siswa Kelas
            </li>
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

        <form id="form-tambah-tagihan" @if($status=='tambah' ) action="" @else
            action="{{ url('data/tipetagihan/perbaharui/' . $tipetagihan->slug . '/store') }}" @endif method="post">

            {{ csrf_field() }}

            <div class="row m-3 mt-4 pt-2">
                <div class="form-group w-100">
                    <label for="nama_tagihan" @if($status=="tambah" ) data-idtipetagihan="{{ $last_id->id+1 }}" @endif
                        id="label_tipetagihan_id">Nama Jenis Tagihan</label>
                    <input type="text" class="form-control greylight-bg" name="nama_tagihan" id="nama_tagihan"
                        aria-describedby="helpId" placeholder="Masukkan Nama Jenis Tagihan" @if($status=='update' )
                        value="{{ $tipetagihan->nama_tagihan }}" @endif
                        style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);">
                </div>
            </div>

            <div class="row m-3">
                <div class="form-group w-100">
                    <label for="nominal">Nominal Biaya</label>
                    <div class="nominal position-relative">
                        <span class="position-absolute" style="left: 13px; top: 5.5px;">Rp.</span>
                        <input type="text"  name="nominal" id="nominal"
                            aria-describedby="helpId" placeholder="Masukkan Nominal Pembayaran" @if($status=='update' )
                            value="{{ $tipetagihan->nominal }}" class="form-control greylight-bg uangs" @else class="form-control greylight-bg" @endif
                            style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1); padding-left: 45px; padding-top: 3.5px; font-size: 16px;">
                    </div>
                </div>
            </div>

            @if($status=="tambah")
            <div class="row m-3">
                <div class="form-group w-100 mb-2">
                    <label for="id_kelas">Untuk Siswa Kelas</label><br>
                    <select class="select-move" id="tipekelas" name="tipekelas[]" multiple>
                        @foreach ($tipekelas as $tp)
                        <option value="{{ $tp->id }}">{{ $tp->nama_tipekelas }} ({{ $tp->desc }})</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @endif

            <div class="row m-3 pb-4 pt-2">
                <button type="submit" class="btn w-100 text-light"
                    style="background: #24143F !important;">@if($status=='tambah')Tambah Jenis
                    Tagihan @else Perbaharui Jenis Tagihan @endif<i class="fas fa-save pl-2"></i></button>
            </div>
        </form>

    </div>
</div>

@include('partials.footer')
@endsection

@push('extras-js')
<script>
    $(document).ready(function(){
        var value = $('.uangs').val();
        $('.uangs').val(formatRupiah(value));
    });

    var nominal = document.getElementById('nominal');
    nominal.addEventListener('keyup', function (e) {
        nominal.value = formatRupiah(this.value);
        console.log(nominal.value = formatRupiah(this.value));
    });

    function formatRupiah(angka) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return rupiah;
    }


    $('#form-tambah-tagihan').submit(function (e) {
        if ($('#tipekelas').val() == '') {
            e.preventDefault();
            toastr.error("Mohon Lengkapi Form!", "Gagal Menambahkan Data", {
                "showMethod": "slideDown",
                "hideMethod": "slideUp",
                timeOut: 3000
            });
            return false;
        }
    });

    $('#tipekelas').on('change', function () {
        var kelas_id = $(this).val();
        var tipetagihanid = $("#label_tipetagihan_id").data('idtipetagihan');
        $('#form-tambah-tagihan').attr("action", "tambah/store/" + kelas_id + "/" + tipetagihanid);
    });
</script>
@endpush