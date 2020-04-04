@extends('layouts.layout')
@section('title')
    {{ $petugas->nama_petugas }}
@endsection

@section('content')

<div id="main-content">
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{url('/')}}">Beranda</a>
        <a class="breadcrumb-item" href="{{url('/data/petugas')}}">Data Petugas</a>
        <a class="breadcrumb-item" href="{{url('/data/petugas/detail/' . $petugas->slug)}}">{{ $petugas->nama_petugas }}</a>
        <span class="breadcrumb-item active"></span>
    </nav>

    <div class="row mt-4 ml-2">
        <div class="col-md-7">
            <div class="row">
              <h2 class="mb-4 w-100" style="font-size: 40px; text-transform: capitalize;">{{ $petugas->nama_petugas }}</h2>
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <h4>NIP</h4>
                            </td>
                            <td align="center" width="100">
                                <h4>:</h4>
                            </td>
                            <td>
                                <h4>{{ $petugas->autentikasi->nomor_induk }}</h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4>Nama Lengkap</h4>
                            </td>
                            <td align="center" width="100">
                                <h4>:</h4>
                            </td>
                            <td>
                                <h4>{{ $petugas->nama_petugas }}</h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4>Nomor Telepon</h4>
                            </td>
                            <td align="center" width="100">
                                <h4>:</h4>
                            </td>
                            <td>
                                <h4>{{ $petugas->no_telp }}</h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4>Email</h4>
                            </td>
                            <td align="center" width="100">
                                <h4>:</h4>
                            </td>
                            <td>
                                <h4>{{ $petugas->autentikasi->email }}</h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4>Role</h4>
                            </td>
                            <td align="center" width="100">
                                <h4>:</h4>
                            </td>
                            <td>
                                <h4>{{ $petugas->role->nama_role }}</h4>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-5 position-relative" id="dropdown-detail" style="padding-left: 60px;">
            <img src="{{ asset('uploaded/images/profil_petugas/' . $petugas->profil) }}"
            style="width:240px; height:240px; border-radius:50px; object-fit: cover; margin-top: 15px;" alt="">
            <button type="button" class="btn btn-info position-absolute btn-toggle-option" style="right: 16px; top: 2px; padding: 2px 10px; background: transparent; border: none; outline: none !important; color: #008A85; font-size: 20px;"><i class="fas fa-ellipsis-v"></i></button>
            <div class="dropdown-navbar dropdown-detail">
                <ul class="pl-0 mb-0">
                    <a href="{{ url('data/petugas/perbaharui/' . $petugas->slug) }}">
                        <li><i class="fas fa-pencil-alt pr-3 pt-1"></i>Edit</li>
                    </a>
                    <li style="list-style: none;"><button type="button" data-direct="{{ url('data/petugas') }}" data-url="{{ url('data/petugas/hapus/' . $petugas->id) }}" class="btn text-dark" id="btn-hapus"><i class="fas fa-trash-alt pr-3"></i>Hapus</button></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row m-1 mt-4 mb-4"
        style="background: #FFFFFF !important; border-radius: 10px; padding-left: 20px; padding-right: 20px; padding-top: 15px; padding-bottom: 30px; box-shadow: 1px 2px 14px rgba(0,0,0,0.1);">
        <h3 class="p-2 w-100 mb-4" style="font-weight: 600;">Info Lainnya</h3>
        <hr>
        <span class="pl-2" style="margin-top: 3.5px; margin-right: 4px; margin-left: 8px; border-left: 3px #1A9B96 solid; height: 20px;"></span>
        <p>Tidak Ada Data</p>
    </div>
</div>

@include('partials.footer')
@endsection