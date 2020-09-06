<header class="app-header navbar">
    <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="{{url('/app')}}">
      <img class="navbar-brand-full" src="{{url('public/img/logo-gbkp.png')}}" width="30" height="30" alt="Logo GBKP">
      <img class="navbar-brand-minimized" src="{{url('public/img/logo-gbkp.png')}}" width="30" height="30" alt="Logo GBKP">
    </a>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
      <span class="navbar-toggler-icon"></span>
    </button>
    <ul class="nav navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
          <img class="img-avatar" src="{{url('/public/img/avatar/default.png')}}" alt="admin">
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          <div class="dropdown-header text-center">
            <strong>Account</strong>
          </div>
          <a href="#" class="dropdown-item" id="btn-logout">
            <i class="fa fa-lock"></i> Logout</a>
        </div>
      </li>
    </ul>
    </button>
    </button>
  </header>