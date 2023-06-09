<?php setlocale(LC_TIME, 'id_ID'); ?>
<!DOCTYPE html>
<html lang="id" dir="ltr">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta name="description" content="Description" />
    
    @yield('extra-meta')

    <link rel="shortcut icon" href="{{ asset('img/RazaafTechW.png') }}" />

    <title>@yield('title') | razaqadhafin.com</title>

    <link rel="stylesheet" href="{{ asset('css/fonts-v2.css') }}" />
    <link rel="stylesheet" href="{{ asset('lib/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" />
    <link rel="stylesheet" href="https://npmcdn.com/basscss@8.0.0/css/basscss.min.css" />

    <link rel="stylesheet" href="{{ asset('css/animation-v2.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/nav-v2.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/base-v2.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/footer-v2.css') }}" />

    <script src="{{ asset('lib/jquery-3.3.1.min.js') }}" type="text/javascript"></script>

    @yield('extra-fonts')
    @yield('prerender-js')
    @yield('extra-css')

  </head>
  <body>
    @include('layouts/nav')
    @yield('content')
    @include('layouts/footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/web-animations/2.3.1/web-animations.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/smooth-scrollbar/8.3.1/smooth-scrollbar.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" type="text/javascript"></script>
    <script src="{{ asset('lib/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('lib/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/base-v1.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/nav-v1.js') }}" type="text/javascript"></script>
    @yield('extra-js')

  </body>
</html>
