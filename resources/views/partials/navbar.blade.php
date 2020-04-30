<nav class="navbar top navbar-expand-lg navbar-light">
    <div class="container-fluid atas-nav" style="min-width: 290px;">
        <button type="button" id="sidebarCollapse" class="btn btn-info"
            style="margin-top: 4px; margin-bottom:2px; background: #FFFFFF !important;">
            <i class="fas fa-align-left"
                style="font-size: 20px; margin-top: 5px; margin-bottom: 6px; color: #24143F;"></i>
        </button>

        <div>
            <ul class="nav navbar-nav ml-auto">
                @if(Auth::User()->role_id=='1')
                <li class="nav-item position-relative" style="margin-right: 38px;">
                    <button id="btn-dropdownnotif"
                        style="background: transparent; border: none; outline: none !important;">
                        <i class="far fa-bell" style="font-size: 21px; color: #241937;"></i>
                        <span class="badge badge-success" id="badge-notif"
                            style="position: absolute; top: -5px; left: 23px; background: #241937 !important;">{{ count(Auth::User()->unreadNotifications) }}</span>
                    </button>
                </li>
                @endif

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
                    <div class="dropdown-navbar notif">
                        <div class="triangle" style="background-color: white;"></div>
                        <div class="container-fluid"
                            style="border-bottom: 1px solid rgba(0, 0, 0, 0.15); padding: 5px 15px;">
                            <div class="row" id="not">
                                <div class="col">
                                    <p class="mb-0" style="font-weight: 500; color: black;">Notifikasi</p>
                                </div>
                                <div class="col" style="align-self: center; text-align: right;">
                                    <button id="closeNotif"
                                        style="border: none; background: transparent; outline: none;"><i
                                            class="fas fa-times-circle" style="color: #241937;"></i></button>
                                </div>
                            </div>
                        </div>
                        <ul class="pl-0" id="notif-content"
                            style="overflow-y: auto; max-height: 241px; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                            @if(count(Auth::User()->unreadNotifications)==0)
                            <a onclick="preventDefault();" id="not" class="pb-5">
                                <li class="text-center">Tidak Ada Notifikasi</li>
                            </a>
                            @endif
                            @foreach (Auth::User()->unreadNotifications as $notification)
                            <a data-id="{{ $notification->id }}" id="markRead">
                                <li style="padding-left: 15px !important;" style="font-size: 16px;">Anda Membayar <span
                                        style="font-weight: 600;"> {{ $notification->data['nama_tagihan'] }}</span> <br>
                                    <p class="mb-0" style="font-size: 14px;">{{ $notification->created_at }}</p>
                                </li>
                            </a>
                            @endforeach
                        </ul>
                    </div>
                    <div class="dropdown-navbar dropdown-navbar-status"
                        style="min-width: 310px !important; z-index: 999;">
                        <div class="profil-navbar-wrapper">
                            <div class="row m-0 pt-4 pb-4"
                                style="background: rgba(36,25,55,0.65); border-top-left-radius: 10px; border-top-right-radius: 10px;">
                                <div class="col-3 ml-1">
                                    <img @if(Auth::User()->role_id=="1")
                                    src="{{ asset('uploaded/images/profil_siswa/' . Auth::User()->siswa->profil) }}"
                                    @else
                                    src="{{ asset('uploaded/images/profil_petugas/' . Auth::User()->petugas->profil) }}"
                                    @endif
                                    style="width:70px; height:70px; border-radius: 60px; object-fit: cover;" alt="">
                                </div>
                                <div class="col ml-2 pt-1">
                                    @if(Auth::User()->role_id=="1")
                                    <p class="text-light mb-0 text-uppercase" style="font-weight: 500;">
                                        {{ Auth::User()->siswa->nama_siswa }}</p>
                                    @else
                                    <p class="text-light mb-0 text-uppercase" style="font-weight: 500;">
                                        {{ Auth::User()->petugas->nama_petugas }}</p>
                                    @endif
                                    <p class="text-light mb-0" style="font-size: 14px;">{{ Auth::User()->nomor_induk }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="triangle"></div>
                        <ul class="pl-0">
                            <a @if(Auth::User()->role_id=="1")
                                href="{{url('profil/' . Auth::User()->siswa->slug . '/' . Auth::User()->siswa->id . '/' . Auth::User()->role_id)}}"
                                @else
                                href="{{url('profil/' . Auth::User()->petugas->slug . '/' . Auth::User()->petugas->id . '/' . Auth::User()->role_id)}}"
                                @endif >
                                <li class="profil"><i class="far fa-address-card"
                                        style="width: 38px; font-size: 16px; color: rgba(0, 0, 0, 0.5);"></i>Profile
                                </li>
                            </a>
                            <a href="" id="btn-about">
                                <li><i class="far fa-question-circle"
                                        style="width: 38px; font-size: 16px; color: rgba(0, 0, 0, 0.5);"></i>About</li>
                            </a>
                            <li class="btn-logout">
                                <a href="{{ route('logout') }}" id="btn-logout">Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

@if(Auth::User()->role_id==1)
@push('extras-js')
<script>
    (function getNotification() {
        $.ajax({
            url: window.location.origin + '/markAsRead',
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                console.log(data.jumlah);
                $('#badge-notif').html(data.jumlah);
                console.log(data.content);
                $("#notif-content").load(document.URL + " #notif-content > *");
            },
            complete: function () {
                setTimeout(getNotification, 3000);
            },
            error: function (err) {
                console.log(err);
            }
        })
    })();

</script>
@endpush
@endif

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
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        confirmButtonColor: "#241937",
                        text: 'Login Gagal!',
                    });
                }
            });
    });

</script>
@endpush
