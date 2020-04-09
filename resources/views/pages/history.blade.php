@extends('layouts.layout')
@section('title','History')

@section('content')

<div id="main-content">
    <div class="row paling-atas">
        <div @if(Auth::User()->role_id=="1" || Auth::User()->role_id=="3") class="col-12" @else class="col-9" @endif>
            <h1>History Pembayaran</h1>
            <nav class="breadcrumb">
                <a class="breadcrumb-item" href="{{url('/')}}">Beranda</a>
                <a class="breadcrumb-item" href="{{url('pembayaran/history')}}">History Pembayaran</a>
                <span class="breadcrumb-item active"></span>
            </nav>
        </div>
        @if(Auth::User()->role_id=="2")
        <div class="col-3 pl-0 d-flex justify-content-center align-items-center mt-4 pt-3">
            <button type="button" class="btn w-100" id="btn-generate" data-baseurl="{{ url('/') }}"
                style="background: #24143F; color: #ffffff; box-shadow: 1px 3px 6px rgba(0,0,0,0.1); height: 47px;">
                Generate Report
                <i class="ml-2 fas fa-file-download"></i>
            </button>
        </div>
        @endif
    </div>
    <div class="clearfix"></div>

    <div class="row mt-3">
        <div class="col-md-6">
            <div class="form-group position-relative">
                <i class="fas fa-search position-absolute" style="margin-left: 15px; margin-top: 11px;"></i>
                <input type="text" class="form-control pl-5 input-toggle-times" name="filter_history" id="filter_history" aria-describedby="helpId" placeholder="Cari Pembayaran Siswa Disini . . ."
                style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1); padding-top: 8px;">
                    <button class="btn-times2"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="col-md-3 pl-0">
            <div class="form-group">
                <select class="custom-select" name="filter_change_history" id="filter_change_history"
                    style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1); padding-top: 8px;">
                    <option selected value="">Plih Jenis Tagihan</option>
                    @foreach ($tipetagihan as $tt)
                    <option value="{{ $tt->nama_tagihan }}">{{ $tt->nama_tagihan }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-3 pl-0">
            <div class="form-group position-relative">
                <input type="text" id="filter_tanggal" placeholder="Tanggal" class="date_picker w-100"
                    style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1); padding-top: 2px; height: 38px; outline: none; padding-left: 20px;">
                    <button class="btn-times"><i class="fa fa-times"></i></button>
            </div>
        </div>
    </div>

    @if(Auth::User()->role_id=="1")
    <div class="row m-1" id="wrapper-history">
        @if($history->count()==0)
        <div class="container-fluid mt-3">
            <div class="row d-flex justify-content-center align-content-center content-no-data" style="min-height: 47vh;">
                <h4>TIdak Ada Data</h4>
            </div>
        </div>
        @else
        @foreach ($history_siswa as $h)
        <div class="col-md-12 mt-3 mb-2" id="item-history" data-id="{{ $h->id }}">
            <div class="row">
                <div class="col">
                    <p>Pembayaran {{ $h->tagihan->tipetagihan->nama_tagihan }}</p>
                </div>
                <div class="col">
                    <p class="float-right kekiri">{{ $h->created_at }}</p>
                </div>
            </div>
            <h3 style="margin-top: -5px;">Rp. {{ $h->nominal }}</h3>
        </div>
        @endforeach
        @endif
    </div>

    @else

    <div class="row m-1" id="wrapper-history">
        @if($history->count()==0)
        <div class="container-fluid mt-3">
            <div class="row d-flex justify-content-center align-content-center content-no-data" style="min-height: 47vh;">
                <h4>TIdak Ada Data</h4>
            </div>
        </div>
        @else
        @foreach ($history as $h)
        <div class="col-md-12 mt-3 mb-2" id="item-history" data-id="{{ $h->id }}">
            <div class="row">
                <div class="col">
                    <p>Pembayaran {{ $h->tagihan->tipetagihan->nama_tagihan }}</p>
                </div>
                <div class="col">
                    <p class="float-right kekiri">{{ $h->created_at }}</p>
                </div>
            </div>
            <h4 style="margin-top: -5px;">{{ $h->tagihan->siswa->nama_siswa }}</h4>
        </div>
        </a>
        @endforeach
        @endif
    </div>

    @endif

</div>

@include('partials.footer')
@endsection

@push('extras-css')
<style>
    @media (max-width: 808px) {
        .row.paling-atas>.col-9 {
            flex: 0 0 100%;
            max-width: 100%;
        }

        .row.paling-atas>.col-3 {
            margin-top: -15px !important;
            margin-bottom: 18px;
            padding-left: 15px !important;
            flex: 0 0 100% !important;
            max-width: 100% !important;
        }
    }

    @media (max-width: 468px) {
        #item-history>h3 {
            margin-top: 5px !important;
            margin-bottom: 0px !important;
        }

        .row>.col>p {
            margin-bottom: 10px !important;
        }

        .row>.col:nth-child(2)>p {
            margin-top: -7px !important;
        }

        .row>.col {
            flex: 0 0 100%;
        }

        p.kekiri {
            float: left !important;
        }
    }

    @media (max-width: 767px) {
        .row.mt-3>.col-md-3 {
            margin-left: 15px;
        }
    }
</style>
@endpush

@push('extras-js')
<script>
    
    $(function () {
        $('.date_picker').datepicker({
            format: "yyyy-mm-dd",
            todayBtn: "linked",
            language: "id",
            orientation: "bottom auto",
        });

    });

    $(document).on('click', '#item-history', function () {
        var id = $(this).data('id');
        $.ajax({
            url: 'history/detail/' + id,
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

    var base_url = $('#btn-generate').attr('data-baseurl');
    var periode;
    var jenis_filter;

    $('button#btn-generate').on('click', function () {
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
                "<button disabled id='gen' href='' jenis='' class='btn text-light w-100 btn-generate' style='margin-bottom:20px; margin-top: 30px; background: #24143F;'>Generate Laporan</button>",
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
            $('.btn-generate').attr("href", "cetak_pdf/" + jenis_filter);
            $('.btn-generate').attr("jenis", jenis_filter);

            $('#' + jenis_filter).on('change', function () {
                if ($(this).children("option:selected").val() == '') {
                    $('#gen').attr('disabled');
                } else if ($(this).children("option:selected").val() != '') {
                    $('#gen').removeAttr('disabled');
                    periode = $(this).children("option:selected").val();
                    jenis_filter = $('.btn-generate').attr('jenis');
                }

            });
            $('#gen').on('click', function(e) {
                if ($('#' + jenis_filter).val() == '') {
                    e.preventDefault();
                    toastr.error("Mohon Lengkapi Form!", "Generate Gagal", {
                        "showMethod": "slideDown",
                        "hideMethod": "slideUp",
                        timeOut: 3000
                    });
                    return false;
                } else {
                    e.preventDefault();
                    var url = base_url + "/pembayaran/cetak_pdf/" + jenis_filter + "/" +
                    periode;
                    location.href = url;
                }
            });
        });
    });
</script>
@endpush