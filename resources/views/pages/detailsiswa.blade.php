@extends('layouts.layout')
@section('title')
{{ $siswa->nama_siswa }}
@endsection

@section('content')

<div id="main-content">
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{url('/')}}">Beranda</a>
        <a class="breadcrumb-item" href="{{url('/data/siswa')}}">Data Siswa</a>
        <a class="breadcrumb-item" href="{{url('/data/siswa/detail/' . $siswa->slug)}}">{{ $siswa->nama_siswa }}</a>
        <span class="breadcrumb-item active"></span>
    </nav>

    <div class="row mt-4 ml-2">
        <div class="col-md-7">
            <div class="row">
                <h2 class="mb-4 w-100" style="font-size: 40px;">{{ $siswa->nama_siswa }}</h2>
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <h4>NIS</h4>
                            </td>
                            <td align="center" width="100">
                                <h4>:</h4>
                            </td>
                            <td>
                                <h4>{{ $auth->nomor_induk }}</h4>
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
                                <h4>{{ $siswa->nama_siswa }}</h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4>Kelas</h4>
                            </td>
                            <td align="center" width="100">
                                <h4>:</h4>
                            </td>
                            <td>
                                <h4>{{ $siswa->class->nama_kelas }}</h4>
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
                                <h4>{{ $auth->email }}</h4>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4>No Telepon</h4>
                            </td>
                            <td align="center" width="100">
                                <h4>:</h4>
                            </td>
                            <td>
                                <h4>{{ $siswa->no_telp }}</h4>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-5" style="padding-left: 60px;">
            <img src="{{ asset('uploaded/images/profil_siswa/' . $siswa->profil) }}"
                style="width:240px; height:240px; border-radius:50px; object-fit: cover; margin-top: 15px;" alt="">
            <button type="button" class="btn btn-info position-absolute btn-toggle-option"
                style="right: 16px; top: 2px; padding: 2px 10px; background: transparent; border: none; outline: none !important; color: #008A85; font-size: 20px;"><i
                    class="fas fa-ellipsis-v"></i></button>
            <div class="dropdown-navbar dropdown-detail">
                <ul class="pl-0 mb-0">
                    <a href="{{ url('data/siswa/perbaharui/' . $siswa->slug . '/' . $siswa->id) }}">
                        <li><i class="fas fa-pencil-alt pr-3 pt-1"></i>Edit</li>
                    </a>
                    <li style="list-style: none;"><button type="button" data-direct="{{ url('data/siswa') }}"
                            data-url="{{ url('data/siswa/hapus/' . $siswa->id) }}" class="btn text-dark"
                            id="btn-hapus"><i class="fas fa-trash-alt pr-3"></i>Hapus</button></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row m-1 mt-4"
        style="background: #FFFFFF !important; border-radius: 10px; padding-left: 20px; padding-right: 20px; padding-top: 15px; padding-bottom: 15px; box-shadow: 1px 2px 14px rgba(0,0,0,0.1);">
        <h3 class="p-2" style="font-weight: 600;">Tagihan Bulanan</h3>
        <table class="w-100">
            <thead align="center">
                <tr style="border-bottom: 1px solid #888; height: 50px;">
                    <td style="font-weight: 600;">No</td>
                    <td style="font-weight: 600;">Jenis Pembayaran</td>
                    <td style="font-weight: 600;">Total Tagihan</td>
                    <td style="font-weight: 600;">Sudah Dibayar</td>
                    <td style="font-weight: 600;">Sisa</td>
                    <td style="font-weight: 600;">Status</td>
                    <td style="font-weight: 600;">Aksi</td>
                </tr>
            </thead>
            <tbody align="center">
                @php
                $no = 1;
                @endphp
                @foreach ($tagihan_spp as $ts)
                <tr style="height: 50px;">
                    <td>{{ $no++ }}</td>
                    <td>{{ $ts->tipetagihan->nama_tagihan }}</td>
                    <td>Rp. {{ $ts->tipetagihan->nominal }}</td>
                    <td>Rp. {{ $ts->sudah_dibayar }}</td>
                    <td>
                        @php
                            echo "Rp. " . ($ts->tipetagihan->nominal - $ts->sudah_dibayar)
                        @endphp
                    </td>
                    <td>@if($ts->keterangan=="blm_lunas")Belum Lunas @else Lunas @endif</td>
                    <td><a type="button" class="btn btn-success"
                            style="padding-top: 5px; padding-bottom: 5px; font-size: 12px;"
                            href="{{ url('pembayaran/entripembayaran') }}">Bayar</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="row m-1 mt-5 mb-4"
        style="background: #FFFFFF !important; border-radius: 10px; padding-left: 20px; padding-right: 20px; padding-top: 15px; padding-bottom: 15px; box-shadow: 1px 2px 14px rgba(0,0,0,0.1);">
        <h3 class="p-2" style="font-weight: 600;">Tagihan Lainnya</h3>
        <table class="w-100">
            <thead align="center">
                <tr style="border-bottom: 1px solid #888; height: 50px;">
                    <td style="font-weight: 600;">No</td>
                    <td style="font-weight: 600;">Jenis Pembayaran</td>
                    <td style="font-weight: 600;">Total Tagihan</td>
                    <td style="font-weight: 600;">Sudah Dibayar</td>
                    <td style="font-weight: 600;">Sisa</td>
                    <td style="font-weight: 600;">Status</td>
                    <td style="font-weight: 600;">Aksi</td>
                </tr>
            </thead>
            <tbody align="center">
                @php
                    $no2 = 1;
                @endphp
                @foreach ($tagihan as $t)
                <tr style="height: 50px;">
                    <td>{{ $no2++ }}</td>
                    <td>{{ $t->tipetagihan->nama_tagihan }}</td>
                    <td>Rp. {{ $t->tipetagihan->nominal }}</td>
                    <td>Rp. {{ $t->sudah_dibayar }}</td>
                    <td>
                        @php
                            echo "Rp. " . ($t->tipetagihan->nominal - $t->sudah_dibayar)
                        @endphp
                    </td>
                    <td>@if($t->keterangan=="blm_lunas")Belum Lunas @else Lunas @endif</td>
                    <td><a type="button" class="btn btn-success"
                            style="padding-top: 5px; padding-bottom: 5px; font-size: 12px;"
                            href="{{ url('pembayaran/entripembayaran') }}">Bayar</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="row mt-4 pt-3 ml-1">
        <h3>History Pembayaran</h3>
    </div>

    @foreach ($history as $h)
    <a href="{{ url('data/siswa/detail/' . $h->tagihan->siswa->slug . '/' . $h->tagihan->siswa->id) }}">
        <div class="col-md-12 mt-3 mb-4"
            style="background: #FFFFFF !important; border-radius: 10px; padding-left: 20px; padding-right: 20px; padding-top: 15px; padding-bottom: 25px; box-shadow: 1px 2px 14px rgba(0,0,0,0.1);">
            <div class="row">
                <div class="col">
                    <p>Pembayaran {{ $h->tagihan->tipetagihan->nama_tagihan }}</p>
                </div>
                <div class="col">
                    <p class="float-right">{{ $h->created_at }}</p>
                </div>
            </div>
            <h4>{{ $h->tagihan->siswa->nama_siswa }}</h4>
        </div>
    </a>
    @endforeach


</div>

@include('partials.footer')
@endsection