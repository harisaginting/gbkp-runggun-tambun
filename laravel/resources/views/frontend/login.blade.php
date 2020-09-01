@extends('frontend.layout')

@section('header-css')
<link rel="stylesheet" href="{{url('/')}}/landing/main.css" />
<link rel="stylesheet" href="{{url('/')}}/landing/login.css" />
@endsection

@section('header-js')
@endsection

@section('content')
    <!-- Page Wrapper -->
      <div id="page-wrapper">

              <section id="login" class="wrapper alt spotlight style2">
                <div class="inner">
                  <div class="content">
                    <label class="content-header text-center">Login</label>
                    <form class="row" action="{{url('/')}}/member/login-process" method="POST">
                      @if(Session::has('activation'))
                        <div class="offset-md-3 col-md-6 col-sm-12 text-left">
                          <div class="alert alert-success alert-block" style="font-weight:100">
                            Selamat kamu telah berhasil mengaktifkan akun kamu, silahkan login
                          </div>
                        </div>
                        @endif

                        @if(Session::has('alert'))
                          <div class="offset-md-3 col-md-6 col-sm-12 text-left">
                            <div class="alert alert-{{ Session::get('alert') == 'success' ? 'success' :  'warning' }} alert-block" style="font-weight:100">
                              {{Session::get('notification')}}
                            </div>
                          </div>
                        @endif
                      @csrf
                      <div class="col-md-6 offset-md-3 col-sm-12">
                        <label class="text-left" for="email">email</label>
                        <input class="form-control" type="email" name="email" id="email" required />
                      </div>
                      <div class="col-md-6 offset-md-3 col-sm-12 mt-4">
                        <label class="text-left" for="password">password</label>
                        <input class="form-control" type="password" name="password" id="password" required />
                      </div>
                      <div class="mt-2 col-md-6 offset-md-3 col-sm-12">
                        <a href="{{url('/')}}/register" style="color: #d4ab00;">DAFTAR</a> / 
                        <a href="{{url('/')}}/member/forgot-password" class="pull-right">RESET PASSWORD</a>
                      </div>
                    <div class="col-12 text-center mt-3">
                      <button class="btn btn-primary btn-sm btn-submit-login">&nbsp;&nbsp;Login&nbsp;&nbsp;</button>
                    </div>
                    </form>
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