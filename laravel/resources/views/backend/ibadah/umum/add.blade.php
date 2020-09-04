@extends('backend.template.master')

@section('content')
  <div class="card">
    <div class="card-header">
      <h4>Ibadah Umum</h4>
    </div>
    <div class="card-body">
      <form id="form-anggota" method="post" action="{{route('app-ibadah-umum-save')}}">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <input type="hidden" name="id_ibadah" name="id_ibadah" value="">
                                    <div class="form-group">
                                        <label>Tema</label>
                                        <input class="form-control" id="theme" name="theme" type="text" placeholder="Tema">
                                    </div>


                                    <div class="form-group">
                                        <label>Tanggal</label>
                                        <input class="form-control" id="date" name="date" type="text" placeholder="Tanggal Ibadah">
                                    </div>

                                    <div class="row">
                                      <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Waktu Mulai</label>
                                            <input class="form-control" id="start_time" name="start_time" type="text" placeholder="Waktu Mulai">
                                        </div>
                                      </div>

                                      <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Waktu Selesai</label>
                                            <input class="form-control" id="end_time" name="send_time" type="text" placeholder="Waktu Ibadah Selesai">
                                        </div>
                                      </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">

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
@endsection


@section('footcode')
<style type="text/css">
  .form-control:disabled, .form-control[readonly], .form-control[readonly].date-picker.date-picker-blue{
    background-color: #fff !important;
  }
</style>
<script type="text/javascript">    
var Page = function () {
    saveAnggota = async() =>{
          var formData = JSON.stringify($("#form-anggota").serializeArray());
          return await fetch("{{route('app-anggota-save')}}", {
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

      return {
          init: function() { 
             $(document).on("click","#btn-save", function(e){
                  e.preventDefault();
                  if($("#form-anggota").valid()){
                      $("#loader").removeClass("hidden");
                      saveAnggota().then((data)=>{
                        $("#loader").addClass("hidden");
                        if(data.status == 200){
                            alert("data berhasil ditambahkan");
                            location.reload();
                        }else{
                           
                        }
                    });
                  }
              });

             $("#marga").select2({
                      placeholder: "Pilih Marga",
                      width: 'resolve',
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

             $("#pekerjaan").select2({
                      placeholder: "Pilih Pekerjaan",
                      width: 'resolve',
                      ajax: {
                          type: 'GET',
                          delay: 200,
                          url:"{{url('/')}}/api/v1/get-config/pekerjaan",
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

             $("#pendidikan").select2({
                      placeholder: "Pilih pendidikan",
                      width: 'resolve',
                      ajax: {
                          type: 'GET',
                          delay: 200,
                          url:"{{url('/')}}/api/v1/get-config/pendidikan",
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

             $("#sektor").select2({
                      placeholder: "Pilih sektor",
                      width: 'resolve',
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

              $("#domisili_provinsi").select2({
                      placeholder: "Pilih Provinsi",
                      width: 'resolve',
                      ajax: {
                          type: 'GET',
                          delay: 200,
                          url:"{{url('/')}}/api/v1/get-provinsi",
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
                                      return { id: obj.id, text: obj.nama};
                                  })
                              };
                          },
                          
                      }
              }); 
              $(document).on("change","#domisili_provinsi", function(e){
                    $("#domisili_kota").removeAttr("disabled");
              });



              $("#domisili_kota").select2({
                  placeholder: "Pilih Kabupaten",
                  width: 'resolve',
                  allowClear : true,
                  ajax: {
                      type: 'GET',
                      delay: 200,
                      url:"{{url('/')}}/api/v1/get-kabupaten",
                      dataType: "json",
                      data: function (params) {
                          return {
                              q: params.term,
                              page: params.page,
                              provinsi : $("#domisili_provinsi").val()
                          };
                      },
                      processResults: function (data) {
                          return {
                              results: $.map(data, function(obj) {
                                  return { id: obj.id, text: obj.nama};
                              })
                          };
                      },
                      
                  }
              });
              $(document).on("change","#domisili_kota", function(e){
                    $("#domisili_kecamatan").removeAttr("disabled");
              }); 

              $("#domisili_kecamatan").select2({
                  placeholder: "Pilih Kecamatan",
                  width: 'resolve',
                  allowClear : true,
                  ajax: {
                      type: 'GET',
                      delay: 200,
                      url:"{{url('/')}}/api/v1/get-kecamatan",
                      dataType: "json",
                      data: function (params) {
                          return {
                              q: params.term,
                              page: params.page,
                              kabupaten : $("#domisili_kota").val()
                          };
                      },
                      processResults: function (data) {
                          return {
                              results: $.map(data, function(obj) {
                                  return { id: obj.id, text: obj.nama};
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