    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="Permata Tambun">
    <meta name="author" content="Harisa Ginting">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title>GBKP Runggun Tambun</title>
    <!-- Icons-->
    <link href="{{url('public/assets/template/coreui')}}/node_modules/@coreui/icons/css/coreui-icons.min.css" rel="stylesheet">
    <link href="{{url('public/assets/template/coreui')}}/node_modules/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">
    <link href="{{url('public/assets/template/coreui')}}/node_modules/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{url('public/assets/template/coreui')}}/node_modules/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">


    <!-- fonts -->
    <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Montserrat%3A400%2C600&#038;ver=0.1.19' type='text/css' media='all' />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;900&display=swap" type='text/css'  rel="stylesheet">


    <link href="{{url('public/assets/plugin/datepicker/css/bootstrap-datepicker3.css')}}" rel="stylesheet">

    <!-- Moment -->
     <script src="{{url('public/assets/plugin/moment/min/moment.min.js')}}"  type="text/javascript"></script>

     <!-- Select 2-->
    <link rel="stylesheet" type="text/css" href="{{url('public/assets/plugin/select2/css/select2.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('public/assets/plugin/select2/css/select2-bootstrap.css')}}">


    <!-- Main styles for this application-->
    <link href="{{url('public/assets/template/coreui')}}/src/css/style.css" rel="stylesheet">
    <link href="{{url('public/assets/template/coreui')}}/src/vendors/pace-progress/css/pace.min.css" rel="stylesheet">

    {{-- Custom CSS --}}
    <link href="{{url('public/backend/')}}/backend.css?{{date('s')}}" rel="stylesheet">

    <!-- CoreUI and necessary plugins-->
    <script src="{{url('public/assets/template/coreui')}}/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="{{url('public/assets/template/coreui')}}/node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="{{url('public/assets/template/coreui')}}/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="{{url('public/assets/template/coreui')}}/node_modules/pace-progress/pace.min.js"></script>
    <script src="{{url('public/assets/template/coreui')}}/node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
    <script src="{{url('public/assets/template/coreui')}}/node_modules/@coreui/coreui/dist/js/coreui.min.js"></script>
    <script src="{{url('public/assets/plugin/datepicker/js/bootstrap-datepicker.min.js')}}"></script>


    <!-- Plugins and scripts required by this view-->
    {{-- <script src="{{url('public/assets/template/coreui')}}/node_modules/chart.js/dist/Chart.min.js"></script> --}}
    <script src="{{url('public/assets/template/coreui')}}/node_modules/@coreui/coreui-plugin-chartjs-custom-tooltips/dist/js/custom-tooltips.min.js"></script>
    {{-- <script src="{{url('public/assets/template/coreui')}}/src/js/main.js"></script> --}}


    <script src="{{url('public/assets/plugin/select2/js/select2.full.min.js')}}"></script>
    <script src="{{url('public/assets/plugin/jquery.priceformat.js')}}"></script>


    <!-- Jquery Validation -->
    <script src="{{url('public/assets/plugin/jquery-validation/dist/jquery.validate.min.js')}}" type="text/javascript" charset="utf-8"></script>
    <script src="{{url('public/assets/plugin/jquery-validation/dist/additional-methods.min.js')}}" type="text/javascript" charset="utf-8"></script>
    <script src="{{url('public/assets/plugin/bootbox.min.js')}}" type="text/javascript" charset="utf-8"></script>
    

    <script src="{{url('public/backend/main.js')}}" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
        const base_url          = "{{url('/')}}";
        const customer_token    = localStorage.getItem('_token');
        const global            = $(document);
    </script>