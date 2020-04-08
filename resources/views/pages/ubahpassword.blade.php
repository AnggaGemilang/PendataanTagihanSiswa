@extends('layouts.layout')
@section('title','Ubah Password')

@section('content')

<div id="main-content">
    <h1>Ubah Password</h1>
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{url('/')}}">Beranda</a>
        <a class="breadcrumb-item" href="{{url('ubahpassword')}}">Ubah Password</a>
        <span class="breadcrumb-item active"></span>
    </nav>

    <div style="background: #EDE6F7; border-radius: 20px;" class="p-2 mt-4">
        <p class="mb-1 ml-2 pl-1 mt-2 text-dark" style="font-weight: 500;">Hal Yang Harus Diperhatikan</p>
        <ol style="opacity: 0.7;">
            <li>Harap ganti password saat pertama kali login</li>
            <li>Jangan pernah berikan password anda kepada orang lain</li>
            <li>Password default adalah Nomor Induk anda sendiri</li>
            <li>Pastikan anda mengetahui password sebelumnya</li>
            <li>Klik tombol ubah password ketika keterangan bernilai "password sama"</li>
        </ol>
    </div>

    <div class="col-md-12 mt-4" style="background: white; box-shadow: 1px 1px 12px rgba(0,0,0,0.1);">
        <div class="row" style="background: #24143F !important; height: 65px; align-content: center;">
            <p class="text-light m-0 pl-4" style="font-weight: 500;">Ubah Password</p>
        </div>

        <form @if(Auth::user()->role_id=='1')
            action="{{ url('ubahpassword/store/' . Auth::user()->siswa->id  . '/' . Auth::user()->siswa->role->nama_role ) }}"
            @else
            action="{{ url('ubahpassword/store/' . Auth::user()->petugas->id  . '/' . Auth::user()->petugas->role->nama_role ) }}"
            @endif
            method="POST" id="form-submit">

            {{ csrf_field() }}

            <div class="row m-3 mt-4">
                <div class="form-group w-100 position-relative mb-2">
                    <label for="password_lama">Password Lama</label>
                    <input type="password" class="form-pwd form-control greylight-bg" name="password_lama"
                        id="password_lama" aria-describedby="helpId" placeholder="Masukkan Password Lama Anda"
                        oldstatus="false"
                        style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);">
                    <button class="btn-eye"><i class="fas fa-eye" style="color: #6C757D;"></i></button>
                </div>
            </div>

            <div class="row ml-3" style="margin-top: -13px; margin-bottom: 0px;">
                <p class="text-success mb-0" style="font-size: 15px; font-weight: 400; display: none;"
                    id="oldpwd_content_true">Password Lama Anda Valid</p>
                <p class="text-danger mb-0" style="font-size: 15px; font-weight: 400; display: none;"
                    id="oldpwd_content_false">Password Lama Anda Tidak Valid</p>
            </div>

            <div class="row m-3">
                <div class="form-group w-100 position-relative mb-2">
                    <label for="password_baru">Password Baru</label>
                    <input type="password" class="form-pwd form-control greylight-bg" name="password_baru"
                        id="password_baru" aria-describedby="helpId" placeholder="Masukkan Password Baru Anda"
                        style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);">
                </div>
            </div>

            <div class="row m-3">
                <div class="form-group w-100 position-relative">
                    <label for="konfirmasi_password">Konfirmasi Password</label>
                    <input type="password" class="form-pwd form-control greylight-bg" name="konfirmasi_password"
                        confirmstatus="false" id="konfirmasi_password" aria-describedby="helpId"
                        placeholder="Konfirmasi Password Baru Anda"
                        style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);">
                </div>
            </div>

            <div class="row ml-3" style="margin-top: -21px; margin-bottom: 25px;">
                <p class="text-success mb-0" style="font-size: 15px; font-weight: 400; display: none;"
                    id="pwd_content_true">Password Sama</p>
                <p class="text-danger mb-0" style="font-size: 15px; font-weight: 400; display: none;"
                    id="pwd_content_false">Password Tidak Sama</p>
            </div>

            <div class="row m-3" style="padding-bottom: 40px;">
                <button type="submit" class="btn w-100 text-light" style="background: #24143F !important;">Ubah
                    Password <i class="fas fa-save pl-2"></i></button>
        </form>

    </div>
</div>
</div>

@include('partials.footer')
@endsection

@push('extras-js')
<script>
    $('#password_lama').on('keyup', function () {
        var value = $(this).val();
        if (value.length > 0) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "ubahpassword/fetch/" + value,
                type: 'GET',
                success: function (data) {
                    if (data == "benar") {
                        $('#oldpwd_content_true').show();
                        $('#oldpwd_content_false').hide();
                        $('#password_lama').attr('oldstatus', 'true');
                    } else {
                        $('#oldpwd_content_false').show();
                        $('#oldpwd_content_true').hide();
                        $('#password_lama').attr('oldstatus', 'false');
                    }
                },
                error: function (err) {
                    console.log(err);
                }
            })
        }
    });

    $('#konfirmasi_password').on('keyup', function () {
        var value_before = $('#password_baru').val();
        var value_after = $(this).val();
        if (value_after == value_before) {
            $('#pwd_content_true').show();
            $('#pwd_content_false').hide();
            $('#konfirmasi_password').attr('confirmstatus', 'true');
        } else {
            $('#pwd_content_false').show();
            $('#pwd_content_true').hide();
            $('#konfirmasi_password').attr('confirmstatus', 'false');
        }
    });

    $(document).on('submit', '#form-submit', function (e) {
        if ($('#konfirmasi_password').attr('confirmstatus') == "false" && $('#password_lama').attr(
            'oldstatus') == "false") {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                confirmButtonColor: "#3AA9A5",
                text: 'Password Tidak Valid!',
            });
        }
    });
</script>
@endpush