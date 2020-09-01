@extends('template.master')

@section('assets')
<!-- Datatable -->
<link href="{{url('public/assets/plugin/datatables/datatablesBootsrap.min.css')}}" rel="stylesheet">
<script src="{{url('public/assets/plugin/datatables/datatables.js')}}"></script>
<script src="{{url('public/assets/plugin/datatables/dataTables.bootstrap4.min.js')}}"></script>

<link href="{{url('public/assets/plugin/summernote/summernote-bs4.css')}}" rel="stylesheet">
<script src="{{url('public/assets/plugin/summernote/summernote-bs4.js')}}"></script>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
                <div class="card">
                        <div class="card-body">
                            <form  mthod="POST" class="row" id="form-email" method="post" action="{{url('/')}}/application/email/send-broadcast">
                                <div class="col-sm-4">
                                    <h4 class="card-title mb-0">Broadcast Email</h4>
                                    <div class="small text-muted">GBKP Runggun Tambun</div>
                                </div>
                                
                                <div class="col-sm-12 form-group mt-4">
                                    <label><strong>Subject</strong></label>
                                    <input type="text" name="subject" id="subject" class="form-control">
                                </div>

                                <div class="col-sm-12">
                                    <div id="summernote"></div>
                                </div>
                                @csrf
                                <input type="hidden" name="emailBody" id="emailBody">
                            </form>
                            <div class="row">
                                <div class="col-md-3 col-sm-12 offset-md-9">
                                    <button type="button" class="btn btn-success btn-sm pull-right" id="btn-send-email">Sebarkan Email</button>
                                </div>
                            </div>
                        </div>            
                    </div>
        </div>
    </div>
@endsection


@section('footcode')
<script type="text/javascript">    
  var Page = function () {

    var wywsigInit = function(){                     
        $('#summernote').summernote({
            height : 300,
            maxHeight : 300
        });
    };  

      return {
          init: function() { 
            wywsigInit();
            $(document).on('click','#btn-send-email', function (e) {
                let emailBody = $('#summernote').summernote('code');
                $("#emailBody").val(emailBody);
                console.log($("#emailBody").val());
                $("#form-email").submit();
            });
           }
      };

  }();

  jQuery(document).ready(function() {
      Page.init();
  });  
</script>
<style type="text/css">
    .table>tbody>tr>td {cursor: pointer;}
</style>
@endsection