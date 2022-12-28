<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, minimal-ui">
    <title>Centromed - App Agendamento</title>
    <link rel="stylesheet" href="{{ asset('/mobile/vendor/swiper/swiper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/mobile/css/style.css') }}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;500;600;800&display=swap"
        rel="stylesheet">
</head>

<body>
    <div class="page page--login" data-page="login">
        <!-- HEADER -->
        <header class="header header--fixed">
            <div class="header__inner">
                <div class="header__icon"><a href="splash.html"><img src="../assets/images/icons/gray/arrow-back.svg"
                            alt="" title="" /></a></div>
            </div>
        </header>

        <div class="login">
            @yield('content')
        </div>



    </div>
    <!-- PAGE END -->

    <script src="{{ asset('/mobile/vendor/jquery/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('/mobile/vendor/jquery/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('/mobile/vendor/swiper/swiper.min.js') }}"></script>
    <script src="{{ asset('/mobile/js/jquery.custom.js') }}"></script>
</body>

</html>
