@php

$logo_url = upload_assets(get_settings('website_logo'),true);
@endphp

<!doctype html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta name="google-site-verification" content="40aCnX7tt4Ig1xeLHMATAESAkTL2pn15srB14sB-EOs" />
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> {{ get_settings('website_name') }} |  @yield('title','الرئيسية')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('meta_tags')

    <link rel="shortcut icon" type="image/x-icon" href="{{ $logo_url }}">
    <!-- Place favicon.ico in the root directory -->

    <!-- ===== All CSS files ===== -->
    <link rel="stylesheet" href="{{ asset('front/assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/assets/css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/assets/css/lineicons.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/assets/css/ud-styles.css') }}" />
    <link rel="stylesheet" href="{{ asset('front/assets/fonts/Tajawal-Bold.ttf') }}" />
   {{-- jquery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <style>
        .show-notify{
            position: absolute;
            z-index: 10000;
            left: 3%;
            top: 18%;
        }
        .dropdown-menu {
            font-size: 15px;
            text-align: right;
            direction: rtl;
        }
        .btn-dark,
        .btn-dark:hover {
            color: #fff;
            background-color: #414850;
            border-color: #52565a;
        }
        .ud-newsletter-box{
            background:var(--primary-color) !important;
        }
        .icon-service{
            color: beige !important;
        }
        .dates-lists li{
            background-color: #7a489a !important;
        }
        .ud-widget .ud-footer-logo{
            margin-bottom: 0px !important;
        }
        .ud-widget .ud-footer-logo {
            max-width: 100px;
        }
    </style>
    @stack('style')
</head>

<body>

    {{-- <!-- preloader -->
    <div id="preloader">
        <div id="loading-center">
            <div class="loader">
                <div class="loader-outter"></div>
                <div class="loader-inner"></div>
            </div>
        </div>
    </div>
    <!-- preloader-end --> --}}



    @include('inc.front_header')

    @if(flash()->message)
        <div class="show-notify alert {{ flash()->class }}">
            {{ flash()->message }}
        </div>
    @endif

    @if($errors->any())
        <div class="show-notify alert alert-danger">
            {{-- هناك خطأ ما يمكنك مراجعته --}}
            {{ $errors->all()[0] }}
        </div>
    @endif

    @yield('content')

    @include('inc.front_footer')

     <!-- ====== Back To Top Start ====== -->
     <a href="javascript:void(0) " class="back-to-top ">
        <i class="lni lni-chevron-up "> </i>
    </a>
    <!-- ====== Back To Top End ====== -->

    <!-- ====== All Javascript Files ====== -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="{{ asset('front/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('front/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('front/assets/js/main.js ')  }}"></script>
    <script>
        jQuery('document').ready(function(){
            setTimeout(() => {
                jQuery('.show-notify').fadeOut(5000);
            }, 3000);
        });

        // ==== for menu scroll
        const pageLink = document.querySelectorAll(".ud-menu-scroll ");

        pageLink.forEach((elem) => {
            elem.addEventListener("click ", (e) => {
                e.preventDefault();
                document.querySelector(elem.getAttribute("href ")).scrollIntoView({
                    behavior: "smooth ",
                    offsetTop: 1 - 60,
                });
            });
        });

        // section menu active
        function onScroll(event) {
            const sections = document.querySelectorAll(".ud-menu-scroll ");
            const scrollPos =
                window.pageYOffset ||
                document.documentElement.scrollTop ||
                document.body.scrollTop;

            for (let i = 0; i < sections.length; i++) {
                const currLink = sections[i];
                const val = currLink.getAttribute("href ");
                const refElement = document.querySelector(val);
                const scrollTopMinus = scrollPos + 73;
                if (
                    refElement.offsetTop <= scrollTopMinus &&
                    refElement.offsetTop + refElement.offsetHeight > scrollTopMinus
                ) {
                    document
                        .querySelector(".ud-menu-scroll ")
                        .classList.remove("active ");
                    currLink.classList.add("active ");
                } else {
                    currLink.classList.remove("active ");
                }
            }
        }

        window.document.addEventListener("scroll ", onScroll);

    </script>
    @stack('script')
</body>

</html>
