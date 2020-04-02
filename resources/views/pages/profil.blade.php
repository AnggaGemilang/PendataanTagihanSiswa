@extends('layouts.layout')
@section('title','Profil Saya')

@section('content')

<div id="main-content">
    <h1>Profil Saya</h1>
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{url('/')}}">Beranda</a>
        <a class="breadcrumb-item" href="{{url('/profil')}}">Profil Saya</a>
        <span class="breadcrumb-item active"></span>
    </nav>

    <div style="background: #E5F3F3; border-radius: 20px;" class="p-2 mt-4">
        <p class="mb-1 ml-2 pl-1 mt-2 text-dark" style="font-weight: 500;">Cek Profil Saya</p>
        <ol style="opacity: 0.7;">
            <li>Pastikan data - data tersebut telah valid</li>
            <li>Tidak semua data dapat anda ubah</li>
            <li>Ubahlah data yang tidak dapat anda ubah dengan menghubungi ICT</li>
            <li>Untuk mengubah data dapat dilakukan dengan cara klik icon pensil</li>
            <li>Lalu kemudian, klik tombol submit</li>
        </ol>
    </div>

    <div class="col-md-12">
        <form action="{{ url('profil/' . $siswa->slug . '/perbaharui/store' ) }}" method="post"
            enctype="multipart/form-data">

            {{ csrf_field() }}

            <div class="row mt-3">
                <div class="col-md-8 pl-0">
                    <div class="row m-1">
                        <div class="form-group w-100">
                            <label for="nis">NIS</label>
                            <input type="text" class="form-control" name="nis" id="nis" aria-describedby="helpId"
                                placeholder="Masukkan Nama Lengkap" value="{{ $siswa->nis }}" disabled
                                style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);">
                        </div>
                    </div>
                    <div class="row m-1">
                        <div class="form-group w-100">
                            <label for="nisn">NISN</label>
                            <input type="text" class="form-control" name="nisn" id="nisn" aria-describedby="helpId"
                                placeholder="Masukkan NISN Siswa" value="{{ $siswa->nisn }}" disabled
                                style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);">
                        </div>
                    </div>
                    <div class="row m-1">
                        <div class="form-group w-100">
                            <label for="nama_siswa">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama_siswa" id="nama_siswa"
                                aria-describedby="helpId" placeholder="Masukkan NIS Siswa"
                                value="{{ $siswa->nama_siswa }}"
                                style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);">
                        </div>
                    </div>
                    <div class="row m-1">
                        <div class="form-group w-100">
                            <label for="kelas">Kelas</label>
                            <select name="kelas" id="kelas" class="form-control w-100 pl-2" disabled
                                style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);">
                                <option value="">Pilih Kelas</option>
                                @foreach($kelas as $k)
                                <option value="{{ $k->id }}" {{ $siswa->kelas_id==$k->id ? 'selected' : '' }}>
                                    {{ $k->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row justify-content-center pt-4 mt-3">
                        <img src="{{ asset('uploaded/images/profil_siswa/' . Auth::User()->profil) }}"
                            style="width:250px; height:250px; border-radius:150px;object-fit: cover;" alt="">
                    </div>
                    <div class="row justify-content-center">
                        <label for="profil" class="btn ubah-profil-btn"
                        style="background: #3AA9A5; color: #ffffff; margin-top: 19px; box-shadow: 1px 3px 6px rgba(0,0,0,0.1); padding: 5px 35px;">Ubah
                        Profil</label>
                        <input type="file" name="profil" id="profil" class="d-none">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group w-100">
                    <label for="no_telp">Nomor Telepon</label>
                    <input type="text" class="form-control" name="no_telp" id="no_telp" aria-describedby="helpId"
                        placeholder="Masukkan Nomor Telepon" value="{{ $siswa->no_telp }}"
                        style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);">
                </div>
            </div>
            <div class="row">
                <div class="form-group w-100">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="email" id="email" aria-describedby="helpId"
                        placeholder="Masukkan Email Siswa" value="{{ $siswa->email }}" disabled
                        style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);">
                </div>
            </div>
            <div class="row">
                <div class="form-group w-100">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat" rows="5" class="form-control w-100"
                        style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);"
                        placeholder="Masukkan Alamat Siswa">{{ $siswa->alamat }}</textarea>
                </div>
            </div>
            <div class="row">
                <div class="form-group w-100">
                    <label for="role">Role</label>
                    <select name="id_kelas" id="id_kelas" class="form-control w-100 pl-2" disabled
                        style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);">
                        <option value="">Pilih Kelas</option>
                        @foreach($role as $r)
                        <option value="{{ $r->id }}" {{ $siswa->role->id==$r->id ? 'selected' : '' }}>
                            {{ $r->nama_role }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-2">
                <button type="submit" class="btn mt-3 w-100"
                    style="background: #3AA9A5; color: #ffffff; box-shadow: 1px 3px 6px rgba(0,0,0,0.1); height: 35px; padding: 0px 35px;">Ubah
                    Data</button>
            </div>
        </form>
    </div>
</div>

@include('partials.footer')
@endsection