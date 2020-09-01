@extends('frontend.layout')

@section('header-css')
<link rel="stylesheet" href="{{url('/')}}/public/landing/main.css?v=permatagbkp" />
@endsection


@section('header-js')
@endsection

@section('content')
    <!-- Page Wrapper -->
      <div id="page-wrapper">
        <!-- Banner -->
          <section id="banner">
            <div class="inner">
              <div class="logo"><img src="{{url('/')}}/img/logo_permata.png" alt="LOGO PERMATA GBKP" height="100"></div>
              <h1>YYYPERMATA GBKP RUNGGUN TAMBUN</h1>
              <p>Bersekutu Melayani Mewujudnyatakan Kehendak ALLAH Ditengah-tengah Gereja, Keluarga, Masyarakat, Bangsa dan Negara.</p>
            </div>
          </section>

        <!-- Wrapper -->
          <section id="wrapper">
              <section id="one" class="wrapper spotlight style1">
                <div class="inner">
                  <img class="image" src="{{url('/')}}/img/doa-resolusi-permata-gbkp.png" alt="misi permata gbkp runggun tambun" />
                  <div class="content">
                    <h2 class="content-header text-dark">VISI PERMATA GBKP</h2>
                    <div class="w-100 text-left"><p>“1 Korintus 3:9 dan 1 Petrus 2:9-10  : Menjadi kawan sekerja Allah untuk menyatakan rahmat Allah kepada dunia. Dalam Bahasa Inggris : to be God’s fellow-workers to manifest God’s mercy to the world, dan dalam Bahasa Karo diartikan sebagai Aron Dibata guna jadi pasu-pasu man isi doni.“</p></div>
                  </div>
                </div>
              </section>

            <!-- Two -->
              <section id="two" class="wrapper alt spotlight style2">
                <div class="inner">
                  <img class="image"  src="{{url('/')}}/img/pelantikan-pengurus-permata-2018-2020.png" alt="misi permata gbkp runggun tambun" />
                  <div class="content">
                    <h2 class="content-header">MISI PERMATA GBKP</h2>
                    <ul>
                      <li>1. Mengembangkan spiritual jemaat berbasis Alkitab</li>
                      <li>2. Mempererat persaudaraan PERMATA GBKP yang saling menopang dan membangun</li>
                      <li>3. Memperkokoh sinergi jaringan organisasi PERMATA GBKP</li>
                      <li>4. Menggali dan mengembangkan potensi PERMATA GBKP</li>
                      <li>5. Meningkatkan rasa kemanusiaan dan keutuhan ciptaan Allah</li>
                    </ul>
                  </div>
                </div>
              </section>

            <!-- Three -->
              <section id="three" class="wrapper spotlight style3">
                <div class="inner">
                  <img class="image" src="{{url('/')}}/img/retreat-permata.png" alt="tentang permata gbkp runggun tambun" />
                  <div class="content">
                    <h2 class="major">TENTANG KAMI</h2>
                    <div class="w-100 text-left">
                      <p>Persadan Man Anak Gerejanta (PERMATA GBKP) adalah salah satu persekutuan kategorial bagi Pemuda GBKP. Kehadiran PERMATA GBKP ditengah-tengah GBKP adalah sebagai tanda kasih setia Allah terhadap kesinambungan gerejaNya ditengah-tengah dunia ini. PERMATA GBKP juga merupakan jemaat kini dan masa yang akan datang yang senantiasa harus mempersiapkan diri dan berusaha memahami panggilan bersaksi, bersekutu dan melayani dari Tuhan Allah terhadap dirinya masing-masing agar mereka mewujudnyatakan Kehendak Allah ditengah-tengah gereja, keluarga, masyarakat, bangsa dan negara.</p>
                    </div>
                  </div>
                </div>
              </section>
        <!-- Footer -->
          <section id="footer">
            <div class="inner">
              <h2 class="major">Yuk Kenal PERMATA GBKP RUNGGUN TAMBUN Lebih Dekat</h2>
              <ul class="contact mb-0">
                <li class="icon brands fa-instagram"><a target="_blank" style="color:#c2c1d8" href="https://www.instagram.com/permatatambun"><strong>@permatatambun</strong></a></li>
                <li class="icon brands fa-facebook mt-3"><a target="_blank" style="color:#c2c1d8" href="https://www.facebook.com/permatatambun/"><strong>Permata Gbkp Tambun</strong> </a></li>
                <li class="mt-1"><strong>Alamat</strong> : Jl. Bumi Lestari Raya Blok H-11 No.1, Mangunjaya, Kec. Tambun Sel., Bekasi, Jawa Barat 17510</li>
              </ul>
              <ul class="copyright">
                <li>&copy; <strong>PERMATA GBKP</strong> RUNGGUN TAMBUN 2020</li>
              </ul>
            </div>
          </section>

      </div>

    <!-- Scripts -->

@endsection
  
@section('footer-js')  
<script src="{{url('public/assets/template/solid-state/assets/js/main.js')}}"></script>
<script type="text/javascript">
      $(document).ready(function() {
        $("body").scrollspy({ target: ".navbar"});

      //smooth scrolling on all links inside the navbar
      $(".scroll a").on("click", function(event) {
        
        if (this.hash !== "") {
          
          event.preventDefault();

          var hash = this.hash;

          $('.nav-link').removeClass('active');
          $(this).addClass('active');

         
          $("html, body").animate(
            {
              scrollTop: $(hash).offset().top
            },
            800,
            function() {
              window.location.hash = hash;
            }
          );
        }
      });
    });
</script>
@endsection