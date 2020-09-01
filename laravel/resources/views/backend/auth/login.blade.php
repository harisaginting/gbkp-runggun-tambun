<!DOCTYPE html>

<html lang="en">
<head>
<base href="./">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
<title>GBKP</title>

<!-- Main styles for this application-->
<link href="{{url('public/assets/template/coreui')}}/node_modules/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<link href="{{url('public/assets/template/coreui')}}/src/css/style.css" rel="stylesheet">

<script src="{{url('public/assets/template/coreui')}}/node_modules/jquery/dist/jquery.min.js"></script>
<script src="{{url('public/assets/template/coreui')}}/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="{{url('public/assets/plugin/jquery-validation/dist/jquery.validate.min.js')}}" type="text/javascript" charset="utf-8"></script>
<script src="{{url('public/js/validate-config.js')}}" type="text/javascript" charset="utf-8"></script>
<style type="text/css">
    body{
      background: linear-gradient(to right bottom,#e6750a,#e6750a,#e6750a,#e6750a,#FFB658,#FFB658,#FFB658,#FFB658,#FFB658,#FFB658,#FFB658,#6168BE,#6168BE,#6168BE,#6168BE,#0D1575,#0D1575);
    }

    .btn-login{
      background-color: #e6750a;
      color: #fff;
    }
    .input-group-text{
        min-width: 40px;
        text-align: center;
    }

    .error-input-group{
        margin-top: -20px;
        display: block;
        position: initial;
    }

    .title-login-form{
      font-size: 1.5em;
      font-weight: 800;
    }
  </style>

</head>
<body class="app flex-row align-items-center">
  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="title-login-form text-center">BERSEKUTU MEMBANGUN GEREJA</div>
              <div class="card-group">
                  <div class="card p-4">
                      <div class="card-body">
                          <form id="form-login">
                            <div class="alert alert-danger alert-block col-12 d-none" id="errLogin">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                      @
                                    </span>
                                </div>
                                <input class="form-control" id="email" name="email" type="text" placeholder="email atau username" autocomplete="off" required>
                            </div>
                          <div class="input-group mb-4">
                              <div class="input-group-prepend">
                                  <span class="input-group-text">
                                  <i class="fa fa-lock"></i>
                                  </span>
                              </div>
                              <input class="form-control" type="password" name="password" id="password" placeholder="password" autocomplete="off" required>
                          </div>
                          <div class="row">
                              <div class="col-6">
                                  <button class="btn btn-login px-4" type="button" id="btn-login">Login</button>
                              </div>
                          </div>
                          </form>
                      </div>
                  </div>
                  <div class="card py-5 d-md-down-none" style="width:44%;background-color: #dedede99;">
                      <div class="card-body text-center">
                          <div>
                                <img src="{{url('/public/img/logo-gbkp.png')}}" width="100">
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</body>

<script type="text/javascript">
const f_email       = $("#email");
const f_password    = $("#password");
class Login {
      constructor(){}
      
      setToken(token){
        this.token  = token();
      }

      getToken(token){
        return this.token;
      }

      email     = () => {
        return f_email.val();
      }
      password  = () => {
        return f_password.val();
      }

      login = async(username, password) =>{
          let data = {"email": username, "password" : password};
          return await fetch("{{route('admin-login-process')}}", {
            method      : 'POST', // *GET, POST, PUT, DELETE, etc.
            mode        : 'cors', // no-cors, *cors, same-origin
            headers: {
              'Content-Type': 'application/json'
            },
            referrerPolicy: 'no-referrer',
            body: JSON.stringify(data)
          }).then(r => 
          r.json())
          .then(data => {
            return data;
          })
            .catch(error => {
              console.error('Error:', error);
          });
       }      
}
document.addEventListener('DOMContentLoaded', function () {
    const form = new Login();

    $(document).on("click","#btn-login",()=>{
        if($("#form-login").valid()){
            form.login(form.email(),form.password()).then((data)=>{
                f_email.attr("readOnly",true);
                f_password.attr("readOnly",true);
                if(data.status == 200){
                    localStorage.setItem('_token', data.data.token);
                    window.location.href = "{{url('/')}}"; 
                    // alert("selamat datang " + data.data.user.nama);
                }else{
                    m = "username atau password kamu salah";
                    if(data.message){
                        m = data.message;
                    }
                    f_email.attr("readOnly",false);
                    f_password.attr("readOnly",false);
                    $("#errLogin").removeClass("d-none");
                    $("#errLogin").text(m);
                }
            });
        }    
    });
});
</script>

</html>