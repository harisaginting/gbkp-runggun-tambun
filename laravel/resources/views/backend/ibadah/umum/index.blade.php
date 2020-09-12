@extends('backend.template.master')

@section('assets')
<!-- Datatable -->
<link href="{{url('public/assets/plugin/datatables/datatablesBootsrap.min.css')}}" rel="stylesheet">
<script src="{{url('public/assets/plugin/datatables/datatables.js')}}"></script>
<script src="{{url('public/assets/plugin/datatables/dataTables.bootstrap4.min.js')}}"></script>
<style type="text/css">
    #data-artikel_wrapper{
        padding: 0px 10px 0px 10px;
    }

    .select2-container--default .select2-selection--single {
        background-color: #fff;
        border: 1px solid #e4e7ea;
        border-radius: 4px;
    }

    .form-control:disabled, .form-control[readonly], .form-control[readonly].date-picker.date-picker-blue {
        background-color: #fff !important;
    }

    .date-picker{
      cursor: pointer;
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
                                    <h4 class="card-title mb-0">Jadwal Ibadah Umum</h4>
                                    <div class="small text-muted">GBKP Runggun Tambun</div>
                                </div>
            
                            
                                <div class="col-sm-12 pl-0 pr-0">
                                    <table id="data-ibadah" class="table table-responsive-sm table-bordered table-striped table-md" style="width: 100%;">
                                        <thead>
                                            <th style="width:20%">Tanggal</th>
                                            <th style="width:40%">Waktu</th>
                                            <th style="width:30%">Pengkhotbah</th>
                                            <th style="width:5%"></th>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                
            
                        <div class="card-footer">
                                <a href="{{url('/')}}/ibadah/umum/add" class="btn btn-brand btn-success float-right" type="button" style="margin-bottom: 4px">
                                    <i class="fa fa-plus"></i>
                                    <span>Tambah Jadwal Ibadah Umum &nbsp;&nbsp;</span>
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
        var table = $('#data-ibadah').DataTable({
                    language: {
                        searchPlaceholder: "Cari"
                    },
                    processing: true,
                    serverSide: true,
                    dom: '<f<t>ip>',
                    ajax: { 
                        url  :"{{route('app-data-ibadah-umum')}}",  
                        type :'GET',
                         beforeSend: function (xhr) {
                                    xhr.setRequestHeader('Authorization', 'Bearer '+customer_token);
                        }
                    },   
                    aoColumns: [
                        {
                            mRender : function(data,type,obj){
                                return obj.tanggal_ibadah;
                            }
                        },
                        {
                            mRender : function(data,type,obj){
                                return obj.waktu_mulai+" s/d "+obj.waktu_selesai;
                            }
                        },
                        {
                            mRender : function(data,type,obj){
                                return obj.pengkotbah;
                            }
                        },
                        {
                            mRender : function(data,type,obj){
                                return "<a style='margin-left:5px;' class='btn btn-warning btn-sm btn-edit' data-id='"+obj.id_ibadah+"' href='{{url('/').'/ibadah/umum/edit/'}}"+obj.id_ibadah+"' ><i data-id='"+obj.id_ibadah+"' class='fa fa-edit'></i></a>"
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

             $(document).on('change','.filter_data_ibadah', function (e) {
                e.stopImmediatePropagation();
                $('#data-ibadah').dataTable().fnDestroy();
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