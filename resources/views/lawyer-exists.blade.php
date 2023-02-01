<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>OABC / CBA - Matricules</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('storage/img/logo-barreau-circle.png') }}" type="image/png">
    <!-- Fonts -->
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700"> -->
    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('vendor/nucleo/css/nucleo.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" type="text/css">
    <!-- Page plugins -->
    <!-- Argon CSS -->
    <link rel="stylesheet" href="{{ asset('css/argon.css?v=1.2.0') }}" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style-particulier-copy.css') }}">

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<div>
    <div class="overlay d-flex justify-content-center align-items-center">
        <div id="state">
            <div class="text-center mb-4">
                <i class="{{ $icon }} {{ $iconcolor }}"></i>
            </div>
            <div class="container text-center my-3">
                <h4 class="mb-4">{{ $message }}</h4>
            </div>

            <div class="container text-center">
                @if ($button)
                <button class="btn btn-block btn-success" onclick="showProfile()">Afficher le profil</button>
                @endif
            </div>
        </div>
    </div>

    <div class="row mx-0 text-center header-title mx-2">
        <div class="col-4 header header-left mt-3 p-0">

        </div>
        <div class="col-4 profile-icon mb-4 animated fadeInDown">
            <img src="{{ asset('storage/img/logo-barreau.png') }}" alt="">
        </div>
        <div class="col-4 header header-left mt-3 p-0">

        </div>
    </div>

    <div id="profile">
        @if ($profile)
        <div class="square"></div>
            <div class="name-card mx-2">
                <div class="profile-img">
                    <img src="{{ asset('storage/img/nfc/profile/'. $profile->image) }}" alt="">
                </div>
                <div class="name text-center animated fadeInUp">
                    <h3 class="text-uppercase">{{ $profile->first_name }} {{ $profile->last_name }}</h3>
                    <h5 class="text-uppercase text-muted">{{ $profile->title }}</h5>
                </div>
                <div class="divider my-1 animated fadeInUp"></div>
                <p class="text-center animated fadeInUp"><span class="" style="color: #00A851">Mat.:</span> {{ $profile->matricule }}</p>
            </div>

            <div class="register-date d-flex align-items-center justify-content-center bg-success py-2 text-white">
                <span>Date d'inscription: {{ date("j M Y",  strtotime($profile->created_at)) }}</span>
            </div>

            <div class="container">

                <div class="contact-block mt-4 animated fadeInUp">
                    <div class="single">
                        <div class="corner">
                            <i class="fas fa-map-marker-alt icon-left"></i>
                        </div>
                        <div class="ml-2">
                            <span>{{ $profile->address }}</span>
                        </div>
                        <!-- <i class="fas fa-map-marker-alt ml-auto"></i> -->
                    </div>
                    <div class="single with-icon-right mt-2">
                        <div class="corner">
                            <i class="fas fa-mobile-alt icon-left"></i>
                        </div>
                        <div class="ml-2">
                            <span>{{ $profile->phone }}
                        </div>
                        <a href="tel:{{ $profile->phone }}" class=" ml-auto icon-right">
                            <i class="fas fa-phone"></i>
                        </a>
                    </div>
                    <div class="single with-icon-right mt-2">
                        <div class="corner">
                            <a href="http://{{ $profile->mail }}"><i class="fas fa-envelope icon-left"></i></a>
                        </div>
                        <div class="ml-2">
                            <span>{{ $profile->mail }}
                        </div>
                        <a href="mailto:{{ $profile->mail }}" class=" ml-auto icon-right">
                            <i class="fa fa-paper-plane"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="bottom-action">
                <a href="{{ route('lawyer.save', $profile->id) }}" class="animated fadeInUp">
                    <div class="save px-4">
                        <i class="fa fa-arrow-down mr-2"></i><span class="">Enregistrer</span>
                    </div>
                </a>
            </div>
        @endif

    </div>


</div>

<script>
    console.log('Hi')
    document.getElementById("profile").style.display = "none";

    function showProfile() {
        document.getElementById("profile").style.display = "block";
        document.getElementById("state").style.display = "none";
    }
</script>
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
</body>

</html>
