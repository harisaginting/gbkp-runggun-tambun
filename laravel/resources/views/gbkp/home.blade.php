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


  .container-visi{
    background: linear-gradient(355deg,  rgba(255,182,88,1) 7%, rgba(255,182,88,1) 74%, rgba(255,255,255,1) 75%,rgba(255,255,255,1) 93%);
  }

  .title-visi{
    font-family: Poppins;
    font-weight: 700 !important;
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


  .title-misi{
    font-family: Poppins;
    font-weight: 700 !important;
    font-size: 5em;
    letter-spacing: 0.08em;
    padding-top: 5%;
    padding-left: 10px;
  }

  .content-misi{
    padding-top: 10px;
    padding-left: 10%;
    font-family: 'Roboto';
    font-size: 1.2em;
    font-weight: 600;
    color: var(--main-white);
  }

  .container-misi{
    background: linear-gradient(5deg, rgba(13,21,117,1) 6%, rgba(13,21,117,1) 7%, rgba(13,21,117,1) 76%, rgba(255,182,88,1) 77%,rgba(255,182,88,1) 93%);
  }


  /*GBKP*/
  #gbkp-tambun{
    background-color: var(--main-white);
  }
  .title-gbkp{
    color: var(--main-primary);
    font-size: 3em;
    font-weight: 700;
    font-family: Poppins, sans-serif;
  }
  .sub-title-gbkp{
    font-size: 1.2em;
    font-weight: 400;
    font-family: Roboto, sans-serif;
  }
  .sub-title-gbkp a, .sub-title-gbkp b{
    color: var(--main-secondary);
  }

  /*Kategorial*/
  #kategorial{
    background-color: var(--main-white-2);
  }
  .subtext-kategorial {
    font-size: 1.5em;
    font-weight: 700;
    font-family: Poppins, sans-serif;
    text-transform: uppercase;
    color: var(--main-dark);
  }

  /*Kebaktian*/
  .title-kebaktian, .sub-title-kebaktian, .sub-title-berita, .title-berita{
    font-family: Poppins;
    font-size: 1.25em;
  }

  .title-kebaktian{
    font-weight: 700;
    font-size: 2.2em;
    color: var(--main-primary);
  }
  .sub-title-kebaktian{
    margin-top: -15px;
    padding-left: 2px;
    font-weight: 700;
    letter-spacing: 0.07em;
    color: var(--main-dark-2);
  }

  .content-kebaktian-title{
    margin-bottom: -2px;
    font-size: 1.5em;
    font-weight: 600;
    font-family: Poppins;
    color: var(--main-dark);
  }

  .content-kebaktian-subtitle{
    color: var(--main-dark-1);
    font-weight:600;
    font-size: 1em;
    margin-top: -18px;
    padding-left: 5px;
  }

  .sub-content-kebaktian{
      border: 1px solid #999999;
      border-radius: 10px;
      padding: 10px;
      background: var(--main-primary-1);
  }
  .content-kebaktian-tema{
    font-size: 2em;
    text-align: center;
    font-weight: 600;
    font-family: Poppins;
    line-height: 1.2em;
    color: var(--main-secondary);
  }
  .content-kebaktian-pengkotbah{
    font-size: 1em;
    text-align: center;
    font-weight: 600;
    font-family: Poppins;
    color: var(--main-dark);
  }


  /*berita*/
  .title-berita{
    font-weight: 700;
    font-size: 2.2em;
    letter-spacing: 0.05em;
    color: var(--main-secondary);
  }

  .sub-title-berita{
    margin-top: -15px;
    padding-left: 2px;
    font-weight: 700;
    letter-spacing: 0.07em;
    color: var(--main-dark-2);
  }

  .card-berita{
      border: 2px solid var(--main-secondary-3) !important;
      border-radius: 10px;
  }

  .content-berita-date{
    font-family: Poppins;
    font-weight: 600;
    font-size: 0.7em;
    color: var(--main-dark-2);
    float: left;
  }

  .card-body-berita{
    background-color: var(--main-white) !important;
    color: black;
    font-family: Roboto;
    max-height: 300px;
    min-height: 300px;
  }

  .content-berita-value{
    max-height: 220px;
    min-height: 220px;
    overflow-y: scroll;
  }

  .card-body-berita::-webkit-scrollbar {
    display: none !important;
  }

  .content-berita-title{
    font-family: Poppins;
    font-weight: 600;
    font-size: 1.25em;
    line-height: 1.1em;
    color: var(--main-dark) !important;
  }

  .card-body-berita{
    max-height: 400px;
    min-height: 400px;
  }

  .content-berita-value{
    max-height: 120px;
    min-height: 120px;
    overflow-y: scroll;
    padding-left: 0px !important;
    padding-top: 0.5rem !important
  }

  @media screen and (max-width: 580px) {
    .title-misi{
      text-align: center !important;
      padding-left: 0px !important;
      margin-left: 0px !important;
      padding-top: 0% !important;
      color: var(--main-secondary) !important;
    }
    .title-visi{
      text-align: center !important;
      padding-right: 0px !important;
      margin-right: 0px !important;
    }
    .content-misi{
      padding-left: 0px !important;
    }
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
                      <img src="{{url('/public/img/banner-1.jpg')}}" class="d-none d-sm-block w-100 banner-desktop" alt="">
                      <img src="{{url('/public/img/banner-1-mobile.jpg')}}" class="mobile d-block d-sm-none w-100 banner-mobile" alt="">
                    </div>
                    <div class="carousel-item">
                      <img src="{{url('/public/img/banner-2.jpg')}}" class="d-none d-sm-block w-100 banner-desktop" alt="">
                      <img src="{{url('/public/img/banner-2-mobile.jpg')}}" class="mobile d-block d-sm-none w-100 banner-mobile" alt="">
                      <div class="carousel-caption carousel-caption-top">
                        <h5>Serayaan GBKP Runggun Tambun</h5>
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

      <section id="gbkp-tambun" class="container-fluid pt-5 pb-5">
        <div class="row">
            <div class="col-md-10 offset-md-1 px-0">
                <div class="w-100 text-center pt-3 px-1">
                    <h1 class="title-gbkp">GBKP Runggun Tambun</h1>
                </div>
                <div class="w-100 text-center px-3 pb-5">
                    <p class="sub-title-gbkp">
                        adalah bagian dari <a href="https://gbkp.or.id/" class="sub-title-gbkp-highlight">Gereja Batak Karo Protestan (GBKP)</a> yang berlokasi di Kecamatan Tambun Selatan Kabupaten Bekasi dan tergabung dalam <a href="http://www.gbkp-kbd.org/" class="sub-title-gbkp-highlight">Klasis Bekasi-Denpasar</a>. Merupakan persekutuan warga gereja yang hidup dan melayani dalam konteks budaya Karo, antara lain prinsip <b>runggu</b> (musyawarah) dan <b>sihamat-hamaten</b> (saling menghormati) dalam kekerabatan <b>merga si lima</b>, <b>rakut si telu</b>, <b>tutur si waluh</b>, <b>perkade-kaden si sepuludua tambah sada</b> (lima marga, tiga ikatan, delapan jenis hubungan, duabelas ditambah satu jenis kekerabatan).
                    </p>
                </div>
            </div>
        </div>
      </section>

      <section id="visimisi" class="container-fluid">
          <div class="row">

              <div class="card border-0 col-md-12 px-0">
                <div class="w-100 text-right px-3 pt-5 container-visi">
                  <div class="title-visi color-secondary pr-5 mr-5">Visi</div>
                  <div class="content-visi pr-5 text-left">
                    <p class="mb-0">GBKP menjadi kawan sekerja Allah untuk menyatakan rahmat Allah kepada dunia. Dalam Bahasa Inggris: to be God’s fellow-workers to manifest God’s mercy to the world (1 Korintus 3:9 dan I Petrus 2:9-10).</p>
                    <p>Dalam bahasa Karo diartikan sebagai <strong class="color-secondary">“GBKP aron Dibata guna jadi pasu-pasu man isi doni”.</strong></p>
                  </div>
                </div>
              </div>

              <div class="card border-0 col-md-12 px-0 ">
                <div class="w-100 container-misi px-3">
                  <div class="title-misi color-white pl-5 ml-5">Misi</div>
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

      <section id="kategorial" class="container-fluid pb-5 pt-3">
          <div class="row pb-0 pt-3" role="tablist">
              <div class="card border-0 col-md-2 col-6 offset-md-1 container-logo-kategorial pt-3">
                  <div class="container-img-kategorial">
                      <img src="{{url('/public/img/logo-mamre.png')}}" alt="logo mamre" class="img-kategorial" >
                  </div>
                  <div class="text-center subtext-kategorial mt-1">
                    Mamre
                  </div>
              </div>
              <div class="card border-0 col-md-2 col-6 container-logo-kategorial pt-3">
                  <div class="container-img-kategorial">
                      <img src="{{url('/public/img/logo-moria.png')}}" alt="logo moria" class="img-kategorial" >
                  </div>
                   <div class="text-center subtext-kategorial mt-1">
                    Moria
                  </div>
              </div>
              <div class="card border-0 col-md-2 col-6 container-logo-kategorial pt-3">
                  <div class="container-img-kategorial">
                      <img src="{{url('/public/img/logo-gbkp.png')}}" alt="logo saitun" class="img-kategorial" >
                  </div>
                   <div class="text-center subtext-kategorial mt-1">
                    Saitun
                  </div>
              </div>
              <div class="card border-0 col-md-2 col-6 offset-md-0 container-logo-kategorial pt-3">
                  <div class="container-img-kategorial">
                      <img src="{{url('/public/img/logo-kakr.png')}}" alt="logo ka/kr" class="img-kategorial" >
                  </div>
                   <div class="text-center subtext-kategorial mt-1">
                    KA/KR
                  </div>
              </div>
              <div class="card border-0 col-md-2 col-sm-6 container-logo-kategorial pt-3">
                  <a href="{{env('APP_URL_FRONTEND_PERMATA')}}" target="_blank" >
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

     <!--  <section class="container-fluid pt-4" id="chart">
          <div class="row">
            <div class="col-md-10 offset-md-1 col-sm-12">
                <div class="w-100">
                    <span class="title-chart">Jemaat Per-Sektor</span>
                </div>
                <div id="anggota-sektor-kategorial"></div>
            </div>
          </div>
      </section>
 -->

       <section class="container-fluid pl-0 pr-0 pt-5" id="ibadah">
          <div class="row">
            <div class="col-md-12">
                <div class="w-100">
                  <div class="pl-3">
                    <h1 class="title-kebaktian">JADWAL KEBAKTIAN</h1>
                    <h2 class="sub-title-kebaktian">GBKP RUNGGUN TAMBUN</h2>
                  </div>
                </div>
            </div>


            <div class="col-12">
              <div class="container-fluid">
                 <div class="row content-kebaktian pb-2">
                @foreach($ibadah as $k => $i)
                    <div class="col-md-6 col-sm-12 mb-2">
                        <div class="container-fluid pl-1 pr-1 sub-content-kebaktian">
                            <div class="row">
                                <div class="col-sm-12 mb-2">
                                  <h5 class="content-kebaktian-title">{{$i['nama']}}</h5>
                                  <span class="content-kebaktian-subtitle">{{$i['tanggal_ibadah']}} - {{$i['waktu_mulai']}} s/d {{$i['waktu_selesai']}} </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 content-kebaktian-tema">{{$i['tema']}}</div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 content-kebaktian-pengkotbah">{{$i['pengkotbah']}}</div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-10 offset-md-1 mt-1 text-center">
                                  <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseIbadah-{{$k}}" aria-expanded="false" aria-controls="collapseIbadah-{{$k}}">
                                    <span class="color-secondary"><i class="fa fa-arrow-down"></i></span>
                                  </button>
                                </div>
                            </div>

                            <div class="collapse" id="collapseIbadah-{{$k}}">
                                @if(!empty($i['keterangan']))
                                   <div class="row">
                                      <div class="col-sm-12 col-md-4 offset-md-1 mt-1 poppins">Keterangan</div>
                                      <div class="col-sm-12 col-md-7 pl-5 color-dark fw8">{{$i['keterangan']}}</div>
                                  </div>
                                @endif
                                <div class="row">
                                    <div class="col-sm-12 col-md-4 offset-md-1 mt-1 poppins">Invocatio</div>
                                    <div class="col-sm-12 col-md-7 pl-5 color-dark fw8">{{$i['invocatio']}}</div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-4 offset-md-1 mt-1 poppins">Ogen</div>
                                    <div class="col-sm-12 col-md-7 pl-5 color-dark fw8">{{$i['ogen']}}</div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-4 offset-md-1 mt-1 poppins">Khotbah</div>
                                    <div class="col-sm-12 col-md-7 pl-5 color-dark fw8">{{$i['khotbah']}}</div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-4 offset-md-1 mt-1 poppins">Liturgi</div>
                                    <div class="col-sm-12 col-md-7 pl-5 color-dark fw8">{{$i['liturgi']}}</div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-4 offset-md-1 mt-1 poppins">Siermomo</div>
                                    <div class="col-sm-12 col-md-7 pl-5 color-dark fw8">{{$i['siermomo']}}</div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-4 offset-md-1 mt-1 poppins">Sinaruh</div>
                                    <div class="col-sm-12 col-md-7 pl-5 color-dark fw8">{{$i['sinaruh']}}</div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-4 offset-md-1 mt-1 poppins">Koordinator</div>
                                    <div class="col-sm-12 col-md-7 pl-5 color-dark fw8">{{$i['koordinator']}}</div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-4 offset-md-1 mt-1 poppins">Organis</div>
                                    <div class="col-sm-12 col-md-7 pl-5 color-dark fw8">{{$i['organis']}}</div>
                                </div>

                                @foreach($i['songleader2'] as $x => $y)
                                  <div class="row">
                                      <div class="col-sm-12 col-md-4 offset-md-1 mt-1 poppins"><?= $x == 0 ? 'Song Leader ' : '' ?></div>
                                      <div class="col-sm-12 col-md-7 pl-5 color-dark fw6">{{$y}}</div>
                                  </div>
                                @endforeach

                                @if(!empty($i['link_youtube']))
                                  <div class="row">
                                    <div class="col-sm-12 col-md-8 offset-md-2 pt-3">
                                        <iframe class="iframeibadah" style="max-width: 100%;width: 100%;" height="315" src="{{$i['link_youtube']}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div>
                                     @if(!empty($i['link_page']))
                                      <div class="col-sm-12 col-md-8 offset-md-2 text-center mt-0 pt-0 container-button-ibadah">
                                        <a href="{{$i['link_page']}}" class="btn btn-primary" target="_blank"><span>sumber</span></a>
                                      </div>
                                     @endif
                                  </div>
                                @endif
                            </div>
                        </div>
                    </div>
                 @endforeach
                 </div>
              </div>
            </div>
          </div>
      </section>

      <section class="container-fluid pl-0 pr-0 pt-4"  id="berita">
        <div class="row">
            <div class="col-md-12">
                <div class="w-100">
                  <div class="pl-3">
                    <h1 class="title-berita">WARTA JEMAAT</h1>
                    <h2 class="sub-title-berita">GBKP RUNGGUN TAMBUN</h2>
                  </div>
                </div>
            </div>

            <div class="col-12">
                <div class="container-fluid">
                 <div class="row">
                  @foreach($artikel as $key => $value)
                  <div class="col-md-4 col-sm-12">
                    <div class="card card-berita mb-4">
                      <div class="card-body card-body-berita py-3">
                        <div class="w-100 mb-2">
                          <a href="{{url('/').'/artikel/'.$value->url_key}}">
                            <div class="content-berita-title">{{$value->title ? $value->title : ''}}</div>
                          </a>
                        </div>
                        <div class="d-sm-inline-flex d-md-flex justify-content-sm-end justify-content-md-end  flex-sm-column float-left">
                          <div class="text-center">
                            <img width="200" src="{{$value->image_mobile ? url('/').'/public/img/artikel/'.$value->image_mobile : 'https://via.placeholder.com/300x300/000/808080'}}" class="rounded img-berita" alt="{{$value->title ? $value->title : ''}}">
                          </div>
                          <div class="pl-3 content-berita-value">
                              {{$value->short_description ? $value->short_description : '' }}
                          </div>
                        </div>
                      </div>

                      <div class="card-footer text-right pt-1 bg-white pb-1">
                        <div class="content-berita-date">{{$value->publish_at ? $value->publish_at : '' }}</div>
                        <a href="{{url('/').'/artikel/'.$value->url_key}}" class="btn btn-primary btn-sm"><span>Lanjutkan</span></a>
                      </div>
                    </div>
                  </div>
                  @endforeach
                  </div>
                   @if($artikelmore)
                    <div class="row">
                        <div class="col-md-12 w-100 text-center">
                          <a href="{{url('/').'/artikel'}}"><span class="color-secondary"><< Lihat Berita Lainnya >> </span></a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
      </section>
@endsection
  
@section('footer-js')  
<script>
  const getChart1 = async() =>{
          return await fetch("{{route('frontend-chart-total-kategorial')}}", {
            method      : 'GET',
          }).then(r => 
          r.json())
          .then(data => {
            console.log(data);
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
  });

</script>
@endsection