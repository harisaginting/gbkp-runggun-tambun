@extends('backend.template.master')

@section('content')
  <div class="card">
    <div class="card-header">
      <h4>Ibadah Umum</h4>
    </div>
    <div class="card-body">
      <form id="form-ibadah" method="post" action="{{route('app-ibadah-umum-save')}}">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <input type="hidden" name="id_ibadah" name="id_ibadah" value="">
                                    <div class="form-group">
                                        <label>Kebaktian</label>
                                        <input class="form-control" id="nama" name="nama" type="text" placeholder="Kebaktian" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Tanggal</label>
                                        <input class="form-control date-picker" id="tanggal" name="tanggal" type="text" placeholder="Tanggal Ibadah" required>
                                    </div>

                                    <div class="row">
                                      <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Waktu Mulai</label>
                                            <input class="form-control time-picker" id="waktu_mulai" name="waktu_mulai" type="text" placeholder="hh:ss" jamMenit="true" required>
                                        </div>
                                      </div>

                                      <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Waktu Selesai</label>
                                            <input class="form-control time-picker" id="waktu_selesai" name="waktu_selesai" type="text" placeholder="hh:ss" jamMenit="true" required>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Tema</label>
                                        <input class="form-control" id="tema" name="tema" type="text" placeholder="Tema ibadah" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Khotbah</label>
                                        <input class="form-control" id="khotbah" name="khotbah" type="text" placeholder="Ayat khotbah" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Invocatio</label>
                                        <input class="form-control" id="invocatio" name="invocatio" type="text" placeholder="Ayat invocatio" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Ogen</label>
                                        <input class="form-control" id="ogen" name="ogen" type="text" placeholder="Ayat ogen" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Link Yutube</label>
                                        <input class="form-control" id="link_youtube" name="link_youtube" type="text" placeholder="Link Video Youtube">
                                    </div>

                                    <div class="form-group">
                                        <label>Link Ibadah</label>
                                        <input class="form-control" id="link_page" name="link_page" type="text" placeholder="Link External Ibadah">
                                    </div>

                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                          <label>Pengkotbah</label>
                                          <input class="form-control" id="pengkotbah" name="pengkotbah" type="text" placeholder="Nama Pengkotbah" required>
                                    </div>
                                    <div class="form-group">
                                          <label>Liturgi</label>
                                          <input class="form-control" id="liturgi" name="liturgi" type="text" placeholder="Nama Pembawa Liturgis" required>
                                    </div>
                                    <div class="form-group">
                                          <label>Koordinator</label>
                                          <input class="form-control" id="koordinator" name="koordinator" type="text" placeholder="Nama Koordinator">
                                    </div>
                                    <div class="form-group">
                                          <label>Sinaruh</label>
                                          <input class="form-control" id="sinaruh" name="sinaruh" type="text" placeholder="Nama Petugas Sinaruh">
                                    </div>
                                    <div class="form-group">
                                          <label>Siermomo</label>
                                          <input class="form-control" id="siermomo" name="siermomo" type="text" placeholder="Nama Petugas Siermomo">
                                    </div>
                                    <div class="form-group">
                                          <label>Simaba Ende-Enden</label>
                                          <input class="form-control" id="simabaenden" name="simabaenden" type="text" placeholder="Nama Petugas Pembawa Puji-Pujian">
                                    </div>
                                    <div class="form-group">
                                          <label>Organis</label>
                                          <input class="form-control" id="organis" name="organis" type="text" placeholder="Nama Petugas Pemain Organ Tunggal">
                                    </div>
                                    <div class="form-group">
                                          <label>Song Leader</label>
                                          <select multiple="multiple" class="form-control" id="songleader" name="songleader[]" type="text" placeholder="Song Leader">
                                          </select>
                                    </div>
                                    <div class="form-group">
                                          <label>Persembahen</label>
                                          <input type="text" id="persembahen" name="persembahen" type="text" placeholder="Simuat Persembahen" >
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
    saveIbadah = async() =>{
          var formData = JSON.stringify($("#form-ibadah").serializeArray());
          return await fetch("{{route('app-ibadah-umum-save')}}", {
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
                  if($("#form-ibadah").valid()){
                      $("#loader").removeClass("hidden");
                      saveIbadah().then((data)=>{
                        $("#loader").addClass("hidden");
                        if(data.status == 200){
                            alert("data berhasil ditambahkan");
                            location.reload();
                        }else{
                           
                        }
                    });
                  }
              });

             $("#songleader").select2({
                      placeholder: "Song Leader",
                      width: 'resolve',
                      tags : true,
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
                              };
                          },
                          processResults: function (data) {
                              return {
                                  results: $.map(data, function(obj) {
                                      let nama = obj.nama_depan;
                                      if(obj.nama_belakang !== null){
                                         nama = nama + " " + obj.nama_belakang;
                                      }

                                      return { id: nama, text: nama};
                                  })
                              };
                          },
                          
                      }
              }); 

             $("#persembahen").select2({
                      placeholder: "Petugas Persembahen",
                      width: 'resolve',
                      tags : true,
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
                              };
                          },
                          processResults: function (data) {
                              return {
                                  results: $.map(data, function(obj) {
                                      let nama = obj.nama_depan;
                                      if(obj.nama_belakang !== null){
                                         nama = nama + " " + obj.nama_belakang;
                                      }

                                      return { id: nama, text: nama};
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