
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Insight | Login</title>

    <link rel="stylesheet" type="text/css" href="{{asset('assetss/css/bootstrap.min.css')}}">    
    <link rel="stylesheet" type="text/css" href="{{asset('assetss/font-awesome/css/font-awesome.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assetss/css/animate.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset ('assetss/js/izi-toast/css/iziToast.css') }}">
	<link rel="stylesheet" type="text/css" href="{{asset('assetss/css/style.css')}}">


</head>

<body class="gray-bg">
<div class="loader" style="display: none;"></div>
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>            
        	<br>            
            <br>            
            <br>            
            <br>            
            <h3>Login</h3>   



<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#home">Login</a></li>
  <li><a data-toggle="tab" href="#menu1">Register</a></li>
</ul>

<div class="tab-content">
  <div id="home" class="tab-pane fade in active">
     <form class="m-t" id="login">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="email" name="email">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="password" name="password">
                </div>
                <button type="button" class="btn btn-primary block full-width m-b" onclick="loginUser()">Login</button>
            </form>
            
  </div>
  <div id="menu1" class="tab-pane fade">
        

        <form class="m-t" id="register">
                        <div class="alert alert-info" id="selamat" style="display: none;">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    Selamat...! Registrasi Berhasil. Silahkan Cek E-mail Untuk Aktivasi.
                        </div>

            
                <div class="form-group">
                    <input type="text" class="form-control reset" placeholder="Nama" name="nama" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control reset" placeholder="contoh : example@email.com" name="email" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control reset" placeholder="password" name="password" autocomplete="off">
                </div>
                <div class="form-group">
                    <input type="" class="form-control reset" placeholder="No. Telpon" name="no_telpon" autocomplete="off">
                </div>
                 <button class="btn btn-primary block full-width m-b" type="button" onclick="register()">Daftar</button>
            </form>
  </div>
</div>                     



 
            
        </div>
    </div>
    <!-- Mainly scripts -->
    <script src="{{asset('assetss/js/jquery-2.1.1.js')}}"></script>	
	<script src="{{asset('assetss/js/bootstrap.min.js')}}"></script>	
</body>

</html>
<script src="{{ asset ('assetss/js/izi-toast/js/iziToast.js') }}"></script>
<script type="text/javascript">
var baseUrl = "{{url('/')}}";
</script>

<script>
    
    function loginUser(){    

        var formInput=$('#login').serialize();        
         $.ajax({
          url     :  baseUrl+'/login/masuk-member',
          type    : 'GET', 
          data    :  formInput+"&_token={{ csrf_token() }}",
          dataType: 'json',
          success : function(response){    
                    if(response.status=='sukses'){
                        window.location = baseUrl+response.redirect;
                    }else if(response.status=='gagal'){
                        alert(response.konten);

                    }
                    
          },
          error: function(jqXHR, exception) {
            if (jqXHR.status === 0) {
                alert('Not connect.\n Verify Network.');
            } else if (jqXHR.status == 404) {
                alert('Requested page not found. [404]');
            } else if (jqXHR.status == 500) {
                alert('');
                alert('Internal Server Error [500].');
            } else if (exception === 'parsererror') {
                alert('Anda Sudah Login');
                window.location="{{route('admin')}}";
                
            } else if (exception === 'timeout') {
                alert('Time out error.');
            } else if (exception === 'abort') {
                alert('Ajax request aborted.');
            } else {
                alert('Uncaught Error.\n' + jqXHR.responseText);
            }
        }


      });
    }

   function register(){            
        $('.loader').css('display','')
        $(".loader").fadeIn("slow");
        var formInput=$('#register').serialize();                
         $.ajax({
          url     :  baseUrl+'/register',
          type    : 'POST', 
          data    :  formInput+"&_token={{ csrf_token() }}",
          dataType: 'json',
          success : function(response){    
                    if(response.status=='sukses'){
                        $('#selamat').css('display','')
                        $(".loader").fadeOut("slow");
                        $(".reset").val('');
                        iziToast.success({                              
                                message: "<i class='fa fa-clock-o'></i> <i>"+response.konten+"</i>",
                                position: 'topRight',
                        });
                        
                    }else if(response.status=='gagal'){
                        iziToast.error({                                
                                message: "<i class='fa fa-clock-o'></i> <i>"+response.konten+"</i>",
                                position: 'topRight',
                            });
                        $('#selamat').css('display','none')
                        $(".loader").fadeOut("slow");

                    }
                    
          },

          error: function(jqXHR, exception) {
            if (jqXHR.status === 0) {
                alert('Not connect.\n Verify Network.');
                $(".loader").fadeOut("slow");
            } else if (jqXHR.status == 404) {
                alert('Requested page not found. [404]');
                $(".loader").fadeOut("slow");
            } else if (jqXHR.status == 500) {
                $(".loader").fadeOut("slow");
                alert('Internal Server Error [500].');
            } else if (exception === 'parsererror') {
                $(".loader").fadeOut("slow");
                alert('Requested JSON parse failed.');
                location.reload();
            } else if (exception === 'timeout') {
                $(".loader").fadeOut("slow");
                alert('Time out error.');
            } else if (exception === 'abort') {
                $(".loader").fadeOut("slow");
                alert('Ajax request aborted.');
            } else {
                $(".loader").fadeOut("slow");
                alert('Uncaught Error.\n' + jqXHR.responseText);
            }
        }


      });
    }

</script>
