@extends('layouts.layout')

@if ($status=='tambah')
@section('title','Tambah Siswa')
@else
@section('title','Perbaharui Siswa')
@endif

@section('content')

<div id="main-content">
    @if ($status=='tambah')
    <h1>Tambah Siswa</h1>
    @else
    <h1>Perbaharui Siswa</h1>
    @endif
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{url('/')}}">Beranda</a>
        <a class="breadcrumb-item" href="{{url('data/siswa/')}}">Data Siswa</a>
        @if ($status=='tambah')
        <a class="breadcrumb-item" href="{{url('data/siswa/tambah')}}">Tambah Siswa</a>
        @else
        <a class="breadcrumb-item" href="{{url('data/siswa/perbaharui/' . $siswa->slug )}}">Perbaharui Siswa</a>
        <a class="breadcrumb-item" href="{{url('data/siswa/perbaharui/' . $siswa->slug )}}">{{$siswa->nama_siswa}}</a>
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
            <p class="text-light m-0 pl-4" style="font-weight: 500;">Tambah Data Siswa</p>
            @else
            <p class="text-light m-0 pl-4" style="font-weight: 500;">Perbaharui Data Siswa</p>
            @endif
        </div>

        <form @if($status=='tambah') action="" id="form_tambah_siswa" @else
            action="{{url('data/siswa/perbaharui/' . $siswa->slug . '/store')}}" @endif method="POST"
            enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="row m-3 mt-4 pt-2">
                <div class="form-group w-100">
                    <label for="nisn">NISN</label>
                    <input type="number" class="form-control greylight-bg" name="nisn" id="nisn"
                        aria-describedby="helpId" placeholder="Masukkan NISN Siswa"
                        style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);"
                        @if($status=='update' ) value="{{ $siswa->nisn }}" @endif>
                </div>
            </div>

            <div class="row m-3">
                <div class="form-group w-100">
                    <label for="nis">NIS</label>
                    <input type="number" class="form-control greylight-bg" name="nis" id="nis" aria-describedby="helpId"
                        placeholder="Masukkan NIS Siswa"
                        style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);"
                        @if($status=='update' ) value="{{ $siswa->nis }}" @endif>
                </div>
            </div>

            <div class="row m-3">
                <div class="form-group w-100">
                    <label for="nama_siswa">Nama Lengkap</label>
                    <input type="text" class="form-control greylight-bg" name="nama_siswa" id="nama_siswa"
                        aria-describedby="helpId" placeholder="Masukkan Nama Lengkap Siswa"
                        style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);"
                        @if($status=='update' ) value="{{ $siswa->nama_siswa }}" @endif>
                </div>
            </div>

            <div class="row m-3">
                <div class="form-group w-100">
                    <label for="no_telp">Nomor Telepon</label>
                    <input type="number" class="form-control greylight-bg" name="no_telp" id="no_telp"
                        aria-describedby="helpId" placeholder="Masukkan Nomor Telepon Siswa"
                        style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);"
                        @if($status=='update' ) value="{{ $siswa->no_telp }}" @endif>
                </div>
            </div>

            <div class="row m-3">
                <div class="form-group w-100">
                    <label for="email">Email</label>
                    <input type="email" class="form-control greylight-bg" name="email" id="email"
                        aria-describedby="helpId" placeholder="Masukkan Email Siswa"
                        style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);"
                        @if($status=='update' ) value="{{ $siswa->email }}" @endif>
                </div>
            </div>

            <div class="row m-3" @if($status=="update") style="display: none;" @endif>
                <div class="form-group w-100 position-relative">
                    <label for="password">Password</label>
                    <input type="password" class="form-pwd form-control greylight-bg" name="password" id="password"
                        aria-describedby="helpId" placeholder="Masukkan Password Siswa"
                        style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);">
                    <button class="btn-eye"><i class="fas fa-eye" style="color: #6C757D;"></i></button>
                </div>
            </div>

            <div class="row m-3">
                <div class="form-group w-100">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat" rows="5" class="form-control w-100 greylight-bg"
                        style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1); padding-left: 12px !important; padding-top: 12px !important; min-height: 48px;"
                        placeholder="Masukkan Alamat Siswa">@if($status=='update'){{ $siswa->alamat }} @endif</textarea>
                </div>
            </div>

            <div class="row m-3">
                <div class="form-group w-100">
                    <label for="id_kelas">Kelas</label>
                    <select name="id_kelas" id="id_kelas" class="form-control greylight-bg w-100 pl-2"
                        style="height: 37px; border: none; border-radius: 7px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);">
                        <option value="">Pilih Kelas</option>
                        @foreach($kelas as $k)
                    <option data-tipekelas_id="{{ $k->tipekelas_id }}" value="{{ $k->id }}" @if($status=='update' )
                            {{ $siswa->kelas_id==$k->id ? 'selected' : '' }} @endif>{{ $k->nama_kelas }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row m-3">
                <div class="form-group mb-0">
                    <label>Profil Siswa</label><br>
                    @if($status=='update')
                    <img src="{{ asset('uploaded/images/profil_siswa/' . $siswa->profil ) }}"
                        style="width:130px; height:130px; border-radius:80px; object-fit: cover; margin-bottom: 10px; margin-top: 5px;"
                        alt=""><br>
                    @endif
                    <label class="infile-label float-left" for="profil">Pilih File
                        <i class="far fa-file" style="color: #7E8387;"></i>
                    </label>
                    <input type="file" name="profil" id="profil" class="infile float-left">
                    <span class="float-left"
                        style="margin-left: 20px; font-size: 13px; margin-top: 15px; color: #888888;"></span>
                </div>
            </div>

            @if($status=="update")
            <div class="row ml-3 mt-4">
                <label class="check-wrapper">Ubah Password User
                    <input type="checkbox" name="cb_ubahpassword" id="cb_ubahpassword">
                    <span class="checkmark"></span>
                </label>
            </div>
            @endif

            <div class="row m-3 pb-4 pt-2">
                <button type="submit" class="btn w-100 text-light"
                    style="background: #1A9B96 !important;">@if($status=='update') Perbaharui Data @else Tambah Data
                    @endif</button>
            </div>
        </form>

    </div>
</div>

@include('partials.footer')
@endsection

@push('extras-js')
<script>
    $('#id_kelas').on('change', function () {
        var tipekelas_id = $('option:selected', this).data('tipekelas_id');
        $('#form_tambah_siswa').attr("action", "tambah/store/" + tipekelas_id);
    });

    var ubahpassword = '<div class="row m-3" >';
    ubahpassword += '<div class="form-group w-100 position-relative ">';
    ubahpassword += '<label for="password">Ubah Password</label>';
    ubahpassword +=
        '<input type="password" class="form-pwd form-control greylight-bg mt-2" name="password" id="password"';
    ubahpassword += 'aria-describedby="helpId" placeholder="Masukkan Password Siswa"';
    ubahpassword += 'style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);">';
    ubahpassword +=
        '<button class="btn-eye"><i class="fas fa-eye" style="color: #6C757D; margin-top: 11px;"></i></button>';
    ubahpassword += '</div>';
    ubahpassword += '</div>';

    $('input[type="checkbox"]').click(function () {
        if ($(this).prop("checked") == true) {
            $(this).parent().parent().after(ubahpassword);
        } else if ($(this).prop("checked") == false) {
            $(this).parent().parent().next().remove();
        }
    });
</script>
@endpush