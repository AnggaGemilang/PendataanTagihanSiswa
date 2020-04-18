@extends('layouts.layout')
@section('title','Entri Pembayaran')

@section('content')
<div id="main-content">
    <h1>Entri Pembayaran</h1>
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{url('/')}}">Beranda</a>
        <a class="breadcrumb-item" href="{{url('pembayaran/entripembayaran')}}">Tambah Pembayaran</a>
        <span class="breadcrumb-item active"></span>
    </nav>

    <div style="background: #EDE6F7; border-radius: 20px;" class="p-2 mt-4">
        <p class="mb-1 ml-2 pl-1 mt-2 text-dark" style="font-weight: 500;">Hal Yang Harus Diperhatikan</p>
        <ol style="opacity: 0.7;">
            <li>Form input dibawah saling berkaitan</li>
            <li>Jika anda memilih, hasilnya akan berbeda antara satu sama lain</li>
            <li>Tagihan tidak akan bisa diklik ketika sudah lunas</li>
            <li>Pastikan data yang ditambahkan sudah valid</li>
            <li>Sistem akan mengakumulasi secara otomatis hasil entri pembayaran</li>
        </ol>
    </div>

    <div class="col-md-12 mt-4 pb-2 mb-3" style="background: #FFFFFF; box-shadow: 1px 1px 12px rgba(0,0,0,0.1);">
        <div class="row" style="background: #241937 !important; height: 65px; align-content: center;">
            <p class="text-light m-0 pl-4" style="font-weight: 500;">Entri Pembayaran Tagihan</p>
        </div>

        <form action="{{ url('pembayaran/entripembayaran/store') }}" method="post" id="form-submit">

            {{ csrf_field() }}

            <div class="row m-3 mt-4 pt-1">
                <div class="form-group w-100">
                    <label for="kelas_id">Kelas</label>
                    <select name="kelas_id" id="kelas_id" class="form-control greylight-bg w-100 pl-2"
                        style="height: 37px; border: none; border-radius: 7px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);">
                        <option value="">Pilih Kelas</option>
                        @foreach($kelas as $k)
                        <option value="{{ $k->id }}">
                            {{ $k->nama_kelas }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row m-3">
                <div class="form-group w-100">
                    <label for="siswa_id">Siswa</label>
                    <select name="siswa_id" id="siswa_id" class="form-control greylight-bg w-100 pl-2"
                        style="height: 37px; border: none; border-radius: 7px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);">
                        <option value="">Pilih Siswa</option>
                        <div class="wrapper-option"></div>
                    </select>
                </div>
            </div>

            <div class="row m-3">
                <div class="form-group w-100">
                    <label for="tagihan_id">Jenis Tagihan</label>
                    <select name="tagihan_id" id="tagihan_id" class="form-control greylight-bg w-100 pl-2"
                        style="height: 37px; border: none; border-radius: 7px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);">
                        <option value="">Pilih Pembayaran</option>
                    </select>
                </div>
            </div>

            <div class="row m-3">
                <div class="form-group w-100">
                    <label for="nominal">Nominal</label>
                    <div class="nominal position-relative">
                        <span class="position-absolute" style="left: 13px; top: 5.5px;">Rp.</span>
                        <input type="text" class="form-control greylight-bg" name="nominal" id="nominal"
                            aria-describedby="helpId" placeholder="Masukkan Nominal Pembayaran"
                            style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1); padding-left: 45px; padding-top: 3.5px; font-size: 16px;">
                    </div>
                </div>
                <p id="sisa_tagihan_pembayaran"></p>
            </div>

            <div class="row m-3 pb-4 pt-2 position-relative">
                <button type="submit" class="btn w-100 text-light" id="btn-submit" onclick="show()" style="background: #241937 !important; transition: all .3s;">Tambah
                    Pembayaran <i class="fas fa-save pl-2"></i></button>
                <img src="{{ asset('assets') }}/images/loader.gif" alt="" class="loader" style="display: none;">
            </div>
        </form>

    </div>
</div>

@include('partials.footer')
@endsection

@push('extras-css')
<style>
    @media (max-width: 1128px) {
        .col-md-12.mt-4 {
            margin-bottom: 0px !important;
        }
    }
</style>
@endpush

@push('extras-js')
<script>
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

    $('#kelas_id').on('change', function () {
        if ($(this).val() != '') {
            console.log('kelas_id');
            var kelas_id = $(this).children("option:selected").val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "entripembayaran/" + kelas_id + "/getsiswa",
                method: "GET",
                data: {
                    kelas_id: kelas_id,
                    _token: _token,
                },
                success: function (result) {
                    console.log(result);
                    $('#siswa_id').html(result);
                }
            })
        }
    });

    $('#siswa_id').on('change', function () {
        if ($(this).val() != '') {
            console.log('siswa_id');
            var siswa_id = $(this).children("option:selected").val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "entripembayaran/" + siswa_id + "/getTagihan",
                method: "GET",
                data: {
                    siswa_id: siswa_id,
                    _token: _token,
                },
                success: function (result) {
                    console.log(result);
                    $('#tagihan_id').html(result);
                }
            })
        }
    });

    $('#tagihan_id').on('change', function () {
        var sisa_tagihan = conventer($(this).find(':selected').data('sisa'));
        var output = "<p style='font-size: 15px; margin-bottom: -10px !important;'>Sisa Tagihan : " +
            sisa_tagihan + "</p>";
        $('#sisa_tagihan_pembayaran').html(output);
    });
</script>
@endpush