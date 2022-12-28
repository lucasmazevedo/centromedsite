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
    <div class="page page--medical" data-page="intro-metro">
        <!-- HEADER -->
        <header class="header header--page header--fixed">
            <div class="header__inner">
                <div class="header__icon header__icon--menu" data-panel="left" data-arrow="right">
                    @if (Route::currentRouteName() != 'app.mobile')
                        <a href="{{ route('app.mobile') }}"><img
                                src="{{ asset('/mobile/assets/images/icons/white/arrow-back.svg') }}" alt=""
                                title="" /></a>
                    @endif
                </div>
                <div class="header__logo header__logo--text"><a href="#"><strong>Centromed</strong> App</a></div>
                <div class="header__icon" data-panel="right" data-arrow="left"><a class="menu-link px-5"
                        href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                        <img src="{{ asset('/mobile/assets/images/icons/white/user.svg') }}" alt=""
                            title="" /> </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>

                </div>
            </div>
        </header>
        <div class="page__content page__content--with-header">

            @yield('content')
        </div>
    </div>

    <script src="{{ asset('/mobile/vendor/jquery/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('/mobile/vendor/jquery/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('/mobile/vendor/swiper/swiper.min.js') }}"></script>
    <script src="{{ asset('/mobile/js/jquery.custom.js') }}"></script>
    <script src="{{ asset('/mobile/js/mask.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#pCpf").inputmask("999.999.999-99");
            $("#pNascimento").inputmask("99/99/9999");
        });
    </script>
</body>

</html>
