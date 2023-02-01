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
    <link rel="stylesheet" href="{{ asset('vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" type="text/css">
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

<body class="font-sans antialiased d-flex align-items-center justify-content-center">

    <div>
        <div class="card text-center py-5 px-5">
            <h4 class="mb-3">Entrez vos identifiant</h4>
            <form action="{{ route('commAuth') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input class="form-control form-control-muted" type="text" name="email" placeholder="Adresse mail">
                </div>
                <button type="submit" class="btn btn-success">Connexion</button>
            </form>
        </div>
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
