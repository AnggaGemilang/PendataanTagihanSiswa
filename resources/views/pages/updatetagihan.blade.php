@extends('layouts.layout')
@section('title','Perbaharui Tagihan')

@section('content')

<div id="main-content">
    <h1>Perbaharui Tagihan {{ $tagihan->siswa->nama_siswa }}</h1>
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{url('/')}}">Beranda</a>
        <a class="breadcrumb-item" href="{{url('data/tipetagihan/detail/' . $tagihan->tipetagihan->slug . '/' . $tagihan->tipetagihan->id )}}">Data Jenis Tagihan</a>
        <a class="breadcrumb-item" href="{{url('data/tagihan/perbaharui/' . $tagihan->id  )}}">Perbaharui
            Tagihan</a>
        <a class="breadcrumb-item" href="{{url('data/tagihan/perbaharui/' . $tagihan->id  )}}">{{ $tagihan->tipetagihan->nama_tagihan }}</a>
        <a class="breadcrumb-item" href="{{url('data/tagihan/perbaharui/' . $tagihan->id  )}}">{{ $tagihan->siswa->nama_siswa }}</a>
        <span class="breadcrumb-item active"></span>
    </nav>

    <div style="background: #EDE6F7; border-radius: 20px;" class="p-2 mt-4">
        <p class="mb-1 ml-2 pl-1 mt-2 text-dark" style="font-weight: 500;">Hal Yang Harus Diperhatikan</p>
        <ol style="opacity: 0.7;">
            <li>Petugas hanya dapat mengubah data "sudah dibayar" dari suatu tagihan</li>
            <li>Jangan gunakan fitur ini ketika tidak terdesak</li>
            <li>Harap gunakan fitur ini hanya dalam keadaan terdesak saja</li>
            <li>Contohnya seperti ketika petugas salah input pembayaran siswa</li>
        </ol>
    </div>

    <div class="col-md-12 mt-4 pb-2" style="background: #FFFFFF; box-shadow: 1px 1px 12px rgba(0,0,0,0.1);">
        <div class="row" style="background: #241937 !important; height: 65px; align-content: center;">
            <p class="text-light m-0 pl-4" style="font-weight: 500;">Perbaharui Tagihan</p>
        </div>

        <form action="{{ url('data/tagihan/perbaharui/' . $tagihan->id  . '/store') }}" method="post" id="form-submit">

            {{ csrf_field() }}

            <div class="row m-3 mt-4 pt-2">
                <div class="form-group w-100">
                    <label for="sudah_dibayar">Sudah Dibayar</label>
                    <div class="nominal position-relative">
                        <span class="position-absolute" style="left: 13px; top: 5.5px;">Rp.</span>
                        <input type="text" class="form-control greylight-bg uangs" id="nominal" name="sudah_dibayar"
                            id="sudah_dibayar" required="required" placeholder="Masukkan Jumlah Sudah Dibayar"
                            @if($status=="update" ) value="{{ $tagihan->sudah_dibayar }}" @endif
                            value="{{ old('sudah_dibayar') }}"
                            style="border: none; border-radius: 8px; padding-left: 45px; padding-top: 3.5px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);">
                    </div>
                </div>
                <div class="mb-2">
                    <p id="sisa_tagihan_pembayaran" style="font-size: 15px; margin-bottom: -1px !important">Sisa Tagihan : Rp. {{ number_format(($tagihan->tipetagihan->nominal - $tagihan->sudah_dibayar),0,'.','.') }}</p>
                </div>
            </div>

            <div class="row m-3 pb-4 pt-2 position-relative">
                <button type="submit" class="btn w-100 text-light"
                    style="background: #241937 !important; transition: all .3s;" id="btn-submit"
                    onclick="show()">Perbaharui Tagihan<i class="fas fa-save pl-2"></i></button>
                <img src="{{ asset('assets') }}/images/loader.gif" alt="" class="loader" style="display: none;">
            </div>
        </form>

    </div>
</div>
@include('partials.footer')
@endsection

@push('extras-js')
<script>
    $(document).ready(function () {
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
</script>
@endpush