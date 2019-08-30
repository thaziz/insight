



	
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

		function notif(){
			$.ajax({
					type: 'POST',
					url: baseUrl+'/lnotif',
					data: {
					        "_token": "{{ csrf_token() }}",
					      },
					success : function(response){
						$('#lnotif').html(response);						
					}
				});
		}

notif();   
setInterval(function(){
notif();   
}, 60000);


function overlayshow(){
	$.LoadingOverlay("show");
}
	
function overlayhide(){
	setTimeout(function(){
    $.LoadingOverlay("hide");
	}, 50);
}
	
	

	</script>
