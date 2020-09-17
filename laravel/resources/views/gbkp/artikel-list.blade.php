@extends('gbkp.template')

@section('header-css')
<style type="text/css">
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
    .title-artikel{
      font-size: 1.2em !important;
    }
  }
</style>
@endsection


@section('header-js')
@endsection

@section('content')
      <section class="container-fluid" id="artikel">
       <div class="row pt-5">
          <div class="col-12">
            <div class="container-fluid">
             <div class="row">
              @foreach($artikelList as $key => $value)
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
            </div>
        </div>
        </div>
      </section>
@endsection
  
@section('footer-js')  
<script>
</script>
@endsection