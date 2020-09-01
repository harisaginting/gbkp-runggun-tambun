@extends('backend.template.master')

@section('assets')
<!-- Datatable -->
<link href="{{url('public/assets/plugin/datatables/datatablesBootsrap.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{url('/')}}/public/assets/landing/plugin/croppie/croppie.css">

<script src="{{url('public/assets/plugin/datatables/datatables.js')}}"></script>
<script src="{{url('public/assets/plugin/datatables/dataTables.bootstrap4.min.js')}}"></script>

<link href="{{url('public/assets/plugin/summernote/summernote-bs4.css')}}" rel="stylesheet">
<script src="{{url('public/assets/plugin/summernote/summernote-bs4.js')}}"></script>
<script src="{{url('public/assets/landing/plugin/croppie/croppie.js')}}"></script>

<style type="text/css">
    #data-anggota_wrapper{
        padding: 0px 10px 0px 10px;
    }

    .select2-container--default .select2-selection--single {
        background-color: #fff;
        border: 1px solid #e4e7ea;
        border-radius: 4px;
    }
    .croppie-container{
      margin-bottom: -32px !important; 
    }
</style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
                <div class="card">
                        <div class="card-body">
                            <form class="row" id="form-artikel" method="post" action="{{url('/')}}/artikel/save">
                                <div class="col-sm-4">
                                    <h4 class="card-title mb-0">Artikel</h4>
                                    <div class="small text-muted">GBKP Runggun Tambun</div>
                                </div>
                                
                                <div class="col-sm-12 form-group mt-4">
                                    <label><strong>Judul</strong></label>
                                    <input type="hidden" name="id_artikel" id="id_artikel">
                                    <input type="text" name="title" id="title" class="form-control" required>
                                </div>

                                <div class="col-sm-12 form-group">
                                    <label><strong>Url key</strong></label>
                                    <input type="text" name="url_key" id="url_key" class="form-control" required>
                                </div>

                                <div class="col-sm-12 form-group">
                                    <label><strong>Deskripsi singkat</strong></label>
                                    <textarea type="text" name="short_description" id="short_description" class="form-control" required>
                                    </textarea>
                                </div>


                                <div class="col-sm-12 form-group">
                                    <label><strong>Kategori</strong></label>
                                    <select id="category" name="category" class="form-control filter_data_anggota">
                                            <option value="">Semua Kategorial</option>
                                            <option value="MARTURIA">MARTURIA</option>
                                            <option value="DIAKONIA">DIAKONIA</option>
                                            <option value="KA/KR">KA/KR</option>
                                            <option value="PERMATA">PERMATA</option>
                                            <option value="MAMRE">MAMRE</option>
                                            <option value="MORIA">MORIA</option>
                                            <option value="SAITUN">SAITUN</option>
                                        </select>
                                </div>

                                 <div class="form-group col-sm-12">
                                    <label>Gambar Desktop</label>
                                    <div id="upload-demo" style="width:100%;padding: 0px;"></div>
                                        <input style="display: none;" type="file" id="upload-photo" accept="image/*">
                                        <input style="display: none;" type="text" id="upload-photo-result" name="upload-photo-result">
                                        <div class="w-100 text-center">
                                          <button type="button" class="btn btn-warning btn-sm hidden" id="btn-set-image">set foto</button>
                                        </div>
                                </div>

                                <div class="form-group col-sm-12">
                                    <label>Gambar Mobile</label>
                                    <div id="upload-demo-mobile" style="width:100%;padding: 0px;"></div>
                                        <input style="display: none;" type="file" id="upload-photo-mobile" accept="image/*">
                                        <input style="display: none;" type="text" id="upload-photo-result-mobile" name="upload-photo-result-mobile">
                                        <div class="w-100 text-center">
                                          <button type="button" class="btn btn-warning btn-sm hidden" id="btn-set-image-mobile">set foto</button>
                                        </div>
                                </div>

                                <div class="col-sm-12 mt-4">
                                    <div id="summernote"></div>
                                </div>
                                <input type="hidden" name="content-value" id="content-value">
                            </form>
                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <button type="button" class="btn btn-success" id="btn-save-artikel">Simpan</button>
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
            height : 600,
            maxHeight : 1200
        });
    };

    getArtikel = async() =>{
          $("#loader").removeClass("hidden");
          let pathArray = window.location.pathname.split('/');
          let uuid = "";
          if(pathArray.length > 0){
            uuid = pathArray[3];
          }
          return await fetch(base_url+"/api/v1/artikel/get/"+uuid, {
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

    saveArtikel = async() =>{
          var formData = JSON.stringify($("#form-artikel").serializeArray());
          return await fetch("{{route('app-artikel-save')}}", {
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
            wywsigInit();
            $(document).on('click','#btn-save-artikel', function (e) {
                e.preventDefault();
                let content = $('#summernote').summernote('code');
                $('#content-value').val(content);
                $uploadCrop.result('base64','viewport').then(function (resp) {
                  $("#upload-photo-result").val(resp);
                });
                if($("#form-artikel").valid()){
                    if($("#upload-photo-result").val() === ""){
                      alert("gambar belum di-set atau dipilih");
                    }else{
                      $("#loader").removeClass("hidden");
                      saveArtikel().then((data)=>{
                          $("#loader").addClass("hidden");
                          if(data.status == 200){
                              alert("data berhasil dirubah");
                              location.reload();
                          }else{
                             
                          }
                      });    
                    }
                    
                }
            });

            // upload foto
            $uploadCropCont = document.getElementById('upload-demo');
            $uploadCrop = new Croppie($uploadCropCont, {
                  enableExif: true,
                  // enableResize: true,
                  enableOrientation: true,
                  viewport: {
                      width: 800,
                      height: 325
                  },
                  boundary: {
                      width: 805,
                      height: 330
                  }
              });

            $('#upload-photo').on('change', function () { 
                var reader = new FileReader();
                reader.onload = function (e) {
                $uploadCrop.bind({
                  url: e.target.result
                }).then(function(){
                    $uploadCrop.result('base64','viewport').then(function (resp) {
                      $("#upload-photo-result").val(resp);
                    });
                });
                
                }
              reader.readAsDataURL(this.files[0]);
              $("#btn-set-image").removeClass("hidden");
            });

            $("#upload-demo > .cr-boundary").on('click', function() {
               $("#upload-photo").click();
            });

            global.on("click","#btn-set-image", function(e){
                e.preventDefault();
                  $uploadCrop.result('base64','viewport').then(function (resp) {
                    $("#upload-photo-result").val(resp);
                    alert("gambar desktop berhasil diatur");
                  });
            });

            $uploadCropContMobile = document.getElementById('upload-demo-mobile');
            $uploadCropMobile     = new Croppie($uploadCropContMobile, {
                  enableExif: true,
                  // enableResize: true,
                  enableOrientation: true,
                  viewport: {
                      width: 350,
                      height: 350
                  },
                  boundary: {
                      width: 355,
                      height: 350
                  }
              });

            $('#upload-photo-mobile').on('change', function () { 
                var reader = new FileReader();
                reader.onload = function (e) {
                $uploadCropMobile.bind({
                  url: e.target.result
                }).then(function(){
                    $uploadCropMobile.result('base64','viewport').then(function (resp) {
                      $("#upload-photo-result-mobile").val(resp);
                    });
                });
                
                }
              reader.readAsDataURL(this.files[0]);
              $("#btn-set-image-mobile").removeClass("hidden");
            });

            $("#upload-demo-mobile > .cr-boundary").on('click', function() {
               $("#upload-photo-mobile").click();
            });

            global.on("click","#btn-set-image-mobile", function(e){
                e.preventDefault();
                  $uploadCrop.result('base64','viewport').then(function (resp) {
                    $("#upload-photo-result-mobile").val(resp);
                    alert("gambar mobile berhasil diatur");
                  });
            });
            // end upload foto

            // get keluarga
              getArtikel().then((data)=>{
                  $("#loader").addClass("hidden");
                  if(data.status == 200){
                      let artikel        = data.data;

                      $("#id_artikel").val(artikel.id);
                      $("#title").val(artikel.title);
                      $("#url_key").val(artikel.url_key);
                      $("#category").val(artikel.category);
                      $("#short_description").val(artikel.short_description);
                      $("#content-value").val(artikel.content);
                      $("#summernote").summernote("code",artikel.content);

                      if(artikel.image_desktop !== "" && artikel.image_desktop !== null && artikel.image_desktop !== "null"){
                          $uploadCrop.bind({
                            url: "{{url('/')}}/public/img/artikel/"+artikel.image_desktop
                          }).then(function(){
                            $uploadCrop.result('base64','viewport').then(function (resp) {
                              $("#upload-photo-result").val(resp);
                            });
                          });
                      }

                      if(artikel.image_mobile !== "" && artikel.image_mobile !== null && artikel.image_mobile !== "null"){
                          $uploadCropMobile.bind({
                            url: "{{url('/')}}/public/img/artikel/"+artikel.image_mobile
                          }).then(function(){
                            $uploadCropMobile.result('base64','viewport').then(function (resp) {
                              $("#upload-photo-result-mobile").val(resp);
                            });
                          });
                      }            
                  }else{
                      alert("terjadi kesalahan");
                  }
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