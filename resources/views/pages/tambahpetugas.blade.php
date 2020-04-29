@extends('layouts.layout')

@if ($status=='tambah')
@section('title','Tambah Petugas')
@else
@section('title','Perbaharui Petugas')
@endif

@section('content')

<div id="main-content">
    @if ($status=='tambah')
    <h1>Tambah Petugas</h1>
    @else
    <h1>Perbaharui Petugas</h1>
    @endif
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{url('/')}}">Beranda</a>
        <a class="breadcrumb-item" href="{{url('data/petugas/')}}">Data Petugas</a>
        @if ($status=='tambah')
        <a class="breadcrumb-item" href="{{url('data/petugas/tambah')}}">Tambah Petugas</a>
        @else
        <a class="breadcrumb-item" href="{{url('data/petugas/perbaharui/' . $petugas->slug . '/' . $petugas->id)}}">Perbaharui Petugas</a>
        <a class="breadcrumb-item" href="{{url('data/petugas/perbaharui/' . $petugas->slug . '/' . $petugas->id)}}">{{$petugas->nama_petugas}}</a>
        @endif
        <span class="breadcrumb-item active"></span>
    </nav>

    <div style="background: #EDE6F7; border-radius: 20px;" class="p-2 mt-4">
        <p class="mb-1 ml-2 pl-1 mt-2 text-dark" style="font-weight: 500;">Hal Yang Harus Diperhatikan</p>
        <ol style="opacity: 0.7;">
            <li>Pastikan data yang anda masukkan valid</li>
            <li>Pilihlah role sesuai dengan bagian masing - masing</li>
            <li>Untuk foto profil maksimal berukuran 1 Mb / 1000 Kb</li>
            <li>Masukkan Data Dengan Baik Dan Teliti</li>
            <li>Jika semua data sudah terisi, klik tombol tambah petugas</li>
        </ol>
    </div>

    <div class="col-md-12 mt-4 pb-2" style="background: #FFFFFF; box-shadow: 1px 1px 12px rgba(0,0,0,0.1);">
        <div class="row" style="background: #241937 !important; height: 65px; align-content: center;">
            @if ($status=='tambah')
            <p class="text-light m-0 pl-4" style="font-weight: 500;">Tambah Data Petugas</p>
            @else
            <p class="text-light m-0 pl-4" style="font-weight: 500;">Perbaharui Data Petugas</p>
            @endif
        </div>

        <form method="POST" id="form-submit" @if($status=="tambah" ) action="{{ url('data/petugas/tambah/store') }}" @else
            action="{{ url('data/petugas/perbaharui/' . $petugas->slug . '/' . $petugas->id . '/store') }}" @endif
            enctype="multipart/form-data">

            {{ csrf_field() }}

            <div class="row m-3 mt-4 pt-2">
                <div class="form-group w-100">
                    <label for="nomor_induk">NIP</label>
                    <input type="number" class="form-control greylight-bg" name="nomor_induk" id="nomor_induk" aria-describedby="helpId"
                        placeholder="Masukkan NIP Petugas" 
                        style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);"
                        @if($status=='update' ) value="{{ $auth->nomor_induk }}" @else value="{{ old('nomor_induk') }}" @endif>
                </div>
            </div>

            <div class="row m-3">
                <div class="form-group w-100">
                    <label for="nama_petugas">Nama Lengkap</label>
                    <input type="text" class="form-control greylight-bg" name="nama_petugas" id="nama_petugas"
                        aria-describedby="helpId" placeholder="Masukkan Username Petugas"
                        style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);"
                        @if($status=='update' ) value="{{ $petugas->nama_petugas }}" @else value="{{ old('nama_petugas') }}" @endif>
                </div>
            </div>

            <div class="row m-3">
                <div class="form-group w-100">
                    <label for="no_telp">Nomor Telepon</label>
                    <input type="number" class="form-control greylight-bg" name="no_telp" id="no_telp"
                        aria-describedby="helpId" placeholder="Masukkan Nomor Telepon Petugas"
                        style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);"
                        @if($status=='update' ) value="{{ $petugas->no_telp }}" @else value="{{ old('no_telp') }}" @endif>
                </div>
            </div>

            <div class="row m-3">
                <div class="form-group w-100">
                    <label for="email">Email</label>
                    <input type="email" class="form-control greylight-bg" name="email" id="email"
                        aria-describedby="helpId" placeholder="Masukkan Email Petugas"
                        style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);"
                        @if($status=='update' ) value="{{ $auth->email }}" @else value="{{ old('email') }}" @endif>
                </div>
            </div>

            <div class="row m-3">
                <div class="form-group w-100">
                    <label for="role_id">Role</label>
                    <select name="role_id" id="role_id" class="form-control greylight-bg w-100 pl-2"
                        style="height: 37px; border: none; border-radius: 7px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);">
                        <option value="">Pilih Role</option>
                        @foreach($role as $r)
                        <option value="{{ $r->id }}"
                            @if($status=='update' )
                            {{ $petugas->role->id==$r->id ? 'selected' : '' }}
                            @else
                            {{ old('role_id')==$r->id ? 'selected' : '' }}
                            @endif>
                            {{ $r->nama_role }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row m-3">
                <div class="form-group mb-0">
                    <label>Profil Petugas</label><br>
                    @if($status=='update')
                    <img src="{{ asset('uploaded/images/profil_petugas/' . $petugas->profil ) }}"
                        style="width:130px; height:130px; border-radius:80px; object-fit: cover; margin-bottom: 10px; margin-top: 5px;"
                        alt=""><br>
                    @endif
                    <label class="infile-label float-left" for="profil">Pilih File
                        <i class="far fa-file" style="color: #7E8387;"></i>
                    </label>
                    <input type="file" name="profil" id="profil" class="infile float-left">
                    <span class="float-left" style="font-size: 13px; margin-top: 15px; color: #888888;"></span>
                    <div class="clearfix"></div><br><br>
                    <p style="font-size: 12px; margin-top: -45px;"><i>*Foto Maksimal Berukuran 1 Mb</i></p>
                </div>
            </div>

            @if($status=='update')
            <div class="row ml-3">
                <label class="check-wrapper">Ubah Password User
                    <input type="checkbox" name="cb_ubahpassword" id="cb_ubahpassword">
                    <span class="checkmark"></span>
                </label>
            </div>
            @endif

            <div class="row m-3 pb-4 pt-2 position-relative">
                <button type="submit" class="btn w-100 text-light" style="background: #241937 !important; transition: all .3s;" id="btn-submit" onclick="show()">
                    @if($status=='tambah')
                    Tambah Petugas
                    @else
                    Perbaharui Petugas
                    @endif
                    <i class="fas fa-save pl-2"></i></button>
                <img src="{{ asset('assets') }}/images/loader.gif" alt="" class="loader" style="display: none;">
            </div>
        </form>

    </div>
</div>

@include('partials.footer')
@endsection

@push('extras-js')
<script>
    var ubahpassword =  '<div class="row m-3" >';
        ubahpassword += '<div class="form-group w-100 position-relative">';
        ubahpassword += '<label for="password">Ubah Password</label>';
        ubahpassword += '<input type="password" class="form-pwd form-control greylight-bg" name="password" id="password"';
        ubahpassword += 'aria-describedby="helpId" placeholder="Masukkan Password Siswa"';
        ubahpassword += 'style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);">';
        ubahpassword += '</div>';
        ubahpassword += '</div>';

    $('input[type="checkbox"]').click(function(){
            if($(this).prop("checked") == true){
                $(this).parent().parent().after(ubahpassword);
            }
            else if($(this).prop("checked") == false){
                $(this).parent().parent().next().remove();
            }
        });
</script>
@endpush