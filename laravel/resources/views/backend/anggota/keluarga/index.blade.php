@extends('backend.template.master')

@section('assets')
<!-- Datatable -->
<link href="{{url('public/assets/plugin/datatables/datatablesBootsrap.min.css')}}" rel="stylesheet">
<script src="{{url('public/assets/plugin/datatables/datatables.js')}}"></script>
<script src="{{url('public/assets/plugin/datatables/dataTables.bootstrap4.min.js')}}"></script>
<style type="text/css">
    #data-anggota_wrapper{
        padding: 0px 10px 0px 10px;
    }

    .select2-container--default .select2-selection--single {
        background-color: #fff;
        border: 1px solid #e4e7ea;
        border-radius: 4px;
    }
</style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
                <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <h4 class="card-title mb-0">Daftar Keluarga</h4>
                                    <div class="small text-muted">GBKP Runggun Tambun</div>
                                </div>
            
                                <div class="col-sm-8" style="margin-bottom: 15px;">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-6 offset-md-9">
                                                <div class="form-group">
                                                        <label for="sektor">Sektor</label>
                                                        <select id="sektor" class="form-control filter_data_anggota">
                                                        </select>
                                                    </div>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="col-sm-12 pl-0 pr-0">
                                    <table id="data-anggota" class="table table-responsive-sm table-bordered table-striped table-md" style="width: 100%;">
                                        <thead>
                                            <th style="width:70%">Keluarga</th>
                                            <th style="width:20%">Total Anggota</th>
                                            <th style="width:10%"></th>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
            
            
                        </div>
                
            
                        <div class="card-footer">
                                <a href="{{url('/keluarga/add')}}" class="btn btn-brand btn-success float-right" type="button" style="margin-bottom: 4px">
                                    <i class="fa fa-plus"></i>
                                    <span>Tambah Keluarga</span>
                                </a>
                        </div>
            
                    </div>
        </div>
    </div>
@endsection


@section('footcode')
<script type="text/javascript">    
  var Page = function () {

    var tableInit = function(){                     
        var table = $('#data-anggota').DataTable({
                    language: {
                        searchPlaceholder: "Cari"
                    },
                    processing: true,
                    serverSide: true,
                    dom: '<f<t>ip>',
                    ajax: { 
                        url  :"{{route('app-data-keluarga')}}",  
                        type :'GET',
                         beforeSend: function (xhr) {
                                    xhr.setRequestHeader('Authorization', 'Bearer '+customer_token);
                        },
                    data : {
                                kategorial : $('#kategorial').val(),
                                sektor : $('#sektor').val(), 
                                status : $('#status').val(),
                                marga : $('#marga').val()
                            },
                        },
                    aoColumns: [
                        {
                            mRender : function(data,type,obj){
                                return obj.nama;
                            }
                        },
                        {
                            mRender : function(data,type,obj){
                                return obj.total;
                            }
                        },
                        {
                            mRender : function(data,type,obj){
                                return "<a class='btn btn-info btn-sm' href='"+base_url+"/keluarga/view/"+obj.id+"' ><i class='fa fa-eye'></i></a><a style='margin-left:5px;' class='btn btn-warning btn-sm btn-edit' href='"+base_url+"/keluarga/edit/"+obj.id+"' ><i class='fa fa-edit'></i></a>"
                            }
                        },

                       ],
                    fnRowCallback: function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                        $(nRow).addClass('r_anggota');
                        $(nRow).attr('data-id',aData['id']);
                    } 
                });  
    };  

      return {
          init: function() { 

            $("#sektor").select2({
                      placeholder: "Pilih sektor",
                      width: 'resolve',
                      allowClear : 'true',
                      ajax: {
                          type: 'GET',
                          delay: 200,
                          url:"{{url('/')}}/api/v1/get-config/sektor",
                          dataType: "json",
                          data: function (params) {
                              return {
                                  q: params.term,
                                  page: params.page,
                              };
                          },
                          processResults: function (data) {
                              return {
                                  results: $.map(data, function(obj) {
                                      return { id: obj.id, text: obj.value};
                                  })
                              };
                          },
                          
                      }
              }); 


            $("#marga").select2({
                      placeholder: "Pilih Marga",
                      width: 'resolve',
                      allowClear : 'true',
                      ajax: {
                          type: 'GET',
                          delay: 200,
                          url:"{{url('/')}}/api/v1/get-marga",
                          dataType: "json",
                          data: function (params) {
                              return {
                                  q: params.term,
                                  page: params.page,
                              };
                          },
                          processResults: function (data) {
                              return {
                                  results: $.map(data, function(obj) {
                                      return { id: obj.id, text: obj.value};
                                  })
                              };
                          },
                          
                      }
              }); 
            tableInit();
             $(document).on('change','.filter_data_anggota', function (e) {
                e.stopImmediatePropagation();
                $('#data-anggota').dataTable().fnDestroy();
                tableInit();
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