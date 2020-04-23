@extends('layouts.layout')
@section('title','Entri Pembayaran')

@section('content')
<div id="main-content">
    @if($status=='detailsiswa')
    <h1>Entri Pembayaran {{ $siswa->nama_siswa }}</h1>
    @else
    <h1>Entri Pembayaran</h1>
    @endif
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{url('/')}}">Beranda</a>
        @if($status=='detailsiswa')
        <a class="breadcrumb-item" href="{{url('/data/siswa')}}">Data Siswa</a>
        <a class="breadcrumb-item"
            href="{{url('data/siswa/detail/' . $siswa->slug . '/' . $siswa->id )}}">{{ $siswa->nama_siswa }}</a>
        <a class="breadcrumb-item"
            href="{{url('pembayaran/entripembayaran/' . $kelas->id . '/' . $siswa->id . '/' . $tagihan->id)}}">Tambah
            Pembayaran</a>
        <a class="breadcrumb-item"
            href="{{url('pembayaran/entripembayaran/' . $kelas->id . '/' . $siswa->id . '/' . $tagihan->id)}}">{{ $tagihan->tipetagihan->nama_tagihan }}</a>
        @else
        <a class="breadcrumb-item" href="{{url('pembayaran/entripembayaran')}}">Tambah Pembayaran</a>
        @endif
        <span class="breadcrumb-item active"></span>
    </nav>

    <div style="background: #EDE6F7; border-radius: 20px;" class="p-2 mt-4">
        <p class="mb-1 ml-2 pl-1 mt-2 text-dark" style="font-weight: 500;">Hal Yang Harus Diperhatikan</p>
        <ol style="opacity: 0.7;">
            <li>Form input dibawah saling berkaitan</li>
            <li>Jika anda memilih, hasilnya akan berbeda antara satu sama lain</li>
            <li>Tagihan tidak akan bisa diklik ketika sudah lunas</li>
            <li>Pastikan data yang ditambahkan sudah valid</li>
            <li>Sistem akan mengakumulasi secara otomatis hasil entri pembayaran</li>
        </ol>
    </div>

    <div class="col-md-12 mt-4 pb-2 mb-3" style="background: #FFFFFF; box-shadow: 1px 1px 12px rgba(0,0,0,0.1);">
        <div class="row" style="background: #241937 !important; height: 65px; align-content: center;">
            <p class="text-light m-0 pl-4" style="font-weight: 500;">Entri Pembayaran Tagihan</p>
        </div>

        <form action="" method="post" id="form-submit" data-baseurl="{{ url('/') }}">

            {{ csrf_field() }}

            <div class="row m-3 mt-4 pt-1">
                <div class="form-group w-100">
                    <label for="kelas_id">Kelas</label>
                    <select name="kelas_id" id="kelas_id" class="form-control greylight-bg w-100 pl-2"
                        style="height: 37px; border: none; border-radius: 7px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);">
                        @if($status=='detailsiswa')
                        <option value="{{ $kelas->id }}" slug="{{ $kelas->nama_kelas }}">{{ $kelas->nama_kelas }}
                        </option>
                        @else
                        <option value="">Pilih Kelas</option>
                        @foreach($kelas as $k)
                        <option value="{{ $k->id }}" slug="{{ $k->nama_kelas }}">
                            {{ $k->nama_kelas }}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
            </div>

            <div class="row m-3">
                <div class="form-group w-100">
                    <label for="siswa_id">Siswa</label>
                    <select name="siswa_id" id="siswa_id" class="form-control greylight-bg w-100 pl-2"
                        style="height: 37px; border: none; border-radius: 7px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);">
                        @if($status=='detailsiswa')
                        <option value="{{ $siswa->id }}" realslug={{ $siswa->slug }} slug="{{ $siswa->nama_siswa }}">
                            {{ $siswa->nama_siswa }}
                        </option>
                        @else
                        <option value="">Pilih Siswa</option>
                        <div class="wrapper-option"></div>
                        @endif
                    </select>
                </div>
            </div>

            <div class="row m-3">
                <div class="form-group w-100">
                    <label for="tagihan_id">Jenis Tagihan</label>
                    <select name="tagihan_id" id="tagihan_id" class="form-control greylight-bg w-100 pl-2"
                        style="height: 37px; border: none; border-radius: 7px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);">
                        @if($status=='detailsiswa')
                        <option value="{{ $tagihan->id }}" slug="{{ $tagihan->tipetagihan->nama_tagihan }}">
                            {{ $tagihan->tipetagihan->nama_tagihan }}</option>
                        @else
                        <option value="">Pilih Pembayaran</option>
                        @endif
                    </select>
                </div>
            </div>

            <div class="row m-3 nom">
                <div class="form-group w-100">
                    <label for="nominal">Nominal</label>
                    <div class="nominal position-relative">
                        <span class="position-absolute" style="left: 13px; top: 5.5px;">Rp.</span>
                        <input type="text" class="form-control greylight-bg" name="nominal" id="nominal"
                            aria-describedby="helpId" placeholder="Masukkan Nominal Pembayaran"
                            style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1); padding-left: 45px; padding-top: 3.5px; font-size: 16px;">
                    </div>
                </div>
                @if($status=='detailsiswa')
                <div id="sisa_wrapper">
                    <p id="sisa_tagihan_pembayaran" style="font-size: 15px; margin-bottom: -1px !important">Sisa Tagihan : Rp. {{ number_format(($tagihan->tipetagihan->nominal - $tagihan->sudah_dibayar),0,'.','.') }}</p>
                </div>
                @else
                <p id="sisa_tagihan_pembayaran"></p>
                @endif
            </div>

            <div class="row m-3 pb-4 pt-2 position-relative">
                <button type="button" id="btn-submit" disabled @if($status=="normal" )
                    class="btn w-100 text-light normal_bray" @else class="btn w-100 text-light" @endif
                    style="background: #241937 !important; transition: all .3s;">Tambah
                    Pembayaran <i class="fas fa-save pl-2"></i></button>
                <img src="{{ asset('assets') }}/images/loader.gif" alt="" class="loader" style="display: none;">
            </div>
        </form>

    </div>
</div>

@include('partials.footer')
@endsection

@push('extras-css')
<style>
    @media (max-width: 1128px) {
        .col-md-12.mt-4 {
            margin-bottom: 0px !important;
        }
    }

    @media (max-width: 373px) {
        .swal2-cancel
        {
            padding: 9px 58px !important;        
        }
    }

    @media (max-width: 354px) {
        .swal2-cancel.swal2-styled
        {
            padding: 9px 58px !important;        
        }
    }

}
</style>
@endpush

@push('extras-js')
<script>
    var nominal = document.getElementById('nominal');
    nominal.addEventListener('keyup', function (e) {
        nominal.value = formatRupiah(this.value);
        console.log(nominal.value = formatRupiah(this.value));
    });

    function formatRupiah(angka) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return rupiah;
    }

    $(document).ready(function () {
        if ($('#btn-submit').hasClass('normal_bray')) {
            $('#kelas_id, #tagihan_id, #siswa_id').on('change', function () {
                var value_kelas = $('#kelas_id').children("option:selected").val();
                var value_tagihan = $('#tagihan_id').children("option:selected").val();
                var value_siswa = $('#siswa_id').children("option:selected").val();

                $('#nominal').on('keyup', function () {
                    var value_nominal = $('#nominal').val();
                    if (value_kelas == '' || value_tagihan == '' || value_siswa == '' ||
                        value_nominal == '') {
                        $('#btn-submit').attr('disabled', true);
                    } else {
                        $('#btn-submit').attr('disabled', false);
                    }
                });
            });
        } else {
            $('#nominal').on('keyup', function () {
                var value_nominal = $('#nominal').val();

                if (value_nominal == '') {
                    $('#btn-submit').attr('disabled', true);
                } else {
                    $('#btn-submit').attr('disabled', false);
                }
            });
        }
    });

    $('#kelas_id').on('change', function () {
        if ($(this).val() != '') {
            var kelas_id = $(this).children("option:selected").val();
            console.log('kelas_id : ' + kelas_id);
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "entripembayaran/" + kelas_id + "/getsiswa",
                method: "GET",
                data: {
                    kelas_id: kelas_id,
                    _token: _token,
                },
                success: function (result) {
                    console.log(result);
                    $('#siswa_id').html(result);
                }
            })
        }
    });

    $('#siswa_id').on('change', function () {
        if ($(this).val() != '') {
            console.log('siswa_id');
            var siswa_id = $(this).children("option:selected").val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "entripembayaran/" + siswa_id + "/getTagihan",
                method: "GET",
                data: {
                    siswa_id: siswa_id,
                    _token: _token,
                },
                success: function (result) {
                    console.log(result);
                    $('#tagihan_id').html(result);
                }
            })
        }
    });

    $('#tagihan_id').on('change', function () {
        var sisa_tagihan = conventer($(this).find(':selected').data('sisa'));
        var output = "<p style='font-size: 15px; margin-bottom: -10px !important;'>Sisa Tagihan : " +
            sisa_tagihan + "</p>";
        $('#sisa_tagihan_pembayaran').html(output);
    });

    $('#form-submit').on('keypress', function (e) {
        if (e.which == 13) {
            e.preventDefault();
            $('#btn-submit').click();
        }
    });

    $('#btn-submit').on('click', function (e) {
        if ($(this).hasClass('normal_bray')) {
            $content =
                '<h2 style="text-align:left; margin-bottom:20px; font-weight:500;">Konfirmasi Pembayaran</h2>';
            $content += '<table>';
            $content += '<tr style="text-align:left;">';
            $content += '<td class="exceptt">Nama Siswa</td>';
            $content += '<td class="exceptt" width="20" align="center">:</td>';
            $content += '<td class="exceptt">' + $('#siswa_id').children("option:selected").attr('slug') +
                '</td>';
            $content += '</tr>';
            $content += '<tr style="text-align:left;">';
            $content += '<td class="exceptt">Kelas</td>';
            $content += '<td class="exceptt" width="20" align="center">:</td>';
            $content += '<td class="exceptt">' + $('#kelas_id').children("option:selected").attr('slug') +
                '</td>';
            $content += '</tr>';
            $content += '<tr style="text-align: left;">';
            $content += '<td class="exceptt">Jenis Tagihan</td>';
            $content += '<td class="exceptt" width="20" align="center">:</td>';
            $content += '<td class="exceptt">' + $('#tagihan_id').children("option:selected").attr('slug') +
                '</td>';
            $content += '</tr>';
            $content += '<tr style="text-align: left; margin-top: 5px;">';
            $content += '<td class="exceptt">Nominal</td>';
            $content += '<td class="exceptt" width="20" align="center">:</td>';
            $content += '<td class="exceptt">Rp. ' + $('#nominal').val() + '</td>';
            $content += '</tr>';
            $content += '</table>';

            var siswa_id = $('#siswa_id').children("option:selected").val();
            var tagihan_id = $('#tagihan_id').children("option:selected").val();
            var kelas_id = $('#kelas_id').children("option:selected").val();
            var nominal = $('#nominal').val();

            swal.fire({
                html: $content,
                showCancelButton: true,
                confirmButtonColor: "#241937",
                confirmButtonText: "Konfirmasi",
                cancelButtonText: "Batal",
                closeOnConfirm: false,
                closeOnCancel: false,

            }).then((result) => {
                $(this).attr('disabled', true);
                $('.loader').show();

                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{ url("pembayaran/entripembayaran/store") }}',
                        data: {
                            siswa_id: siswa_id,
                            kelas_id: kelas_id,
                            tagihan_id: tagihan_id,
                            nominal: nominal
                        },
                        dataType: 'json',
                        method: 'POST',
                        success: function (data) {
                            console.log(data);
                            if (data == 'sukses') {
                                $(this).attr('disabled', true);
                                $('.loader').hide();

                                $('#siswa_id').val("");
                                $('#siswa_id').children('option:not(:first)').remove();
                                $('#kelas_id').val("");
                                $('#tagihan_id').val("");
                                $('#tagihan_id').children('option:not(:first)').remove();
                                $('#nominal').val("");
                                $('#sisa_tagihan_pembayaran').html('');
                                $('#btn-submit').attr('disabled', true);
                                toastr.success("Pembayaran Berhasil!", "Berhasil", {
                                    "showMethod": "slideDown",
                                    "hideMethod": "slideUp",
                                    timeOut: 3000
                                });
                            } else {
                                $(this).attr('disabled', true);
                                $('.loader').hide();

                                toastr.error("Nominal Terlalu Besar!", "Gagal", {
                                    "showMethod": "slideDown",
                                    "hideMethod": "slideUp",
                                    timeOut: 3000
                                });
                            }
                        },
                        error: function (err) {
                            console.log(err);
                        }
                    })
                } else {
                    $(this).attr('disabled', true);
                    $('.loader').hide();

                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        confirmButtonColor: "#241937",
                        text: 'Gagal Menambahkan Pembayaran!',
                    });
                }
            });
        } else {
            $content =
                '<h2 style="text-align:left; margin-bottom:20px; font-weight:500;">Konfirmasi Pembayaran</h2>';
            $content += '<table>';
            $content += '<tr style="text-align:left;">';
            $content += '<td class="exceptt">Nama Siswa</td>';
            $content += '<td class="exceptt" width="20" align="center">:</td>';
            $content += '<td class="exceptt">' + $('#siswa_id').children("option:selected").attr('slug') +
                '</td>';
            $content += '</tr>';
            $content += '<tr style="text-align:left;">';
            $content += '<td class="exceptt">Kelas</td>';
            $content += '<td class="exceptt" width="20" align="center">:</td>';
            $content += '<td class="exceptt">' + $('#kelas_id').children("option:selected").attr('slug') +
                '</td>';
            $content += '</tr>';
            $content += '<tr style="text-align: left;">';
            $content += '<td class="exceptt">Jenis Tagihan</td>';
            $content += '<td class="exceptt" width="20" align="center">:</td>';
            $content += '<td class="exceptt">' + $('#tagihan_id').children("option:selected").attr('slug') +
                '</td>';
            $content += '</tr>';
            $content += '<tr style="text-align: left; margin-top: 5px;">';
            $content += '<td class="exceptt">Nominal</td>';
            $content += '<td class="exceptt" width="20" align="center">:</td>';
            $content += '<td class="exceptt">Rp. ' + $('#nominal').val() + '</td>';
            $content += '</tr>';
            $content += '</table>';

            var siswa_id = $('#siswa_id').children("option:selected").val();
            var tagihan_id = $('#tagihan_id').children("option:selected").val();
            var kelas_id = $('#kelas_id').children("option:selected").val();
            var nominal = $('#nominal').val();

            swal.fire({
                html: $content,
                showCancelButton: true,
                confirmButtonColor: "#241937",
                confirmButtonText: "Konfirmasi",
                cancelButtonText: "Batal",
                closeOnConfirm: false,
                closeOnCancel: false,
            }).then((result) => {
                $(this).attr('disabled', true);
                $('.loader').show();

                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{ url("pembayaran/entripembayaran/store") }}',
                        data: {
                            siswa_id: siswa_id,
                            kelas_id: kelas_id,
                            tagihan_id: tagihan_id,
                            nominal: nominal
                        },
                        dataType: 'json',
                        method: 'POST',
                        success: function (data) {
                            console.log(data);
                            $("#sisa_wrapper").load(document.URL + ' #sisa_wrapper');
                            $(this).attr('disabled', true);
                            $('.loader').hide();

                            function successFunc() {
                                var value = $('#sisa_tagihan_pembayaran').text();
                                console.log(value);
                                if (data == 'sukses') {
                                    if (value == 'Sisa Tagihan : Rp. 0') {
                                        var base_url = $('#form-submit').attr('data-baseurl');
                                        var slug = $('#siswa_id').children("option:selected").attr('realslug');
                                        var siswa_id = $('#siswa_id').children("option:selected").val();
                                        var url = base_url + "/data/siswa/detail/" + slug + "/" + siswa_id;
                                        location.href = url;
                                    } else {
                                        $('#nominal').val("");
                                        $('#btn-submit').attr('disabled', true);
                                        toastr.success("Pembayaran Berhasil!", "Berhasil", {
                                            "showMethod": "slideDown",
                                            "hideMethod": "slideUp",
                                            timeOut: 3000
                                        });
                                    }
                                } else {
                                    if (nominal.length > 0) {
                                        $('#btn-submit').attr('disabled', false);
                                    }
                                    $('.loader').hide();

                                    toastr.error("Nominal Terlalu Besar!", "Gagal", {
                                        "showMethod": "slideDown",
                                        "hideMethod": "slideUp",
                                        timeOut: 3000
                                    });
                                }
                            }
                            setTimeout(successFunc, 600);
                        },
                        error: function (err) {
                            console.log(err);
                        }
                    })
                } else {
                    if (nominal.length > 0) {
                        $('#btn-submit').attr('disabled', false);
                    }
                    $('.loader').hide();

                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        confirmButtonColor: "#241937",
                        text: 'Gagal Menambahkan Pembayaran!',
                    });
                }
            });

        }
    });
</script>
@endpush