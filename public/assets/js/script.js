/* ---------------------------------------------------
    SIDEBAR COLLAPSE
----------------------------------------------------- */

$('#sidebarCollapse').on('click', function () {
    if ($('#content-section').attr('status') == "true") {
        $('#content-section').css('margin-left', '250px');
        $('nav.navbar.top').css('left', '250px');
        $('#content-section').attr('status', 'false');
        $('#profil-list > a > h6').show();
        $('#item-list > a > span').show();
        $('#item-list > a > i').css('width', '18px');
        $('.child-item-list > li > a > span').show();
        $('.child-item-list > li > a > i').css('width', '18px');
        $('[data-toggle="tooltip"]').tooltip('disable')
    } else {
        $('#content-section').css('margin-left', '80px');
        $('nav.navbar.top').css('left', '80px');
        $('#content-section').attr('status', 'true');
        $('#profil-list > a > h6').hide();
        $('#item-list > a > span').hide();
        $('#item-list > a > i').css('width', '37px');
        $('.child-item-list > li > a > span').hide();
        $('.child-item-list > li > a > i').css('width', '36px');
        $('[data-toggle="tooltip"]').tooltip('enable');
    }
});

/* ---------------------------------------------------
    DROPDOWN BUTTON OPTION
----------------------------------------------------- */

$('#btn-dropdownnavbar').click(function (e) {
    e.stopPropagation();
    e.preventDefault();
    $(".dropdown-navbar-status").fadeToggle();
    return false;
});

$('.btn-toggle-option').click(function (e) {
    e.stopPropagation();
    e.preventDefault();
    $(".dropdown-detail").fadeToggle();
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
    FILTER CARI LIHAT DATA
----------------------------------------------------- */

$("#field_cari").on("keyup", function () {
    var value = $(this).val().toLowerCase();
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

$("#filter_tanggal").on("change", function () {
    var value = $(this).val().toLowerCase();
    console.log(value);
    $("#wrapper-history #item-history").filter(function () {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
});

$("#filter_kelas").on("change", function () {
    var value = $(this).val().toLowerCase();
    $("#table-refresh tr").not('#header-tr').filter(function () {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
});

$("#filter_role").on("change", function () {
    var value = $(this).val().toLowerCase();
    $("#table-refresh tr").not('#header-tr').filter(function () {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
});

$("#filter_jurusan").on("change", function () {
    var value = $(this).val().toLowerCase();
    $("#table-refresh tr").not('#header-tr').filter(function () {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
});

$("#filter_tagihan").on("change", function () {
    var value = $(this).val().toLowerCase();
    $("#wrapper-history #item-history").filter(function () {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
});