/* ---------------------------------------------------
    SIDEBAR COLLAPSE
----------------------------------------------------- */

$('#sidebarCollapse').on('click', function(){
    if($('#content-section').attr('status')=="true"){
        $('#content-section').css('margin-left','250px');
        $('nav.navbar.top').css('left','250px');
        $('#content-section').attr('status','false');
        $('#profil-list > a > h6').show();
        $('#item-list > a > span').show();
        $('#item-list > a > i').css('width','18px');
        $('.child-item-list > li > a > span').show();
        $('.child-item-list > li > a > i').css('width','18px');
        $('[data-toggle="tooltip"]').tooltip('disable')
    }else{
        $('#content-section').css('margin-left','80px');
        $('nav.navbar.top').css('left','80px');
        $('#content-section').attr('status','true');
        $('#profil-list > a > h6').hide();
        $('#item-list > a > span').hide();
        $('#item-list > a > i').css('width','37px');
        $('.child-item-list > li > a > span').hide();
        $('.child-item-list > li > a > i').css('width','36px');
        $('[data-toggle="tooltip"]').tooltip('enable');
    }
});

/* ---------------------------------------------------
    DROPDOWN BUTTON OPTION
----------------------------------------------------- */

$(document).ready(function () {
    $('#btn-dropdownnavbar').click(function (e) {
        e.stopPropagation();
        e.preventDefault();
        $(".dropdown-navbar-status").fadeToggle();
        return false;
    });
});

$(document).ready(function () {
    $('.btn-toggle-option').click(function (e) {
        e.stopPropagation();
        e.preventDefault();
        $(".dropdown-detail").fadeToggle();
        return false;
    });
});

/* ---------------------------------------------------
    DELETE DATA AJAX
----------------------------------------------------- */
 
$("#table-refresh").on('click', '#btn-hapus', function (e) {
    e.stopPropagation();
    var link = $(this).attr('data-url');
    swal.fire({
            title: "Apakah Anda Yakin?",
            text: "Data akan terhapus secara permanen",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3AA9A5",
            confirmButtonText: "Hapus",
            cancelButtonText: "Batal",
            closeOnConfirm: false,
            closeOnCancel: false,
        })
        .then((result) => {
            if (result.value) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: link,
                    type: 'POST',
                    success: function () {
                        $("#table-refresh").load(document.URL + ' #table-refresh');
                        toastr.success("Data Berhasil Dihapus!", "Berhasil", {
                            "showMethod": "slideDown",
                            "hideMethod": "slideUp",
                            timeOut: 3000
                        });
                    },
                    error: function (err) {
                        console.log(err);
                    }
                })
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    confirmButtonColor: "#3AA9A5",
                    text: 'Data Gagal Dihapus!',
                });
            }
        });
});

$(".dropdown-detail").on('click', '#btn-hapus', function (e) {
    e.stopPropagation();
    var link = $(this).attr('data-url');
    var direct = $(this).attr('data-direct');
    swal.fire({
            title: "Apakah Anda Yakin?",
            text: "Data akan terhapus secara permanen",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3AA9A5",
            confirmButtonText: "Hapus",
            cancelButtonText: "Batal",
            closeOnConfirm: false,
            closeOnCancel: false,
        })
        .then((result) => {
            if (result.value) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: link,
                    type: 'POST',
                    success: function () {
                        // toastr.success("Data Berhasil Dihapus!", "Berhasil", {
                        //     "showMethod": "slideDown",
                        //     "hideMethod": "slideUp",
                        //     timeOut: 3000
                        // });
                        $(location).attr('href', direct);
                    },
                    error: function (err) {
                        console.log(err);
                    }
                })
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    confirmButtonColor: "#3AA9A5",
                    text: 'Data Gagal Dihapus!',
                })
            }
        });
});

/* ---------------------------------------------------
    INPUT FILE
----------------------------------------------------- */

$('.infile-label').on('click', function () {
    console.log($(this).nextAll().eq(1).show());
    $($(this).next()).on('change', function () {
        var filename = $(this).val();
        if (filename.substring(3, 11) == 'fakepath') {
            if (filename.length > 100) {
                filename = filename.substring(12, 100) + '...';
            } else {
                filename = filename.substring(12, 100);
            }
        }
        console.log($(this).next().html(filename));
    });
});

$('.ubah-profil-btn').on('click', function () {
    console.log($(this).nextAll().eq(1).show());
    $($(this).next()).on('change', function () {
        $('.ubah-profil-btn').css('padding','5px 20px');
        var filename = $(this).val();
        if (filename.substring(3, 11) == 'fakepath') {
            if (filename.length > 40) {
                filename = filename.substring(12, 32) + '...';
            } else {
                filename = filename.substring(12, 35);
            }
        }
        console.log($(this).prev().html(filename));
    });
});

/* ---------------------------------------------------
    HREF ROW TABLE
----------------------------------------------------- */

$("#table-refresh").on("click", "#row-main", function (e) {
    var href = $(this).attr("href");
    if (href) {
        window.location = href;
    }
});

/* ---------------------------------------------------
    FILTER CARI LIHAT DATA
----------------------------------------------------- */

$("#field_cari").on("keyup", function () {
    var value = $(this).val().toLowerCase();
    $("#table-refresh tr").not('#header-tr').filter(function () {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
});

/* ---------------------------------------------------
    UBAH TIPE INPUT PASSWORD MENJADI TEXT
----------------------------------------------------- */

$('.btn-eye').on('click', function (e) {
    e.stopPropagation();
    if ($(this).prev().hasClass('active')) {
        $('.form-pwd').attr('type', 'password').removeClass('active');
        $('.btn-eye > i').attr('class', 'fas fa-eye');
    } else {
        $(this).prev().attr('type', 'text').addClass('active');
        $(this).find('i').attr('class', 'fas fa-eye-slash');
    }
    return false;
});

/* ---------------------------------------------------
    SELECT OPTION MULTIPLE
----------------------------------------------------- */

tail.select(".select-move", {
    search: false,
    descriptions: false,
    hideSelected: true,
    hideDisabled: true,
    multiLimit: 3,
    multiShowCount: false,
    multiContainer: true,
});

/* ---------------------------------------------------
    GENERATE REPORT
----------------------------------------------------- */

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