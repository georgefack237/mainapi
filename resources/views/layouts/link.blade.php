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
    {{-- <link rel="stylesheet" href="{{ mix('css/app.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/style-particulier.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    @livewireStyles

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body class="font-sans antialiased">

    <div class="main-content" id="panel">
        {{ $slot }}
    </div>



    @stack('modals')

    @livewireScripts

    @stack('scripts')

    <script>

        function toClipboard(el)
        {
            const copyBtn = el.dataset.id;
            const content = document.getElementById(copyBtn).textContent;
            navigator.clipboard.writeText(content);
            console.log(content);
        }

        function downloadQR() {
            const targetQR = document.getElementById('qr');
            html2canvas(targetQR).then(function (canvas) {
                const base64image = canvas.toDataURL("image/png", 1);
                console.log(base64image);
                anchor = document.createElement('a');
                anchor.setAttribute("href", base64image);
                anchor.setAttribute("download", "qr-code-image");
                anchor.click();
                anchor.remove();
            });
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
    <script src="{{ asset('js/html2canvas.min.js') }}"></script>
    <!-- Argon JS -->
    <script src="{{ asset('js/argon.js?v=1.2.0') }}"></script>
</body>

</html>
