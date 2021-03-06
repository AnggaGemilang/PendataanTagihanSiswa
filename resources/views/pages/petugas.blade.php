@extends('layouts.layout')
@section('title','Petugas')

@section('content')

<div id="main-content">
    <h1>Data Petugas</h1>
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{url('/')}}">Beranda</a>
        <a class="breadcrumb-item" href="{{url('/data/petugas')}}">Data Petugas</a>
        <span class="breadcrumb-item active"></span>
    </nav>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="form-group position-relative">
                <i class="fas fa-search position-absolute" style="margin-left: 15px; margin-top: 11px;"></i>
                <input type="text" class="form-control pl-5 input-toggle-times" name="field_cari" id="field_cari" aria-describedby="helpId" placeholder="Cari Petugas Disini . . ." style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1); padding-top: 8px; padding-right: 41px;">
                <button class="btn-times2"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="col-md-3 pl-0">
            <div class="form-group">
                <select class="custom-select" name="filter_change_table" id="filter_change_table"
                    style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1); padding-top: 8px;">
                    <option selected value="">Pilih Role</option>
                    @foreach ($role as $r)
                    <option value="{{ $r->nama_role }}">{{ $r->nama_role }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-3 pl-0">
            <a type="button" href="{{url('/data/petugas/tambah')}}" class="btn w-100" style="background: #241937; color: #ffffff; box-shadow: 1px 3px 6px rgba(0,0,0,0.1);">Tambah Petugas</a>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12 table-wrapper">
            <table class="table table-striped align-center" id="table-refresh">
                <thead align="center">
                    <tr id="header-tr">
                        <th class="except" scope="col">No</th>
                        <th scope="col">NIP</th>
                        <th scope="col">Nama Petugas</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Profil</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody align="center">
                    @php
                        $no=1;
                    @endphp
                    @foreach ($petugas as $p)
                    <tr href="petugas/detail/{{ $p->slug }}" id="row-main">
                        <th class="except" scope="row">{{ $no++ }}</th>
                        <td>{{ $p->autentikasi->nomor_induk }}</td>
                        <td>{{ $p->nama_petugas }}</td>
                        <td>{{ $p->autentikasi->email }}</td>
                        <td>{{ $p->role->nama_role }}</td>
                        <td>
                            <img src="{{ asset('uploaded/images/profil_petugas/' . $p->profil) }}"
                                style="width:78px; height:78px; border-radius:60px;object-fit: cover;" alt="">
                        </td>
                        <td>
                            <button type="button" data-url="{{ url('data/petugas/hapus/' . $p->id) }}" class="btn btn-danger text-light" id="btn-hapus" data-desc="<span><span style='text-align: center; font-size: 17px; padding: 0px 15px;'>Data Petugas, dan Autentikasi Akan Terhapus Secara Permanen</span>" style="padding: 4px 10px; font-size: 14.5px;">Hapus</button>
                            <a href="{{ url('data/petugas/perbaharui/' . $p->slug . '/' . $p->id) }}" class="btn btn-success text-light" style="padding: 4px 15px; font-size: 14.5px;">Edit</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @if($petugas->count()==0)
            <div class="alert alert-danger mt-4" role="alert">
                <i class="fas fa-exclamation-circle pr-2" ></i> Data Tidak Ditemukan, Klik <a href="{{ url('data/petugas/tambah') }}" class="alert-no-data">Disini</a> untuk menambahkan petugas baru.
            </div>
            @endif
        </div>
    </div>

    <div class="row mt-0 justify-content-end mr-2">
        <p style="font-weight: 400;"><span id="custom-count">{{$petugas->count()}}</span> dari {{ $petugas->count() }} Data Ditampilkan</p>
    </div>

</div>

@include('partials.footer')
@endsection

@push ('extras-css')
<style>
    th.except
    {
        min-width: 50px;
    }
    td:not(.except)
    {
        min-width: 115px !important;
    }

    @media (max-width: 768px) {
        .row.mt-4>.col-md-3 {
            flex: 0 0 100%;
            max-width: 100%;
            padding-left: 14.5px !important;
        }

        .row.mt-4>.col-md-6 {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }

    @media (max-width: 893px) {
        td > a
        {
            margin-top: 5px;
            width: 70px;
        }

        td > button
        {
            width: 70px;
        }
    }
</style>
@endpush