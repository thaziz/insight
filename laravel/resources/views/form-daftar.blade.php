<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Form Registrasi</title>

    <!-- Font special for pages-->
    <link rel="stylesheet" type="text/css" href="{{asset('assetss/font-awesome/css/font-awesome.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('assetss/css/bootstrap.min.css')}}"> 

    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assetss/register/main.css')}}">    
    
    
    <style type="text/css">
       

    </style>
</head>

<body>
    <div class="loader" style="display: none;"></div>
    <div class="page-wrapper bg-dark p-t-100 p-b-50">
        <div class="wrapper wrapper--w900">
            <div class="card card-6">
                <div class="card-heading">
                    <h2 class="title">Form Registrasi</h2>
                </div>
                <div class="card-body">                    
                    <form id="login">
                        <div class="alert alert-info" id="selamat" style="display: none;">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    Selamat...! Registrasi Berhasil. Silahkan Cek E-mail Untuk Aktivasi.
                        </div>
                        <div class="form-row">
                            <div class="name">Nama</div>
                            <div class="value">
                                <input class="input--style-6" type="text" name="nama">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Email</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-6" type="email" name="email" placeholder="contoh : example@email.com">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Password</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-6" type="password" name="password">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">No. Telpon</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-6" name="no_telpon">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <button class="btn btn--radius-2 btn--blue-2" type="button" onclick="register()">Daftar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="{{asset('assetss/js/jquery-2.1.1.js')}}"></script>


    <!-- Main JS-->
    <!-- <script src="js/global.js"></script> -->


<script type="text/javascript">
var baseUrl = "{{url('/')}}";
</script>

<script>
    
    

   function register(){            
        $('.loader').css('display','')
        $(".loader").fadeIn("slow");
        var formInput=$('#login').serialize();        
         $.ajax({
          url     :  baseUrl+'/register',
          type    : 'POST', 
          data    :  formInput+"&_token={{ csrf_token() }}",
          dataType: 'json',
          success : function(response){    
                    if(response.status=='sukses'){
                        $('#selamat').css('display','')
                        $(".loader").fadeOut("slow");
                    }else if(response.status=='gagal'){
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

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->