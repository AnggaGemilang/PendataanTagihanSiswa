@extends('layouts.layout')
@section('title','Beranda')

@section('content')

<div id="main-content" class="m-1">
    <h1>Beranda</h1>
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{url('/')}}">Beranda</a>
        <span class="breadcrumb-item active"></span>
    </nav>

    @if(Auth::User()->role_id=="1")

    <div class="col-md-12 content-siswa">
        <div class="row atas-siswa">
            <div class="col">
                <h4 class="p-2 w-100 mb-4" style="font-weight: 600;">Informasi</h4>
            </div>
            <div class="col">
                <h4 class="float-right pt-2"><span id="wrapper-day"></span><span id="wrapper-date"></span></h4>
            </div>
        </div>
        <div class="row info-content">
            <span class="pl-2 border-informasi"></span>
            <p>Tidak Ada Informasi</p>
        </div>
    </div>

    <div class="row mt-4 ml-1">
        <h3>History Pembayaran</h3>
    </div>

    @if($history->count()==0)
    <div class="alert alert-danger mt-3" role="alert">
        <i class="fas fa-exclamation-circle pr-2"></i> Data Tidak Ditemukan, segera lakukan pembayaran kepada petugas.
    </div>
    @else
    @foreach ($history_siswa as $h)
    <div class="col-md-12 mt-3 mb-4" id="item-history" data-id="{{ $h->id }}" data-sisa="{{ $h->sisa_tagihan }}" data-diterima="{{ $h->nominal }}">
        <div class="row">
            <div class="col bawah">
                <p>Pembayaran {{ $h->tagihan->tipetagihan->nama_tagihan }}</p>
            </div>
            <div class="col bawah">
                <p class="float-right kekiri">{{ $h->created_at }}</p>
            </div>
        </div>
        <h3 style="margin-top: -5px;" class="uang">Rp. {{ $h->nominal }}</h3>
    </div>
    @endforeach
    @endif

    @else

    <div class="col-md-12 mt-4 pt-3">
        <div class="row">
            <div class="col mr-4 atas"
                style="background: #24143F; border-radius: 10px; color: #FFFFFF; padding: 20px; position: relative;">
                <h4>Siswa Membayar</h4>
                <h1 style="font-size: 60px;">{{ $countbayar }}</h1>
                <img src="{{asset('assets')}}/images/profil-icon.png" alt=""
                    style="position: absolute; right: -20px; top: 30px;">
            </div>
            <div class="col ml-4 atas"
                style="background: #24143F; border-radius: 10px; color: #FFFFFF; padding: 20px; position: relative;">
                <h4 id="tgl-hari"></h4>
                <h1 style="font-size: 60px;" id="waktu"></h1>
                <img src="{{asset('assets')}}/images/jam-icon.png" alt=""
                    style="position: absolute; right: -20px; top: 30px;">
            </div>
        </div>
    </div>

    <div class="row mt-4 ml-1">
        <h3>Pembayaran Hari ini</h3>
    </div>

    @if($history->count()==0)
    <div class="alert alert-danger mt-3" role="alert">
        <i class="fas fa-exclamation-circle pr-2"></i> Data Tidak Ditemukan, Klik <a
            href="{{ url('pembayaran/entripembayaran') }}" class="alert-no-data">Disini</a> untuk menambahkan pembayaran
        baru.
    </div>
    @else
    @foreach ($history as $h)
    <div class="col-md-12 mt-3 mb-4" id="item-history" data-id="{{ $h->id }}" data-sisa="{{ $h->sisa_tagihan }}" data-diterima="{{ $h->nominal }}">
        <div class="row history">
            <div class="col bawah">
                <p>Pembayaran {{ $h->tagihan->tipetagihan->nama_tagihan }}</p>
            </div>
            <div class="col bawah">
                <p class="float-right kekiri">{{ $h->created_at }}</p>
            </div>
        </div>
        <h4>{{ $h->tagihan->siswa->nama_siswa }}</h4>
    </div>
    @endforeach
    @endif

    @endif

</div>

@include('partials.footer')
@endsection

@push('extras-css')
<style>
    .penghalang {
        height: 99.5% !important;
    }

    @media (max-width: 865px) {
        .row>.col.atas {
            flex: 0 0 100%;
        }

        .row>.col.atas:last-child {
            margin-top: 20px !important;
            margin-left: 0px !important;
        }

        .info-content {
            margin-top: 14px;
            margin-bottom: -6px;
        }

        .info-content>p {
            margin-bottom: 0px !important;
        }
    }

    @media (max-width: 556px) {
        .row.atas-siswa>.col {
            flex: 0 0 100%;
        }

        .row.atas-siswa>.col:nth-child(2) {
            margin-top: -5px;
            margin-left: 7px;
        }

        .row.atas-siswa>.col>h4 {
            margin-bottom: 0px !important;
            float: left !important;
        }
    }

    @media (max-width: 468px) {
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

    @media (max-width: 431px) {
        .row>.col.atas>img {
            display: none;
        }
    }
</style>
@endpush

@push('extras-js')
<script>
    setInterval(function () {
        var weekday = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu"];
        var date = new Date();

        $('#wrapper-day').html(
            weekday[date.getDay()] + ", "
        ).css('margin-right', '8px');

        $('#wrapper-date').html(
            ((date.getDate() < 10) ? "0" + date.getDate() : date.getDate()) + " - " + ((date.getMonth() <
                10) ? "0" + date.getMonth() : date.getMonth()) + " - " + date
            .getFullYear() + ", " + ((date.getHours() < 10) ? "0" + date.getHours() : date.getHours()) +
            ":" + ((date.getMinutes() < 10) ? "0" + date.getMinutes() : date.getMinutes()) + ":" + ((date
                .getSeconds() < 10) ? "0" + date.getSeconds() : date.getSeconds())
        );

        $('#tgl-hari').html(
            weekday[date.getDay()] + ", " + ((date.getDate() < 10) ? "0" + date.getDate() : date
                .getDate()) + " - " + ((date.getMonth() < 10) ? "0" + date.getMonth() : date.getMonth()) +
            " - " +
            date
            .getFullYear()
        );
        $('#waktu').html(
            ((date.getHours() < 10) ? "0" + date.getHours() : date.getHours()) +
            ":" + ((date.getMinutes() < 10) ? "0" + date.getMinutes() : date.getMinutes()) + ":" + ((date
                .getSeconds() < 10) ? "0" + date.getSeconds() : date.getSeconds())
        );
    }, 500);

    $(document).on('click', '#item-history', function () {
        var id = $(this).data('id');
        var diterima = conventer($(this).data('diterima'));
        var sisa = conventer($(this).data('sisa'));
        $.ajax({
            url: 'pembayaran/history/detail/' + id,
            type: 'get',
            data: {
                diterima: diterima,
                sisa: sisa
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