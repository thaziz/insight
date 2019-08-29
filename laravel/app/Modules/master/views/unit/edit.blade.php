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
	                		<a href="{{route('index_unit')}}" class="btn btn-default pull-right"><i class="fa fa-back"></i> Kembali</a>
                		</div>
                	</div>
                	<br>
                <div class="row">                	
                    
                    		<legend>Edit Unit</legend>
                    		

											
													<form id="form">
														<input type="hidden" name="m_id">
														<div class="col-md-2 col-sm-6 col-xs-12">
															<label>Nama Induk<span style="color: red"> *</span></label>
														</div>
														<div class="col-md-4 col-sm-6 col-xs-12">
															<div class="form-group form-group-sm" id="div_kategori">
																<input type="hidden" class="form-control reset" name="id" value="{{$data->u_id}}" required autocomplete="off">

										<select name="nama_induk" data-placeholder="Choose a Country..." class="chosen-select" style="width:100%;" tabindex="2">
                
										</select>
															</div>
														</div>

														<div class="col-md-2 col-sm-6 col-xs-12">
															<label>Nama Unit<span style="color: red"> *</span></label>
														</div>
														<div class="col-md-4 col-sm-6 col-xs-12">
															<div class="form-group form-group-sm" id="div_kategori">
																<input type="text" class="form-control reset" name="nama_unit" value="{{$data->u_nama_unit}}" required autocomplete="off">
															</div>
														</div>


<div class="col-md-2 col-sm-6 col-xs-12">
	<label>Manager<span style="color: red"> *</span></label>
</div>
<div class="col-md-4 col-sm-6 col-xs-12">
	<div class="form-group form-group-sm" id="div_kategori">
		<input value="{{$data->u_manager}}" type="text" class="form-control reset"  name="manager" required autocomplete="off">
	</div>
</div>													

<div class="col-md-2 col-sm-6 col-xs-12">
	<label>K3<span style="color: red"> *</span></label>
</div>
<div class="col-md-4 col-sm-6 col-xs-12">
	<div class="form-group form-group-sm" id="div_kategori">
		<input type="text" value="{{$data->u_k3}}" class="form-control reset" name="k3" required autocomplete="off">
	</div>
</div>


														<div class="col-md-2 col-sm-6 col-xs-12">
															<label>Alamat<span style="color: red"> *</span></label>
														</div>
														<div class="col-md-10 col-sm-6 col-xs-12">
															<div class="form-group form-group-sm" id="div_kategori">
																<input type="text" class="form-control reset" name="alamat" value="{{$data->u_alamat}}" required autocomplete="off">
															</div>
														</div>

													</form>												
											
											
								
				</div>
					
					<div class="row">
										<div class="widget-footer enter pull-right">											
											<button type="button" class="btn btn-primary" onclick="simpan()">Simpan</button>
											<a href="{{route('index_unit')}}" class="btn btn-default">Kembali</a>
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
	
		var addr_url = '{{ url("master-induk/select-induk") }}';	

$.getJSON(addr_url, function(json){
    var $select_elem = $(".chosen-select");
    $select_elem.empty();
    $.each(json, function (idx, obj) {
    	console.log(obj.length)
    	for(x = 0;x < obj.length;x++) {  
        				$select_elem.append('<option value="' + obj[x].i_id + '">' + obj[x].i_nama+ '</option>');
        				
        	$(".chosen-select").val("{{$data->i_id}}").trigger("chosen:updated");
        }

        
    });
    $select_elem.chosen({ width: "100%" });
})
	

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
					url : '{{route('update_unit')}}',
					success : function(response){
						if (response.status == 'berhasil') {
							iziToast.success({							    
							    message: "<i class='fa fa-clock-o'></i> <i>Berhasil Disimpan!</i>",
							    position: 'topRight',
							});
							setTimeout(function () {
								window.location.href = "{{route('index_unit')}}";	
						    }, 200);
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
