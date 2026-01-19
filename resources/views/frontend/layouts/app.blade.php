<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - ARAF Human Development</title>
    <!-- favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/frontend/images/favicon.png') }}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/vendor/fontawesome/css/all.min.css') }}">
    <!-- Bootstrap 5 CSS -->
    <link href="{{ asset('assets/frontend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- main css -->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/styles.css') }}">
    @livewireStyles
</head>

<body>

    <!-- Navbar -->
    <livewire:frontend.theme.navbar />

    @yield('content')


    <!-- Footer -->
    <livewire:frontend.theme.footer />

    <!-- পপার আগে থাকবে -->
    <script data-navigate-once src="{{ asset('assets/frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- <script data-navigate-once src="{{ asset('assets/frontend/vendor/bootstrap/js/bootstrap.min.js') }}"></script> -->

    <script>
        window.onscroll = function() {
            var nav = document.querySelector('.navbar');
            if (window.pageYOffset > 50) {
                nav.classList.add('shadow-sm', 'py-2');
            } else {
                nav.classList.remove('shadow-sm', 'py-2');
            }
        };
    </script>


    @livewireScripts
</body>

</html>