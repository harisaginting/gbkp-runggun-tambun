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
                                    <h4 class="card-title mb-0">Daftar Serayaan</h4>
                                    <div class="small text-muted">GBKP Runggun Tambun</div>
                                </div>
            
                            
                                <div class="col-sm-12 pl-0 pr-0">
                                    <table id="data-serayaan" class="table table-responsive-sm table-bordered table-striped table-md" style="width: 100%;">
                                        <thead>
                                            <th style="width:20%">Jabatan</th>
                                            <th style="width:40%">Nama</th>
                                            <th style="width:30%">Periode</th>
                                            <th style="width:5%;">Status</th>
                                            <th style="width:5%"></th>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                
            
                        <div class="card-footer">
                                <button id="btn-serayaan" class="btn btn-brand btn-success float-right" type="button" style="margin-bottom: 4px">
                                    <i class="fa fa-plus"></i>
                                    <span>Tambah Serayaan &nbsp;&nbsp;</span>
                                </button>
                        </div>
            
                    </div>
        </div>
    </div>

    <!-- Modal -->
      <div class="modal fade" id="modal-serayaan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content p-2">
            <div class="h4 mb-3"><strong>Tambahkan Serayaan</strong></div>
            <div class="w-100 border-1">
              <form id="form-serayaan">
              
              <div class="form-group">
                <label>Nama</label>
                <input class="form-control" id="id" name="id" type="hidden" />
                <select class="form-control" id="anggota" name="anggota" required></select>
              </div>

              <div class="form-group">
                <label>jabatan</label>
               <select class="form-control date-picker-milenium" id="jabatan" name="jabatan" required></select>
              </div>

              <div class="form-group">
                <label>Tanggal Mulai</label>
                  <input class="form-control date-picker-milenium" id="period_start" name="period_start" type="text" readonly />
              </div>

              <div class="form-group">
                <label>Tanggal Selesai</label>
               <input class="form-control date-picker-milenium" id="period_end" name="period_end" type="text" readonly />
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

    getserayaan = async(id) =>{
          $("#loader").removeClass("hidden");
          return await fetch(base_url+"/api/v1/serayaan/get/"+id, {
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


    saveserayaan = async() =>{
          var formData = JSON.stringify($("#form-serayaan").serializeArray());
          return await fetch("{{route('app-serayaan-save')}}", {
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
        var table = $('#data-serayaan').DataTable({
                    language: {
                        searchPlaceholder: "Cari"
                    },
                    processing: true,
                    serverSide: true,
                    dom: '<f<t>ip>',
                    ajax: { 
                        url  :"{{route('app-data-serayaan')}}",  
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
                                return obj.jabatan_name;
                            }
                        },
                        {
                            mRender : function(data,type,obj){
                                let nama = obj.nama_panggilan;
                                if (nama === null || nama === "null" || nama === "") {
                                  nama = obj.nama_depan + " " + obj.nama_belakang
                                }
                                return obj.jabatan_title+" "+nama;
                            }
                        },
                        {
                            mRender : function(data,type,obj){
                                return "<strong>"+obj.start_date +"</strong> &nbsp;&nbsp;sampai&nbsp;&nbsp; <strong>"+obj.end_date+"</strong>";
                            }
                        },
                        {
                            mRender : function(data,type,obj){
                              let status = "<i class='fa fa-circle text-danger'></i>";
                                if (obj.status === 1 || obj.status === "1") {
                                  status = "<i class='fa fa-circle text-success'></i>";
                                }
                                return "<div class='w-100 text-center'>"+status+"</div>";
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

             $("#anggota").select2({
                      placeholder: "Pilih Anggota",
                      width: 'resolve',
                      ajax: {
                          type: 'GET',
                          delay: 200,
                          url:"{{url('/')}}/api/v1/anggota/select",
                          dataType: "json",
                          headers: {
                            'Content-Type': 'application/json',
                            'Authorization': 'Bearer '+customer_token,
                          },
                          data: function (params) {
                              return {
                                  q: params.term,
                                  page: params.page,
                                  jabatan: false
                              };
                          },
                          processResults: function (data) {
                              return {
                                  results: $.map(data, function(obj) {
                                      let nama = obj.nama_depan;
                                      if(obj.nama_belakang !== null){
                                         nama = nama + " " + obj.nama_belakang;
                                      }

                                      return { id: obj.uuid, text: nama};
                                  })
                              };
                          },
                          
                      }
              }); 


             $("#jabatan").select2({
                      placeholder: "Pilih Jabatan",
                      width: 'resolve',
                      ajax: {
                          type: 'GET',
                          delay: 200,
                          url:"{{route('app-jabatan-select')}}",
                          dataType: "json",
                          headers: {
                            'Content-Type': 'application/json',
                            'Authorization': 'Bearer '+customer_token,
                          },
                          data: function (params) {
                              return {
                                  q: params.term,
                                  page: params.page
                              };
                          },
                          processResults: function (data) {
                              return {
                                  results: $.map(data, function(obj) {
                                      return { id: obj.id, text: obj.name};
                                  })
                              };
                          },
                          
                      }
              }); 


             global.on("click","#btn-serayaan", e => {
                $('#id').val("");
                $('#title').val("");
                $('#name').val("");
                $('#description').val("");
                $('#modal-serayaan').modal('show');
             });

             global.on("click",".btn-edit", e => {
                $('#id').val("");
                $('#name').val("");
                $('#title').val("");
                $('#description').val("");
                let id = $(e.target).data("id");
                getserayaan(id).then((data)=>{
                    $("#loader").addClass("hidden");
                    if(data.status == 200){
                        let serayaan_data        = data.data;
                        $('#id').val(serayaan_data.id);
                        $('#name').val(serayaan_data.name);
                        $('#title').val(serayaan_data.title);
                        $('#description').val(serayaan_data.description);
                        $('#modal-serayaan').modal('show');              
                    }else{
                        alert("terjadi kesalahan");
                    }
                });
                
             });

             global.on("click","#btn-save", e => {
                if ($("#form-serayaan").valid()) {
                  $("#loader").removeClass("hidden");
                        saveserayaan().then((data)=>{
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