/* ---------------------------------------------------
    SIDEBAR COLLAPSE
----------------------------------------------------- */

$(document).ready(function () {
    checkSize();
    $(window).resize(checkSize);
});


function checkSize() {
    if ($("#tanda-responsive").css("display") == "none") {
        console.log('leungit');
        $('#profil-list > a > h6').hide();
        $('#item-list > a > span').hide();
        $('#sidebarCollapse').on('click', function () {
            if ($('#content-section').hasClass('status-actived')) {
                $('#content-section').removeClass('status-actived');
                $('#content-section').attr('style', 'margin-left: 0px !important;');
                $('nav.navbar.top').attr('style', 'left: 0px !important;');
            } else {
                $('#content-section').addClass('status-actived');
                $('#content-section').attr('style','margin-left: 80px !important;');
                $('nav.navbar.top').attr('style','left: 80px !important;');
                $('#profil-list > a > h6').hide();
                $('#item-list > a > span').hide();
                $('.child-item-list > li > a > span').hide();
                $('[data-toggle="tooltip"]').tooltip('enable');
                $('#item-list > a > i').css('width', '37px');
                $('.child-item-list > li > a > i').css('width', '36px');
            }
        });
    } else {
        console.log('muncul');
        $('#profil-list > a > h6').show();
        $('#item-list > a > span').show();
        $('#sidebarCollapse').on('click', function () {
            if ($('#content-section').hasClass('status-actived')) {
                $('#content-section').css('margin-left', '250px');
                $('nav.navbar.top').css('left', '250px');
                $('#content-section').removeClass('status-actived');
                $('#profil-list > a > h6').show();
                $('#item-list > a > span').show();
                $('#item-list > a > i').css('width', '18px');
                $('.child-item-list > li > a > span').show();
                $('.child-item-list > li > a > i').css('width', '18px');
                $('[data-toggle="tooltip"]').tooltip('disable')
            } else {
                $('#content-section').css('margin-left', '80px');
                $('nav.navbar.top').css('left', '80px');
                $('#content-section').addClass('status-actived');
                $('#profil-list > a > h6').hide();
                $('#item-list > a > span').hide();
                $('#item-list > a > i').css('width', '37px');
                $('.child-item-list > li > a > span').hide();
                $('.child-item-list > li > a > i').css('width', '36px');
                $('[data-toggle="tooltip"]').tooltip('enable');
            }
        });
    }
}

/* ---------------------------------------------------
    DROPDOWN BUTTON OPTION
----------------------------------------------------- */

$(document).click(function () {
    if ($('#btn-dropdownnavbar').hasClass('status')) {
        $('#btn-dropdownnavbar').removeClass('status');
        $(".dropdown-navbar-status").fadeOut();
        return false;
    } else if ($('.btn-toggle-option').hasClass('status_edit')) {
        $('.btn-toggle-option').removeClass('status_edit');
        $(".dropdown-detail").fadeOut();
        return false;
    }
});

$('.dropdown-navbar-status').click(function (e) {
    e.stopPropagation();
});

$(".dropdown-detail").click(function (e) {
    e.stopPropagation();
});

$('#btn-dropdownnavbar').click(function (e) {
    e.stopPropagation();
    e.preventDefault();
    $(".dropdown-navbar-status").fadeToggle();
    $(this).toggleClass('status');
    return false;
});

$('.btn-toggle-option').click(function (e) {
    e.stopPropagation();
    e.preventDefault();
    $(".dropdown-detail").fadeToggle();
    $(this).toggleClass('status_edit');
    return false;
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
            confirmButtonColor: "#24143F",
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
                    confirmButtonColor: "#24143F",
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
            confirmButtonColor: "#24143F",
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
                    confirmButtonColor: "#24143F",
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
        $('.ubah-profil-btn').css('padding', '5px 20px');
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
    SET 0 VALUE ON BUTTON
----------------------------------------------------- */

$('.date_picker').focus(function () {
    $('button.btn-times').fadeIn().click(function () {
        $('.date_picker').val('').change().focusout();
    });
});

$('.date_picker').focusout(function () {
    $('.btn-times').fadeOut();
});

$('.input-toggle-times').focus(function () {
    $('.btn-times2').fadeIn().click(function () {
        $('.input-toggle-times').val('').trigger('keyup');
    });
});

$('.input-toggle-times').focusout(function () {
    $('.btn-times2').fadeOut();
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

$("#filter_change_table").on("change", function () {
    var value = $(this).val().toLowerCase();
    console.log(value);
    $("#table-refresh tr").not('#header-tr').filter(function () {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
});

$("#status_change").on("change", function () {
    var value = $(this).val().toLowerCase();
    console.log(value);
    $("#table-refresh tr").not('#header-tr').filter(function () {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
});

$("#filter_history").on("keyup", function () {
    var value = $(this).val().toLowerCase();
    console.log(value);
    $("#wrapper-history #item-history").filter(function () {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
});

$("#filter_change_history").on("change", function () {
    var value = $(this).val().toLowerCase();
    console.log(value);
    $("#wrapper-history #item-history").filter(function () {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
});

$("#filter_tanggal").on("change", function () {
    var value = $(this).val().toLowerCase();
    console.log(value);
    $("#wrapper-history #item-history").filter(function () {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
});