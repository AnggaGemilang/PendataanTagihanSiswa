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

    <div class="col-md-12"
        style="margin-top: 40px; background: #FFFFFF !important; border-radius: 10px; padding-left: 20px; padding-right: 20px; padding-top: 15px; padding-bottom: 30px; box-shadow: 1px 2px 14px rgba(0,0,0,0.1);">
        <div class="row">
            <div class="col">
                <h4 class="p-2 w-100 mb-4" style="font-weight: 600;">Informasi</h4>
            </div>
            <div class="col">
                <h4 class="float-right pt-2" id="wrapper-clock"></h4>
            </div>
        </div>
        <div class="row">
            <span class="pl-2"
                style="margin-top: 4px; margin-right: 4px; margin-left: 25px; border-left: 3px #1A9B96 solid; height: 20px;"></span>
            <p>Tidak Ada Informasi</p>
        </div>
    </div>

    <div class="row mt-4 ml-1">
        <h3>History Pembayaran</h3>
    </div>

    @foreach ($history_siswa as $h)
    <div class="col-md-12 mt-3 mb-4" id="item-history">
        <div class="row">
            <div class="col">
                <p>Pembayaran {{ $h->tagihan->tipetagihan->nama_tagihan }}</p>
            </div>
            <div class="col">
                <p class="float-right">{{ $h->created_at }}</p>
            </div>
        </div>
        <h3 style="margin-top: -5px;">Rp. {{ $h->nominal }}</h3>
    </div>
    @endforeach

    @else

    <div class="col-md-12 mt-4 pt-3">
        <div class="row">
            <div class="col mr-4"
                style="background: #3AA9A5; border-radius: 10px; color:#FFFFFF; padding: 20px; position: relative;">
                <h4>Siswa Membayar</h4>
                <h1 style="font-size: 60px;">{{ $countbayar }}</h1>
                <img src="{{asset('assets')}}/images/profil-icon.png" alt=""
                    style="position: absolute; right: -20px; top: 30px;">
            </div>
            <div class="col ml-4"
                style="background: #3AA9A5; border-radius: 10px; color: #FFFFFF; padding: 20px; position: relative;">
                <h4 id="tgl-hari"></h4>
                <h1 style="font-size: 60px;" id="waktu"></h1>
                <img src="{{asset('assets')}}/images/jam-icon.png" alt=""
                    style="position: absolute; right: -20px; top: 30px;">
            </div>
        </div>
    </div>

    <div class="row mt-4 ml-1">
        <h3>History Pembayaran</h3>
    </div>

    @foreach ($history as $h)
    <div class="col-md-12 mt-3 mb-4" id="item-history" data-id="{{ $h->id }}">
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
    @endforeach

    @endif

</div>

@include('partials.footer')
@endsection

@push('extras-js')
<script>
    setInterval(function () {
        var weekday = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu"];
        var date = new Date();
        $('#wrapper-clock').html(
            weekday[date.getDay()] + ", " + date.getDate() + " - " + date.getMonth() + " - " + date
            .getFullYear() + ", " + date.getHours() +
            ":" + date.getMinutes() + ":" + date.getSeconds()
        );

        $('#tgl-hari').html(weekday[date.getDay()] + ", " + date.getDate() + " - " + date.getMonth() + " - " +
            date.getFullYear());
        $('#waktu').html(date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds());
    }, 500);

    $(document).on('click', '#item-history', function () {
        var id = $(this).data('id');
        $.ajax({
            url: 'pembayaran/history/detail/' + id,
            type: 'get',
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