<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Angelic | Holy N Pure</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <meta name="facebook-domain-verification" content="sytq25ez40y87l13wgykn2k6vbry35" />
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{ asset('public/assets/store') }}/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Lightbox-->
    <link rel="stylesheet" href="{{ asset('public/assets/store') }}/vendor/lightbox2/css/lightbox.min.css">
    <!-- Range slider-->
    <link rel="stylesheet" href="{{ asset('public/assets/store') }}/vendor/nouislider/nouislider.min.css">
    <!-- Bootstrap select-->
    <link rel="stylesheet"
        href="{{ asset('public/assets/store') }}/vendor/bootstrap-select/css/bootstrap-select.min.css">
    <!-- Owl Carousel-->
    <link rel="stylesheet" href="{{ asset('public/assets/store') }}/vendor/owl.carousel2/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="{{ asset('public/assets/store') }}/vendor/owl.carousel2/assets/owl.theme.default.css">
    <!-- Google fonts-->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@300;400;700&amp;display=swap">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Martel+Sans:wght@300;400;800&amp;display=swap">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{ asset('public/assets/store') }}/css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{ asset('public/assets/store') }}/css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{ asset('public/assets/store') }}/img/favicon.png">
    <!-- Tweaks for older IEs-->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->

    <!-- Facebook Pixel Code -->
    <!-- Meta Pixel Code -->
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '716807922693667');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=716807922693667&ev=PageView&noscript=1" /></noscript>
    <!-- End Meta Pixel Code -->
    <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=359614955964158&ev=PageView&noscript=1" /></noscript>
    <!-- End Facebook Pixel Code -->

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    @stack('css')
</head>

<body>
    <div
        class="page-holder {{ (isset($page) && $page == 'detail') || $page == 'checkouted_info' || $page == 'checkorder' ? 'bg-light' : '' }}">
        @include('templates.store.header')

        @yield('content')

        @if (isset($page) && $page !== 'checkorder')
            @include('templates.store.footer')
        @endif

        <!-- JavaScript files-->
        <script src="{{ asset('public/assets/store') }}/vendor/jquery/jquery.min.js"></script>
        <script src="{{ asset('public/assets/store') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('public/assets/store') }}/vendor/lightbox2/js/lightbox.min.js"></script>
        <script src="{{ asset('public/assets/store') }}/vendor/nouislider/nouislider.min.js"></script>
        <script src="{{ asset('public/assets/store') }}/vendor/bootstrap-select/js/bootstrap-select.min.js"></script>
        <script src="{{ asset('public/assets/store') }}/vendor/owl.carousel2/owl.carousel.min.js"></script>
        <script src="{{ asset('public/assets/store') }}/vendor/owl.carousel2.thumbs/owl.carousel2.thumbs.min.js"></script>
        <script src="{{ asset('public/assets/store') }}/js/front.js"></script>
        <script>
            // ------------------------------------------------------- //
            //   Inject SVG Sprite - 
            //   see more here 
            //   https://css-tricks.com/ajaxing-svg-sprite/
            // ------------------------------------------------------ //
            function injectSvgSprite(path) {

                var ajax = new XMLHttpRequest();
                ajax.open("GET", path, true);
                ajax.send();
                ajax.onload = function(e) {
                    var div = document.createElement("div");
                    div.className = 'd-none';
                    div.innerHTML = ajax.responseText;
                    document.body.insertBefore(div, document.body.childNodes[0]);
                }
            }
            // this is set to BootstrapTemple website as you cannot 
            // inject local SVG sprite (using only 'icons/orion-svg-sprite.svg' path)
            // while using file:// protocol
            // pls don't forget to change to your domain :)
            injectSvgSprite('https://bootstraptemple.com/files/icons/orion-svg-sprite.svg');
        </script>
        <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
            integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

        @stack('js-library')
        @stack('js')
    </div>
</body>

</html>
