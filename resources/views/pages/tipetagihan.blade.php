@extends('layouts.layout')
@section('title','Tagihan')

@section('content')

<div id="main-content">
    <h1>Data Jenis Tagihan</h1>
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{url('/')}}">Beranda</a>
        <a class="breadcrumb-item" href="{{url('/data/tipetagihan')}}">Data Jenis Tagihan</a>
        <span class="breadcrumb-item active"></span>
    </nav>

    <div class="row mt-4">
        <div class="col-md-9">
            <div class="form-group position-relative">
                <i class="fas fa-search position-absolute" style="margin-left: 15px; margin-top: 11px;"></i>
                <input type="text" class="form-control pl-5 input-toggle-times" name="field_cari" id="field_cari"
                    aria-describedby="helpId" placeholder="Cari Jenis Tagihan Disini . . ."
                    style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1); padding-top: 8px;">
                <button class="btn-times2"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="col-md-3 pl-0">
            <a type="button" href="{{url('/data/tipetagihan/tambah')}}" class="btn w-100"
                style="background: #24143F; color: #ffffff; box-shadow: 1px 3px 6px rgba(0,0,0,0.1);">Tambah Data</a>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12 table-wrapper">
            <table class="table table-striped align-center" id="table-refresh">
                <thead align="center">
                    <tr id="header-tr">
                        <th class="except" scope="col">No</th>
                        <th scope="col">Nama Jenis Tagihan</th>
                        <th scope="col">Nominal</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody align="center">
                    @php
                    $no = 1;
                    @endphp
                    @foreach ($tipetagihan as $t)
                    <tr href="tipetagihan/detail/{{ $t->slug }}/{{ $t->id }}" id="row-main">
                        <th class="except" scope="row">{{$no++}}</th>
                        <td>{{ $t->nama_tagihan }}</td>
                        <td>Rp. {{ $t->nominal }}</td>
                        <td>
                            <button type="button" data-url="{{ url('data/tipetagihan/hapus/' . $t->id) }}"
                                class="btn btn-danger text-light" id="btn-hapus"
                                style="padding: 4px 10px; font-size: 14.5px;">Hapus</button>
                            <a href="{{ url('data/tipetagihan/perbaharui/' . $t->slug ) }}" class="btn btn-success"
                                style="padding: 4px 15px; font-size: 14.5px;">Edit</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @if($tipetagihan->count()==0)
            <div class="alert alert-danger mt-3" role="alert">
                <i class="fas fa-exclamation-circle pr-2"></i> Data Tidak Ditemukan, Klik <a
                    href="{{ url('/data/tipetagihan/tambah') }}" class="alert-no-data">Disini</a> untuk menambahkan jenis
                tagihan baru.
            </div>
            @endif
        </div>
    </div>
</div>

@include('partials.footer')
@endsection

@push ('extras-css')
<style>
    th.except {
        min-width: 60px;
    }

    td:not(.except) {
        min-width: 160px !important;
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

    @media (max-width: 556px) {
        td>a {
            margin-top: 5px;
            width: 70px;
        }

        td>button {
            width: 70px;
        }
    }
</style>
@endpush