@extends('layouts.app')
@section('title','Login')

@section('content')

<div id="particles-js">
    <div class="container" id="main-content">
        <div class="row img-logo justify-content-center mb-5">
            <img src="{{ asset('assets') }}/auth/images/smkn4-logo.png" alt="Logo SMKN 4 Bandung">
        </div>
        <div class="row justify-content-center mb-2">
            <h2 class="title w-100 mb-4 pb-2">Login Tagihan Sekolah</h2>
            <form method="POST" action="{{ route('login') }}" class="w-100" id="form-submit">
                {{ csrf_field() }}
                <div class="row m-2 mt-3 pt-2">
                    <div class="form-group w-100">
                        <input id="login" type="login" name="login" id="login" value="{{ old('login') }}"
                            autocomplete="off" autofocus class="greylight-bgmt-1" aria-describedby="helpId"
                            placeholder="Nomor Induk atau Email">
                    </div>
                </div>

                <div class="row m-2 d-flex justify-content-center">
                    <div class="form-group w-100 position-relative">
                        <input id="password" type="password" name="password" autocomplete="off" class="form-pwd mt-1"
                            aria-describedby="helpId" placeholder="Password" style="padding-right: 80px !important;">
                    </div>
                    <div class="wrapper-icon-show">
                        <button type="button" class="btn-eye"><i class="fas fa-eye"
                                style="color: #6C757D;"></i></button>
                    </div>
                </div>

                <div class="row m-2 d-flex justify-content-left mt-2 pt-1">
                    <div class="form-group w-100 position-relative">
                        <label class="wrapper-checkbox position-relative"
                            style="color: #9389B8; font-size: 14px; font-weight: 500;">Remember Me?
                            <input type="checkbox" style="width: 10px; !important;">
                            <span class="checkmark"></span>
                        </label>
                    </div>
                </div>

                <div class="row m-2 mt-2 justify-content-center">
                    <div class="position-relative">
                        <button type="submit" id="btn-submit" class="btn btn-login text-light" onclick="show()"
                            style="background: #1EB5AD; outline: #B0A1FF !important;">Login
                        </button>
                        <img src="{{ asset('assets') }}/images/loader.gif" class="loader" style="display: none;">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('extras-js')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@endpush