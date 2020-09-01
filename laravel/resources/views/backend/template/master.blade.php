<!DOCTYPE html>
<html>
  <head> 
    @include('backend.template.assets')
    @yield('assets')
  </head>
  <body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
    @include('backend.template.header')
    <div id="loader" class="hidden">
      <svg viewBox="0 0 100 100">
        <defs>
          <filter id="loadershadow">
            <feDropShadow dx="0" dy="0" stdDeviation="1.5" 
              flood-color="#0E1655"/>
          </filter>
        </defs>
        <circle id="spinner" style="fill:transparent;stroke:#122054;stroke-width: 7px;stroke-linecap: round;filter:url(#loadershadow);" cx="50" cy="50" r="45"/>
    </svg>
    </div>
    <div class="app-body">
        @include('backend.template.sidebar')      
          <main class="main">
              <div class="container-fluid pl-2 pr-2">
                @include('backend.template.pesan')
                @yield('content')
              </div>
          </main>
    </div>
        @include('backend.template.footer')
        <script type="text/javascript">
          if (localStorage.getItem('_token') === "" || localStorage.getItem('_token') === null) {
            window.location.href = "{{url('/login')}}";
          }
        </script>
  </body>
</html>

@yield('footcode')