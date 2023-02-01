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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">


    <!-- Argon CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/argon.css?v=1.2.0') }}" type="text/css">

    <!-- Page plugins -->
    <script src="{{ asset('vendor/fullcalendar-5.11.3/lib/main.js') }}"></script>
    <style rel="stylesheet" href="{{ asset('vendor/simple-scrollbar/simple-scrollbar.css') }}"></style>
    <link rel="stylesheet" href="{{ asset('vendor/fullcalendar-5.11.3/lib/main.css') }}">

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
    <a href="#" class="menu-btn text-white d-flex justify-content-center align-items-center d-lg-none"
        data-toggle="modal" data-target="#modalMenu">
        <i class="fa fa-bars"></i>
    </a>

    {{-- Modal Limit Exhausted --}}
    <div class="modal fade" id="modalMenu" tabindex="-1" aria-labelledby="modalMenuLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm navbar-expand-xs mobile-menu">
            <div class="modal-content">
                <ul class="navbar-nav">
                    @auth
                        <div class="card mx-3 bg-transparent shadow-none">
                            <li class="nav-item dropdown mt-4">
                                <a class="pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <div class="d-flex align-items-center text-center border p-2 bg-lighter"
                                        style="border-radius: 20px;">
                                        <span class="avatar avatar-md rounded-circle">
                                            <img
                                                src="{{ asset('storage/img/nfc/profile/' . Auth::user()->profile_photo_path) }}">
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
                    <li class="nav-item">
                        <a class="nav-link {{ 'dashboard' == request()->path() ? 'active' : '' }}"
                            href="{{ url('/dashboard') }}">
                            <i class="ni ni-tv-2 text-success"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ 'client/nfcprofiles' == request()->path() ? 'active' : '' }}"
                            href="{{ url('/client/nfcprofiles') }}">
                            <i class="bi bi-people-fill text-success"></i>
                            <span class="nav-link-text">Profiles</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ 'client/contacts' == request()->path() ? 'active' : '' }}"
                            href="{{ url('/client/contacts') }}">
                            <i class="bi bi-person-badge text-success"></i>
                            <span class="nav-link-text">Contacts</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ 'client/appointments' == request()->path() ? 'active' : '' }}"
                            href="{{ url('/client/appointments') }}">
                            <i class="bi bi-calendar-date text-success"></i>
                            <span class="nav-link-text">Rendez-vous</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ 'client/conversion' == request()->path() ? 'active' : '' }}"
                            href="{{ url('/client/conversion') }}">
                            <i class="bi bi-person-lines-fill text-success"></i>
                            <span class="nav-link-text">Conversion</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ 'client/sales' == request()->path() ? 'active' : '' }}"
                            href="{{ url('/client/sales') }}">
                            <i class="bi bi-cart-check text-success"></i>
                            <span class="nav-link-text">Ventes</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ 'client/activites' == request()->path() ? 'active' : '' }}"
                            href="{{ url('/client/activites') }}">
                            <i class="bi bi-clipboard-data text-success"></i>
                            <span class="nav-link-text">Suivi d'Activités</span>
                            <span class="bi bi-exclamation-circle-fill text-warning ml-auto"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ 'client/alerts' == request()->path() ? 'active' : '' }}"
                            href="{{ url('/client/alerts') }}">
                            <i class="bi bi-bell text-success"></i>
                            <span class="nav-link-text">Alertes</span>
                            <span class="badge badge-pill bg-danger ml-auto">13</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ 'client/mailing' == request()->path() ? 'active' : '' }}"
                            href="{{ url('/client/mailing') }}">
                            <i class="bi bi-chat-square-text text-success"></i>
                            <span class="nav-link-text">Mailing</span>
                            <span class="badge badge-pill bg-warning ml-auto">43</span>
                        </a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link {{ 'client/chats' == request()->path() ? 'active' : '' }}"
                            href="{{ url('/client/chats') }}">
                            <i class="fa fa-comments text-success"></i>
                            <span class="nav-link-text">Chats</span>
                        </a>
                    </li> --}}
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
            <x-sidenav />
        </div>
    </nav>
    <!-- <x-jet-banner /> -->

    <div class="main-content" id="panel">
        {{-- @livewire('navigation-menu') --}}

        {{ $slot }}
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
    <script src="{{ asset('vendor/simple-scrollbar/simple-scrollbar.min.js') }}"></script>

    <script src="//cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>

    <script>
        // CKEDITOR.replace('content');

        $(document).ready(function() {
            $('.scrollbar-inner').scrollbar();

            // window.livewire.emit('showEditor');
        });

        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
        SimpleScrollbar.initEl(document.querySelector(".scrollable"));


        // const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        // const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

        // const copyBtn = document.getElementById('copy');
        // copyBtn.addEventListener('click', (event) => {
        //     const content = document.getElementById('to-copy').textContent;
        //     navigator.clipboard.writeText(content);
        // })

        function toClipboard(el) {
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
