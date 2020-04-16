@extends('layouts.layout')
@section('title')
{{ $petugas->nama_petugas }}
@endsection

@section('content')

<div id="main-content">
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{url('/')}}">Beranda</a>
        <a class="breadcrumb-item" href="{{url('/data/petugas')}}">Data Petugas</a>
        <a class="breadcrumb-item"
            href="{{url('/data/petugas/detail/' . $petugas->slug)}}">{{ $petugas->nama_petugas }}</a>
        <span class="breadcrumb-item active"></span>
    </nav>

    <div class="row mt-4 ml-2" style="margin-right: 8px;">
        <div class="col-md-7">
            <div class="row">
                <h2 class="mb-4 w-100" style="font-size: 40px; text-transform: capitalize;">{{ $petugas->nama_petugas }}
                </h2>
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <h4>NIP</h4>
                            </td>
                            <td align="center" width="60">
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
                            <td align="center" width="60">
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
                            <td align="center" width="60">
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
                            <td align="center" width="60">
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
                            <td align="center" width="60">
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
        <div class="col-md-5 position-relative d-flex justify-content-center pl-0" id="dropdown-detail">
            <img src="{{ asset('uploaded/images/profil_petugas/' . $petugas->profil) }}" class="prev-profil" alt="">
            <button type="button" class="btn btn-info position-absolute btn-toggle-option">
                <i class="fas fa-ellipsis-v" style="color: #24143F;"></i>
            </button>
            <div class="dropdown-navbar dropdown-detail">
                <ul class="pl-0 mb-0">
                    <a href="{{ url('data/petugas/perbaharui/' . $petugas->slug) }}">
                        <li><i class="fas fa-pencil-alt pr-3 pt-1"></i>Edit</li>
                    </a>
                    <li style="list-style: none;"><button type="button" data-direct="{{ url('data/petugas') }}"
                            data-url="{{ url('data/petugas/hapus/' . $petugas->id) }}" class="btn text-dark"
                            id="btn-hapus"><i class="fas fa-trash-alt pr-3"></i>Hapus</button></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row m-1 mt-5 mb-4 info-lainnya" >
        <h3 class="p-2 w-100 mb-3 pb-3" style="font-weight: 600;">Info Lainnya</h3>
        <hr>
        <span class="pl-2"
            style="margin-top: 4px; margin-right: 9px; margin-left: 20px; border-left: 3px #24143F solid; height: 20px;"></span>
        <p>Data Tidak Ditemukan</p>
    </div>
</div>

@include('partials.footer')
@endsection

@push('extras-css')
<style>
    .info-lainnya
    {
        background: #FFFFFF !important; 
        border-radius: 10px; 
        padding-left: 20px; 
        padding-right: 20px; 
        padding-top: 15px; 
        padding-bottom: 30px; 
        box-shadow: 1px 2px 14px rgba(0,0,0,0.1);
    }

    .btn-toggle-option {
        right: 0px;
        top: 18px;
        padding: 2px 10px;
        background: transparent;
        border: none;
        outline: none !important;
        font-size: 20px;
    }

    .prev-profil {
        width: 240px;
        height: 240px;
        border-radius: 50px;
        object-fit: cover;
        margin-top: 15px;
    }

    @media(max-width: 816px)
    {
        .row > .col-md-7, 
        .row > .col-md-5
        {
            flex: 0 0 100% !important;
            max-width: 100%;
        }

        .row > .col-md-5
        {
            margin-right: 0px !important;
            padding-right: 0px !important;
        }

        .row.mt-4 > .col-md-5
        {
            margin-top: 20px !important;
        }
    }

    @media(max-width: 498px)
    {
        td > h4
        {
            font-size: 15px;
        }

        .row > h2.mb-4
        {
            font-size: 28px !important;  
        }

        .bg-data > h3
        {
            font-size: 23px;
        }

        table > thead > tr
        {
            font-size: 14px;
        } 

        table > tbody > tr
        {
            font-size: 12px !important;
        } 

        h3.p-2.w-100
        {
            font-size: 25px;
        }
    }
</style>
@endpush