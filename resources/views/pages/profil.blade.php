@extends('layouts.layout')
@section('title','Profil Saya')

@section('content')

<div id="main-content">
    <h1>Profil Saya</h1>
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{url('/')}}">Beranda</a>
        @if(Auth::User()->role_id=='1')
        <a class="breadcrumb-item" href="{{url('/profil/' . $auth->siswa->slug . '/' . $auth->siswa->id . '/' . $auth->siswa->role_id)}}">Profil Saya</a>
        @else 
        <a class="breadcrumb-item" href="{{url('/profil/' . $auth->petugas->slug . '/' . $auth->petugas->id . '/' . $auth->petugas->role_id)}}">Profil Saya</a>
        @endif
        <span class="breadcrumb-item active"></span>
    </nav>

    <div style="background: #EDE6F7; border-radius: 20px;" class="p-2 mt-4">
        <p class="mb-1 ml-2 pl-1 mt-2 text-dark" style="font-weight: 500;">Hal Yang Harus Diperhatikan</p>
        <ol style="opacity: 0.7;">
            <li>Pastikan data - data tersebut telah valid</li>
            <li>Tidak semua data dapat anda ubah</li>
            <li>Ubahlah data yang tidak dapat anda ubah dengan menghubungi ICT</li>
            <li>Klik ubah profil untuk mengganti foto profil</li>
        </ol>
    </div>

    <div class="col-md-12 pb-2" style="background: #FFFFFF; box-shadow: 1px 1px 12px rgba(0,0,0,0.1);">
        <div class="row mt-4" style="background: #241937 !important; height: 65px; align-content: center;">
            <p class="text-light m-0 pl-4" style="font-weight: 500;">Ubah Profil</p>
        </div>

        @if($auth->role_id=='1')

        <form id="form-submit"
            action="{{ url('profil/' . $auth->siswa->slug . '/' . $auth->siswa->role_id . '/' . $auth->siswa->id . '/perbaharui/store' ) }}"
            method="post" enctype="multipart/form-data">

            {{ csrf_field() }}

            <div class="row mt-3">
                <div class="col-md-8">
                    <div class="row m-1 ml-3 mr-3">
                        <div class="form-group w-100">
                            <label for="nis">NIS</label>
                            <input type="text" class="form-control" name="nis" id="nis" aria-describedby="helpId"
                                placeholder="Masukkan Nama Lengkap" value="{{ $auth->nomor_induk }}" disabled
                                style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);">
                        </div>
                    </div>
                    <div class="row m-1 ml-3 mr-3">
                        <div class="form-group w-100">
                            <label for="nisn">NISN</label>
                            <input type="text" class="form-control" name="nisn" id="nisn" aria-describedby="helpId"
                                placeholder="Masukkan NISN Siswa" value="{{ $auth->siswa->nisn }}" disabled
                                style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);">
                        </div>
                    </div>
                    <div class="row m-1 ml-3 mr-3">
                        <div class="form-group w-100">
                            <label for="nama_siswa">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama_siswa" id="nama_siswa"
                                aria-describedby="helpId" placeholder="Masukkan NIS Siswa"
                                value="{{ $auth->siswa->nama_siswa }}"
                                style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);">
                        </div>
                    </div>
                    <div class="row m-1 ml-3 mr-3">
                        <div class="form-group w-100">
                            <label for="kelas">Kelas</label>
                            <select name="kelas" id="kelas" class="form-control w-100 pl-2" disabled
                                style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);">
                                <option value="">Pilih Kelas</option>
                                @foreach($kelas as $k)
                                <option value="{{ $k->id }}" {{ $auth->siswa->kelas_id==$k->id ? 'selected' : '' }}>
                                    {{ $k->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col foto-side">
                    <div class="row justify-content-center pt-4 mt-3 mr-2">
                        <img src="{{ asset('uploaded/images/profil_siswa/' . $auth->siswa->profil) }}"
                            style="width:240px; height:240px; border-radius:50px; object-fit: cover; margin-top: 15px;"
                            alt="">
                    </div>
                    <div class="row justify-content-center">
                        <label for="profil" class="btn ubah-profil-btn mr-3">Ubah
                            Foto</label>
                        <input type="file" name="profil" id="profil" class="d-none">
                    </div>
                </div>
            </div>
            <div class="row ml-3 mr-3 pl-1 pr-1">
                <div class="form-group w-100">
                    <label for="no_telp">Nomor Telepon</label>
                    <input type="text" class="form-control" name="no_telp" id="no_telp" aria-describedby="helpId"
                        placeholder="Masukkan Nomor Telepon" value="{{ $auth->siswa->no_telp }}"
                        style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);">
                </div>
            </div>
            <div class="row ml-3 mr-3 pl-1 pr-1">
                <div class="form-group w-100">
                    <label for="email_siswa">Email</label>
                    <input type="text" class="form-control" name="email_siswa" id="email_siswa"
                        aria-describedby="helpId" placeholder="Masukkan Email Siswa" value="{{ $auth->email }}" disabled
                        style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);">
                </div>
            </div>
            <div class="row ml-3 mr-3 pl-1 pr-1">
                <div class="form-group w-100">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat" rows="5" class="form-control w-100"
                        style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);"
                        placeholder="Masukkan Alamat Siswa">{{ $auth->siswa->alamat }}</textarea>
                </div>
            </div>
            <div class="row ml-3 mr-3 pl-1 pr-1">
                <div class="form-group w-100">
                    <label for="role">Role</label>
                    <select name="id_kelas" id="id_kelas" class="form-control w-100 pl-2" disabled
                        style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);">
                        <option value="">Pilih Role</option>
                        @foreach($role as $r)
                        <option value="{{ $r->id }}" {{ $auth->siswa->role->id==$r->id ? 'selected' : '' }}>
                            {{ $r->nama_role }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row m-3 pb-4 pt-2 position-relative">
                <button type="submit" class="btn w-100 text-light" style="background: #241937 !important; transition: all .3s;" id="btn-submit" onclick="show()">Ubah Profil<i class="fas fa-save pl-2"></i></button>
                <img src="{{ asset('assets') }}/images/loader.gif" alt="" class="loader" style="display: none;">
            </div>
        </form>

        @else

        <form id="form-submit"
            action="{{ url('profil/' . $auth->petugas->slug . '/' . $auth->petugas->role_id . '/' . $auth->petugas->id . '/perbaharui/store' ) }}"
            method="post" enctype="multipart/form-data">

            {{ csrf_field() }}

            <div class="row mt-3">
                <div class="col-md-8 mt-2">
                    <div class="row m-1 ml-3 mr-3">
                        <div class="form-group w-100">
                            <label for="nip">NIP</label>
                            <input type="text" class="form-control" name="nip" id="nip" aria-describedby="helpId"
                                placeholder="Masukkan Nama Lengkap" value="{{ $auth->nomor_induk }}" disabled
                                style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);">
                        </div>
                    </div>
                    <div class="row m-1 ml-3 mr-3">
                        <div class="form-group w-100">
                            <label for="nama_petugas">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama_petugas" id="nama_petugas"
                                aria-describedby="helpId" placeholder="Masukkan NIS Siswa"
                                value="{{ $auth->petugas->nama_petugas }}"
                                style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);">
                        </div>
                    </div>
                    <div class="row m-1 ml-3 mr-3">
                        <div class="form-group w-100">
                            <label for="no_telp">Nomor Telepon</label>
                            <input type="text" class="form-control" name="no_telp" id="no_telp"
                                aria-describedby="helpId" placeholder="Masukkan Nomor Telepon"
                                value="{{ $auth->petugas->no_telp }}"
                                style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);">
                        </div>
                    </div>
                    <div class="row m-1 ml-3 mr-3">
                        <div class="form-group w-100">
                            <label for="email_petugas">Email</label>
                            <input type="text" class="form-control" name="email_petugas" id="email_petugas"
                                aria-describedby="helpId" placeholder="Masukkan Email Siswa" value="{{ $auth->email }}"
                                disabled
                                style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);">
                        </div>
                    </div>
                </div>
                <div class="col foto-side">
                    <div class="row justify-content-center pt-4 mt-3 mr-2">
                        <img src="{{ asset('uploaded/images/profil_petugas/' . $auth->petugas->profil) }}"
                            style="width:240px; height:240px; border-radius:50px; object-fit: cover; margin-top: 15px;"
                            alt="">
                    </div>
                    <div class="row justify-content-center">
                        <label for="profil" class="btn ubah-profil-btn mr-3"
                            style="background: #241937; color: #ffffff; margin-top: 19px; box-shadow: 1px 3px 6px rgba(0,0,0,0.1); padding: 5px 35px;">Ubah
                            Foto</label>
                        <input type="file" name="profil" id="profil" class="d-none">
                    </div>
                </div>
            </div>
            <div class="row ml-3 mr-3 form-bawah">
                <div class="form-group w-100">
                    <label for="role">Role</label>
                    <select name="id_kelas" id="id_kelas" class="form-control w-100 pl-2" disabled
                        style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);">
                        <option value="">Pilih Kelas</option>
                        @foreach($role as $r)
                        <option value="{{ $r->id }}" {{ $auth->petugas->role->id==$r->id ? 'selected' : '' }}>
                            {{ $r->nama_role }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row m-3 pb-4 pt-2 position-relative">
                <button type="submit" class="btn w-100 text-light" style="background: #241937 !important; transition: all .3s;" id="btn-submit" onclick="show()">Ubah Profil<i class="fas fa-save pl-2"></i></button>
                <img src="{{ asset('assets') }}/images/loader.gif" alt="" class="loader" style="display: none;">
            </div>
        </form>

        @endif

    </div>
</div>

@include('partials.footer')
@endsection

@push ('extras-css')
<style>
    #content {
        padding-bottom: 11px !important;
    }

    @media (max-width: 1127px) {
        #content {
            padding-bottom: 0px !important;
        }
    }

    @media (max-width: 988px) {
        .row.mt-3>.col-md-8 {
            flex: 0 0 100% !important;
            max-width: 100% !important;
        }

        .col.foto-side>.row:nth-child(1) {
            margin-top: -30px !important;
            margin-right: -13px !important;
        }

        .col.foto-side>.row:nth-child(2)>label {
            width: 100% !important;
            margin-left: 32px;
            margin-top: 30px !important;
            margin-right: 32px !important;
        }

        .form-bawah {
            margin-top: 15px;
        }
    }
</style>
@endpush