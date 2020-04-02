@extends('layouts.layout')
@section('title','History')

@section('content')

<div id="main-content">
    <div class="row">
        <div class="col-9">
            <h1>History Pembayaran</h1>
            <nav class="breadcrumb">
                <a class="breadcrumb-item" href="{{url('/')}}">Beranda</a>
                <a class="breadcrumb-item" href="{{url('pembayaran/history')}}">History Pembayaran</a>
                <span class="breadcrumb-item active"></span>
            </nav>
        </div>
        <div class="col-3 pl-0 d-flex justify-content-center align-items-center mt-4 pt-3">
            <button type="button" class="btn w-100" id="btn-generate"
                style="background: #3AA9A5; color: #ffffff; box-shadow: 1px 3px 6px rgba(0,0,0,0.1); height: 47px;">
                Generate Report
                <i class="ml-2 fas fa-file-download"></i>
            </button>
        </div>
    </div>
    <div class="clearfix"></div>

    {{-- @if(Auth::User()->role->nama_role=="siswa") --}}

    @foreach ($history_siswa as $h)
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

    {{-- @else --}}

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

    {{-- @endif --}}

</div>

@include('partials.footer')
@endsection

@push('extras-js')
<script>
    $('#btn-generate').on('click', function () {
        var jenis_filter =
            "<select name='jenis_filter' id='jenis_filter' class='form-control greylight-bg w-100 pl-2' style='height: 37px; border: none; border-radius: 7px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1); margin-top: 10px;'>";
        jenis_filter += "<option value=''>Pilih Filter</option>";
        jenis_filter += "<option value='jenis_perbulan'>Perbulan</option>";
        jenis_filter += "<option value='jenis_triwulan'>Triwulan</option>";
        jenis_filter += "<option value='jenis_semester'>Semester</option>";
        jenis_filter += "<option value='jenis_pertahun'>Pertahun</option>";
        jenis_filter += "</select>";

        var jenis_perbulan =
            "<select name='jenis_perbulan' id='jenis_perbulan' class='form-control greylight-bg w-100 pl-2 klik' style='height: 37px; border: none; border-radius: 7px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1); margin-top: 10px; margin-top: 25px;'>";
        jenis_perbulan += "<option value=''>Pilih Perbulan</option>";
        jenis_perbulan += "<option value='Januari'>Januari</option>";
        jenis_perbulan += "<option value='Februari'>Februari</option>";
        jenis_perbulan += "<option value='Maret'>Maret</option>";
        jenis_perbulan += "<option value='April'>April</option>";
        jenis_perbulan += "<option value='Mei'>Mei</option>";
        jenis_perbulan += "<option value='Juni'>Juni</option>";
        jenis_perbulan += "<option value='Juli'>Juli</option>";
        jenis_perbulan += "<option value='Agustus'>Agustus</option>";
        jenis_perbulan += "<option value='September'>September</option>";
        jenis_perbulan += "<option value='Oktober'>Oktober</option>";
        jenis_perbulan += "<option value='November'>November</option>";
        jenis_perbulan += "<option value='Desember'>Desember</option>";
        jenis_perbulan += "</select>";

        var jenis_triwulan =
            "<select name='jenis_triwulan' id='jenis_triwulan' class='form-control greylight-bg w-100 pl-2 klik' style='height: 37px; border: none; border-radius: 7px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1); margin-top: 10px; margin-top: 25px;'>";
        jenis_triwulan += "<option value=''>Pilih Triwulan</option>";
        jenis_triwulan += "<option value='Januari-Februari-Maret'>Januari - Februari - Maret</option>";
        jenis_triwulan += "<option value='April-Mei-Juni'>April - Mei - Juni</option>";
        jenis_triwulan += "<option value='Juli-Agustus-September'>Juli - Agustus - September</option>";
        jenis_triwulan +=
            "<option value='Oktober-November-Desember'>Oktober - November - Desember</option>";
        jenis_triwulan += "</select>";

        var jenis_semester =
            "<select name='jenis_semester' id='jenis_semester' class='form-control greylight-bg w-100 pl-2 klik' style='height: 37px; border: none; border-radius: 7px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1); margin-top: 10px; margin-top: 25px;'>";
        jenis_semester += "<option value=''>Pilih Semester</option>";
        jenis_semester +=
            "<option value='Januari-Februari-Maret-April-Mei-Juni'>Januari - Februari - Maret - April - Mei - Juni</option>";
        jenis_semester +=
            "<option value='Juli-Agustus-September-Oktober-November-Desember'>Juli - Agustus - September - Oktober - November - Desember</option>";
        jenis_semester += "</select>";

        var jenis_pertahun =
            "<select name='jenis_pertahun' id='jenis_pertahun' class='form-control greylight-bg w-100 pl-2 klik' style='height: 37px; border: none; border-radius: 7px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1); margin-top: 10px; margin-top: 25px;'>";
        jenis_pertahun += "<option value=''>Pilih Pertahun</option>";
        jenis_pertahun += "<option value='2020'>2020</option>";
        jenis_pertahun += "<option value='2019'>2019</option>";
        jenis_pertahun += "</select>";

        Swal.fire({
            title: '<span class="m-2">Generate Report</span>',
            html: jenis_filter +
                "<a href='' jenis='' class='btn text-light w-100 btn-generate' style='margin-bottom:20px; margin-top: 30px; background: #3AA9A5;'>Generate Laporan</a>",
            showCloseButton: true,
            showCancelButton: false,
            showConfirmButton: false,
            focusConfirm: false,
        })

        $('#jenis_filter').on('change', function () {
            var jenis_filter = $(this).children("option:selected").val();
            if ($(this).attr('status')) {
                $(this).next().remove();
                if (jenis_filter == 'jenis_perbulan') {
                    $(this).after(jenis_perbulan);
                } else if (jenis_filter == 'jenis_triwulan') {
                    $(this).after(jenis_triwulan);
                } else if (jenis_filter == 'jenis_semester') {
                    $(this).after(jenis_semester);
                } else {
                    $(this).after(jenis_pertahun);
                }
            } else {
                $(this).attr('status', 'active');
                if (jenis_filter == 'jenis_perbulan') {
                    $(this).after(jenis_perbulan);
                } else if (jenis_filter == 'jenis_triwulan') {
                    $(this).after(jenis_triwulan);
                } else if (jenis_filter == 'jenis_semester') {
                    $(this).after(jenis_semester);
                } else {
                    $(this).after(jenis_pertahun);
                }
            }
            $('.btn-generate').attr("href","cetak_pdf/" + jenis_filter);
            $('.btn-generate').attr("jenis",jenis_filter);

            $('#' + jenis_filter).on('change', function () {
                var periode = $(this).children("option:selected").val();
                var jenis_filter = $('.btn-generate').attr('jenis');
                $('.btn-generate').attr("href","cetak_pdf/" + jenis_filter + "/" + periode);
            });
        });
    });
</script>
@endpush