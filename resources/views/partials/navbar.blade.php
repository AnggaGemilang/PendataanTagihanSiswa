<nav class="navbar top navbar-expand-lg navbar-light">
    <div class="container-fluid atas-nav" style="min-width: 290px;">
        <button type="button" id="sidebarCollapse" class="btn btn-info"
            style="margin-top: 4px; margin-bottom:2px; background: #FFFFFF !important;">
            <i class="fas fa-align-left"
                style="font-size: 20px; margin-top: 5px; margin-bottom: 6px; color: #24143F;"></i>
        </button>

        <div>
            <ul class="nav navbar-nav ml-auto">
                <li class="nav-item position-relative mr-4">
                    <button style="background: transparent; border: none; outline: none !important;">
                        <i class="far fa-bell" style="font-size: 21px; color: #241937;"></i>
                        <span class="badge badge-success" style="position: absolute; top: -5px; left: 23px; background: #241937 !important;">1</span>
                    </button>
                </li>
                <li class="nav-item position-relative">
                    <a id="btn-dropdownnavbar" href=""
                        style="color: #24143F; font-weight: 500; text-transform: capitalize;">
                        @if(Auth::User()->role_id=="1")
                        {{ Auth::User()->siswa->nama_siswa }}
                        @else
                        {{ Auth::User()->petugas->nama_petugas }}
                        @endif
                        <i class="fas fa-caret-down ml-2"></i>
                    </a>
                    <div class="dropdown-navbar dropdown-navbar-status"
                        style="min-width: 129px !important; z-index: 999;">
                        <ul class="pl-0">
                            <a @if(Auth::User()->role_id=="1")
                                href="{{url('profil/' . Auth::User()->siswa->slug . '/' . Auth::User()->siswa->id . '/' . Auth::User()->role_id)}}"
                                @else
                                href="{{url('profil/' . Auth::User()->petugas->slug . '/' . Auth::User()->petugas->id . '/' . Auth::User()->role_id)}}"
                                @endif >
                                <li><i class="fa fa-user" style="width: 29px;"></i>Profile</li>
                            </a>
                            <a href="" id="btn-about">
                                <li><i class="fa fa-info-circle" style="width: 29px;"></i>About</li>
                            </a>
                            <a href="{{ route('logout') }}" id="btn-logout"
                                class="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <li><i class="fas fa-sign-out-alt" style="width: 29px;"></i>Log Out</li>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

@push('extras-js')
<script>
    $('#btn-about').click(function (e) {
        e.preventDefault();
        Swal.fire({
            title: '<span class="mt-4">ujikom_angga @ 2020</span>',
            html: '<span class="mt-3 mb-3">v. 1.0.0.0</span>',
            showCloseButton: true,
            showConfirmButton: false,
        })
    });

    $('#btn-logout').click(function (e) {
        e.preventDefault();
        swal.fire({
                title: "Apakah Anda Yakin?",
                text: "Anda Akan Logout",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#24143F",
                confirmButtonText: "Logout",
                cancelButtonText: "Batal",
                closeOnConfirm: false,
                closeOnCancel: false,
            })
            .then((result) => {
                if (result.value) {
                    $('#btn-logout').attr("onclick",
                        "event.preventDefault(); document.getElementById('logout-form').submit();");
                    $('#logout-form').submit();
                } else {

                }
            });
    });
</script>
@endpush