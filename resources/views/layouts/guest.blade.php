<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="/imgs/logo/logo-intisab.svg" type="image/x-icon">

    <title>SMK AL-INTISAB PATOKBEUSI - {{ $title }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />

    {{-- Font Awesome Icons --}}
    <script src="https://kit.fontawesome.com/9d4da73c07.js" crossorigin="anonymous"></script>

    <style>
        .bg-pattern {
            background-image: url('{{ asset("imgs/component/login/component-login-1.svg") }}');
            background-repeat: repeat;
            background-position: center;
            background-size: cover;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-poppins">
    {{ $slot }}
</body>

</html>