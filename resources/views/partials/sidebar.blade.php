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
} else if (\Request::is('data/tagihan')) {
@$data_tagihan = 'active';
} else if (\Request::is('pembayaran/data')) {
@$data_pembayaran = 'active';
} else if (\Request::is('ubahpassword')) {
@$ubah_password = 'active';
}
@endphp

<div class="wrapper">
    <nav id="sidebar">
        <div class="sidebar-header" style="padding-top: 28px;">
            <h3 style="font-size: 20px;">
                <i class="fas fa-wallet mr-2 pr-1"></i>
                Tagihan Sekolah
            </h3>
            <strong><i class="fas fa-wallet pr-1"></i></strong>
        </div>

        <ul class="list-unstyled components">
            <li style="padding: 15px 0px">
                <a href="{{url('profil/' . Auth::User()->slug)}}">
                    <div style="width: 56px; height: 56px; border-radius: 50px; float: left; margin-left: 2px; border: 3px solid white;">
                        <img src="{{ asset('uploaded/images/profil_siswa/' . Auth::User()->profil) }}"
                        style="width:50px; height:50px; border-radius:60px;object-fit: cover;" alt="">
                    </div>
                    <h6 style="margin-left: 75px; margin-top: 5px;">{{ Auth::User()->nama_siswa }}</h6>
                    <h6 style="margin-left: 75px;" class="mb-0">{{ Auth::User()->nis }}</h6>
                    <div class="clearfix"></div>
                </a>
            </li>
            <li class="{{ @$dashboard }}">
                <a href="{{ url('/') }}">
                    <i class="fas fa-home" style="width: 18px;"></i>
                    Home
                </a>
            </li>
            <li class="{{ @$history_pembayaran }} {{ @$entri_pembayaran }}">
                <a href="#pageSubPembayaran" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-briefcase" style="width: 18px;"></i>
                    Pembayaran
                </a>
                <ul class="collapse list-unstyled" id="pageSubPembayaran">
                    <li class="{{ @$history_pembayaran }}">
                        <a href="{{ url('pembayaran/history') }}">
                            <i class="fas fa-history pl-4 "></i>
                            History
                        </a>
                    </li>
                    <li class="{{ @$entri_pembayaran }}">
                        <a href="{{ url('pembayaran/entripembayaran') }}">
                            <i class="fas fa-notes-medical pl-4 pr-1"></i>
                            Entri
                        </a>
                    </li>
                </ul>
            </li>
            <li class="{{ @$data_siswa }} {{ @$data_kelas }} {{ @$data_petugas }} {{ @$data_tagihan }}">
                <a href="#pageSubKelola" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-copy" style="width: 18px;"></i>
                    Kelola Data
                </a>
                <ul class="collapse list-unstyled" id="pageSubKelola">
                    <li class="{{ @$data_siswa }}">
                        <a href="{{ url('/data/siswa') }}">
                            <i class="fas fa-user-graduate pl-4 pr-1"></i>
                            Data Siswa
                        </a>
                    </li>
                    <li class="{{ @$data_kelas }}">
                        <a href="{{ url('/data/kelas') }}">
                            <i class="fas fa-glass-whiskey pl-4"></i>
                            Data Kelas
                        </a>
                    </li>
                    <li class="{{ @$data_petugas }}">
                        <a href="{{ url('/data/petugas') }}">
                            <i class="fas fa-cube pl-4"></i>
                            Data Petugas
                        </a>
                    </li>
                    <li class="{{ @$data_tagihan }}">
                        <a href="{{ url('/data/tagihan') }}">
                            <i class="fas fa-file-invoice-dollar pl-4 pr-1"></i>
                            Data Tagihan
                        </a>
                    </li>
                </ul>
            </li>
            <li class="{{ @$data_pembayaran }}">
                <a href="{{ url('/pembayaran/data') }}">
                    <i class="fas fa-image" style="width: 18px;"></i>
                    Data Pembayaran
                </a>
            </li>
            <li class="{{ @$ubah_password }}">
                <a href="{{ url('ubahpassword') }}">
                    <i class="fas fa-key" style="width: 18px;"></i>
                    Ubah Password
                </a>
            </li>
        </ul>
    </nav>

    <div id="content-section">
        @include('partials.navbar')
        <div id="content">
            @yield('content')
        </div>
    </div>

</div>

@push('extras-js')
<script type="text/javascript">
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });
    });
</script>
@endpush