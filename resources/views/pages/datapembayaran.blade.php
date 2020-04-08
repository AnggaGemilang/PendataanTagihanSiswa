@extends('layouts.layout')
@section('title','Data Pembayaran')

@section('content')

<div id="main-content">
    <h1>Data Pembayaran</h1>
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{url('')}}">Beranda</a>
        <a class="breadcrumb-item" href="{{url('/pembayaran/data')}}">Data Pembayaran</a>
        <span class="breadcrumb-item active"></span>
    </nav>

    <div class="row m-1 mt-4 bg-data">
        <h3 class="p-2" style="font-weight: 600;">Tagihan Bulanan</h3>
        <table class="w-100">
            <thead align="center">
                <tr style="border-bottom: 1px solid #888; height: 50px;">
                    <td class="except" style="font-weight: 600;">No</td>
                    <td style="font-weight: 600;">Jenis Tagihan</td>
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
                    <td class="except">{{ $no++ }}</td>
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
                            style="padding-top: 5px; padding-bottom: 5px; font-size: 12px; color: white;"
                            href="{{ url('pembayaran/entripembayaran') }}">Bayar</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="row m-1 mt-4 mb-4 bg-data">
        <h3 class="p-2" style="font-weight: 600;">Tagihan Lainnya</h3>
        <table class="w-100">
            <thead align="center">
                <tr style="border-bottom: 1px solid #888; height: 50px;">
                    <td class="except" style="font-weight: 600;">No</td>
                    <td style="font-weight: 600;">Jenis Tagihan</td>
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
                    <td class="except">{{ $no2++ }}</td>
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
                            style="padding-top: 5px; padding-bottom: 5px; font-size: 12px; color: white;"
                            href="{{ url('pembayaran/entripembayaran') }}">Bayar</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('partials.footer')
@endsection

@push ('extras-css')
<style>
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
        min-width: 50px;
    }
    td:not(.except)
    {
        min-width: 144px !important;
    }

</style>
@endpush