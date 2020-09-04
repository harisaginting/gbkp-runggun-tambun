<div class="sidebar">
        <nav class="sidebar-nav">
          <ul class="nav">
            <li class="nav-item">
              <a class="nav-link" href="{{route('app-dashboard')}}">
                <i class="nav-icon icon-speedometer"></i> Dashboard
              </a>
            </li>

            <li class="nav-item nav-dropdown {{Request::segment(1) == 'anggota' || Request::segment(1) == 'keluarga' ? 'open' : ''}}">
              <a class="nav-link nav-dropdown-toggle {{Request::segment(1) == 'anggota' || Request::segment(1) == 'keluarga' ? 'active' : ''}}" href="#">
              <i class="nav-icon fa fa-user-circle-o"></i> Anggota</a>
              <ul class="nav-dropdown-items">
                <li class="nav-item">
                  <a class="nav-link {{ Request::segment(1) == 'anggota'? 'active' : ''}}" href="{{url('/')}}/anggota">
                  <i class="nav-icon fa fa-user"></i> Perorangan</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ Request::segment(1) == 'keluarga'? 'active' : ''}}" href="{{url('/')}}/keluarga">
                  <i class="nav-icon fa fa-group"></i> Tata Keluarga
                  </a>
                </li>
              </ul>
            </li>

            
            <li class="nav-item nav-dropdown {{Request::segment(1) == 'ibadah' ? 'open' : ''}}">
              <a class="nav-link nav-dropdown-toggle {{Request::segment(1) == 'ibadah' ? 'active' : ''}}" href="#">
              <i class="nav-icon fa fa-heart-o"></i> Ibadah <span class="badge badge-warning">dev.</span></a>
              <ul class="nav-dropdown-items">
                <li class="nav-item">
                  <a class="nav-link {{ Request::segment(1) == 'ibadah' && Request::segment(2) == 'umum'? 'active' : ''}}" href="{{url('/')}}/ibadah/umum">
                  <i class="nav-icon fa fa-star"></i> Umum</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ Request::segment(1) == 'ibadah' && Request::segment(2) == 'pa'? 'active' : ''}}" href="#">
                  <i class="nav-icon fa fa-star"></i> P.J.J
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ Request::segment(1) == 'ibadah' && Request::segment(2) == 'pa'? 'active' : ''}}" href="#">
                  <i class="nav-icon fa fa-star"></i> P.A
                  </a>
                </li>
              </ul>
            </li>

            <li class="nav-item">
              <a class="nav-link {{Request::segment(1) == 'artikel' ? 'active' : ''}}" href="{{url('/')}}/artikel">
                <i class="nav-icon fa fa-file"></i> Artikel
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link {{Request::segment(1) == 'serayaan' ? 'active' : ''}}" href="{{url('/')}}/serayaan">
                <i class="nav-icon icon-star"></i> Serayaan</a>
            </li>
            <!--
            <li class="nav-item">
              <a class="nav-link {{Request::segment(2) == 'acara' ? 'active' : ''}}" href="{{url('/')}}/application/acara">
                <i class="nav-icon icon-people"></i> Acara
                <span class="badge badge-warning">dev.</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{url('/')}}/application/pa"> 
                <i class="nav-icon icon-puzzle"></i> Pen. Alkitab</a>
            </li>

            <li class="nav-item nav-dropdown">
              <a class="nav-link nav-dropdown-toggle" href="#">
              <i class="nav-icon fa fa-file"></i> Laporan</a>
              <ul class="nav-dropdown-items">
                <li class="nav-item">
                  <a class="nav-link" href="{{url('/')}}/application/laporan/iuran kas">
                  <i class="nav-icon icon-list"></i> Keuangan</a>
                  <span class="badge badge-warning">dev.</span> 
                </li>
              </ul>
            </li>
 -->
            <!-- <li class="nav-item">
              <a class="nav-link" href="{{url('/')}}/application/email"> 
                <i class="nav-icon fa fa-envelope"></i> Email</a>
            </li> -->

            <li class="nav-title">Admin</li>
            <li class="nav-item">
              <a class="nav-link {{Request::segment(1) == 'jabatan' ? 'active' : ''}}" href="{{url('/')}}/jabatan">
                <i class="nav-icon icon-star"></i> Jabatan</a>
            </li>
            <li class="nav-item nav-dropdown">
              <a class="nav-link nav-dropdown-toggle {{Request::segment(1) == 'konfigurasi' ? 'active' : ''}}" href="#">
              <i class="nav-icon fa fa-cog"></i> Konfigurasi</a>
              <ul class="nav-dropdown-items">
                <li class="nav-item">
                  <a class="nav-link {{Request::segment(1) == 'konfigurasi' && empty(Request::segment(2)) ? 'active' : ''}}" href="{{route('app-config')}}">
                  <i class="nav-icon fa fa-circle"></i> Umum</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{Request::segment(1) == 'konfigurasi' && Request::segment(2) == 'lokasi' ? 'active' : ''}}" href="{{route('app-config-location')}}/lokasi">
                  <i class="nav-icon fa fa-map-marker"></i> Lokasi
                  </a>
                </li>
              </ul>
            </li> 
          </ul>
        </nav>
        <button class="sidebar-minimizer brand-minimizer" type="button"></button>
      </div>