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
	                	<a href="{{route('index_user')}}" class="btn btn-default pull-right"><i class="fa fa-back"></i> Kembali</a>
                		</div>
                	</div>
                	<br>
                <div class="row">                	
                    
                    		<legend>Edit user</legend>
                    		

											
													<form id="form">
														<input type="hidden" name="id" value="{{$data->m_id}}">
														<div class="col-md-2 col-sm-6 col-xs-12">
															<label>Nama<span style="color: red"> *</span></label>
														</div>
														<div class="col-md-4 col-sm-6 col-xs-12">
															<div class="form-group form-group-sm">
<input type="text" class="form-control reset" name="nama" required autocomplete="off" value="{{$data->m_name}}">
															</div>
														</div>

														<div class="col-md-2 col-sm-6 col-xs-12">
															<label>NIP<span style="color: red"> *</span></label>
														</div>
														<div class="col-md-4 col-sm-6 col-xs-12">
															<div class="form-group form-group-sm" id="div_kategori">
																<input type="text" class="form-control reset" name="nip" required autocomplete="off" value="{{$data->m_nip}}">
															</div>
														</div>

														<div class="col-md-2 col-sm-6 col-xs-12">
															<label>Bidang<span style="color: red"> *</span></label>
														</div>
														<div class="col-md-4 col-sm-6 col-xs-12">
															<div class="form-group form-group-sm">
																<input type="text" class="form-control reset" name="bidang" required autocomplete="off" value="{{$data->m_bidang}}">
															</div>
														</div>


														<div class="col-md-2 col-sm-6 col-xs-12">
															<label>Email<span style="color: red"> *</span></label>
														</div>
														<div class="col-md-4 col-sm-6 col-xs-12">
															<div class="form-group form-group-sm">
																<input type="text" class="form-control reset" name="email" required autocomplete="off" value="{{$data->m_email}}">
															</div>
														</div>

														<div class="col-md-2 col-sm-6 col-xs-12">
															<label>Handphone<span style="color: red"> *</span></label>
														</div>
														<div class="col-md-4 col-sm-6 col-xs-12">
															<div class="form-group form-group-sm">
																<input type="number" class="form-control reset" name="hp" required autocomplete="off" value="{{$data->m_hp}}">
															</div>
														</div>

														<div class="col-md-2 col-sm-6 col-xs-12">
													<label>Role</label>
													</div>
													<div class="col-md-4 col-sm-6 col-xs-12">
														<div class="form-group">
														<select  class="form-control" name="role" id="role">
															<option @if($data->m_role=='User') selected="" @endif>User</option>
															<option @if($data->m_role=='Admin') selected="" @endif >Admin</option>			
														</select>
														</div>
													</div>

													<div class="col-md-2 col-sm-6 col-xs-12">
													<label>Ganti Password</label>
													</div>
													<div class="col-md-4 col-sm-6 col-xs-12">
														<div class="form-group">
														<select onchange="chekpwd()" class="form-control" name="chekpassword" id="chekpassword">
															<option>Tidak</option>	
															<option>Ya</option>
														</select>
														</div>
													</div>

													<div class="col-md-2 col-sm-6 col-xs-12 passwordb">
														<label>Password Baru</label>
													</div>
													<div class="col-md-4 col-sm-6 col-xs-12 passwordb">
														<div class="form-group">
														<input type="password" name="password_baru" class="form-control">
														</div>
													</div>

													</form>												
											
											
								
				</div>
					
					<div class="row">
										<div class="widget-footer enter pull-right">											
											<button type="button" class="btn btn-primary" onclick="simpan()">Simpan</button>
											<a href="{{route('index_user')}}" class="btn btn-default">Kembali</a>
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

	chekpwd();
function chekpwd(){	
	var chek=$('#chekpassword').val();	
	if(chek=='Tidak'){
		$('.passwordb').css('display','none')
	}
	else{
		$('.passwordb').css('display','')
	}
}

$.getJSON(addr_url, function(json){
    var $select_elem = $(".chosen-select");
    $select_elem.empty();
    $.each(json, function (idx, obj) {
    	console.log(obj.length)
    	for(x = 0;x < obj.length;x++) {  
        				$select_elem.append('<option value="' + obj[x].i_id + '">' + obj[x].i_nama+ '</option>');
        }

        
    });
    $select_elem.chosen({ width: "100%" });
})

             




	
        /*  placeholder: "Pilih Lokasi",
          ajax: {
            url: addr_url,
            dataType: 'json',
            data: function (params) {              
              return {
                  keyword: $.trim(params)                  
              };
            },
            results: function (res) {
            	
            	var user;
            	if(res.data.length > 0) {
            		for(x = 0;x < res.data.length;x++) {            			
        				res.data[x]['id'] = res.data[x].i_id;
        				res.data[x]['text'] = res.data[x].i_name;
            		}
            	}

                return {
                    results: res.data
                };
            },
            cache: true
          }, 
        });
	*/

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
					url : '{{route('update_user')}}',
					success : function(response){
						if (response.status == 'berhasil') {
							iziToast.success({							    
							    message: "<i class='fa fa-clock-o'></i> <i>Berhasil Disimpan!</i>",
							    position: 'topRight',
							});
							setTimeout(function () {
									window.location.href = "{{route('index_user')}}";	
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
