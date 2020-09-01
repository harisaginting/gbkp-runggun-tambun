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
</style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
                <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <h4 class="card-title mb-0">Daftar Jabatan</h4>
                                    <div class="small text-muted">GBKP Runggun Tambun</div>
                                </div>
            
                            
                                <div class="col-sm-12 pl-0 pr-0">
                                    <table id="data-jabatan" class="table table-responsive-sm table-bordered table-striped table-md" style="width: 100%;">
                                        <thead>
                                            <th style="width:40%">Nama</th>
                                            <th style="width:25%">Gelar</th>
                                            <th style="width:30%">Deskripsi</th>
                                            <th style="width:5%"></th>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                
            
                        <div class="card-footer">
                                <button id="btn-jabatan" class="btn btn-brand btn-success float-right" type="button" style="margin-bottom: 4px">
                                    <i class="fa fa-plus"></i>
                                    <span>Tambah Jabatan &nbsp;&nbsp;</span>
                                </button>
                        </div>
            
                    </div>
        </div>
    </div>

    <!-- Modal -->
      <div class="modal fade" id="modal-jabatan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content p-2">
            <div class="h4 mb-3"><strong>Tambahkan Jabatan</strong></div>
            <div class="w-100 border-1">
              <form id="form-jabatan">
              
              <div class="form-group">
                <label>Nama</label>
                <input class="form-control" id="id" name="id" type="hidden" />
                <input class="form-control" id="name" name="name" required type="text" />
              </div>

              <div class="form-group">
                <label>Gelar</label>
                <input class="form-control" id="title" name="title" required type="text" />
              </div>

              <div class="form-group">
                <label>Deskripsi</label>
                <textarea id="description" name="description" class="form-control"></textarea>
              </div>

              </form>
            </div>   
          <button type="button" class="btn btn-primary btn-md" id="btn-save">simpan</button>
          </div>
        </div>
      </div>

@endsection


@section('footcode')
<script type="text/javascript">    
  var Page = function () {

    getJabatan = async(id) =>{
          $("#loader").removeClass("hidden");
          return await fetch(base_url+"/api/v1/jabatan/get/"+id, {
            method      : 'GET', // *GET, POST, PUT, DELETE, etc.
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


    saveJabatan = async() =>{
          var formData = JSON.stringify($("#form-jabatan").serializeArray());
          return await fetch("{{route('app-jabatan-save')}}", {
            method      : 'POST', // *GET, POST, PUT, DELETE, etc.
            mode        : 'cors', 
            headers: {
              'Content-Type': 'application/json',
              'Authorization': 'Bearer '+customer_token,
            },
            referrerPolicy: 'no-referrer',
            body: formData
          }).then(r => 
          r.json())
          .then(data => {
            return data;
          })
            .catch(error => {
              console.error('Error:', error);
          });
       }

    var tableInit = function(){                     
        var table = $('#data-jabatan').DataTable({
                    language: {
                        searchPlaceholder: "Cari"
                    },
                    processing: true,
                    serverSide: true,
                    dom: '<f<t>ip>',
                    ajax: { 
                        url  :"{{route('app-data-jabatan')}}",  
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
                                return obj.name;
                            }
                        },
                        {
                            mRender : function(data,type,obj){
                                return obj.title;
                            }
                        },
                        {
                            mRender : function(data,type,obj){
                                return obj.description
                            }
                        },
                        {
                            mRender : function(data,type,obj){
                                return "<div style='margin-left:5px;' class='btn btn-warning btn-sm btn-edit' data-id='"+obj.id+"' ><i data-id='"+obj.id+"' class='fa fa-edit'></i></div>"
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

             global.on("click","#btn-jabatan", e => {
                $('#id').val("");
                $('#title').val("");
                $('#name').val("");
                $('#description').val("");
                $('#modal-jabatan').modal('show');
             });

             global.on("click",".btn-edit", e => {
                $('#id').val("");
                $('#name').val("");
                $('#title').val("");
                $('#description').val("");
                let id = $(e.target).data("id");
                getJabatan(id).then((data)=>{
                    $("#loader").addClass("hidden");
                    if(data.status == 200){
                        let jabatan_data        = data.data;
                        $('#id').val(jabatan_data.id);
                        $('#name').val(jabatan_data.name);
                        $('#title').val(jabatan_data.title);
                        $('#description').val(jabatan_data.description);
                        $('#modal-jabatan').modal('show');              
                    }else{
                        alert("terjadi kesalahan");
                    }
                });
                
             });

             global.on("click","#btn-save", e => {
                if ($("#form-jabatan").valid()) {
                  $("#loader").removeClass("hidden");
                        saveJabatan().then((data)=>{
                        $("#loader").addClass("hidden");
                        if(data.status == 200){
                            alert("data berhasil ditambahkan");
                            location.reload();
                        }else{
                           
                        }
                    });
                  }
             });

             $(document).on('change','.filter_data_anggota', function (e) {
                e.stopImmediatePropagation();
                $('#data-artikel').dataTable().fnDestroy();
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