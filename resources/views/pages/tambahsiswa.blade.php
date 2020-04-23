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
        <a class="breadcrumb-item" href="{{url('data/siswa/perbaharui/' . $siswa->slug . '/' . $siswa->id )}}">Perbaharui Siswa</a>
        <a class="breadcrumb-item" href="{{url('data/siswa/perbaharui/' . $siswa->slug . '/' . $siswa->id )}}">{{$siswa->nama_siswa}}</a>
        @endif
        <span class="breadcrumb-item active"></span>
    </nav>

    <div style="background: #EDE6F7; border-radius: 20px;" class="p-2 mt-4">
        <p class="mb-1 ml-2 pl-1 mt-2 text-dark" style="font-weight: 500;">Hal - Hal Yang Harus Diperhatikan</p>
        <ol style="opacity: 0.7;">
            <li>Pastikan data yang anda masukkan sudah valid</li>
            <li>Isi semua form input dengan baik dan teliti</li>
            <li>Untuk foto profil maksimal berukuran 1 Mb / 1000 Kb</li>
            <li>Ketika siswa baru ditambahkan, tagihan wajib (SPP & uang bangunan) akan otomatis ditambahkan</li>
            <li>Jika semua data sudah terisi, klik tombol tambah siswa</li>
        </ol>
    </div>

    <div class="col-md-12 mt-4 pb-2" style="background: #FFFFFF; box-shadow: 1px 1px 12px rgba(0,0,0,0.1);">
        <div class="row" style="background: #241937 !important; height: 65px; align-content: center;">
            @if ($status=='tambah')
            <p class="text-light m-0 pl-4" style="font-weight: 500;">Tambah Data Siswa</p>
            @else
            <p class="text-light m-0 pl-4" style="font-weight: 500;">Perbaharui Data Siswa</p>
            @endif
        </div>

        <form id="form-submit" @if($status=='tambah') 
            action="{{ url('data/siswa/tambah/store') }}"
            @else
            action="{{url('data/siswa/perbaharui/' . $siswa->id . '/store')}}" 
            @endif 
            method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="row m-3 mt-4 pt-2">
                <div class="form-group w-100">
                    <label for="nisn">NISN</label>
                    <input type="number" class="form-control greylight-bg" name="nisn" id="nisn"
                        aria-describedby="helpId" placeholder="Masukkan NISN Siswa"
                        style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);"
                        @if($status=='update' ) 
                        value="{{ $siswa->nisn }}" 
                        @else
                        value="{{ old('nisn') }}"
                        @endif>
                </div>
            </div>

            <div class="row m-3">
                <div class="form-group w-100">
                    <label for="nomor_induk">NIS</label>
                    <input type="number" class="form-control greylight-bg" name="nomor_induk" id="nomor_induk" aria-describedby="helpId"
                        placeholder="Masukkan NIS Siswa"
                        style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);"
                        @if($status=='update' ) 
                        value="{{ $auth->nomor_induk }}" 
                        @else
                        value="{{ old('nomor_induk') }}"
                        @endif>
                </div>
            </div>

            <div class="row m-3">
                <div class="form-group w-100">
                    <label for="nama_siswa">Nama Lengkap</label>
                    <input type="text" class="form-control greylight-bg" name="nama_siswa" id="nama_siswa"
                        aria-describedby="helpId" placeholder="Masukkan Nama Lengkap Siswa"
                        style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);"
                        @if($status=='update' ) 
                        value="{{ $siswa->nama_siswa }}" 
                        @else
                        value="{{ old('nama_siswa') }}"
                        @endif>
                </div>
            </div>

            <div class="row m-3">
                <div class="form-group w-100">
                    <label for="no_telp">Nomor Telepon</label>
                    <input type="number" class="form-control greylight-bg" name="no_telp" id="no_telp"
                        aria-describedby="helpId" placeholder="Masukkan Nomor Telepon Siswa"
                        style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);"
                        @if($status=='update' ) 
                        value="{{ $siswa->no_telp }}" 
                        @else
                        value="{{ old('no_telp') }}"
                        @endif>
                </div>
            </div>

            <div class="row m-3">
                <div class="form-group w-100">
                    <label for="email">Email</label>
                    <input type="email" class="form-control greylight-bg" name="email" id="email"
                        aria-describedby="helpId" placeholder="Masukkan Email Siswa"
                        style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);"
                        @if($status=='update' ) 
                        value="{{ $auth->email }}"
                        @else
                        value="{{ old('email') }}"
                        @endif>
                </div>
            </div>

            <div class="row m-3">
                <div class="form-group w-100">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat" rows="5" class="form-control w-100 greylight-bg"
                        style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1); padding-left: 12px !important; padding-top: 12px !important; min-height: 48px;"
                        placeholder="Masukkan Alamat Siswa">@if($status=='update'){{ $siswa->alamat }}@else{{old('alamat')}}@endif</textarea>
                </div>
            </div>

            <div class="row m-3">
                <div class="form-group w-100">
                    <label for="kelas_id">Kelas</label>
                    <select name="kelas_id" id="kelas_id" class="form-control greylight-bg w-100 pl-2"
                        style="height: 37px; border: none; border-radius: 7px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);">
                        <option value="">Pilih Kelas</option>
                        @foreach($kelas as $k)
                        <option data-tipekelas_id="{{ $k->tipekelas_id }}" value="{{ $k->id }}" 
                            @if($status=='update' )
                            {{ $siswa->kelas_id==$k->id ? 'selected' : '' }}
                            @else
                            {{ old('kelas_id')==$k->id ? 'selected' : '' }}
                            @endif>
                            {{ $k->nama_kelas }}
                        </option>
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
                        style="font-size: 13px; margin-top: 15px; color: #888888;"></span>
                    <div class="clearfix"></div><br><br>
                    <p style="font-size: 12px; margin-top: -45px;"><i>*Foto Maksimal Berukuran 1 Mb</i></p>
                </div>
            </div>

            @if($status=="update")
            <div class="row ml-3" style="margin-top: -10px;">
                <label class="check-wrapper">Ubah Password Siswa
                    <input type="checkbox" name="cb_ubahpassword" id="cb_ubahpassword">
                    <span class="checkmark"></span>
                </label>
            </div>
            @endif

            <div class="row m-3 pb-4 pt-2 position-relative">
                <button type="submit" class="btn w-100 text-light" style="background: #241937 !important; transition: all .3s;" id="btn-submit" onclick="show()">@if($status=='update') Perbaharui Siswa @else Tambah Siswa
                    @endif<i class="fas fa-save pl-2"></i></button>
                <img src="{{ asset('assets') }}/images/loader.gif" alt="" class="loader" style="display: none;">
            </div>
        </form>

    </div>
</div>

@include('partials.footer')
@endsection

@push('extras-js')
<script>
    var ubahpassword = '<div class="row m-3" >';
    ubahpassword += '<div class="form-group w-100 position-relative ">';
    ubahpassword += '<label for="password">Ubah Password</label>';
    ubahpassword +=
        '<input type="password" class="form-pwd form-control greylight-bg mt-2" name="password" id="password"';
    ubahpassword += 'aria-describedby="helpId" placeholder="Masukkan Password Siswa"';
    ubahpassword += 'style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);">';
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