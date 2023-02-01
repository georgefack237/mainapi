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
    <!-- Page plugins -->
    <!-- Argon CSS -->
    <link rel="stylesheet" href="{{ asset('css/argon.css?v=1.2.0') }}" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/style-particulier-demo.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    @stack('scripts')

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="font-sans antialiased">
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
                                            <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}">
                                            {{-- <img src="{{ asset('storage/img/nfc/profile/' . Auth::user()->profile_photo_path) }}"> --}}
                                        </span>
                                        <div class="media-body d-none d-lg-block">
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

                                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                        <a href="{{ route('api-tokens.index') }}" class="dropdown-item">
                                            <span>
                                                {{ __('API Tokens') }}
                                            </span>
                                        </a>
                                    @endif

                                    <div class="dropdown-divider"></div>

                                    <a href="{{ route('admin.logout') }}" class="dropdown-item"
                                        onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit();">
                                        <i class="ni ni-user-run"></i>
                                        <span>Logout</span>
                                    </a>
                                    <form method="POST" id="logout-form" action="{{ route('admin.logout') }}">
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
                            <a class="nav-link active" href="{{ url('/dashboard') }}">
                                <i class="ni ni-tv-2 text-success"></i>
                                <span class="nav-link-text">Dashboard</span>
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link {{'admin' == request()->path() ? 'active' : ''}}" href="{{ url('/admin') }}">
                                <i class="fa fa-display text-success"></i>
                                <span class="nav-link-text">Dashboard</span>
                            </a>
                        </li>
                        @if (Auth::user()->is_super==true)
                        <li class="nav-item">
                            <a class="nav-link {{'admin/agents' == request()->path() ? 'active' : ''}}" href="{{ url('/admin/agents') }}">
                                <i class="fa fa-user-tie text-success"></i>
                                <span class="nav-link-text">Equipe</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{'admin/partners' == request()->path() ? 'active' : ''}}" href="{{ url('/admin/partners') }}">
                                <i class="fa fa-store text-success"></i>
                                <span class="nav-link-text">Partenaires</span>
                            </a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a class="nav-link {{'admin/clients' == request()->path() ? 'active' : ''}}" href="{{ url('/admin/clients') }}">
                                <i class="fa fa-users text-success"></i>
                                <span class="nav-link-text">Clients</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{'admin/settings' == request()->path() ? 'active' : ''}}" href="{{ url('/admin/settings') }}">
                                <i class="fas fa-cog text-success"></i>
                                <span class="nav-link-text">Paramettres</span>
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

        @yield('content')
    </div>



    @stack('modals')

    @livewireScripts

    @stack('scripts')

    <!-- Argon Scripts -->
    <!-- Core -->
    <script src="{{ asset('vendor/jquery/dist/jquery.min.js') }}"></script>
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
