@extends('gbkp.template')

@section('header-css')
<link rel="stylesheet" href="{{url('public/gbkp/landing.css?v=').date('s')}}" />
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
       <div class="container">
          <div class="row">
            <div class="col-md-10 offset-md-1 col-sm-12 pt-4 container-title-artikel text-center">
              <h1 class="title-artikel color-secondary-2">{{$artikel["title"]}}</h1>
            </div>
            <div class="col-md-8 offset-md-2 col-sm-12 pt-2 container-img-artikel">
              <img class="img-artikel d-none d-sm-block w-100 banner" src="{{ $artikel['image_desktop'] ? url('/').'/public/img/artikel/'.$artikel['image_desktop'] : '' }}" alt="{{$artikel['title']}}">
              <img class="img-artikel d-block d-sm-none w-100" src="{{ $artikel['image_mobile'] ? url('/').'/public/img/artikel/'.$artikel['image_mobile'] : '' }}" alt="{{$artikel['title']}}">
            </div>
            <div class="col-10 offset-1 pl-0 pr-0">
                {!! $artikel["content"] !!}
            </div>
          </div>
        </div>
      </section>
@endsection
  
@section('footer-js')  
<script>
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