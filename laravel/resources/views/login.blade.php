
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

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>            
        	<br>            
            <br>            
            <br>            
            <br>            
            <h3>Login</h3>                        
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
    </div>
    <!-- Mainly scripts -->
    <script src="{{asset('assetss/js/jquery-2.1.1.js')}}"></script>	
	<script src="{{asset('assetss/js/bootstrap.min.js')}}"></script>	
</body>

</html>

<script type="text/javascript">

var baseUrl = "{{url('/')}}";

</script>
<script>

   function loginUser(){    

        var formInput=$('#login').serialize();        
         $.ajax({
          url     :  baseUrl+'/login/masuk',
          type    : 'POST', 
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
                alert('Requested JSON parse failed.');
                location.reload();
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

</script>