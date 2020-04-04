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

    <div style="background: #E5F3F3; border-radius: 20px;" class="p-2 mt-4">
        <p class="mb-1 ml-2 pl-1 mt-2 text-dark" style="font-weight: 500;">Cara Mengentri Pembayaran</p>
        <ol style="opacity: 0.7;">
            <li>Pilih Dahulu Kelas Siswa Yang Ingin Dientri</li>
            <li>Pilih Nama Siswa Terkait</li>
            <li>Pilih Jenis Tagihan Yang Akan Dibayarkan</li>
            <li>Masukkan Nominal Uang Yang Akan Siswa Bayarkan</li>
            <li>Submit Pembayaran Dan Data Tagihan Akan Otomatis Terakumulasi</li>
        </ol>
    </div>

    <div class="col-md-12 mt-4 pb-2" style="background: #FFFFFF; box-shadow: 1px 1px 12px rgba(0,0,0,0.1);">
        <div class="row" style="background: #1A9B96 !important; height: 65px; align-content: center;">
            <p class="text-light m-0 pl-4" style="font-weight: 500;">Entri Pembayaran Tagihan</p>
        </div>

        <form action="{{ url('pembayaran/entripembayaran/store') }}" method="post">

            {{ csrf_field() }}
    
            <div class="row m-3 mt-4 pt-1">
                <div class="form-group w-100">
                    <label for="kelas_id">Kelas</label>
                    <select name="kelas_id" id="kelas_id" class="form-control greylight-bg w-100 pl-2"
                        style="height: 37px; border: none; border-radius: 7px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);">
                        <option value="">Pilih Kelas</option>
                        @foreach($kelas as $k)
                        <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
    
            <div class="row m-3">
                <div class="form-group w-100">
                    <label for="nama_siswa">Siswa</label>
                    <select name="nama_siswa" id="nama_siswa" class="form-control greylight-bg w-100 pl-2"
                        style="height: 37px; border: none; border-radius: 7px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);">
                        <option value="">Pilih Siswa</option>
                        <div class="wrapper-option"></div>
                    </select>
                </div>
            </div>

            <div class="row m-3">
                <div class="form-group w-100">
                    <label for="jenis_pembayaran">Jenis Pembayaran</label>
                    <select name="jenis_pembayaran" id="jenis_pembayaran" class="form-control greylight-bg w-100 pl-2"
                        style="height: 37px; border: none; border-radius: 7px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);">
                        <option value="">Pilih Pembayaran</option>
                    </select>
                </div>
            </div>
     
            <div class="row m-3">
                <div class="form-group w-100">
                    <label for="nominal">Nominal</label>
                    <input type="text" class="form-control greylight-bg" name="nominal" id="nominal" aria-describedby="helpId"
                        placeholder="Masukkan Nominal Pembayaran"
                        style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);">
                </div>
            </div>
    
            <div class="row m-3 pb-4 pt-2">
                <button type="submit" class="btn w-100 text-light" style="background: #1A9B96 !important;">Tambah
                    Pembayaran</button>
            </div>
        </form>

    </div>
</div>

@include('partials.footer')
@endsection

@push('extras-js')
<script>
    $('#kelas_id').on('change', function(){
        if($(this).val() != ''){
            var kelas_id = $(this).children("option:selected").val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "entripembayaran/" + kelas_id + "/getsiswa",
                method: "GET",
                data: {
                    kelas_id:kelas_id,
                    _token:_token,
                },
                success:function(result)
                {
                    console.log(result);
                    $('#nama_siswa').html(result);
                }
            })
        }
    });

    $('#nama_siswa').on('change', function(){
        if($(this).val() != ''){
            var siswa_id = $(this).children("option:selected").val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "entripembayaran/" + siswa_id + "/getTagihan",
                method: "GET",
                data: {
                    siswa_id:siswa_id,
                    _token:_token,
                },
                success:function(result)
                {
                    console.log(result);
                    $('#jenis_pembayaran').html(result);
                }
            })
        }
    });
</script>
@endpush