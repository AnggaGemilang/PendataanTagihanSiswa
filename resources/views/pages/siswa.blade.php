@extends('layouts.layout')
@section('title','Siswa')

@section('content')

<div id="main-content">
    <h1>Data Siswa</h1>
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{url('/')}}">Beranda</a>
        <a class="breadcrumb-item" href="{{url('/data/siswa')}}">Data Siswa</a>
        <span class="breadcrumb-item active"></span>
    </nav>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="form-group position-relative">
                <i class="fas fa-search position-absolute" style="margin-left: 15px; margin-top: 11px;"></i>
                <input type="text" class="form-control pl-5 input-toggle-times" name="field_cari" id="field_cari"
                    aria-describedby="helpId" placeholder="Cari Siswa Disini . . ."
                    style="padding-right: 41px; border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1); padding-top: 8px;">
                <button class="btn-times2"><i class="fa fa-times"></i></button>
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
            <a type="button" href="{{url('/data/siswa/tambah')}}" class="btn w-100"
                style="background: #241937; color: #ffffff; box-shadow: 1px 3px 6px rgba(0,0,0,0.1);">Tambah Siswa</a>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12 table-wrapper">
            <table class="table table-striped align-center" id="table-refresh">
                <thead align="center">
                    <tr id="header-tr">
                        <th scope="col" class="except">No</th>
                        <th>Nis</th>
                        <th>Nama Siswa</th>
                        <th>Kelas</th>
                        <th>Profil</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody align="center">
                    @php
                    $no = 1;
                    @endphp
                    @foreach ($siswa as $s)
                    <tr href="siswa/detail/{{ $s->slug }}/{{ $s->id }}" id="row-main">
                        <th class="except" scope="row">{{ $no++ }}</th>
                        <td>{{ $s->autentikasi->nomor_induk }}</td>
                        <td>{{ $s->nama_siswa }}</td>
                        <td>{{ $s->class->nama_kelas }}</td>
                        <td>
                            <img src="{{ asset('uploaded/images/profil_siswa/' . $s->profil) }}" class="img-table">
                        </td>
                        <td>
                            <button type="button" data-url="{{ url('data/siswa/hapus/' . $s->id) }}"
                                class="btn btn-danger text-light" id="btn-hapus" data-desc="<span style='text-align: center; font-size: 17px; padding: 0px 15px;'>Data Siswa, Autentikasi, Pembayaran, dan Tagihan Akan Terhapus Secara Permanen</span>"
                                style="padding: 4px 10px; font-size: 14.5px;">Hapus</button>
                            <a href="{{ url('data/siswa/perbaharui/' . $s->slug . '/' . $s->id) }}"
                                class="btn btn-success text-light"
                                style="padding: 4px 15px; font-size: 14.5px;">Edit</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @if($siswa->count()==0)
            <div class="alert alert-danger mt-4" role="alert">
            <i class="fas fa-exclamation-circle pr-2" ></i> Data Tidak Ditemukan, Klik <a href="{{ url('data/siswa/tambah') }}" class="alert-no-data">Disini</a> untuk menambahkan siswa baru.
            </div>
            @endif
        </div>
    </div>

    <div class="row mt-0 justify-content-end mr-1">
        <p style="font-weight: 400;"><span id="custom-count">{{$siswa->count()}}</span> dari {{ $siswa->count() }} Data Ditampilkan</p>
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
        min-width: 110px !important;
    }

    @media (max-width: 769px) {
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

    @media (max-width: 749px) {
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