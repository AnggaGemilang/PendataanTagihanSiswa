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

<div class="wrapper" style="overflow: auto;">
    <nav id="sidebar">
        <div class="sidebar-header" style="padding-top: 28px;">
            <h3 style="font-size: 20px;">
                <i class="fas fa-wallet mr-2 pr-1"></i>
                Tagihan Sekolah
            </h3>
            <strong><i class="fas fa-wallet pr-1"></i></strong>
        </div>

        <ul class="list-unstyled components">
            <li style="padding: 15px 0px" id="profil-list">
                <a @if(Auth::User()->role_id=="1") 
                    href="{{url('profil/' . Auth::User()->siswa->slug . '/' . Auth::User()->siswa->id . '/' . Auth::User()->role_id)}}" 
                    @else 
                    href="{{url('profil/' . Auth::User()->petugas->slug . '/' . Auth::User()->petugas->id . '/' . Auth::User()->role_id)}}"  
                    @endif >
                    <div
                        style="width: 56px; height: 56px; border-radius: 50px; float: left; margin-left: 2px; border: 3px solid white;">
                        <img 
                        @if(Auth::User()->role_id=="1") 
                        src="{{ asset('uploaded/images/profil_siswa/' . Auth::User()->siswa->profil) }}"
                        @else 
                        src="{{ asset('uploaded/images/profil_petugas/' . Auth::User()->petugas->profil) }}"
                        @endif
                            style="width:50px; height:50px; border-radius:60px;object-fit: cover;" alt="">
                    </div>
                    @if(Auth::User()->role_id=="1") 
                    <h6 style="margin-left: 75px; margin-top: 5px;">{{ Auth::User()->siswa->nama_siswa }}</h6>
                    <h6 style="margin-left: 75px;" class="mb-0">{{ Auth::User()->siswa->autentikasi->nomor_induk }}</h6>
                    @else 
                    <h6 style="margin-left: 75px; margin-top: 5px;">{{ Auth::User()->petugas->nama_petugas }}</h6>
                    <h6 style="margin-left: 75px;" class="mb-0">{{ Auth::User()->petugas->autentikasi->nomor_induk }}</h6>
                    @endif
                    <div class="clearfix"></div>
                </a>
            </li>
            <li class="{{ @$dashboard }}" id="item-list" style="margin-top: -2px;" data-toggle="tooltip" data-placement="right" title="Home">
                <a href="{{ url('/') }}">
                    <i class="fas fa-home" style="width: 18px;"></i>
                    <span>Home</span>
                </a>
            </li>
            <li class="{{ @$history_pembayaran }} {{ @$entri_pembayaran }}" id="item-list">
                <a href="#pageSubPembayaran" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-briefcase" style="width: 18px;"></i>
                    <span>Pembayaran</span>
                </a>
                <ul class="child-item-list collapse list-unstyled" id="pageSubPembayaran">
                    <li class="{{ @$history_pembayaran }}">
                        <a href="{{ url('pembayaran/history') }}" style="padding-left: 35px;" data-toggle="tooltip" data-placement="right" title="History">
                            <i class="fas fa-history" style="width: 18px;"></i>
                            <span>History</span>
                        </a>
                    </li>
                    <li class="{{ @$entri_pembayaran }}">
                        <a href="{{ url('pembayaran/entripembayaran') }}" style="padding-left: 35px;" data-toggle="tooltip" data-placement="right" title="Entri">
                            <i class="fas fa-notes-medical" style="width: 18px;"></i>
                            <span>Entri</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="{{ @$data_siswa }} {{ @$data_kelas }} {{ @$data_petugas }} {{ @$data_tagihan }}" id="item-list">
                <a href="#pageSubKelola" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-copy" style="width: 18px;"></i>
                    <span>Kelola Data</span>
                </a>
                <ul class="child-item-list collapse list-unstyled" id="pageSubKelola">
                    <li class="{{ @$data_siswa }}">
                        <a href="{{ url('/data/siswa') }}" style="padding-left: 27px;" data-toggle="tooltip" data-placement="right" title="Data Siswa">
                            <i class="fas fa-user-graduate" style="width: 18px;"></i>
                            <span>Data Siswa</span>
                        </a>
                    </li>
                    <li class="{{ @$data_kelas }}">
                        <a href="{{ url('/data/kelas') }}" style="padding-left: 27px;" data-toggle="tooltip" data-placement="right" title="Data Kelas">
                            <i class="fas fa-glass-whiskey" style="width: 18px;"></i>
                            <span>Data Kelas</span>
                        </a>
                    </li>
                    <li class="{{ @$data_petugas }}">
                        <a href="{{ url('/data/petugas') }}" style="padding-left: 27px;" data-toggle="tooltip" data-placement="right" title="Data Petugas">
                            <i class="fas fa-cube" style="width: 18px;"></i>
                            <span>Data Petugas</span>
                        </a>
                    </li>
                    <li class="{{ @$data_tagihan }}">
                        <a href="{{ url('/data/tagihan') }}" style="padding-left: 27px;" data-toggle="tooltip" data-placement="right" title="Data Tagihan">
                            <i class="fas fa-file-invoice-dollar" style="width: 18px;"></i>
                            <span>Data Tagihan</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="{{ @$data_pembayaran }}" id="item-list">
                <a href="{{ url('/pembayaran/data') }}" data-toggle="tooltip" data-placement="right" title="Data Pembayaran">
                    <i class="fas fa-image" style="width: 18px;"></i>
                    <span>Data Pembayaran</span>
                </a>
            </li>
            <li class="{{ @$ubah_password }}" id="item-list">
                <a href="{{ url('ubahpassword/') }}" data-toggle="tooltip" data-placement="right" title="Ubah Password">
                    <i class="fas fa-key" style="width: 18px;"></i>
                    <span>Ubah Password</span>
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