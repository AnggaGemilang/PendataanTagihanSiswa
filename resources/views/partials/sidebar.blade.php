@php
if(\Request::is('/')) {
@$dashboard = 'active';
} else if(\Request::is('pembayaran/history')) {
@$history_pembayaran = 'active';
@$status = 'true';
} else if (\Request::is('pembayaran/entripembayaran')) {
@$entri_pembayaran = 'active';
} else if (\Request::is('data/siswa')) {
@$data_siswa = 'active';
} else if(\Request::is('data/kelas')) {
@$data_kelas = 'active';
} else if (\Request::is('data/petugas')) {
@$data_petugas = 'active';
} else if (\Request::is('data/tipetagihan')) {
@$data_tagihan = 'active';
} else if (\Request::is('pembayaran/data')) {
@$data_pembayaran = 'active';
} else if (\Request::is('ubahpassword')) {
@$ubah_password = 'active';
}
@endphp

<div class="wrapper" style="overflow: auto;">
    <span id="tanda-responsive"></span>
    <nav id="sidebar">
        <div class="sidebar-header" style="padding-top: 28px;">
            <a href="{{ url('/') }}">
                <h3 style="font-size: 20px;">
                    <i class="fas fa-wallet mr-2 pr-1"></i>
                    Tagihan Sekolah
                </h3>
                <strong><i class="fas fa-wallet pr-1"></i></strong>
            </a>
        </div>

        <ul class="list-unstyled components">
            <li style="padding: 12px 0px" id="profil-list">
                <a style="text-transform: capitalize;" @if(Auth::User()->role_id=="1")
                    href="{{url('profil/' . Auth::User()->siswa->slug . '/' . Auth::User()->siswa->id . '/' . Auth::User()->role_id)}}"
                    @else
                    href="{{url('profil/' . Auth::User()->petugas->slug . '/' . Auth::User()->petugas->id . '/' . Auth::User()->role_id)}}"
                    @endif>
                    <div class="profil-sidebar">
                        <img @if(Auth::User()->role_id=="1")
                        src="{{ asset('uploaded/images/profil_siswa/' . Auth::User()->siswa->profil) }}"
                        @else
                        src="{{ asset('uploaded/images/profil_petugas/' . Auth::User()->petugas->profil) }}"
                        @endif
                        style="width:100%; height:100%; border-radius:60px; object-fit: cover;" alt="">
                    </div>
                    @if(Auth::User()->role_id=="1")
                    <h6 id="biodata-section" class="profil-item">
                        {{ Auth::User()->siswa->nama_siswa }}</h6>
                    <h6 id="biodata-section" class="profil-item">
                        {{ Auth::User()->siswa->autentikasi->nomor_induk }}</h6>
                    @else
                    <h6 id="biodata-section" class="profil-item">
                        {{ Auth::User()->petugas->nama_petugas }}</h6>
                    <h6 id="biodata-section" class="profil-item">
                        {{ Auth::User()->petugas->autentikasi->nomor_induk }}</h6>
                    @endif
                    <div class="clearfix"></div>
                </a>
            </li>
            <li class="{{ @$dashboard }}" id="item-list" data-toggle="tooltip" data-placement="right" title="Home">
                <a href="{{ url('/') }}" id="data" data-baseurl="{{ url('/') }}">
                    <i class="fas fa-home" style="width: 18px;"></i>
                    <span>Beranda</span>
                </a>
            </li>
            <li class="{{ @$history_pembayaran }} {{ @$entri_pembayaran }} {{ @$data_pembayaran }}" id="item-list">
                <a href="#pageSubPembayaran" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-briefcase" style="width: 18px;"></i>
                    <span class="pembayaranSPP">Pembayaran</span>
                </a>
                <ul class="child-item-list collapse list-unstyled" id="pageSubPembayaran">
                    <li class="{{ @$history_pembayaran }}">
                        <a href="{{ url('pembayaran/history') }}" style="padding-left: 35px;" data-toggle="tooltip"
                            data-placement="right" title="History">
                            <i class="fas fa-history" style="width: 18px;"></i>
                            <span>History</span>
                        </a>
                    </li>

                    @if(Auth::User()->role_id=="2" || Auth::User()->role_id=="3")

                    <li class="{{ @$entri_pembayaran }}">
                        <a href="{{ url('pembayaran/entripembayaran') }}" style="padding-left: 35px;"
                            data-toggle="tooltip" data-placement="right" title="Entri">
                            <i class="fas fa-notes-medical" style="width: 18px;"></i>
                            <span>Entri</span>
                        </a>
                    </li>

                    @endif

                    @if(Auth::User()->role_id=="1")

                    <li class="{{ @$data_pembayaran }}">
                        <a href="{{ url('/pembayaran/data') }}" style="padding-left: 35px;" data-toggle="tooltip"
                            data-placement="right" title="Data Pembayaran">
                            <i class="fas fa-image" style="width: 18px;"></i>
                            <span>Data</span>
                        </a>
                    </li>

                    @endif

                </ul>
            </li>

            @if(Auth::User()->role_id=="2")

            <li class="{{ @$data_siswa }} {{ @$data_kelas }} {{ @$data_petugas }} {{ @$data_tagihan }}" id="item-list">
                <a href="#pageSubKelola" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-copy" style="width: 18px;"></i>
                    <span class="pembayaranSPP">Kelola Data</span>
                </a>
                <ul class="child-item-list collapse list-unstyled" id="pageSubKelola">
                    <li class="{{ @$data_siswa }}">
                        <a href="{{ url('/data/siswa') }}" style="padding-left: 27px;" data-toggle="tooltip"
                            data-placement="right" title="Data Siswa">
                            <i class="fas fa-user-graduate" style="width: 18px;"></i>
                            <span>Data Siswa</span>
                        </a>
                    </li>
                    <li class="{{ @$data_kelas }}">
                        <a href="{{ url('/data/kelas') }}" style="padding-left: 27px;" data-toggle="tooltip"
                            data-placement="right" title="Data Kelas">
                            <i class="fas fa-glass-whiskey" style="width: 18px;"></i>
                            <span>Data Kelas</span>
                        </a>
                    </li>
                    <li class="{{ @$data_petugas }}">
                        <a href="{{ url('/data/petugas') }}" style="padding-left: 27px;" data-toggle="tooltip"
                            data-placement="right" title="Data Petugas">
                            <i class="fas fa-cube" style="width: 18px;"></i>
                            <span>Data Petugas</span>
                        </a>
                    </li>
                    <li class="{{ @$data_tagihan }}">
                        <a href="{{ url('/data/tipetagihan') }}" style="padding-left: 27px;" data-toggle="tooltip"
                            data-placement="right" title="Data Tagihan">
                            <i class="fas fa-file-invoice-dollar" style="width: 18px;"></i>
                            <span>Jenis Tagihan</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li id="item-list">
                <a href="" data-toggle="tooltip" data-placement="right" title="Generate Laporan" id="btn-generate">
                    <i class="fas fa-chart-pie" style="width: 18px;"></i>
                    <span>Generate Laporan</span>
                </a>
            </li>
            @endif

            <li class="{{ @$ubah_password }}" id="item-list">
                <a href="{{ url('ubahpassword/') }}" data-toggle="tooltip" data-placement="right" title="Ubah Password">
                    <i class="fas fa-key" style="width: 18px;"></i>
                    <span>Ubah Password</span>
                </a>
            </li>
        </ul>
    </nav>

    <div id="content-section" class="status-sd">
        @include('partials.navbar')
        <div id="content">
            <div class="penghalang"></div>
            @yield('content')
        </div>
    </div>
</div>

@push('extras-js')
<script type="text/javascript">
    var base_url = $('#data').attr('data-baseurl');
    var periode;
    var jenis_filter;

    $(function () {
        $('[data-toggle="tooltip"]').tooltip({
            boundary: 'window'
        });
    })

    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });
    });

    $('a#btn-generate').on('click', function (e) {

        e.preventDefault();

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
                "<button disabled type='submit' id='gen' jenis='' class='btn text-light w-100 btn-generate' style='margin-bottom:20px; margin-top: 30px; background: #241937;'>Generate Laporan</button>",
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
            $('#gen').on('click', function (e) {
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

<style>
    #sidebar::-webkit-scrollbar {
        width: 2px;
    }

    #sidebar::-webkit-scrollbar-track {
        border-radius: 200px;
    }

    #sidebar::-webkit-scrollbar-thumb {
        background: #939393;
        border-radius: 200px;
    }

    #sidebar::-webkit-scrollbar-thumb:hover {
        background: darkgray;
    }
</style>