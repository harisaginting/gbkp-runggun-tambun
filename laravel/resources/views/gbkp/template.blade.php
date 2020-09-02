<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>{{$title ?? 'GBKP RUNGGUN TAMBUN'}}</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <meta name=”description” content="{{$description ??'GBKP Runggun Tambun - Gereja Batak Karo Protestan Runggun Tambun'}}">
    <meta name="google" content="notranslate" />
    <meta name="google-site-verification" content="tW0WUpvfArHS_Vuvfmi0lCd59v4QOMco7yGOmqZwxkg" />
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">


    <meta property="og:locale" content="id_ID" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{$title ?? 'GBKP RUNGGUN TAMBUN'}}" />
    <meta property="og:description" content="{{$description ??'GBKP Runggun Tambun - Gereja Batak Karo Protestan Runggun Tambun'}}"/>
    <meta property="og:url" content="https://gbkprungguntambun.org" />
    <meta property="og:site_name" content="GBKP RUNGGUN TAMBUN" />

    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:description" content="{{$description ??'GBKP Runggun Tambun - Gereja Batak Karo Protestan Runggun Tambun'}}" />
    <meta name="twitter:title" content="{{$title ?? 'GBKP RUNGGUN TAMBUN'}}" />
    <meta name="twitter:image" content="{{ env('APP_URL_FRONTEND') }}/public/img/logo-gbkp.png" />

    <!-- Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat%3A400%2C600&#038;ver=0.1.19' type='text/css' media='all' />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;900&display=swap" type='text/css'  rel="stylesheet">

    <!-- Jquery -->
    <script src="{{url('vendor/jquery.min.js')}}"></script>
    <script src="{{url('vendor/popper.min.js')}}"></script>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{url('vendor/bootstrap.min.css')}}" />
    <script src="{{url('vendor/bootstrap.min.js')}}"></script>

    <!-- custom -->
    <link rel="stylesheet" href="{{url('public/gbkp/landing.css?v=').date('s')}}" />

    <!-- Icon -->
    <link rel="icon" href="{{url('public/img/logo32x32.png')}}" sizes="32x32" />
    <link rel="stylesheet" href="{{url('vendor/fontawesome-all.min.css')}}" />
    @yield('header-css')

    <!-- theme -->
    <script src="{{url('public/assets/template/solid-state/assets/js/jquery.scrollex.min.js')}}"></script>
    <script src="{{url('public/assets/template/solid-state/assets/js/browser.min.js')}}"></script>
    <script src="{{url('public/assets/template/solid-state/assets/js/breakpoints.min.js')}}"></script>
    <script src="{{url('public/assets/template/solid-state/assets/js/util.js')}}"></script> 

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-127183385-3"></script>
    <script>
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

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/5f4bdbdd1e7ade5df445388c/default';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->
    @yield('header-js')
</head>
    <div class="loader-page hidden" id="landing-loader">
        <img src="{{url('/img/loader-bar.gif')}}">
        <span class="loader-page-text">Timai kentisik ya...</span>
    </div>
    <body class="is-preload">
    <nav class="navbar navbar-light navbar-expand-lg fixed-top" id="navbar-top">
        <div class="container-fluid">
          <a class="navbar-brand ml-3" href="{{url('/')}}" style="display: flex;">
            <img src="{{url('/public/img/logo-gbkp.png')}}" width="80" height="80" class="d-inline-block align-top" alt="logo gbkp">
            <div class="ml-2" style="margin-top: 1px;">
              <div class="color-secondary gbkp-header">GBKP</div>
              <div class="color-secondary-2 gbkp-subheader">Greja Batak Karo Protestan</div>
            </div>
          </a>
          <div class="collapse navbar-collapse justify-content-end scroll" id="myNavbar">
            <ul class="nav navbar-nav ml-auto scroll">
              <li class="nav-item"><a href="{{url('/')}}" class="nav-link pl-10">Beranda</a></li>
              <li class="nav-item"><a href="{{url('/artikel')}}" class="nav-link pl-10 scroll">Warta Jemaat</a></li>
              <li class="nav-item"><a href="#kategorial" class="nav-link pl-10 scroll">Koinonia</a></li>
              <li class="nav-item"><a href="#" class="nav-link pl-10">Marturia</a></li>
              <li class="nav-item"><a href="#" class="nav-link pl-10">Diakonia</a></li>
              <li class="nav-item"><a href="{{url('/statistik')}}" class="nav-link pl-10">Statistik</a></li>
              <li class="nav-item"><a href="#" class="nav-link pl-10">PJJ Sektor</a></li>
              </ul>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNavbar" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>
        </div>
    </nav>
    <div id="app">
      <div class="app-body">
    @yield('content')
        </div>
    </div>

     <section id="contact">
        <div class="container pl-2 pr-2 pt-4 pb-5">
        <div class="card ">
          <div class="card-header text-center title-contact py-3">
             Hubungi Kami
          </div>
          <div class="card-body card-body-contact">
              <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <div style="width: 100%"><iframe width="100%" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=GBKP%20Runggun%20Tambun+(Gbkp%20Runggun%20Tambun)&amp;t=&amp;z=16&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe></div>
                </div>
                <div class="col-lg-6 col-sm-12">
                      <ul class="contact mb-0 pl-0">
                        <li>
                          <i class="fab fa-instagram"></i>
                          <a target="_blank" href="https://www.instagram.com/gbkprungguntambun"><strong>gbkprungguntambun</strong></a></li>
                        <!-- <li>
                          <i class="fab fa-facebook"></i>
                          <a target="_blank" href="https://www.facebook.com/permatatambun/"><strong>GBKP Runggun Tambun</strong> </a>
                        </li> -->
                        <li class="mt-1"><strong>Alamat</strong> : Jl. Bumi Lestari Raya Blok H-11 No.1, Mangunjaya, Kec. Tambun Sel., Bekasi, Jawa Barat 17510</li>
                      </ul>
                </div>
              </div>  
          </div>
        </div>  
        </div>  
      </section>
    <footer class="footer float-bottom">
      <div class="container-fluid p-2 text-center">
        <strong class="title-footer">&copy;&nbsp; GBKP RUNGGUN TAMBUN 2020 </strong>
      </div>
    </footer>
    <script type="text/javascript">
        //smooth scrolling on all links inside the navbar
        $("body").scrollspy({ target: ".navbar"});
        $(".scroll a").on("click", function(event) {
        
        if (this.hash !== "") {
          
            event.preventDefault();

            var hash = this.hash;

            $('.nav-link').removeClass('active');
            $(this).addClass('active');

          console.log("run");
            $("html, body").animate(
              {
                scrollTop: $(hash).offset().top - 100
              }
            );
          }
        });
    </script>
    @yield('footer-js')
    </body>
</html>
