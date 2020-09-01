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
				<div class="card col-md-12 mb-1 bg-primary">
					<div class="card-body p-1">
						<div><strong class="label-anggota">TOTAL ANGGOTA</strong></div>
						<div><span class="label-anggota-count">10</span> <small>Orang</small> </div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-9">
			<div id="chart-anggota"></div>
		</div>
	</div>
	<div class="row">
		<div id='calendar1' class='calendar col-md-8'></div>
  		<div id='calendar2' class='calendar col-md-4'></div>
	</div>
    
@endsection


@section('footcode')
<script type="text/javascript">

</script>
@endsection 