@extends('backend.template.master')

@section('content')
  <div class="card">
    <div class="card-header">
      <h4>Data Anggota</h4>
    </div>
    <div class="card-body">
      <form id="form-anggota" method="post" action="{{route('app-anggota-save')}}">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <input type="hidden" name="id_anggota" name="id_anggota" value="">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input class="form-control" id="email" name="email" type="email" placeholder="Email">
                                    </div>

                                    <div class="form-group">
                                        <label>Nama Depan</label>
                                        <input class="form-control" id="nama_depan" name="nama_depan" type="text" placeholder="Nama Depan" value=""  required>
                                    </div>

                                    <div class="form-group">
                                        <label>Nama Belakang</label>
                                        <input class="form-control" id="nama_belakang" name="nama_belakang" type="text" placeholder="Nama Belakang">
                                    </div>

                                    <div class="form-group">
                                        <label>Marga</label>
                                        <select id="marga" name="marga" class="form-control" required>
                                            <option value=""></option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Jenis Kelamin</label>
                                        <select id="jenis_kelamin"  name="jenis_kelamin" class="form-control">
                                            <option value="L">Laki-laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Tempat Lahir</label>
                                         <input type="text" name="tempat_lahir" id="tempat_lahir"class="form-control" placeholder="Tempat Lahir">
                                    </div>

                                    <div class="form-group">
                                        <label>Tanggal Lahir</label>
                                        <input type="text" name="tanggal_lahir" id="tanggal_lahir" class="form-control date-picker-born" readOnly value="" placeholder="klik untuk menambahkan tanggal">
                                    </div>

                                    <div class="form-group">
                                        <label>Status Pernikahan</label>
                                        <select  name="status_pernikahan" id="status_pernikahan" class="form-control">
                                            <option value="0">Lajang</option>
                                            <option value="1">Menikah</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Pendidikan Terakhir</label>
                                        <select  name="pendidikan" id="pendidikan" class="form-control">
                                            <option value=""></option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Pekerjaan</label>
                                        <select id="pekerjaan" name="pekerjaan" class="form-control">
                                              <option></option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Hobi</label>
                                        <input type="text" name="hobi" id="hobi" class="form-control" placeholder="Silahkan tuliskan hobi kamu" value="">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                      <div class="form-group">
                                        <label>Tahun Ngawan</label>
                                        <input type="number" name="tahun_ngawan" id="tahun_ngawan" class="form-control" placeholder="Tahun Ngawan / Sidi"  max="{{date('Y')}}">
                                      </div>

                                      <div class="form-group">
                                        <label>Runggun Ngawan</label>
                                        <input type="text" name="runggun_ngawan" id="runggun_ngawan" class="form-control"  placeholder="Greja Ngawan / Sidi" value="">
                                      </div>

                                      <div class="form-group">
                                        <label>Telepon</label>
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                            <span class="input-group-text">
                                              +62
                                            </span>
                                          </div>
                                            <input class="form-control" id="telepon" type="text" name="telepon" placeholder="Telepon" value="">
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label>Sektor</label>
                                        <select id="sektor" name="sektor" class="form-control">
                                            <option></option>
                                        </select>
                                      </div>

                                      <div class="form-group">
                                          <label>Provinsi</label>
                                          <select class="form-control" name="domisili_provinsi" id="domisili_provinsi">
                                              <option value=""></option>
                                          </select>
                                      </div>

                                      <div class="form-group">
                                          <label>Kabupaten</label>
                                          <select class="form-control" name="domisili_kota" id="domisili_kota" >
                                            <option value=""></option>
                                          </select>
                                      </div>

                                      <div class="form-group">
                                          <label>Kecamatan</label>
                                          <select class="form-control" name="domisili_kecamatan" id="domisili_kecamatan" >
                                            <option value=""></option>
                                          </select>
                                      </div>

                                      <div class="form-group">
                                          <label>Alamat</label>
                                          <textarea rows="5" class="form-control" id="alamat" name="alamat" placeholder="Alamat lengkap tempat tinggal (sesuai kartu identitas KTP/SIM/Kartu Pelajar)" ></textarea>
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