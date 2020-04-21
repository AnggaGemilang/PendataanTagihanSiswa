<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="theme-color" content="#FFFFFF" />

    <title>@yield('title') - Tagihan Sekolah Siswa</title>

    @stack("extras-css")

    <!-- Styles-->
    <link rel="stylesheet" href="{{asset('assets')}}/css/bootstrap.css">
    <link rel="stylesheet" href="{{asset('assets')}}/css/style.css">
    <link rel="stylesheet" href="{{asset('assets')}}/css/sweetalert2.css">
    <link rel="stylesheet" href="{{asset('assets')}}/css/toastr.css">

    <!-- date picker -->
    <link rel="stylesheet" href="{{ asset('assets') }}/bootstrap-datepicker-1.9.0-dist/css/bootstrap-datepicker.css">

    <!-- tail custom select -->
    <link rel="stylesheet"
        href="{{ asset('assets') }}/pytesNET-tail.select-d6454ba/css/bootstrap4/tail.select-default.css">

    <!-- Favicon-->
    <link rel="icon" type="image/png" href="{{asset('assets')}}/images/favicon.png">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">

</head>

<body class="position-relative">

    <button class="btn-top" type="button">
        <i class="fa fa-arrow-up" aria-hidden="true"></i>
    </button>

    @include('partials.sidebar')

    <!-- Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="{{ asset('assets') }}/pytesNET-tail.select-d6454ba/js/tail.select.js"></script>
    <script src="{{ asset('assets') }}/bootstrap-datepicker-1.9.0-dist/js/bootstrap-datepicker.js"></script>
    <script src="{{ asset('assets') }}/js/script.js"></script>
    <script src="{{ asset('assets') }}/js/sweetalert2.js"></script>
    <script src="{{ asset('assets') }}/js/toastr.js"></script>

    @if(Session::has('description'))
    <script>
        var type = "{{ Session::get('alert-type', 'info') }}";
        switch (type) {
            case 'info':
                toastr.info("{{ Session::get('description') }}", "{{ Session::get('title') }}", {
                    "showMethod": "slideDown",
                    "hideMethod": "slideUp",
                    timeOut: 3000
                });
                break;

            case 'warning':
                toastr.warning("{{ Session::get('description') }}", "{{ Session::get('title') }}", {
                    "showMethod": "slideDown",
                    "hideMethod": "slideUp",
                    timeOut: 3000
                });
                break;

            case 'success':
                toastr.success("{{ Session::get('description') }}", "{{ Session::get('title') }}", {
                    "showMethod": "slideDown",
                    "hideMethod": "slideUp",
                    timeOut: 3000
                });
                break;

            case 'error':
                toastr.error("{{ Session::get('description') }}", "{{ Session::get('title') }}", {
                    "showMethod": "slideDown",
                    "hideMethod": "slideUp",
                    timeOut: 3000
                });
                break;
        }
    </script>
    @endif

    @if(Session::get('errors'))
    <script>
    @if(count($errors) > 0)
        @foreach($errors->all() as $error)
        toastr.error("{{ $error }}", "Gagal Menambahkan Data!", {
                    "showMethod": "slideDown",
                    "hideMethod": "slideUp",
                    timeOut: 10000
                });
        @endforeach
    @endif
    </script>
    @endif
    @stack('extras-js')
</body>
</html>