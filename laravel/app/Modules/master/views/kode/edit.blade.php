@extends('main')

@section('content')


<div class="wrapper wrapper-content animated fadeIn">
<div class="p-w-md m-t-sm">
    
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">



                <div class="ibox-content">
                	<div class="row">
                		<div class="col-sm-12">
	                		<a href="{{route('index_kode')}}" class="btn btn-default pull-right"><i class="fa fa-back"></i> Kembali</a>
                		</div>
                	</div>
                	<br>
                <div class="row">                	
                    
                    		<legend>Edit kode</legend>
                    		<form id="form">
														<div class="col-md-2 col-sm-6 col-xs-12">
															<label>Masa Berlaku<span style="color: red"> *</span></label>
														</div>
														<div class="col-md-4 col-sm-6 col-xs-12">
															<div class="form-group form-group-sm" id="div_kategori">
																<input type="hidden" name="id" value="{{$data->kode_id}}">
																<input type="text" class="form-control" name="masa_berlaku" required autocomplete="off" value="{{$data->masa_berlaku}}">
															</div>
														</div>
														<div class="col-md-2 col-sm-6 col-xs-12">
															<label>Jumlah Main<span style="color: red"> *</span></label>
														</div>
														<div class="col-md-4 col-sm-6 col-xs-12">
															<div class="form-group form-group-sm" id="div_kategori">
																<input type="text" class="form-control" name="jumlah_main" required autocomplete="off" value="{{$data->jumlah_main}}">
															</div>
														</div>

														<div class="col-md-2 col-sm-6 col-xs-12">
															<label>Group<span style="color: red"> *</span></label>
														</div>
														<div class="col-md-4 col-sm-6 col-xs-12">
															<div class="form-group form-group-sm" id="div_kategori">
																<select class="form-control" name="group">
																	@foreach($group as $g)
																	<option value="{{$g->g_id}}">{{$g->g_nama}}</option>
																	@endforeach
																</select>
															</div>
														</div>


														<div class="col-md-2 col-sm-6 col-xs-12">
															<button type="button" class="btn btn-warning btn-sm" id="generate">Bikin Kode</button>
														</div>
														<div class="col-md-2 col-sm-6 col-xs-12">
															<div class="form-group form-group-sm" id="div_kategori">
																<input type="text" class="form-control kode" id="kode" name="kode" required autocomplete="off"
																readonly="" value="{{$data->kode}}">
															</div>
														</div>

														<div class="col-md-2 col-sm-6 col-xs-12">
								<button type="button" onclick="myFunction()" class="btn btn-warning btn-sm">Copy</button>
														</div>
													</form>												
											
											

											
												
								
				</div>
					
					<div class="row">
										<div class="widget-footer enter pull-right">											
											<button type="button" class="btn btn-primary" onclick="simpan()">Simpan</button>
											<a href="{{route('index_kode')}}" class="btn btn-default">Kembali</a>
										</div>

					</div>

                    
                </div>
            </div>
        </div>
    </div>

</div>
</div>

@endsection
@section('extra_scripts')
<script type="text/javascript">
	
		
function myFunction() {
  var copyText = document.getElementById("kode");
  copyText.select();
  document.execCommand("copy");
  /*alert("Copied the text: " + copyText.value);*/
}
	

		function simpan(){
			if (validation()) {
				overlayshow();
				$.ajaxSetup({
					headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				$.ajax({
					type: 'POST',
					data: $('#form').serialize()+"&_token={{ csrf_token() }}",
					dataType: 'json',
					url : baseUrl + '/master-kode/update',
					success : function(response){
						if (response.status == 'berhasil') {
							iziToast.success({							    
							    message: "<i class='fa fa-clock-o'></i> <i>Berhasil Disimpan!</i>",
							    position: 'topRight',
							});

							setTimeout(function () {            
   							window.location.href = "{{route('index_kode')}}";	
      						}, 1000);							
							
						} else {							
							iziToast.error({							    
							    message: response.pesan,
							    position: 'topRight',
							});
						}
						overlayhide();
					}
				});
			}
		}

		function validation(){		
			var kategori = $('input[name="k_name"]').val();

			if (kategori == "") {
				$('#div_kategori').addClass('has-error');
				return false;
			} else {
				$('#div_kategori').css('box-shadow', '0 0 5px green');
				$('#div_kategori').removeClass('has-error');
			}

			
			return true;
		}
</script>
@endsection
