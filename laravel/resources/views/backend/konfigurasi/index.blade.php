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
</style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
                <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <h4 class="card-title mb-0">Konfigurasi Aplikasi</h4>
                                </div>
            
                                <div class="col-sm-8" style="margin-bottom: 15px;">
                                    <div class="row">
                                      
                                        <div class="offset-md-5 col-md-4 col-sm-6">
                                                <div class="form-group">
                                                        <select id="type" class="form-control">
                                                            <option value="">Semua</option>
                                                            <option value="AKTIF">Pekerjaan</option>
                                                            <option value="PASIF">Pendidikan</option>
                                                        </select>
                                                </div>
                                        </div>

                                        <div class="col-md-3 col-sm-6">
                                            <div class="form-group">
                                                <button class="btn w-100 btn-brand btn-info" type="button" style="">
                                                    <i class="fa fa-download pull-left"></i>
                                                    <span>Download</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="col-sm-12 pl-0 pr-0">
                                    <table id="data-konfigurasi" class="table table-responsive-sm table-bordered table-striped table-md" style="width: 100%;">
                                        <thead>
                                            <th style="width:10%">ID</th>
                                            <th style="width:15%">Type</th>
                                            <th style="width:70%">Value</th>                                            
                                            <th style="width:5%"></th>                                            
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
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

    var tableInit = function(){                     
        var table = $('#data-konfigurasi').DataTable({
                    language: {
                        searchPlaceholder: "Cari dengan nama"
                    },
                    processing: true,
                    serverSide: true,
                    dom: '<<t>ip>',
                    ajax: { 
                        url  :"{{route('app-data-config-general')}}", 
                        type :'GET',
                        beforeSend: function (xhr) {
                                    xhr.setRequestHeader('Authorization', 'Bearer '+customer_token);
                        },
                        'data' : {type:$('#type').val()},
                        },
                    aoColumns: [
                        {mData: "id"},
                        {mData: "type"},
                        {mData: "value"},
                        {
                            mRender : function(data,type,obj){
                                return "<a style='margin-left:5px;' class='btn btn-warning btn-sm btn-edit' href='"+base_url+"anggota/edit/"+obj.uuid+"' ><i class='fa fa-edit'></i></a>"
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