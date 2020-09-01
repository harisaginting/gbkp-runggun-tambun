@extends('frontend.layout')

@section('header-css')
<link rel="stylesheet" href="{{url('/')}}/landing/main.css" />
<link rel="stylesheet" href="{{url('/')}}/landing/article.css" />
@endsection

@section('header-js')
@endsection

@section('content')
    <!-- Page Wrapper -->
      <div id="page-wrapper">

              <section id="artikel" class="wrapper alt spotlight style2 mt-0">
                <div class="inner">
                  <div class="content">
                    <label class="content-header text-center">Artikel</label>
                    <div class="row">
                      <div class="card col-sm-12 col-md-6">
                        <div class="card-header">
                          
                        </div>
                        <div class="card-body">
                          
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </section>

      </div>

    <!-- Scripts -->

@endsection
  
@section('footer-js')  
<script src="{{url('/')}}/assets/template/solid-state/assets/js/main.js"></script>
<script type="text/javascript">
</script>
@endsection