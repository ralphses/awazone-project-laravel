<!DOCTYPE html>
<html lang="en" class="light scroll-smooth" dir="ltr">
<head>
    <meta charset="UTF-8" />
    <title>Techwind - Tailwind CSS Multipurpose Landing Page Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Tailwind CSS Saas & Software Landing Page Template" />
    <meta name="keywords" content="agency, application, business, clean, creative, cryptocurrency, it solutions, modern, multipurpose, nft marketplace, portfolio, saas, software, tailwind css" />
    <meta name="author" content="Shreethemes" />
    <meta name="website" content="https://shreethemes.in" />
    <meta name="email" content="support@shreethemes.in" />
    <meta name="version" content="1.5.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />


    <!-- Css -->
    <link href="{{ asset('assets/libs/tiny-slider/tiny-slider.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/libs/tobii/css/tobii.min.css') }}" rel="stylesheet" type="text/css">
    <!-- Main Css -->
    <link href="{{ asset('/libs/@iconscout/unicons/css/line.css') }}" type="text/css" rel="stylesheet" >
    <link rel="stylesheet" href="{{ asset('assets/css/icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/tailwind.css') }}" type="text/css" >
    <link rel="stylesheet" href="{{ asset('assets/js/plugins/sweetalert2/sweetalert2.min.css') }}" type="text/css">

</head>

<body class="font-nunito text-base text-black dark:text-white dark:bg-slate-900">


{{ $slot }}


<!-- JAVASCRIPTS -->
<script src="{{ asset('assets/libs/tiny-slider/min/tiny-slider.js') }}"></script>
<script src="{{ asset('assets/libs/shufflejs/shuffle.min.js') }}"></script>
<script src="{{ asset('assets/libs/tobii/js/tobii.min.js') }}"></script>
<script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins.init.js') }}"></script>
<script src="{{ asset('assets/js/app.js') }}"></script>
<!-- JAVASCRIPTS -->
</body>
</html>
