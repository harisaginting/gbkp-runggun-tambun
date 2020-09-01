@extends('backend.template.master')

@section('content')
  <div class="card">
    <div class="card-header">
      <h4>Data Keluarga</h4>
    </div>
    <div class="card-body">
      <form id="form-keluarga" method="post" action="{{route('app-keluarga-save')}}">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <input type="hidden" name="id_anggota" name="id_anggota" value="">
                                    <div class="form-group">
                                        <label>Nama Keluarga</label>
                                        <input type="hidden" name="id_keluarga" id="id_keluarga">
                                        <input class="form-control" id="nama_keluarga" name="nama_keluarga" type="text" placeholder="Nama Keluarga" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Anggota Keluarga</label>
                                        <table class="table">
                                          <thead>
                                            <tr>
                                              <th style="width: 50%;">Nama</th>
                                              <th style="width: 40%;">Status</th>
                                              <th  style="width: 10%;"><button type="button" class="btn btn-sm btn-success pull-right" data-toggle="modal" data-target="#modal-add-anggota" id="btn-add-anggota"><i class="fa fa-plus"></i></button></th>
                                            </tr>
                                          </thead>
                                          <tbody id="table-body-keluarga">
                                          </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                          <div class="row">
                              <div class="col-md-12 text-center">
                                  <button class="btn btn-success btn-login px-4" type="button" id="btn-save">simpan</button>
                              </div>
                          </div>
                          </form>
    </div>
  </div>


   <!-- Modal -->
      <div class="modal fade" id="modal-add-anggota" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content p-2">
            <div class="h4 mb-3"><strong>Tambahkan Anggota Keluarga</strong></div>
            <div class="w-100 border-1">
              <form id="form-anggota">
                <div class="form-group">
                <label>Nama</label>
                <select class="form-control" id="anggota" name="anggota" required></select>
              </div>

              <div class="form-group">
                <label>Status</label>
                <select class="form-control" id="status" name="status" required></select>
              </div>
              </form>
            </div>   
          <button type="button" class="btn btn-primary btn-md" id="btn-add-anggota-save">simpan</button>
          </div>
        </div>
      </div>
@endsection


@section('footcode')
<style type="text/css">
  .form-control:disabled, .form-control[readonly], .form-control[readonly].date-picker.date-picker-blue{
    background-color: #fff !important;
  }
</style>
<script type="text/javascript"> 
var list_anggota = [];  
var Page = function () {
    saveAnggota = async() =>{
          var formData = JSON.stringify($("#form-anggota").serializeArray());
          return await fetch("{{route('app-keluarga-save')}}", {
            method      : 'POST', // *GET, POST, PUT, DELETE, etc.
            mode        : 'cors', 
            headers: {
              'Content-Type': 'application/json',
              'Authorization': 'Bearer '+customer_token,
            },
            referrerPolicy: 'no-referrer',
            body: JSON.stringify({id_keluarga : $("#id_keluarga").val(), keluarga : $("#nama_keluarga").val(), anggota : list_anggota})
          }).then(r => 
          r.json())
          .then(data => {
            return data;
          })
            .catch(error => {
              console.error('Error:', error);
          });
       }

      return {
          init: function() { 
             $(document).on("click","#btn-save", function(e){
                  e.preventDefault();
                  if($("#form-keluarga").valid()){
                      $("#loader").removeClass("hidden");
                      saveAnggota().then((data)=>{
                        $("#loader").addClass("hidden");
                        if(data.status == 200){
                            alert("data keluarga berhasil ditambahkan");
                            window.location.href = "{{route('app-keluarga')}}";
                        }else{
                           
                        }
                    });
                  }
              });




             global.on("click","#btn-add-anggota",()=>{
                $('#anggota').val(null).trigger('change');
                $('#status').val(null).trigger('change');
             });

             global.on("click",".btn-delete-anggota", e =>{
                id_deleted = $(e.target).data("id"); 
                pos_delete = null;
                list_anggota.map((value,index) => {
                    if(value.anggota == id_deleted){
                       pos_delete = index;
                    }
                });
                if(pos_delete !== null){
                  list_anggota.splice(pos_delete, 1);
                  $("#row-"+id_deleted).remove();
                }

             });

             global.on("click","#btn-add-anggota-save",()=>{
               if($("#form-anggota").valid()){
                  
                  let id_anggota    = $("#anggota").val();
                  let nama_anggota  = $('#anggota').select2('data')[0].text;


                  let id_status   = $("#status").val();
                  let nama_status = $('#status').select2('data')[0].text;


                  let container_anggota   = document.createElement("tr");
                  $(container_anggota).attr("id", "row-" + $("#anggota").val());

                  let field_nama_anggota  = document.createElement("td");
                  $(field_nama_anggota).text(nama_anggota);

                  let field_status_anggota  = document.createElement("td");
                  $(field_status_anggota).text(nama_status);

                  let field_btn_anggota         = document.createElement("td");
                  let btn_delete_anggota        = document.createElement("button");
                  let btn_delete_anggota_label  = document.createElement("span");
                  $(btn_delete_anggota).addClass("btn btn-danger btn-sm btn-delete-anggota pull-right");
                  $(btn_delete_anggota).attr("type","button");
                  $(btn_delete_anggota).attr("data-id",$("#anggota").val());
                  $(btn_delete_anggota_label).attr("data-id",$("#anggota").val());
                  $(btn_delete_anggota_label).addClass("fa fa-trash");
                  

                  let isvalid = true;
                  let anggota = {
                    anggota:  $("#anggota").val(),
                    status:   $("#status").val()
                  };                  
                  list_anggota.map((value,index) => {
                      if(value.anggota == anggota.anggota){
                        isvalid =  false;
                      }
                  });


                  if(isvalid === true){
                    list_anggota.push(anggota);
                    $(container_anggota).append(field_nama_anggota);
                    $(container_anggota).append(field_status_anggota);
                    $(btn_delete_anggota).append(btn_delete_anggota_label);
                    $(field_btn_anggota).append(btn_delete_anggota);
                    $(container_anggota).append(field_btn_anggota);
                    $("#table-body-keluarga").append(container_anggota);
                  }

                  $('#modal-add-anggota').modal('hide');
               };
             });


             $("#anggota").select2({
                      placeholder: "Pilih Anggota Keluarga",
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
                                  keluarga: false
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

             $("#status").select2({
                      placeholder: "Pilih Status Anggota Keluarga",
                      width: 'resolve',
                      ajax: {
                          type: 'GET',
                          delay: 200,
                          url:"{{url('/')}}/api/v1/get-keluarga-status",
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

           }
      };

  }();

  jQuery(document).ready(function() {
      Page.init();
  });  
</script>
@endsection