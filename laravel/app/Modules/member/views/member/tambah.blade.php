@extends('main')

@section('content')


<div class="wrapper wrapper-content animated fadeIn">
<div class="p-w-md m-t-sm">
    
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">



                <div class="ibox-content">
                	<div class="row">                		
                	</div>
                	<br>
                <div class="row">                	
                    <fieldset class="col-md-12 col-sm-12 col-xs-12">                    	
                    		<legend>Registrasi</legend>
                    		

											
							<form  enctype="multipart/form-data" id="uploadForm" autocomplete="off">	{{ csrf_field() }}										
							<div class="col-md-2 col-sm-6 col-xs-12">
								<label>No Invoice <span style="color: red"> *</span></label>
							</div>
							<div class="col-md-4 col-sm-6 col-xs-12">
								<div class="form-group form-group-sm" id="div_kategori">
									<input class="form-control" type="" name="no" readonly="" value="{{$no}}">
									<input class="form-control" type="hidden" name="u_id" readonly="" value="{{$data->u_id}}">
								</div>
							</div>
							<div class="col-md-2 col-sm-6 col-xs-12">
								<label>Nama <span style="color: red"> *</span></label>
							</div>
							<div class="col-md-4 col-sm-6 col-xs-12">
								<div class="form-group form-group-sm" id="div_kategori">
									<input class="form-control" type="" name="" readonly="" value="{{$data->m_username}}">
								</div>
							</div>

							<div class="col-md-2 col-sm-6 col-xs-12">
								<label>Email <span style="color: red"> *</span></label>
							</div>
							<div class="col-md-4 col-sm-6 col-xs-12">
								<div class="form-group form-group-sm" id="div_kategori">
									<input class="form-control" type="" name="" readonly="" value="{{$data->m_email}}">
								</div>
							</div>


							<div class="col-md-2 col-sm-6 col-xs-12">
								<label>No Telpon <span style="color: red"> *</span></label>
							</div>
							<div class="col-md-4 col-sm-6 col-xs-12">
								<div class="form-group form-group-sm" id="div_kategori">
									<input class="form-control" type="" name="" readonly="" value="{{$data->m_hp}}">
								</div>
							</div>




							<div class="col-md-2 col-sm-6 col-xs-12">
								<label>Paket <span style="color: red"> *</span></label>
							</div>
							<div class="col-md-4 col-sm-6 col-xs-12">
								<div class="form-group form-group-sm" id="div_kategori">
									<select class="form-control" name="paket" id="paket">
										<option value="">--Pilih--</option>
										@foreach($paket as $p)
										<option data-p="{{$p->mp_nominal}}" value="{{$p->mp_id}}">{{$p->mp_paket}} - {{$p->mp_nominal}} ({{$p->mp_ket}}) </option>
										@endforeach
									</select>
									<input type="hidden" name="nominal" id="nominal">
								</div>
							</div>

							<div class="col-md-2 col-sm-6 col-xs-12">
								<label>Bank <span style="color: red"> *</span></label>
							</div>
							<div class="col-md-4 col-sm-6 col-xs-12">
								<div class="form-group form-group-sm" id="div_kategori">
									<select id="rek" class="form-control" name="bank">
										<option value="">--Pilih--</option>
										@foreach($bank as $b)
										<option data-rek="{{$b->ba_no_rek}}">{{$b->ba_name}} - A/N. {{$b->ba_an}}</option>
										@endforeach
									</select>
								</div>
							</div>

							<div class="col-md-2 col-sm-6 col-xs-12">
								<label>Bukti Transfer <span style="color: red"> *</span></label>
							</div>

							<div class="col-md-4 col-sm-6 col-xs-12">
								<div class="form-group form-group-sm" id="div_kategori">
									<input class="form-control" type="file" name="lbukti_transfer">
								</div>
							</div>

							<div class="col-md-2 col-sm-6 col-xs-12">
								<label>No Rek <span style="color: red"> *</span></label>
							</div>
							<div class="col-md-4 col-sm-6 col-xs-12">
								<div class="form-group form-group-sm" id="div_kategori">
									<input type="" name="rek" class="form-control" readonly="" id="norek">
								</div>
							</div>							
																
					</fieldset>					
				</div>					

										<div class="widget-footer enter">											
											<button type="submit" class="btn btn-primary">Simpan</button>
											<a href="{{route('member-aktifasi')}}" class="btn btn-default">Kembali</a>

										</div>
	</form>	
                    
                </div>
            </div>
        </div>
    </div>

</div>
</div>






















@endsection
@section('extra_scripts')
<script type="text/javascript">	
		
		$("#uploadForm").on('submit',(function(e) {	
			e.preventDefault();
			$('.loader').css('display','')
        	$(".loader").fadeIn("slow");
			
				$.ajax({
					type: 'POST',					
					dataType: 'json',
					data:  new FormData(this),
					contentType: false,
					dataType: 'json',
    	    		cache: false,
					processData:false,
					url : "{{route('perpanjangan')}}",
					success : function(response){
						if (response.status == 'berhasil') {
							$(".loader").fadeOut("slow");
							iziToast.success({							    
							    message: "<i class='fa fa-clock-o'></i> <i>Berhasil Disimpan!</i>",
							    position: 'topRight',
							});
							$('input[name="k_name"]').val('');
							window.location.href = baseUrl + '/member-aktifasi/index';
						} else {							
							iziToast.error({							    
							    message: "<i class='fa fa-clock-o'></i> <i>"+response.konten+"</i>",
							    position: 'topRight',
							});
							$(".loader").fadeOut("slow");
						}
						$(".loader").fadeOut("slow");
					}
				});
			
		})
		)

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

	

	$("#rek").on("change", function(){        
        $("#norek").val(($(this).find(':selected').data('rek')));        
    });
    $("#paket").on("change", function(){        
        $("#nominal").val(($(this).find(':selected').data('p')));        
    });
</script>
@endsection
