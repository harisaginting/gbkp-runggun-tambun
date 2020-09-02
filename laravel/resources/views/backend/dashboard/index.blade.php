@extends('backend.template.master')
@section('assets')
	<!-- Highcharts -->
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

	<style type="text/css">
		.label-anggota{
			font-size: 1.2em;
			font-weight: 800;
		}

		.label-anggota-count{
			font-size:3em;
			font-weight: 800;
			line-height: 1em;
		}

		.label-anggota-count-2{
			font-size:2em;
			font-weight: 800;
			line-height: 1em;
		}

		.label-sub-anggota{
			font-size: 0.8em;
    		font-weight: 700;
		}
		.label-sub-anggota-count{
			font-size: 2.4em;
			font-weight: 700;
			line-height: 0.7em;
		}
	</style>
@endsection

@section('content')
	<div class="row">
		<div class="col-md-3">
			<div class="row">
				<div class="col-md-12 px-1">
					<div class="card card-body p-1 mb-1" style="background-color: #0000;border:0px;">
						<div><strong class="label-anggota">TOTAL ANGGOTA</strong></div>
						<div class="mt-0">
							<span class="label-anggota-count">{{$totalAnggota['all']}}</span> <small>Orang&nbsp;&nbsp;</small> 
							<span class="label-anggota-count-2">/ {{$totalKeluarga}}</span> <small>Keluarga</small> 
						</div>
					</div>
				</div>
				<div class="col-md-12 px-1">
					<div class="card card-body p-1 mb-1" style="background-color: #242765;color:#fff;">
						<div><strong class="label-anggota">SAITUN</strong></div>
						<div class="mt-2"><span class="label-anggota-count">{{$totalAnggota['saitun']}}</span> <small>Orang</small> </div>
					</div>
				</div>
				<div class="col-md-12 px-1">
					<div class="card card-body p-1 mb-1" style="background-color: #e67635;color:#fff;">
						<div><strong class="label-anggota">MAMRE</strong></div>
						<div class="mt-2"><span class="label-anggota-count">{{$totalAnggota['mamre']}}</span> <small>Orang</small> </div>
					</div>
				</div>
				<div class="col-md-12 px-1">
					<div class="card card-body p-1 mb-1" style="background-color: #147ae2;color:#fff;">
						<div><strong class="label-anggota">MORIA</strong></div>
						<div class="mt-2"><span class="label-anggota-count">{{$totalAnggota['moria']}}</span> <small>Orang</small> </div>
					</div>
				</div>
				<div class="col-md-6 px-1">
					<div class="card card-body p-1 mb-1" style="background-color: #353f87;color:#fff;">
						<div><strong class="label-anggota">PERMATA</strong></div>
						<div class="mt-2"><span class="label-anggota-count">{{$totalAnggota['permata']}}</span> <small>Orang</small> </div>
					</div>
				</div>
				<div class="col-md-6 px-1">
					<div class="card card-body p-1 mb-1" style="background-color: #fbcc37;color:#000;">
						<div><strong class="label-anggota">KA/KR</strong></div>
						<div class="mt-2"><span class="label-anggota-count">{{$totalAnggota['kakr']}}</span> <small>Orang</small> </div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-9">
			<div id="anggota-sektor-kategorial"></div>
		</div>
	</div>
	<div class="row">
		<div id='calendar1' class='calendar col-md-8'></div>
  		<div id='calendar2' class='calendar col-md-4'></div>
	</div>
    
@endsection


@section('footcode')
<script type="text/javascript">
	var Page = function () {
	getChart1 = async() =>{
          return await fetch("{{route('app-dashboard-chart-total-kategorial')}}", {
            method      : 'POST', // *GET, POST, PUT, DELETE, etc.
            mode        : 'cors', 
            headers: {
              'Content-Type': 'application/json',
              'Authorization': 'Bearer '+customer_token,
            },
            referrerPolicy: 'no-referrer'
          }).then(r => 
          r.json())
          .then(data => {
            return data;
          })
            .catch(error => {
              console.error('Error:', error);
          });
	}	
    startChart1 = async(data) =>{
    	for (var i =  0; i < data.chart.length; i++) {
    		switch(data.chart[i]["name"]) {
			 case "SAITUN":
			    data.chart[i]["color"] = "#242765";
			 	break;
			 case "MAMRE":
			    data.chart[i]["color"] = "#e67635";
			 	break;
			 case "MORIA":
			    data.chart[i]["color"] = "#147ae2";
			 	break;
			 case "PERMATA":
			    data.chart[i]["color"] = "#353f87";
			    break;
			  case "KA/KR":
			    data.chart[i]["color"] = "#fbcc37";
			    break;
			  default:
			    data.chart[i]["color"] = "#e67635";
			}

    		console.log(data.chart[i]["name"]);
    	}
        Highcharts.chart('anggota-sektor-kategorial', {
			    chart: {
			        type: 'column',
			        backgroundColor: '#ffffff92',
			        borderRadius: '10px',
			    },
			    subtitle: {
			        text: ''
			    },
			    credits: { text: 'gbkprungguntambun', href : 'https://gbkprungguntambun.org'},
			    title: {
			        text: 'Total Jemaat per-Sektor'
			    },
			    xAxis: {
			        categories: data.list_sektor
			    },
			    yAxis: {
			        min: 0,
			        title: {
			            text: 'Jemaat'
			        },
			        stackLabels: {
			            enabled: true,
			            style: {
			                fontWeight: 'bold',
			                color: ( // theme
			                    Highcharts.defaultOptions.title.style &&
			                    Highcharts.defaultOptions.title.style.color
			                ) || 'gray'
			            }
			        }
			    },
			    legend: {
			        align: 'right',
			        x: -30,
			        verticalAlign: 'top',
			        y: 25,
			        floating: true,
			        backgroundColor: '#ffffff92',
			        borderColor: '#CCC',
			        borderWidth: 1,
			        shadow: false
			    },
			    tooltip: {
			        headerFormat: '<b>{point.x}</b><br/>',
			        pointFormat: '{series.name}: {point.y}<br/>Total: {point.stackTotal}'
			    },
			    plotOptions: {
			        column: {
			            stacking: 'normal',
			            dataLabels: {
			                enabled: true
			            }
			        }
			    },
			    series: data.chart
		});
    }
 

      return {
          init: function() { 
            getChart1().then((data)=>{
                    $("#loader").addClass("hidden");
                    if(data.status == 200){
                       startChart1(data.data);           
                    }else{
                        alert("terjadi kesalahan");
                    }
                });
          }
   	};

  }();

  jQuery(document).ready(function() {
      Page.init();
  });  


	
</script>
@endsection 