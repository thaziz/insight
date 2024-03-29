
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Lucky Spin</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('img/icon.png')}}">    


    
    <link rel="stylesheet" type="text/css" href="{{asset('assetss/css/bootstrap.min.css')}}">    
    <link rel="stylesheet" type="text/css" href="{{asset('assetss/font-awesome/css/font-awesome.css')}}">
    
    <link rel="stylesheet" type="text/css" href="{{asset('assetss/css/plugins/toastr/toastr.min.css')}}">
    

    
<link rel="stylesheet" type="text/css" href="{{asset('assetss/js/plugins/gritter/jquery.gritter.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assetss/css/animate.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset ('assetss/js/izi-toast/css/iziToast.css') }}">
<link rel="stylesheet" type="text/css" href="{{asset('assetss/css/style.css')}}">
<link type="text/css" rel="stylesheet" href="{{ asset ('assetss/css/plugins/dataTables/datatables.min.css') }}">
<link type="text/css" rel="stylesheet" href="{{ asset ('assetss/css/plugins/select2/select2.min.css') }}">


    <link href="{{ asset ('assetss/css/plugins/chosen/chosen.css') }}"  rel="stylesheet">

    <link href="{{ asset ('assetss/css/plugins/datapicker/datepicker3.css') }}"  rel="stylesheet">
</head>


    <!-- Main Section -->
    <section class="main-section">
        <!-- Add Your Content Inside -->
        <div class="content">
            <!-- Remove This Before You Start -->
            <h1>Anak IT -  Send Email</h1>
            @if(\Session::has('alert-failed'))
                <div class="alert alert-failed">
                    <div>{{Session::get('alert-failed')}}</div>
                </div>
            @endif
            @if(\Session::has('alert-success'))
                <div class="alert alert-success">
                    <div>{{Session::get('alert-success')}}</div>
                </div>
            @endif
            <form action="{{ url('/sendEmail') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="form-group">
                    <label for="nama">Nama:</label>
                    <input type="text" class="form-control" id="name" name="nama"/>
                </div>
                <div class="form-group">
                    <label for="judul">Judul:</label>
                    <input type="text" class="form-control" id="judul" name="judul"/>
                </div>
                <div class="form-group">
                    <label for="pesan">Pesan:</label>
                    <textarea class="form-control" id="pesan" name="pesan"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-md btn-primary">Send Email</button>
                </div>
            </form>
        </div>
        <!-- /.content -->
    </section>
    <!-- /.main-section -->






    
    <!-- Mainly scripts -->
    <script src="{{asset('assetss/js/jquery-2.1.1.js')}}"></script>
    
    <script src="{{asset('assetss/js/bootstrap.min.js')}}"></script>    
    <script src="{{asset('assetss/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>   
    <script src="{{asset('assetss/js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
    

    <!-- Flot -->
    <script src="{{asset('assetss/js/plugins/flot/jquery.flot.js')}}"></script> 
    <script src="{{asset('assetss/js/plugins/flot/jquery.flot.tooltip.min.js')}}"></script> 
    <script src="{{asset('assetss/js/plugins/flot/jquery.flot.spline.js')}}"></script>  
    <script src="{{asset('assetss/js/plugins/flot/jquery.flot.resize.js')}}"></script>  
    <script src="{{asset('assetss/js/plugins/flot/jquery.flot.pie.js')}}"></script>

    <!-- Peity -->  
    <script src="{{asset('assetss/js/plugins/peity/jquery.peity.min.js')}}"></script>   
    <script src="{{asset('assetss/js/demo/peity-demo.js')}}"></script>

    <!-- Custom and plugin javascript -->   
    <script src="{{asset('assetss/js/inspinia.js')}}"></script> 
    <script src="{{asset('assetss/js/plugins/pace/pace.min.js')}}"></script>

    <!-- jQuery UI -->    
    <script src="{{asset('assetss/js/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <!-- GITTER --> 
    <script src="{{asset('assetss/js/plugins/gritter/jquery.gritter.min.js')}}"></script>

    <!-- Sparkline -->  
    <script src="{{asset('assetss/js/plugins/sparkline/jquery.sparkline.min.js')}}"></script>

    <!-- Sparkline demo data  -->   
    <script src="{{asset('assetss/js/demo/sparkline-demo.js')}}"></script>

    <!-- ChartJS--> 
    <script src="{{asset('assetss/js/plugins/chartJs/Chart.min.js')}}"></script>

    <!-- Toastr -->    
    <script src="{{asset('assetss/js/plugins/toastr/toastr.min.js')}}"></script>


    <script src="{{ asset('assetss/js/plugins/autocomplete/autocomplete.js') }}"></script>

    <script src="{{asset('assetss/js/loadingoverlay.min.js')}}"></script>

    <script src="{{asset('assetss/js/loadingoverlay.js')}}"></script>

    <script src="{{ asset ('assetss/js/izi-toast/js/iziToast.js') }}"></script>

    <script src="{{ asset ('assetss/js/plugins/dataTables/datatables.min.js') }}"></script>


    <!-- JQUERY SELECT2 INPUT -->
        <!-- <script src="{{asset('assets/js/plugin/select2/select2.min.js')}}"></script> -->

        <script src="{{asset('assetss/js/plugins/chosen/chosen.jquery.js')}}"></script>

        <script src="{{asset('assetss/js/plugins/datapicker/bootstrap-datepicker.js')}}"></script>


<script src="{{asset('assetss/js/Winwheel.js')}}"></script>


<script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenMax.min.js"></script>
        
        <!-- <script src="{{asset('assetss/js/demo/chartjs-demo.js')}}"></script> -->
         
    

         


    <script type="text/javascript">
        var baseUrl = "{{url('/')}}";
    </script>
    <script type="text/javascript"> 
             var dataTableLanguage = {
           "emptyTable": "Tidak ada data",
           "sInfo": "Menampilkan _START_ - _END_ Dari _TOTAL_ Baris",
           "sSearch": 'Pencarian..',
           "sLengthMenu": "Menampilkan &nbsp; _MENU_ &nbsp; Data",
           "paginate": {
                "previous": "Sebelumnya",
                "next": "Selanjutnya",
             }
          }

        function logout(){
            $.ajax({
                    type: 'post',
                    url: baseUrl+'/logout',

                    data: {
                            "_token": "{{ csrf_token() }}",
                          },
                    success : function(response){
                        window.location=baseUrl;
                    }
                });
        }
function overlayshow(){
    $.LoadingOverlay("show");
}

function overlayhide(){
    setTimeout(function(){
    $.LoadingOverlay("hide");
    }, 50);
}
                    
    </script>
