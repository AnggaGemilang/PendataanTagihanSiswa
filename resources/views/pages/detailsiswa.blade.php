@extends('layouts.layout')
@section('title')
{{ $siswa->nama_siswa }}
@endsection

@section('content')

<div id="main-content">
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{url('/')}}">Beranda</a>
        <a class="breadcrumb-item" href="{{url('/data/siswa')}}">Data Siswa</a>
        <a class="breadcrumb-item"
            href="{{url('/data/siswa/detail/' . $siswa->slug . '/' . $siswa->id)}}">{{ $siswa->nama_siswa }}</a>
        <span class="breadcrumb-item active"></span>
    </nav>

    <div class="row mt-4 ml-2" style="margin-right: 8px;">

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
        <div class="col-md-5 d-flex justify-content-center pl-0 ml-0">
            <img src="{{ asset('uploaded/images/profil_siswa/' . $siswa->profil) }}" alt="" class="prev-profil">
            <button type="button" class="btn btn-info position-absolute btn-toggle-option">
                <i class="fas fa-ellipsis-v" style="color: #241937; "></i></button>
            <div class="dropdown-detail">
                <div class="triangle"></div>
                <ul class="pl-0 mb-0">
                    <a href="{{ url('data/siswa/perbaharui/' . $siswa->slug . '/' . $siswa->id) }}">
                        <li><i class="fas fa-pencil-alt pr-3 pt-1"></i>Edit</li>
                    </a>
                    <a href="" onclick="event.preventDefault()">
                        <li id="btn-hapus" data-direct="/data/siswa" data-url="{{ url('data/siswa/hapus/' . $siswa->id) }}">
                            <i class="fas fa-trash-alt pr-3"></i>Hapus
                        </li>
                    </a>
                </ul>
            </div>
        </div>
    </div>

    <div class="row m-1 mt-4 bg-data">
        <h3 class="p-2" style="font-weight: 600;">Tagihan Bulanan</h3>
        <table class="w-100">
            <thead align="center">
                <tr style="border-bottom: 1px solid #888; height: 50px;">
                    <td class="except" style="font-weight: 600;">No</td>
                    <td class="change" style="font-weight: 600;">Jenis Tagihan</td>
                    <td class="change" style="font-weight: 600;">Total Tagihan</td>
                    <td class="change" style="font-weight: 600;">Sudah Dibayar</td>
                    <td class="change" style="font-weight: 600;">Sisa</td>
                    <td class="change" style="font-weight: 600;">Status</td>
                    <td class="change" style="font-weight: 600;">Aksi</td>
                </tr>
            </thead>
            <tbody align="center">
                @php
                $no = 1;
                @endphp
                @foreach ($tagihan_spp as $ts)
                <tr style="height: 50px;">
                    <td class="except">{{ $no++ }}</td>
                    <td class="change">{{ $ts->tipetagihan->nama_tagihan }}</td>
                    <td class="change uang">{{ $ts->tipetagihan->nominal }}</td>
                    <td class="change uang">{{ $ts->sudah_dibayar }}</td>
                    <td class="change uang">@php echo($ts->tipetagihan->nominal-$ts->sudah_dibayar)@endphp</td>
                    <td class="change">@if($ts->keterangan=="blm_lunas")Belum Lunas @else Lunas @endif</td>
                    <td class="change">
                        <a @if($ts->keterangan=='lunas') class="disabled btn" @else class="btn" @endif
                            style="background: #241937; color: white; padding-top: 5px; padding-bottom: 5px; font-size:
                            12px;"
                            href="{{ url('pembayaran/entripembayaran/' . $ts->siswa->class->id .  '/' . $ts->siswa->id . '/' . $ts->id) }}">Bayar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if($tagihan_spp->count()==0)
        <div class="alert alert-danger mt-4 w-100" role="alert">
            <i class="fas fa-exclamation-circle pr-2"></i> Data Tidak Ditemukan, Klik <a
                href="{{ url('data/tipetagihan/tambah') }}" class="alert-no-data">Disini</a> untuk menambahkan tagihan baru.
        </div>
        @endif
    </div>

    <div class="row m-1 mt-4 mb-4 bg-data">
        <h3 class="p-2" style="font-weight: 600;">Tagihan Lainnya</h3>
        <table class="w-100">
            <thead align="center">
                <tr style="border-bottom: 1px solid #888; height: 50px;">
                    <td class="except" style="font-weight: 600;">No</td>
                    <td class="change" style="font-weight: 600;">Jenis Tagihan</td>
                    <td class="change" style="font-weight: 600;">Total Tagihan</td>
                    <td class="change" style="font-weight: 600;">Sudah Dibayar</td>
                    <td class="change" style="font-weight: 600;">Sisa</td>
                    <td class="change" style="font-weight: 600;">Status</td>
                    <td class="change" style="font-weight: 600;">Aksi</td>
                </tr>
            </thead>
            <tbody align="center">
                @php
                $no2 = 1;
                @endphp
                @foreach ($tagihan as $t)
                <tr style="height: 50px;">
                    <td class="except">{{ $no2++ }}</td>
                    <td class="change">{{ $t->tipetagihan->nama_tagihan }}</td>
                    <td class="change uang">{{ $t->tipetagihan->nominal }}</td>
                    <td class="change uang">{{ $t->sudah_dibayar }}</td>
                    <td class="change uang">@php echo($t->tipetagihan->nominal - $t->sudah_dibayar)@endphp</td>
                    <td class="change">@if($t->keterangan=="blm_lunas")Belum Lunas @else Lunas @endif</td>
                    <td class="change">
                        <a @if($t->keterangan=='lunas') class="disabled btn" @else class="btn" @endif
                            style="background: #241937; color: white; padding-top: 5px; padding-bottom: 5px; font-size:
                            12px;"
                            href="{{ url('pembayaran/entripembayaran/' . $ts->siswa->class->id .  '/' . $ts->siswa->id . '/' . $t->id) }}">Bayar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if($tagihan->count()==0)
        <div class="alert alert-danger mt-4 w-100" role="alert">
            <i class="fas fa-exclamation-circle pr-2"></i> Data Tidak Ditemukan, Klik <a
                href="{{ url('data/tipetagihan/tambah') }}" class="alert-no-data">Disini</a> untuk menambahkan tagihan baru.
        </div>
        @endif
    </div>

    @if(Auth::User()->role_id!='1')

    <div class="row mt-4 pt-3 ml-1">
        <h3>History Pembayaran</h3>
    </div>

    @if($history->count()==0)
    <div class="alert alert-danger mt-3" role="alert">
        <i class="fas fa-exclamation-circle pr-2"></i> Data Tidak Ditemukan, Klik <a
            href="{{ url('pembayaran/entripembayaran/') }}" class="alert-no-data">Disini</a> untuk menambahkan
        pembayaran
        baru.
    </div>
    @else
    @foreach ($history->take(10) as $h)
    <div class="col-md-12 mt-4 mb-4" id="item-history" data-id="{{ $h->id }}" data-sisa="{{ $h->sisa_tagihan }}"
        data-diterima="{{ $h->nominal }}">
        <div class="row">
            <div class="col bawah">
                <p>Pembayaran {{ $h->tagihan->tipetagihan->nama_tagihan }}</p>
            </div>
            <div class="col bawah">
                <p class="float-right kekiri">{{ $h->created_at }}</p>
            </div>
        </div>
        <h3 style="margin-top: -5px;" class="uang">{{ $h->nominal }}</h3>
    </div>
    @endforeach
    @endif
    @endif

    <div class="row mt-0 justify-content-end mr-2">
        <p style="font-weight: 400;"><span id="custom-count">{{$history->take(10)->count()}}</span> dari {{ $history->count() }} Data Ditampilkan</p>
    </div>

</div>

@include('partials.footer')
@endsection

@push('extras-css')
<style>
    a.disabled {
        pointer-events: none;
        cursor: default;
        background: #534D5B !important;
    }

    .bg-data {
        background: #FFFFFF !important;
        border-radius: 10px;
        padding-left: 20px;
        padding-right: 20px;
        padding-top: 15px;
        display: inline-block;
        width: 100%;
        padding-bottom: 15px;
        box-shadow: 1px 2px 14px rgba(0, 0, 0, 0.1);
        overflow-x: auto;
    }

    .prev-profil {
        width: 240px;
        height: 240px;
        border-radius: 50px;
        object-fit: cover;
        margin-top: 15px;
    }

    td.except {
        min-width: 50px !important;
    }

    td.change {
        min-width: 144px !important;
    }

    .btn-toggle-option {
        right: 0px;
        top: 18px;
        border: none;
        outline: none !important;
        font-size: 20px;
    }

    @media(max-width: 910px) {

        .row>.col-md-7,
        .row>.col-md-5 {
            flex: 0 0 100% !important;
            max-width: 100%;
        }

        .row>.col-md-5 {
            margin-right: 0px !important;
            padding-right: 0px !important;
        }
    }

    @media(max-width: 498px) {
        td>h4 {
            font-size: 17px;
        }

        .row>h2.mb-4 {
            font-size: 32px !important;
        }

        .bg-data>h3 {
            font-size: 23px;
        }

        .bg-data>table>thead>tr {
            font-size: 17px;
        }

        .bg-data>table>tbody>tr {
            font-size: 15px !important;
        }
    }

    @media(max-width: 458px) {
        #item-history>h4 {
            margin-bottom: 0px !important;
        }

        #item-history>h3 {
            margin-top: 0px !important;
            margin-bottom: 0px !important;
        }

        .row>.col.bawah {
            flex: 0 0 100%;
        }

        .row>.col.bawah>p {
            margin-bottom: 5px !important;
        }

        .row>.col.bawah:nth-child(2)>p {
            margin-top: -2px !important;
        }

        p.kekiri {
            float: left !important;
        }
    }
</style>
@endpush

@push('extras-js')
<script>
    $(document).ready(function () {
        var value;
        $('.uang').each(function (i) {
            value = $(this).text();
            console.log(value + ' : ' + i);
            $(this).html(conventer(value, i));
        });
    });

    $(document).on('click', '#item-history', function () {
        var id = $(this).data('id');
        var diterima = conventer($(this).data('diterima'));
        var sisa = conventer($(this).data('sisa'));
        console.log(diterima);
        console.log(sisa);
        $.ajax({
            url: window.location.origin + '/pembayaran/history/detail/' + id,
            type: 'get',
            data: {
                sisa: sisa,
                diterima: diterima
            },
            dataType: 'json',
            success: function (data) {
                console.log(data);
                swal.fire({
                    html: data,
                    showCloseButton: true,
                    showCancelButton: false,
                    showConfirmButton: false,
                    focusConfirm: false,
                });
            },
            error: function (data) {
                console.log("Gagal" + data);
            }
        });
    });
</script>
@endpush