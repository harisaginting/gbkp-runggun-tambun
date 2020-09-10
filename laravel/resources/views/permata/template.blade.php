<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>{{$title ?? 'PERMATA GBKP | RUNGGUN TAMBUN'}}</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <meta name=”description” content="{{$description ??'PERMATA GBKP Runggun Tambun adalah salah satu persekutuan kategorial bagi Pemuda GBKP di Runggun Tambun. Kehadiran PERMATA ditengah-tengah GBKP Runggun Tambun adalah sebagai tanda kasih setia Allah terhadap kesinambungan gerejaNya ditengah-tengah dunia ini.'}}">
    <meta name="google" content="notranslate" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">


    <meta property="og:locale" content="id_ID" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{$title ?? 'PERMATA GBKP RUNGGUN TAMBUN'}}" />
    <meta property="og:description" content="{{$description ??'PERMATA GBKP Runggun Tambun adalah salah satu persekutuan kategorial bagi Pemuda GBKP di Runggun Tambun. Kehadiran PERMATA ditengah-tengah GBKP Runggun Tambun adalah sebagai tanda kasih setia Allah terhadap kesinambungan gerejaNya ditengah-tengah dunia ini.'}}"/>
    <meta property="og:url" content="https://permata.gbkprungguntambun.org" />
    <meta property="og:site_name" content="PERMATA GBKP RUNGGUN TAMBUN" />

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:description" content="{{$description ??'PERMATA GBKP Runggun Tambun adalah salah satu persekutuan kategorial bagi Pemuda GBKP di Runggun Tambun. Kehadiran PERMATA ditengah-tengah GBKP Runggun Tambun adalah sebagai tanda kasih setia Allah terhadap kesinambungan gerejaNya ditengah-tengah dunia ini.'}}" />
    <meta name="twitter:title" content="{{$title ?? 'PERMATA GBKP RUNGGUN TAMBUN'}}" />
    <meta name="twitter:image" content="https://permata.gbkprungguntambun.org/img/logo-permata.png" />

    <!-- Fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
    <link rel='stylesheet' id='google-fonts-css'  href='//fonts.googleapis.com/css?family=Montserrat%3A400%2C600&#038;ver=0.1.19' type='text/css' media='all' />

    <!-- Jquery -->
    <script src="{{url('vendor/jquery.min.js')}}"></script>
    <script src="{{url('vendor/popper.min.js')}}"></script>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{url('vendor/bootstrap.min.css')}}" />
    <script src="{{url('vendor/bootstrap.min.js')}}"></script>

    <!-- Icon -->
    <link rel="icon" href="{{url('public/img/logo32x32.png')}}" sizes="32x32" />
    <link rel="stylesheet" href="{{url('vendor/fontawesome-all.min.css')}}" />
    @yield('header-css')

    <script src="{{url('public/assets/template/solid-state/assets/js/jquery.scrollex.min.js')}}"></script>
    <script src="{{url('public/assets/template/solid-state/assets/js/browser.min.js')}}"></script>
    <script src="{{url('public/assets/template/solid-state/assets/js/breakpoints.min.js')}}"></script>
    <script src="{{url('public/assets/template/solid-state/assets/js/util.js')}}"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-127183385-3"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
     window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-127183385-3');
    </script>


    <script>
        window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
        'user' => Auth::user()
        ]) !!};

        const global = $(document);  
    </script>
    @yield('header-js')
</head>
    <div class="loader-page hidden" id="landing-loader">
        <img src="{{url('/img/loader-bar.gif')}}">
        <span class="loader-page-text">Timai kentisik ya...</span>
    </div>
    <body class="is-preload">
    <nav class="navbar navbar-light navbar-expand-lg fixed-top d-none d-sm-block" id="navbar-top">
        <div class="container">
          <div class="collapse navbar-collapse justify-content-end scroll" id="myNavbar">
            <ul class="nav navbar-nav ml-auto scroll">
              <li class="nav-item"><a href="{{url('/')}}" class="nav-link pl-10">Beranda</a></li>
              <li class="nav-item"><a href="{{url('/info')}}" class="nav-link pl-10">Informasi</a></li>
              </ul>
          </div>
        </div>
    </nav>
    @yield('content')
    <nav class="navbar fixed-bottom navbar-light d-block d-sm-none" id="navbar-bottom">
        <div class="row text-center">
            <a class="col-6 btn btn-sm nav-link-bottom " href="{{url('/')}}"><i class="fa fa-home"></i></a>
            <a class="col-6 btn btn-sm nav-link-bottom " href="{{url('/info')}}"><i class="fa fa-info-circle"></i>
        </div>
    </nav>
    @yield('footer-js')
    </body>
</html>
