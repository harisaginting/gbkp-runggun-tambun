@extends('gbkp.template')

@section('header-css')
<style type="text/css">
  .title-artikel{
    font-size: 2em !important;
    font-family: Montserrat;
    font-weight: 600;
  }

  .container-img-artikel{
    margin-bottom: 1em; 
  }

  .img-artikel{
    width: 100%;
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
              <div class="col-md-6 col-sm-12">
                <div class="card card-berita mb-4">
                  <div class="card-body card-body-berita py-1">
                    <div class="w-100 mb-2">
                      <div class="content-berita-date">{{$value->publish_at ? $value->publish_at : '' }}</div>
                      <a href="{{url('/').'/artikel/'.$value->url_key}}">
                        <div class="content-berita-title">{{$value->title ? $value->title : ''}}</div>
                      </a>
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

                  <div class="card-footer text-right pt-1 bg-white pb-1">
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