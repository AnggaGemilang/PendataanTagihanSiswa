@extends('layouts.layout')
@section('title')
{{ $kelas->nama_kelas }}
@endsection

@section('content')

<div id="main-content">
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{url('/')}}">Beranda</a>
        <a class="breadcrumb-item" href="{{url('/data/kelas')}}">Data Kelas</a>
        <a class="breadcrumb-item" href="{{url('/data/kelas/detail/' . $kelas->slug)}}">{{ $kelas->nama_kelas }}</a>
        <span class="breadcrumb-item active"></span>
    </nav>

    <div class="row mt-4 ml-1 mr-1 position-relative">
        <h2 class="mb-4 w-100" style="font-size: 40px;">XII - RPL 1</h2>
        <table>
            <tbody>
                <tr>
                    <td class="left">
                        <h4>Kelas</h4>
                    </td>
                    <td align="center" width="100" class="tengah">
                        <h4>:</h4>
                    </td>
                    <td>
                        <h4>{{ $kelas->nama_kelas }}</h4>
                    </td>
                </tr>
                <tr>
                    <td class="left">
                        <h4>Jurusan</h4>
                    </td>
                    <td align="center" width="100" class="tengah">
                        <h4>:</h4>
                    </td>
                    <td>
                        <h4>{{ $kelas->jurusan }}</h4>
                    </td>
                </tr>
                <tr>
                    <td class="left">
                        <h4>Wali Kelas</h4>
                    </td>
                    <td align="center" width="100" class="tengah">
                        <h4>:</h4>
                    </td>
                    <td class="left">
                        <h4>{{ $kelas->wali_kelas }}</h4>
                    </td>
                </tr>
            </tbody>
        </table>
        <button type="button" class="mt-2 btn btn-info position-absolute btn-toggle-option"><i class="fas fa-ellipsis-v" style="color:#008A85; "></i></button>
        <div class="dropdown-navbar dropdown-detail">
            <ul class="pl-0 mb-0">
                <a href="{{ url('data/kelas/perbaharui/' . $kelas->slug) }}">
                    <li><i class="fas fa-pencil-alt pr-3 pt-1"></i>Edit</li>
                </a>
                <li style="list-style: none;"><button type="button" data-direct="{{ url('data/kelas') }}" data-url="{{ url('data/kelas/hapus/' . $kelas->id) }}" class="btn text-dark" id="btn-hapus"><i class="fas fa-trash-alt pr-3"></i>Hapus</button></li>
            </ul>
        </div>
    </div>

    <div class="row m-1 mt-4 bg-data">
        <h2 class="p-2" style="font-weight: 600;">Daftar Siswa</h2>
        <table class="w-100" id="table-refresh">
            <thead align="center">
                <tr style="border-bottom: 1px solid #888; height: 50px;">
                    <td class="except" style="font-weight: 600;">No</td>
                    <td class="change" style="font-weight: 600;">NISN</td>
                    <td class="change" style="font-weight: 600;">NIS</td>
                    <td class="change" style="font-weight: 600;">Nama Siswa</td>
                    <td class="change" style="font-weight: 600;">Email</td>
                    <td class="change" style="font-weight: 600;">Nomor Telepon</td>
                    <td class="change" style="font-weight: 600;">Profil</td>
                </tr>
            </thead>
            <tbody align="center">
                @php
                $no = 1;
                @endphp
                @foreach ($kelas->students as $student)
                <tr style="height: 75px;" href="{{ url('data/siswa/detail/' . $student->slug . '/' . $student->id )  }}" id="row-main">
                    <th class="except">{{ $no++ }}</th>
                    <td class="change">{{ $student->nisn }}</td>
                    <td class="change">{{ $student->autentikasi->nomor_induk }}</td>
                    <td class="change">{{ $student->nama_siswa }}</td>
                    <td class="change">{{ $student->autentikasi->email }}</td>
                    <td class="change">{{ $student->no_telp }}</td>
                    <td class="change">
                        <img src="{{ asset('uploaded/images/profil_siswa/' . $student->profil) }}"
                            style="width:55px; height:55px; border-radius:60px;object-fit: cover;" alt="">
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


</div>

@include('partials.footer')
@endsection

@push('extras-css')
<style>
    .btn-toggle-option
    {
        right: 0px; 
        top: -1px; 
        padding: 2px 10px; 
        background: transparent; 
        border: none; 
        outline: none !important; 
        color: #008A85; 
        font-size: 20px;
    }

    .bg-data
    {
        background: #FFFFFF !important; 
        border-radius: 10px; 
        padding-left: 20px; 
        padding-right: 20px; 
        padding-top: 15px; 
        padding-bottom: 15px; 
        box-shadow: 1px 2px 14px rgba(0,0,0,0.1);
        overflow: auto;
    }

    td.except
    {
        min-width: 50px !important;
    }
    td.change
    {
        min-width: 134px !important;
    }

    @media(max-width: 630px)
    {
        td > h4
        {
            font-size: 15px;
        }

        .row > h2.mb-4
        {
            font-size: 30px !important;  
        }

        .tengah
        {
            width: 30px !important;
        }

        .left
        {
            width: 25px !important;
        }

        .bg-data > h2
        {
            font-size: 25px;
        }

        table > thead > tr
        {
            font-size: 15px;
        } 

        table > tbody > tr
        {
            font-size: 13px !important;
        } 
    }
</style>
@endpush