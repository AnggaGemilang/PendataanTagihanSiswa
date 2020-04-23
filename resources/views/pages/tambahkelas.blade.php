@extends('layouts.layout')

@if ($status=='tambah')
@section('title','Tambah Kelas')
@else
@section('title','Perbaharui Kelas')
@endif

@section('content')

<div id="main-content">
    @if ($status=='tambah')
    <h1>Tambah Kelas</h1>
    @else
    <h1>Perbaharui Kelas</h1>
    @endif
    <nav class="breadcrumb">
        <a class="breadcrumb-item" href="{{url('/')}}">Beranda</a>
        <a class="breadcrumb-item" href="{{url('data/kelas/')}}">Data Kelas</a>
        @if ($status=='tambah')
        <a class="breadcrumb-item" href="{{url('data/kelas/tambah')}}">Tambah Kelas</a>
        @else
        <a class="breadcrumb-item" href="{{url('data/kelas/perbaharui/' . $kelas->slug )}}">Perbaharui Kelas</a>
        <a class="breadcrumb-item" href="{{url('data/kelas/perbaharui/' . $kelas->slug )}}">{{$kelas->nama_kelas}}</a>
        @endif
        <span class="breadcrumb-item active"></span>
    </nav>

    <div style="background: #EDE6F7; border-radius: 20px;" class="p-2 mt-4">
        <p class="mb-1 ml-2 pl-1 mt-2 text-dark" style="font-weight: 500;">Hal Yang Harus Diperhatikan</p>
        <ol style="opacity: 0.7;">
            <li>Data kelas sebenarnya sudah disediakan seluruhnya</li>
            <li>Jika ada kelas baru, pastikan data tersebut valid</li>
            <li>Masukkan data dengan baik dan teliti</li>
            <li>Jika semua data sudah terisi, klik tombol tambah kelas</li>
        </ol>
    </div>

    <div class="col-md-12 mt-4 pb-2" style="background: #FFFFFF; box-shadow: 1px 1px 12px rgba(0,0,0,0.1);">
        <div class="row" style="background: #241937 !important; height: 65px; align-content: center;">
            @if ($status=='tambah')
            <p class="text-light m-0 pl-4" style="font-weight: 500;">Tambah Data Kelas</p>
            @else
            <p class="text-light m-0 pl-4" style="font-weight: 500;">Perbaharui Data Kelas</p>
            @endif
        </div>

    <form @if($status=="tambah") action="{{ url('/data/kelas/tambah/store') }}" @else action="{{ url('/data/kelas/perbaharui/' . $kelas->slug . '/store') }}" @endif method="POST" id="form-submit">

        {{ csrf_field() }}

            <div class="row m-3 mt-4 pt-2">
                <div class="form-group w-100">
                    <label for="nama_kelas">Nama Kelas</label>
                    <input type="text" class="form-control greylight-bg"  name="nama_kelas" id="nama_kelas" aria-describedby="helpId"
                        placeholder="Masukkan Nama Kelas" @if($status=='tambah') value="{{ old('nama_kelas') }}" @else value="{{$kelas->nama_kelas}}" @endif
                        style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);">
                </div>
            </div>

            <div class="row m-3">
                <div class="form-group w-100">
                    <label for="tipekelas_id">Tingkat Kelas</label>
                    <select name="tipekelas_id" id="tipekelas_id" class="form-control greylight-bg w-100 pl-2"
                        style="height: 37px; border: none; border-radius: 7px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);">
                        <option value="">Pilih Tingkat Kelas</option>
                        @foreach($tipekelas as $tk)
                        <option value="{{ $tk->id }}"
                            @if($status=='update')
                            {{ $kelas->tipekelas->id==$tk->id ? 'selected' : '' }} 
                            @else
                            {{ old('tipekelas_id')==$tk->id ? 'selected' : '' }}
                            @endif>
                            {{ $tk->nama_tipekelas }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row m-3">
                <div class="form-group w-100">
                    <label for="jurusan">Jurusan</label>
                    <input type="text" class="form-control greylight-bg" name="jurusan" id="jurusan" aria-describedby="helpId"
                        placeholder="Masukkan Jurusan Kelas" @if($status=='update') value="{{$kelas->jurusan}}" @else value="{{ old('jurusan') }}" @endif
                        style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);">
                </div>
            </div>

            <div class="row m-3">
                <div class="form-group w-100">
                    <label for="wali_kelas">Wali Kelas</label>
                    <input type="text" class="form-control greylight-bg" name="wali_kelas" id="wali_kelas" aria-describedby="helpId"
                        placeholder="Masukkan Nama Wali Kelas"  @if($status=='update' ) value="{{$kelas->wali_kelas}}" @else value="{{ old('wali_kelas') }}"
                        @endif style="border: none; border-radius: 8px; box-shadow: 1px 1px 6px rgba(0,0,0,0.1);">
                </div>
            </div>

            <div class="row m-3 pb-4 pt-2 position-relative">
                <button type="submit" class="btn w-100 text-light" style="background: #241937 !important; transition: all .3s;" id="btn-submit" onclick="show()">
                    @if ($status=='tambah')
                    Tambah Kelas
                    @else
                    Perbaharui Kelas
                    @endif
                    <i class="fas fa-save pl-2"></i></button>
                <img src="{{ asset('assets') }}/images/loader.gif" alt="" class="loader" style="display: none;">
            </div>
        </form>

    </div>
</div>

@include('partials.footer')
@endsection