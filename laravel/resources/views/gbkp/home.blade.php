@extends('gbkp.template')

@section('asset')
  <script src="{{url('public/assets/plugin/highchart/code/highcharts.js')}}"></script>
  <script src="{{url('public/assets/plugin/highchart/code/modules/drilldown.js')}}"></script>
  <script src="{{url('public/assets/plugin/highchart/code/modules/exporting.js')}}"></script>
  <script src="{{url('public/assets/plugin/highchart/code/grouped-categories.js')}}"></script>
  <script src="{{url('public/assets/plugin/highchart/code/highcharts-more.js')}}"></script>
  <script src="{{url('public/assets/plugin/highchart/code/highcharts-3d.js')}}"></script>
  <script src="{{url('public/assets/plugin/highchart/code/lib/canvg.js')}}"></script>
  <script src="{{url('public/assets/plugin/highchart/code/lib/jspdf.js')}}"></script>
  <script src="{{url('public/assets/plugin/highchart/code/lib/rgbcolor.js')}}"></script>
@endsection
@section('header-css')
<style type="text/css">
  #slider {
    margin-right: 0;
    margin-left: 0;
    border-width: .2rem;
    width: 100%;
  }

  .box-center {
    margin: 0 auto;
  }

  .carousel-caption {
    right: 0;
    bottom: 0;
    left: 0;
    padding-bottom: 30px;
    opacity: 0;
    transition: all 800ms linear;
    background: rgba(0, 0, 0, 0.45);
  }

  .carousel-item.active .carousel-caption {
    opacity: 1;
  }

  .container-img-kategorial{
    text-align: center;
  }

  .container-logo-kategorial{
     border-bottom: 0px !important;
  }

  .container-logo-kategorial.active{
     border-bottom: 2px solid var(--main-secondary-2) !important;
  }

  .line-kategorial{
        border-bottom: 3px solid var(--main-secondary-3);
  }

  .subtext-kategorial {
      font-size: 1em;
      font-weight: 600;
      font-family: Poppins, sans-serif;
      color: var(--main-secondary);
  }

  .img-kategorial{
    max-width: 70px;
    max-height: 70px;
  }

  ul.contact li {
      list-style: none;
      text-decoration: none;
      margin: 0.5em 0 0 0;
      padding: 0 0 0 1.25em;
      position: relative;
  }

  #visimisi > .row > .card > .w-100{
    min-height: 400px;
  }

  .title-visimisi{
    font-family: Montserrat;
    font-weight: 600;
    font-size: 5em;
    letter-spacing: 0.08em;
    padding-top: 5%;
    padding-left: 10px;
  }

  .content-visi{
    padding-left: 30px;
    font-family: 'Roboto';
    font-size: 1.2em;
    font-weight: 600;
  }

  .content-misi{
    padding-top: 10px;
    padding-left: 20px;
    font-family: 'Roboto';
    font-size: 1.2em;
    font-weight: 600;
    color: var(--main-white);
  }

</style>
@endsection


@section('header-js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.min.js"></script>
@endsection

@section('content')
          
      <section id="home">
       <div class="container-fluid ">
          <div class="row">
            <div class="col-12 box-center pl-0 pr-0">
              <div id="slider">
                <div class="carousel slide" id="carousel">
                  <div class="carousel-inner">
                    <div class="carousel-item active">
                      <img src="{{url('/public/img/banner-desktop-1.jpg')}}" class="d-none d-sm-block w-100 banner-desktop" alt="">
                      <img src="{{url('/public/img/banner-mobile-1.jpg')}}" class="mobile d-block d-sm-none w-100 banner-mobile" alt="">
                      <!-- <div class="carousel-caption">
                        <h5>Title Here</h5>
                        <p>description here</p>
                      </div> -->
                    </div>
                    <div class="carousel-item">
                      <img src="{{url('/public/img/banner-desktop-2.jpg')}}" class="d-none d-sm-block w-100 banner-desktop" alt="">
                      <img src="{{url('/public/img/banner-mobile-2.jpg')}}" class="mobile d-block d-sm-none w-100 banner-mobile" alt="">
                      <div class="carousel-caption">
                        <h5>Pendeta, Pertua & Diaken GBKP Runggun Tambun</h5>
                        <p>2020</p>
                      </div>
                    </div>
                  </div>
                  <ol class="carousel-indicators">
                    <li data-slide-to="0"></li>
                    <li data-slide-to="1"></li>
                  </ol>
                  <a class="carousel-control-prev" href="#" role="button"><span class="carousel-control-prev-icon" aria-hidden="true"><span class="sr-only">Previous</span></span></a>
                  <a class="carousel-control-next" href="#" role="button"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="sr-only">Next</span></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section id="visimisi" class="container-fluid">
          <div class="row">
              <div class="card border-0 col-md-6 px-0 ">
                <div class="w-100 bg-primary-1 px-3">
                  <div class="title-visimisi color-secondary">Visi</div>
                  <div class="content-visi">
                    GBKP menjadi kawan sekerja Allah untuk menyatakan rahmat Allah kepada dunia. Dalam Bahasa Inggris: to be God’s fellow-workers to manifest God’s mercy to the world (1 Korintus 3:9 dan I Petrus 2:9-10). 
                    <p>Dalam bahasa Karo diartikan sebagai <br><strong class="color-secondary">“GBKP aron Dibata guna jadi pasu-pasu man isi doni”.</strong></p>
                  </div>
                </div>
              </div>

              <div class="card border-0 col-md-6 px-0 ">
                <div class="w-100 bg-secondary px-3">
                  <div class="title-visimisi color-primary-1">Misi</div>
                  <div class="content-misi">
                    <ol>
                      <li>Menumbuhkembangkan <strong class="color-primary-1">spiritualitas jemaat berbasis Alkitab</strong></li>
                      <li>Menegakkan <strong class="color-primary-1">keadilan, perdamaian dan keutuhan ciptaan Allah</strong></li>
                      <li>Memperkuat <strong class="color-primary-1">semangat gotong royong antar sesama jemaat dan masyarakat</strong></li>
                      <li>Menggali dan menumbuhkembangkan potensi jemaat untuk <strong class="color-primary-1">bersekutu dan bersinergi</strong></li>
                    </ol>
                  </div>
                </div>
              </div>
          </div>
      </section>

       <section id="kategorial" class="container-fluid pb-3">
          <div class="row">
            <div class="col-12 line-kategorial">
            </div>
          </div>
          <div class="row pb-0 pt-3"  role="tablist">
              <div class="card border-0 col-md-2 col-4 offset-md-1 container-logo-kategorial pt-2">
                  <div class="container-img-kategorial">
                      <img src="{{url('/public/img/logo-mamre.png')}}" alt="logo mamre" class="img-kategorial" >
                  </div>
                  <div class="text-center subtext-kategorial mt-1">
                    Mamre
                  </div>
              </div>
              <div class="card border-0 col-md-2 col-4 container-logo-kategorial pt-2">
                  <div class="container-img-kategorial">
                      <img src="{{url('/public/img/logo-moria.png')}}" alt="logo moria" class="img-kategorial" >
                  </div>
                   <div class="text-center subtext-kategorial mt-1">
                    Moria
                  </div>
              </div>
              <div class="card border-0 col-md-2 col-4 container-logo-kategorial pt-2">
                  <div class="container-img-kategorial">
                      <img src="{{url('/public/img/logo-gbkp.png')}}" alt="logo saitun" class="img-kategorial" >
                  </div>
                   <div class="text-center subtext-kategorial mt-1">
                    Saitun
                  </div>
              </div>
              <div class="card border-0 col-md-2 col-4 offset-md-0 offset-2 container-logo-kategorial pt-2">
                  <div class="container-img-kategorial">
                      <img src="{{url('/public/img/logo-kakr.png')}}" alt="logo ka/kr" class="img-kategorial" >
                  </div>
                   <div class="text-center subtext-kategorial mt-1">
                    KA/KR
                  </div>
              </div>
              <div class="card border-0 col-md-2 col-4 container-logo-kategorial pt-2">
                  <a href="https://kitapermata.com" target="_blank" >
                  <div class="container-img-kategorial" href="https://kitapermata.com" target="_blank">
                      <img src="{{url('/public/img/logo-permata.png')}}" class="img-kategorial" alt="logo permata">
                  </div>
                   <div class="text-center subtext-kategorial mt-1">
                    Permata
                  </div>
                  </a>
              </div>
          </div>
      </section>

      <section class="container-fluid pt-4" id="chart">
          <div class="row">
            <div class="col-md-10 offset-md-1 col-sm-12">
                <div class="w-100">
                    <span class="title-chart">Jemaat Per-Sektor</span>
                </div>
                <div id="anggota-sektor-kategorial"></div>
            </div>
          </div>
      </section>

      <section class="container pl-2 pr-2"  id="berita">
        <div class="row">
          <div class="col-md-12 col-12">
            <div class="w-100 title-berita">
              Warta Jemaat
            </div>

            @foreach($artikel as $key => $value)
            <div class="card border mb-4">
              <div class="card-body card-body-berita">
                <div class="w-100 mb-2">
                  <a href="{{url('/').'/artikel/'.$value->url_key}}">
                    <strong class="content-berita-title">{{$value->title ? $value->title : ''}}</strong>
                  </a>
                    <div class="float-right content-berita-date">{{$value->publish_at ? $value->publish_at : '' }}</div>
                </div>
                <div class="d-sm-inline-flex d-md-flex justify-content-sm-end justify-content-md-end  flex-sm-column flex-md-row float-left">
                  <div class="text-center">
                    <img width="200" src="{{$value->image_mobile ? url('/').'/public/img/artikel/'.$value->image_mobile : 'https://via.placeholder.com/300x300/000/808080'}}" class="rounded img-berita" alt="{{$value->title ? $value->title : ''}}">
                  </div>
                  <div class="pl-3 content-berita-value">
                      {{$value->short_description ? $value->short_description : '' }}
                  </div>
                </div>
              </div>

              <div class="card-footer text-right pt-1  pb-1">
                <a href="{{url('/').'/artikel/'.$value->url_key}}" class="btn btn-primary btn-sm">Lanjutkan</a>
              </div>
            </div>
            @endforeach

            @if($artikelmore))
            <div class="col-12 w-100 text-right mb-5" style="margin-top:-20px;">
              <a href="#berita">Lihat berita lainnya >>> </a>
            </div>
            @endif
          </div>
        </div>
      </section>
@endsection
  
@section('footer-js')  
<script>
  const getChart1 = async() =>{
          return await fetch("{{route('app-dashboard-chart-total-kategorial')}}", {
            method      : 'POST', // *GET, POST, PUT, DELETE, etc.
            mode        : 'cors', 
            referrerPolicy: 'no-referrer'
          }).then(r => 
          r.json())
          .then(data => {
            return data;
          })
            .catch(error => {
              console.error('Error:', error);
          });
  } 

  const startChart1 = async(data) =>{
      for (var i =  0; i < data.chart.length; i++) {
        switch(data.chart[i]["name"]) {
       case "SAITUN":
          data.chart[i]["color"] = "#242765";
        break;
       case "MAMRE":
          data.chart[i]["color"] = "#e67635";
        break;
       case "MORIA":
          data.chart[i]["color"] = "#147ae2";
        break;
       case "PERMATA":
          data.chart[i]["color"] = "#353f87";
          break;
        case "KA/KR":
          data.chart[i]["color"] = "#fbcc37";
          break;
        default:
          data.chart[i]["color"] = "#e67635";
      }

        console.log(data.chart[i]["name"]);
      }
        Highcharts.chart('anggota-sektor-kategorial', {
          chart: {
              type: 'column',
              backgroundColor: '#0000',
              borderRadius: '10px',
              height : '500px',
              marginTop : 20
          },
          exporting: { enabled: false },
          subtitle: {
              text: ''
          },
          credits: { text: 'gbkprungguntambun', href : 'https://gbkprungguntambun.org'},
          title: {
              text: '',
          },
          xAxis: {
              categories: data.list_sektor
          },
          yAxis: {
              min: 0,
              title: {
                  text: 'Jemaat'
              },
              stackLabels: {
                  enabled: true,
                  style: {
                      fontWeight: 'bold',
                      color: ( // theme
                          Highcharts.defaultOptions.title.style &&
                          Highcharts.defaultOptions.title.style.color
                      ) || 'gray'
                  }
              }
          },
          legend: {
              align: 'right',
              x: 0,
              // verticalAlign: 'top',
              // y: 100,
              floating: false,
              backgroundColor: '#ffffff92',
              borderColor: '#CCC',
              borderWidth: 1,
              shadow: false
          },
          tooltip: {
              headerFormat: '<b>{point.x}</b><br/>',
              pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
          },
          plotOptions: {
              column: {
                  stacking: 'normal',
                  dataLabels: {
                      enabled: true
                  }
              }
          },
          series: data.chart
    });
    }


  $(document).ready(function() {   
        var $slider = $('#carousel'),hammer = new Hammer($slider.get(0));
        $slider.find('img').each((index, elem) => {
          $(elem).prop('draggable', false);
        });
        $slider.carousel();
        $slider.find(".carousel-control-prev").click(e => {
          e.preventDefault();
          $slider.carousel("prev");
        });
        $slider.find(".carousel-control-next").click(e => {
          e.preventDefault();
          $slider.carousel("next");
        });
        hammer.on("panleft panright", e => {
          e.preventDefault();
          if (e.type == 'panleft') {
            $slider.carousel("next");
          }
          if (e.type == 'panright') {
            $slider.carousel("prev");
          }
        });
        $slider.find('.carousel-indicators li').click(e => {
          $slider.carousel($(e.target).data('slide-to'));
        });   

        getChart1().then((data)=>{
            $("#landing-loader").removeClass("hidden");
            if(data.status == 200){
               $("#landing-loader").addClass("hidden");
               startChart1(data.data);           
            }else{
                alert("terjadi kesalahan");
            }
        });
  });

</script>
@endsection