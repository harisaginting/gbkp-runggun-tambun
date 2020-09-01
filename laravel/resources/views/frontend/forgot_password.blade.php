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
                    <label class="content-header text-center">Reset Password</label>
                    <form class="row" id="form-forgot-password" action="{{url('/')}}/member/forgot-password" method="POST">
                      @csrf
                        @if(Session::has('status'))
                          <div class="offset-md-3 col-md-6 col-sm-12 text-left">
                            <div class="alert alert-{{ Session::get('status') == 'success' ? 'success' :  'warning' }} alert-block" style="font-weight:100">
                              @switch(Session::get('status'))
                                    @case('success')
                                        <p>
                                          hi {{Session::get('name')}}, silahkan periksa email kamu ({{Session::get('email')}}) untuk me-reset password akun ini
                                        </p>
                                        @break
                                    @case('error')
                                        <p>
                                          hi {{Session::get('name')}}, mohon maaf terjadi gangguan saat kami mencoba mengirim email ke ({{Session::get('email')}}), silahkan coba beberapa saat lagi
                                        </p> 
                                        @break
                                    @case('not-found')
                                        <p>
                                          email {{Session::get('email')}} belum terdaftar sebagai anggota permata tambun silahkan <a href="{{url('/')}}/register">mendaftar</a> terlebih dahulu
                                        </p> 
                                        @break
                                    @default
                                @endswitch

                            </div>
                          </div>
                        @endif
                        <div class="col-md-6 offset-md-3 col-sm-12">
                          <label class="text-left" for="email">email</label>
                          <input class="form-control" type="email" name="email" id="email" required/>
                        </div>
                      
                        <div class="col-12 text-center mt-3">
                          <button class="btn btn-primary btn-sm btn-submit-login">Verifikasi</button>
                        </div>
                    </form>
                  </div>
                </div>
              </section>

      </div>

    <!-- Scripts -->

@endsection
  
@section('footer-js')  
<script src="{{url('/')}}/template/solid-state/assets/js/main.js"></script>
<script type="text/javascript">
</script>
@endsection