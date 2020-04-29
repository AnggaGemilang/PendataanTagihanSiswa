@extends('layouts.layout')
@section('title')
{{ $tipetagihan->nama_tagihan }}
@endsection

@section('content')

<div id="main-content">
    <h1>Daftar Tagihan {{ $tipetagihan->nama_tagihan }}</h1>
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{url('/')}}">Beranda</a>
        <a class="breadcrumb-item" href="{{url('/data/tipetagihan')}}">Tagihan</a>
        <a class="breadcrumb-item" href="{{url('/data/tipetagihan/detail/'. $tipetagihan->slug.'/'. $tipetagihan->id)}}">{{ $tipetagihan->nama_tagihan }}</a>
        <span class="breadcrumb-item active"></span>
    </nav>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="form-group position-relative">
                <i class="fas fa-search position-absolute" style="margin-left: 15px; margin-top: 11px;"></i>
                <input type="text" class="form-control pl-5" name="" id="field_cari" aria-describedby="helpId"
                    placeholder="Cari Siswa Disini . . ."
                    style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1); padding-top: 8px;">
            </div>
        </div>
        <div class="col-md-3 pl-0">
            <div class="form-group">
                <select class="custom-select" name="filter_change_table" id="filter_change_table"
                    style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1); padding-top: 8px;">
                    <option selected value="">Pilih Kelas</option>
                    @foreach ($kelas as $k)
                    <option value="{{ $k->nama_kelas }}">{{ $k->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-3 pl-0">
            <div class="form-group">
                <select class="custom-select" name="status_change" id="status_change"
                    style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1); padding-top: 8px;">
                    <option selected value="">Pilih Status Tagihan</option>
                    <option value="belum lunas">Belum Lunas</option>
                    <option value="sudah lunas">Sudah Lunas</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12 table-wrapper">
            <table class="table table-striped align-center" id="table-refresh">
                <thead align="center">
                    <tr id="header-tr">
                        <th class="except" scope="col">No</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Nominal</th>
                        <th>Sudah Dibayar</th>
                        <th>Sisa Tagihan</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody align="center">
                    @php
                    $no = 1;
                    @endphp
                    @foreach ($tagihan as $t)
                    <tr>
                        <th class="except" scope="row">{{$no++}}</th>
                        <td>{{ $t->siswa->nama_siswa }}</td>
                        <td>{{ $t->siswa->class->nama_kelas }}</td>
                        <td class="uang">{{ $t->tipetagihan->nominal }}</td>
                        <td class="uang">{{ $t->sudah_dibayar }}</td>
                        <td class="uang">{{ $t->tipetagihan->nominal - $t->sudah_dibayar }}</td>
                        <td>@if($t->keterangan=="blm_lunas") Belum Lunas @else Sudah Lunas @endif</td>
                        <td>
                            <button type="button" data-url="{{ url('data/tagihan/hapus/' . $t->id ) }}"
                                class="btn btn-danger text-light" id="btn-hapus"
                                style="padding: 4px 11px; font-size: 14.5px;"><i class="fas fa-trash-alt"></i></button>
                            <a href="{{ url('data/tagihan/perbaharui/' . $t->id ) }}"
                                class="btn btn-success text-light"
                                style="padding: 4px 9.5px; font-size: 14.5px;"><i class="fas fa-pen"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @if($tagihan->count()==0)
            <div class="alert alert-danger mt-4" role="alert">
            <i class="fas fa-exclamation-circle pr-2" ></i> Data Tidak Ditemukan, Klik <a href="{{ url('data/siswa/tambah') }}" class="alert-no-data">Disini</a> untuk membuat data tagihan dengan menambahkan siswa baru.
            </div>
            @endif
        </div>
    </div>

    <div class="row mt-0 justify-content-end mr-2">
        <p style="font-weight: 400;"><span id="custom-count">{{$tagihan->count()}}</span> dari {{ $tagihan->count() }} Data Ditampilkan</p>
    </div>

</div>

@include('partials.footer')
@endsection

@push ('extras-css')
<style>
    th.except {
        min-width: 50px;
    }

    td:not(.except) {
        min-width: 95px !important;
    }

    @media (max-width: 768px) {
        .row.mt-4>.col-md-3 {
            margin-left: 15px;
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