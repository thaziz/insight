
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Inspeksi | Login</title>

    <link rel="stylesheet" type="text/css" href="{{asset('assetss/css/bootstrap.min.css')}}">    
    <link rel="stylesheet" type="text/css" href="{{asset('assetss/font-awesome/css/font-awesome.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assetss/css/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset ('assetss/js/izi-toast/css/iziToast.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('assetss/css/style.css')}}">
      <style type="text/css">
      body{
        background-color: #f1f1f1;
      }
      .form{
        margin: 50px auto;
        padding: 25px 20px;
        background: #333;
        box-shadow: 2px 2px 4px #a5a5a5;
        border-radius: 5px;
        color: #fff;
      }
      .form h2{
        margin-top: 0px;
        margin-bottom: 15px;
        padding-bottom: 5px;
        border-radius: 10px;
      }
      .footer{
        padding: 10px;
      }
    </style>

</head>

<body>
    <nav class="navbar-inverse">
      <div class="container-fluid"> 
        <div class="navbar-header"> 
          <button type="button" class="collapsed navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"> 
            <span class="sr-only">Toggle navigation</span> 
            <span class="icon-bar"></span> 
            <span class="icon-bar"></span> 
            <span class="icon-bar"></span> 
          </button> 
          <a href="#" class="navbar-brand"><!-- Code Grope --></a> 
        </div> 
        <div class="collapse navbar-collapse pull-right" id="navbar-collapse"> 
          
        </div> 
      </div>
    </nav>
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-sm-6 col-xs-12 col-md-offset-4 col-sm-offset-3">
            @if(Session::has('message'))
                <p class="alert {{ Session::get('alert-class', 'alert-warning') }}">{{ Session::get('message') }}</p>
            @endif
          <div class="bslf form">
            <form id="login">
              <h2 class="text-center">Main</h2>       
              <div class="form-group">
                 <input style="color: black" type="text" class="form-control" placeholder="Kode Main" name="kode">
              </div>
              <div class="form-group clearfix">
                <button type="button" class="btn btn-primary pull-right btn-block" onclick="main()">Main</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="navbar-default navbar-fixed-bottom">
      <div class="text-center footer">Copyright © 2018 Code Grope. All Right Reserved.</div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </body>

</html>

<script type="text/javascript">

var baseUrl = "{{url('/')}}";

</script>
<script>

   function main(){    
        var formInput=$('#login').serialize();        
         $.ajax({
          url     :  baseUrl+'/main/kode-login',
          type    : 'get', 
          data    :  formInput+"&_token={{ csrf_token() }}",
          dataType: 'json',
          success : function(response){    
                    if(response.status=='sukses'){
                        window.location = baseUrl+response.redirect;
                    }else if(response.status=='gagal'){
                        alert(response.data);

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