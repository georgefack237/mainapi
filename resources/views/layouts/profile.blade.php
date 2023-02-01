<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/png">
    <!-- Fonts -->
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700"> -->
    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('vendor/nucleo/css/nucleo.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <!-- Page plugins -->
    <!-- Argon CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/argon.css?v=1.2.0') }}" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/style-particulier-demo.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    {{-- <link rel="stylesheet" href="{{ mix('css/app.css') }}"> --}}

    @stack('scripts')

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="font-sans antialiased">
    <a href="#" class="menu-btn text-white d-flex justify-content-center align-items-center d-lg-none" data-toggle="modal" data-target="#modalMenu">
        <i class="fa fa-bars"></i>
    </a>

    {{-- Modal Limit Exhausted --}}
    <div class="modal fade" id="modalMenu" tabindex="-1"
        aria-labelledby="modalMenuLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm navbar-expand-xs mobile-menu">
            <div class="modal-content">
                <ul class="navbar-nav">
                    @auth
                        <div class="card mx-3 bg-transparent shadow-none">
                            <li class="nav-item dropdown mt-4">
                                <a class="pr-0" href="#" role="button" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <div class="d-flex align-items-center text-center border p-2 bg-lighter"
                                        style="border-radius: 20px;">
                                        <span class="avatar avatar-md rounded-circle">
                                            <img src="{{ asset('storage/img/nfc/profile/' . Auth::user()->image) }}">
                                        </span>
                                        <div class="media-body">
                                            <span class="mb-0 text-dark font-weight-bold" style="font-size: 12px;">
                                                {{ Auth::user()->name }}
                                            </span>
                                        </div>
                                    </div>
                                </a>
                                <div class="dropdown-menu  dropdown-menu-right">
                                    <div class="dropdown-header noti-title">
                                        <h6 class="text-overflow m-0">
                                            {{ __('Manage Account') }}
                                        </h6>
                                    </div>

                                    <a href="{{ route('profile.show') }}" class="dropdown-item">
                                        <i class="ni ni-single-02"></i>
                                        <span>
                                            {{ __('Profile') }}
                                        </span>
                                    </a>

                                    <div class="dropdown-divider"></div>

                                    <a href="{{ route('logout') }}" class="dropdown-item"
                                        onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                        <i class="ni ni-user-run"></i>
                                        <span>Logout</span>
                                    </a>
                                    <form method="POST" id="logout-form" action="{{ route('logout') }}">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </div>
                    @endauth
                </ul>
                <ul class="navbar-nav">
                    {{-- <li class="nav-item">
                        <a class="nav-link {{'profile' == request()->path() ? 'active' : ''}}" href="{{ url('/profile') }}">
                            <i class="fa fa-display text-success"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link {{'profile/contacts' == request()->path() ? 'active' : ''}}" href="{{ url('/profile/contacts') }}">
                            <i class="fa fa-users text-success"></i>
                            <span class="nav-link-text">Contacts</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ 'profile/activites' == request()->path() ? 'active' : '' }}"
                            href="{{ url('profile/activites') }}">
                            <i class="fas fa-chart-line text-success"></i>
                            <span class="nav-link-text">Mes Activités</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{'profile/settings' == request()->path() ? 'active' : ''}}" href="{{ url('/profile/settings') }}">
                            <i class="fas fa-cog text-success"></i>
                            <span class="nav-link-text">Profile</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Sidenav -->
    <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light" id="sidenav-main">
        <div class="scrollbar-inner">
            <!-- Brand -->
            {{-- <div class="sidenav-header d-flex align-items-center justify-content-center">
                <h1 class="text-success">NFC Dashboard</h1>
                <!-- <a class="navbar-brand" href="/">
                    <img src="{{ asset('img/brand/blue.png') }}" class="navbar-brand-img" alt="...">
                </a> -->
            </div> --}}
            <div class="navbar-inner">
                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="sidenav-collapse-main">

                    <ul class="navbar-nav">
                        @auth
                        <div class="card mx-3 bg-transparent shadow-none">
                            <li class="nav-item dropdown mt-4">
                                <a class="pr-0" href="#" role="button" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <div class="d-flex align-items-center text-center border p-2 bg-lighter" style="border-radius: 20px;">
                                        <span class="avatar avatar-md rounded-circle">
                                            <img src="{{ asset('storage/img/nfc/profile/' . Auth::user()->image) }}">
                                        </span>
                                        <div class="media-body d-none d-lg-block">
                                            <span class="mb-0 text-dark font-weight-bold" style="font-size: 12px;">
                                                    {{ Auth::user()->lastname }}
                                            </span>
                                        </div>
                                    </div>
                                </a>
                                <div class="dropdown-menu  dropdown-menu-right">
                                    <div class="dropdown-header noti-title">
                                        <h6 class="text-overflow m-0">
                                            {{ __('Manage Account') }}
                                        </h6>
                                    </div>

                                    <div class="dropdown-divider"></div>

                                    <a href="{{ route('profile.logout') }}" class="dropdown-item"
                                        onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit();">
                                        <i class="ni ni-user-run"></i>
                                        <span>Logout</span>
                                    </a>
                                    <form method="POST" id="logout-form" action="{{ route('profile.logout') }}">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        </div>
                        @endauth
                    </ul>
                    <!-- Nav items -->
                    <ul class="navbar-nav">
                        {{-- <li class="nav-item">
                            <a class="nav-link {{'profile' == request()->path() ? 'active' : ''}}" href="{{ url('/profile') }}">
                                <i class="fa fa-display text-success"></i>
                                <span class="nav-link-text">Dashboard</span>
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link {{'profile/contacts' == request()->path() ? 'active' : ''}}" href="{{ url('/profile/contacts') }}">
                                <i class="fa fa-users"></i>
                                <span class="nav-link-text">Contacts</span>
                            </a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link {{ 'profile/activites' == request()->path() ? 'active' : '' }}"
                            href="{{ url('profile/activites') }}">
                            <i class="fas fa-chart-line"></i>
                            <span class="nav-link-text">Mes Activités</span>
                        </a>
                    </li>
                        <li class="nav-item">
                            <a class="nav-link {{'profile/settings' == request()->path() ? 'active' : ''}}" href="{{ url('/profile/settings') }}">
                                <i class="fas fa-cog"></i>
                                <span class="nav-link-text">Profile</span>
                            </a>
                        </li>
                    </ul>
                    <!-- Divider -->
                    {{-- <hr class="my-3"> --}}
                    <!-- Heading -->
                    {{-- <h6 class="navbar-heading p-0 text-muted">
                        <span class="docs-normal">Documentation</span>
                    </h6> --}}
                    <!-- Navigation -->
                    {{-- <ul class="navbar-nav mb-md-3">
                        <li class="nav-item">
                            <a class="nav-link" href="/">
                                <i class="fa fa-home"></i>
                                <span class="nav-link-text">Home page</span>
                            </a>
                        </li>
                    </ul> --}}
                </div>
            </div>
        </div>
    </nav>
    <!-- <x-jet-banner /> -->

    <div class="main-content rounded" id="panel">
        {{-- @livewire('navigation-menu') --}}

        {{-- @yield('content') --}}
        {{ $slot }}
    </div>



    @stack('modals')

    @livewireScripts

    @stack('scripts')

    <!-- Argon Scripts -->
    <!-- Core -->
    <script src="{{ asset('vendor/jquery/dist/jquery.min.js') }}"></script>
    {{-- <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script> --}}
    <script src="{{ asset('vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/js-cookie/js.cookie.js') }}"></script>
    <script src="{{ asset('vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>
    <!-- Optional JS -->
    <script src="{{ asset('vendor/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('vendor/chart.js/dist/Chart.extension.js') }}"></script>
    <!-- Argon JS -->
    <script src="{{ asset('js/argon.js?v=1.2.0') }}"></script>
    <script src="{{ asset('js/html2canvas.min.js') }}"></script>

    <script>
        // const copyBtn = document.getElementById('copy');
        // copyBtn.addEventListener('click', (event) => {
        //     const content = document.getElementById('to-copy').textContent;
        //     navigator.clipboard.writeText(content);
        // })

        function toClipboard(el)
        {
            const copyBtn = el.dataset.id;
            const content = document.getElementById(copyBtn).textContent;
            navigator.clipboard.writeText(content);
            console.log(content);
        }

        const saveQR = document.getElementById('download-qr');
        saveQR.addEventListener('click', (event) => {
            const targetQR = document.getElementById('qr-code');
            html2canvas(targetQR).then(canvas => {
                const base64image = canvas.toDataURL("image/png");
                anchor.setAttribute("href", base64image);
                anchor.setAttribute("download", "qr-code-image");
                anchor.click();
                anchor.remove();
            });
        })

    </script>
</body>

</html>
