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
                    		

											
						<form id="form">
							<input type="hidden" name="m_id">						

							<div class="col-md-2 col-sm-6 col-xs-12">
								<label>Paket <span style="color: red"> *</span></label>
							</div>
							<div class="col-md-10 col-sm-6 col-xs-12">
								<div class="form-group form-group-sm" id="div_kategori">
									<select class="form-control">
										@foreach($paket as $p)
										<option>{{$p->mp_paket}} - {{$p->mp_nominal}} ({{$p->mp_ket}}) </option>
										@endforeach
									</select>
								</div>
							</div>

							<div class="col-md-2 col-sm-6 col-xs-12">
								<label>Bank <span style="color: red"> *</span></label>
							</div>
							<div class="col-md-10 col-sm-6 col-xs-12">
								<div class="form-group form-group-sm" id="div_kategori">
									<select class="form-control">
										@foreach($bank as $b)
										<option>{{$b->ba_name}} - A/N. {{$b->ba_an}} - No Rek.({{$b->ba_no_rek}})</option>
										@endforeach
									</select>
								</div>
							</div>

							<div class="col-md-2 col-sm-6 col-xs-12">
								<label>Bukti Transfer <span style="color: red"> *</span></label>
							</div>
							<div class="col-md-10 col-sm-6 col-xs-12">
								<div class="form-group form-group-sm" id="div_kategori">
									<input type="file" name="">
								</div>
							</div>

						</form>												
											
											
					</fieldset>					
				</div>
					

										<div class="widget-footer enter">											
											<button type="button" class="btn btn-primary" onclick="simpan()">Simpan</button>
											<a href="" class="btn btn-default">Kembali</a>
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
	
		$("#m_name").autocomplete({
			source: baseUrl + '/user/user/getpegawai',
			select: function(event, ui) {
				getdata(ui.item.id);
			}, messages: {
		        noResults: '',
    		    results: function() {}
	    	}

		});

		function getdata(id){
			$.ajax({
				type: 'get',
				data:{id},
				dataType: 'JSON',
				url: baseUrl + '/user/user/getdetailpegawai',
				success : function(response){
					$('input[name=m_nik]').val(response[0].m_nik);
					$('textarea[name=m_address]').val(response[0].m_address);
					$('input[name=m_nohp]').val(response[0].m_nohp);
					$('input[name=m_email]').val(response[0].m_email);
					$('input[name=m_id]').val(response[0].m_id);
				}
			});
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
					type: 'get',
					data: 'akses=simpan&'+$('#form').serialize(),
					dataType: 'json',
					url : baseUrl + '/master/kategori-barang/simpan',
					success : function(response){
						if (response.status == 'berhasil') {
							iziToast.success({							    
							    message: "<i class='fa fa-clock-o'></i> <i>Berhasil Disimpan!</i>",
							    position: 'topRight',
							});
							$('input[name="k_name"]').val('');
							/*window.location.href = baseUrl + '/user/user/user';*/
						} else {							
							iziToast.error({							    
							    message: "<i class='fa fa-clock-o'></i> <i>Gagal Disimpan</i>",
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
