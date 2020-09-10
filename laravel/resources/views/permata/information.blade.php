@extends('permata.template')

@section('header-css')
<link rel="stylesheet" href="{{url('public/landing/main.css?v=permatagbkp')}}" />
<link rel="stylesheet" href="{{url('/')}}/public/landing/information.css?v=askdjfhjdk" />

<style type="text/css">
  .bg-dalam-bekasi{
    background: #3d6ae8;
  }

  .bg-luar-bekasi{
    background: #454886;
  }
</style>
@endsection

@section('header-js')
<script src="{{url('public/assets/plugin/highchart/code/highcharts.js')}}"></script>
<script src="{{url('public/assets/plugin/highchart/code/modules/drilldown.js')}}"></script>
<script src="{{url('public/assets/plugin/highchart/code/modules/exporting.js')}}"></script>
<script src="{{url('public/assets/plugin/highchart/code/grouped-categories.js')}}"></script>
<script src="{{url('public/assets/plugin/highchart/code/highcharts-more.js')}}"></script>
<script src="{{url('public/assets/plugin/highchart/code/highcharts-3d.js')}}"></script>
<script src="{{url('public/assets/plugin/highchart/code/lib/canvg.js')}}"></script>
<script src="{{url('public/assets/plugin/highchart/code/lib/jspdf.js')}}"></script>
<script src="{{url('public/assets/plugin/highchart/code/lib/rgbcolor.js')}}"></script>

<!-- FullCalendar -->
<link href="{{url('public/assets/plugin/fullCalendar/packages/core/main.css')}}" rel='stylesheet' />
<link href="{{url('public/assets/plugin/fullCalendar/packages/daygrid/main.css')}}" rel='stylesheet' />
<link href="{{url('public/assets/plugin/fullCalendar/packages/timegrid/main.css')}}" rel='stylesheet' />
<link href="{{url('public/assets/plugin/fullCalendar/packages/list/main.css')}}" rel='stylesheet' />

<script src="{{url('public/assets/plugin/fullCalendar/packages/core/main.js')}}"></script>
<script src="{{url('public/assets/plugin/fullCalendar/packages/daygrid/main.js')}}"></script>
<script src="{{url('public/assets/plugin/fullCalendar/packages/timegrid/main.js')}}"></script>
<script src="{{url('public/assets/plugin/fullCalendar/packages/list/main.js')}}"></script>
@endsection

@section('content')
    <!-- Page Wrapper -->
      <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">

                  <div class="col-md-3 col-sm-12">
                    <div class="text-center w-100"><img src="{{url('/')}}/public/img/logo-permata.png" alt="logo permata gbkp" class="logo-permata"></div>
                    <div class="row mb-1">
                      <div class="card col-md-12 mb-1 bg-primary">
                        <div class="card-body p-1">
                          <div><strong class="label-anggota">TOTAL ANGGOTA</strong></div>
                          <div><span class="label-anggota-count"><?= $totalAnggota["all"] ?></span> <small>Orang</small> </div>
                        </div>
                      </div>

                      <div class="card col-md-6 col-sm-12 bg-dalam-bekasi pl-0 pr-0 mb-1 text-center">
                        <div class="card-body p-1">
                          <div class="text-left"><strong class="label-sub-anggota">Domisili Bekasi</strong></div>
                          <div><span class="label-sub-anggota-count"><?= $totalDalamBekasi ?></span></div>
                        </div>
                      </div>

                      <div class="card col-md-6 col-sm-12 bg-luar-bekasi pl-0 pr-0 mb-1 text-center">
                        <div class="card-body p-1">
                          <div class="text-left"><strong class="label-sub-anggota">Domisili Diluar Bekasi</strong></div>
                          <div><span class="label-sub-anggota-count"><?= $totalLuarBekasi ?></span></div>
                        </div>
                      </div>

                      <div class="card bg-success col-md-4 pl-0 pr-0 text-center">
                        <div class="card-body p-1">
                          <div class="text-left"><strong class="label-sub-anggota">AKTIF</strong></div>
                          <div><span class="label-sub-anggota-count"><?= $totalAnggota["aktif"] ?></span></div>
                        </div>
                      </div>

                      <div class="card col-md-4 bg-warning pl-0 pr-0 text-center">
                        <div class="card-body p-1">
                          <div class="text-left"><strong class="label-sub-anggota">PASIF</strong></div>
                          <div><span class="label-sub-anggota-count"><?= $totalAnggota["pasif"] ?></span></div>
                        </div>
                      </div>

                      <div class="card col-md-4 bg-danger pl-0 pr-0 text-center">
                        <div class="card-body p-1">
                          <div class="text-left"><strong class="label-sub-anggota">TERDAFTAR</strong></div>
                          <div><span class="label-sub-anggota-count"><?= $totalAnggota["terdaftar"] ?></span></div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-9 col-sm-12 container-chart-anggota pt-4">
                    <div id="chart-anggota"></div>
                  </div>
                
                </div>


                <!-- Anggota -->
                <div class="row mt-3">
                 <h2 style="margin-bottom: 0em;">ANGGOTA</h2>:
                 @foreach ($sektor as $vSektor)
                 <div class="col-12">
                   <h4>SEKTOR {{$vSektor}}</h4>
                   <div class="row anggota-sektor">
                     @foreach ($anggotaBySektor[$vSektor] as $vAnggota)
                     <?php if($vAnggota->email != 'mvikral@gmail.com') :  ?>
                     <div class="container-person <?= $vAnggota->status == 'AKTIF' ? 'bg-success':''; ?> <?= $vAnggota->status == 'TIDAK AKTIF' || $vAnggota->status == 'PASIF' ? 'bg-warning':''; ?> <?= $vAnggota->status == 'TERDAFTAR' ? 'bg-danger':''; ?>">
                        <div class="w-100 text-right pb-0 mb-0 info-location">
                        <?php if(!empty($vAnggota->kota)) :  ?>  
                        <i class="fa fa-location-arrow"></i>&nbsp;&nbsp;{{ $vAnggota->kota ?? '-'}}
                        <?php  else: ?>
                          &nbsp;
                        <?php  endif; ?>
                        </div>
                        <img src="<?= !empty($vAnggota->avatar) ? url('/').'/public/img/avatar/'.$vAnggota->avatar : url('/').'/public/img//logo-permata.png' ?>" alt="PERMATA GBKP {{$vAnggota->nama_depan}}"  class="avatar">

                        <div class="person-name">{{$vAnggota->nama_depan .' '.$vAnggota->nama_belakang }}</div>
                     </div>
                     <?php endif; ?>
                     @endforeach
                   </div>
                 </div>
                 @endforeach

                  <label style="color: yellow;font-size: 0.8em;text-transform: inherit;letter-spacing: inherit;">*bila menemukan ketidaksesuaian data harap segera melaporkan ke Pengurus PERMATA GBKP RUNGGUN TAMBUN </label>
                </div>

            </div>
      </div>

    <!-- Scripts -->

@endsection
  
@section('footer-js')  
<script src="{{url('/')}}/public/assets/template/solid-state/assets/js/main.js"></script>
<script type="text/javascript">
var Page = (() => {
  const chartAnggota = () => {
    let colors = <?= json_encode($chartAnggota["color"]); ?>,
    categories = <?= json_encode($sektor); ?>,
    data = <?= json_encode($chartAnggota["chart"]); ?>
    ,
    sektorData = [],
    sektorStatusData = [],
    i,
    j,
    dataLen = data.length,
    drillDataLen,
    brightness;

    // Build the data arrays
    for (i = 0; i < dataLen; i += 1) {

        // add browser data
        sektorData.push({
            name: categories[i],
            y: data[i].y,
            color: data[i].color
        });

        // add version data
        drillDataLen = data[i].drilldown.data.length;
        for (j = 0; j < drillDataLen; j += 1) {
            brightness = 0.2 - (j / drillDataLen) / 5;
            sektorStatusData.push({
                name: data[i].drilldown.categories[j],
                y: data[i].drilldown.data[j],
                color: data[i].drilldown.color[j]
            });
        }
    }

    // Chart Pekerjaan
    Highcharts.chart('chart-anggota', {
          chart: {
              type: 'pie',
              backgroundColor: '#eee',
              borderRadius: '10px',
          },
          exporting: { enabled: false },
          title: {
              text: '<strong>Anggota per-sektor</strong>'
          },
          subtitle: {
              text: ''
          },
          credits: { text: ''},
          plotOptions: {
              pie: {
                  shadow: false,
                  center: ['50%', '50%']
              }
          },
          tooltip: {
              valueSuffix: ' orang'
          },
          series: [{
              name: 'Sektor',
              data: sektorData,
              size: '90%',
              dataLabels: {
                  formatter: function () {
                      return this.point.name +", <div class='label-chart-anggota'>"+this.y+' orang</div>';
                  },
                  color: '#ffffff',
                  distance: -70
              }
          }, 
          {
              name: 'Status',
              data: sektorStatusData,
              size: '100%',
              innerSize: '90%',
              dataLabels: {
                  formatter: function () {
                      // display only if larger than 1
                      return this.y > 1 ? '<b>' + this.point.name + ':</b> ' +
                          this.y + ' orang' : null;
                  },
                  distance: 10
              },
              id: 'versions'
          }],
          responsive: {
              rules: [{
                  condition: {
                      maxWidth: 400
                  },
                  chartOptions: {
                      series: [{
                      }, {
                          id: 'versions',
                          dataLabels: {
                              enabled: false
                          }
                      }]
                  }
              }]
          }
    });
  }     
     

    return {
      init: () => {
          chartAnggota();
       }
  };
})();

global.ready(()=> {
    Page.init();
});  
</script>
@endsection