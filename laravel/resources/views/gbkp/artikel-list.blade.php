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
      <section id="artikel">
       <div class="container pt-5">
          @foreach($artikelList as $key => $value)
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
        </div>
      </section>
@endsection
  
@section('footer-js')  
<script>
</script>
@endsection