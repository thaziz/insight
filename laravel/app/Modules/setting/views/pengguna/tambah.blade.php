@extends('main')

@section('content')


<div class="wrapper wrapper-content animated fadeIn">
@include('setting::pengguna.modal_grub')
<div class="p-w-md m-t-sm">
    
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">



                <div class="ibox-content">
                	<div class="row">
                		<div class="col-sm-12">
	                		<a href="{{route('tambah_user')}}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Tambah</a>
                		</div>
                	</div>
                	<br>
                    <fieldset>
                    		<legend>Informasi Pengguna</legend>
											<div class="row">

											<form id="formpegawai">
												<input type="hidden" name="m_id">
												<div class="col-md-3 col-sm-6 col-xs-12">
													<label>Nama Pegawai</label>
												</div>
												<div class="col-md-3 col-sm-6 col-xs-12">
													<div class="form-group form-group-sm" id="divm_name">
														<input type="text" class="form-control required" name="m_name" id="m_name" required autocomplete="off">
													</div>
												</div>

												<div class="col-md-3 col-sm-6 col-xs-12">
													<label>No. HP</label>
												</div>
												<div class="col-md-3 col-sm-6 col-xs-12">
													<div class="form-group form-group-sm" id="divm_nohp">
														<input type="text" class="form-control" readonly name="m_nohp" required>
													</div>
												</div>

												<div class="col-md-3 col-sm-6 col-xs-12">
													<label>NIK</label>
												</div>
												<div class="col-md-3 col-sm-6 col-xs-12">
													<div class="form-group form-group-sm" id="divm_nik">
														<input type="text" class="form-control" readonly name="m_nik" required>
													</div>
												</div>
												<div class="col-md-3 col-sm-6 col-xs-12">
													<label>E-mail</label>
												</div>
												<div class="col-md-3 col-sm-6 col-xs-12">
													<div class="form-group form-group-sm" id="divm_email">
														<input type="email" class="form-control" readonly name="m_email" required>
													</div>
												</div>

												<div class="col-md-3 col-sm-6 col-xs-12">
													<label>Address</label>
												</div>
												<div class="col-md-9 col-sm-6 col-xs-12">
													<div class="form-group" id="divm_address">
														<textarea rows="3" class="form-control" readonly name="m_address" required></textarea>
													</div>
												</div>
												<div class="col-md-3 col-sm-6 col-xs-12">
													<label>Username</label>
												</div>
												<div class="col-md-3 col-sm-6 col-xs-12">
													<div class="form-group form-group-sm" id="divm_username">
														<input type="text" class="form-control" name="m_username" required>
													</div>
												</div>

												<div class="col-md-3 col-sm-6 col-xs-12">
													<label>Password</label>
												</div>
												<div class="col-md-3 col-sm-6 col-xs-12">
													<div class="form-group form-group-sm" id="divm_passwd">
														<input type="password" class="form-control" name="m_passwd" required>
													</div>
												</div>
												</form>
											</div>
										</fieldset>

										<div class="enter">      
											<div class="row">
												<form id="formgroup">
												@for($i=0;$i<count($group);$i++)

												<div class="col-xl-1 col-lg-2 col-md-3 col-sm-4 col-xs-12">

													<div class="form-group">
														<label><input type="checkbox" onchange="klikgroup({{$group[$i]->g_id}})" id="klikgroup-{{$group[$i]->g_id}}" class="checkbox"> <span class="btn-grup-detail">{{$group[$i]->g_name}}</span></label>
														<input type="hidden" name="group[]" id="group-{{$group[$i]->g_id}}">
													</div>
												@endfor
												</form>


											</div>
										</div>
										<div class="table-responsive enter">      
											<table class="table table-hover table-bordered" style="overflow: scroll">
												<thead>
													<tr>
														<th>Menu</th>
														<th>View</th>
														<th>Create</th>
														<th>Update</th>
														<th>Delete</th>
														<th>Print</th>
													</tr>
												</thead>
												<tbody>
													<form id="formakses">
													@foreach ($menu as $key => $value)
														@if ($value->m_parent == null)
															<tr>
																<td class="font-weight-bold">
																	{{$value->m_name}}
																	<input type="hidden" name="id_access[]" value="{{$value->m_id}}">
																</td>
																<td align="center">
																	<label><input type="checkbox" onchange="klikview({{$value->m_id}})" id="pview-{{$value->m_id}}" class="checkbox"> <span></span></label>
																	<input type="hidden" name="view[]" id="inputview-{{$value->m_id}}" value="N">
																</td>
																<td align="center">
																	<label><input type="checkbox" onchange="klikcreate({{$value->m_id}})" id="pcreate-{{$value->m_id}}" class="checkbox"> <span></span></label>
																	<input type="hidden" name="create[]" id="inputcreate-{{$value->m_id}}" value="N">
																</td>
																<td align="center">
																	<label><input type="checkbox" onchange="klikupdate({{$value->m_id}})" id="pupdate-{{$value->m_id}}" class="checkbox"> <span></span></label>
																	<input type="hidden" name="update[]" id="inputupdate-{{$value->m_id}}" value="N">
																</td>
																<td align="center">
																	<label><input type="checkbox" onchange="klikdelete({{$value->m_id}})" id="pdelete-{{$value->m_id}}" class="checkbox"> <span></span></label>
																	<input type="hidden" name="delete[]" id="inputdelete-{{$value->m_id}}" value="N">
																</td>
																<td align="center">
																	<label><input type="checkbox" onchange="klikprint({{$value->m_id}})" id="pprint-{{$value->m_id}}" class="checkbox"> <span></span></label>
																	<input type="hidden" name="print[]" id="inputprint-{{$value->m_id}}" value="N">
																</td>
															</tr>
														@else
															<tr>
																<td>&nbsp; {{' '}} {{$value->m_name}} <input type="hidden" name="id_access[]" value="{{$value->m_id}}"></td>
																<td align="center">
																	<label><input type="checkbox" id="view-{{$value->m_parent}}" class="checkbox view-{{$value->m_id}}"> <span></span></label>
																	<input type="hidden" name="view[]" id="inputview1-{{$value->m_parent}}" value="N">
																</td>
																<td align="center">
																	<label><input type="checkbox" id="create-{{$value->m_parent}}" class="checkbox create-{{$value->m_id}}"> <span></span></label>
																	<input type="hidden" name="create[]" id="inputcreate1-{{$value->m_parent}}" value="N">
																</td>
																<td align="center">
																	<label><input type="checkbox" id="update-{{$value->m_parent}}" class="checkbox update-{{$value->m_id}}"> <span></span></label>
																	<input type="hidden" name="update[]" id="inputupdate1-{{$value->m_parent}}" value="N">
																</td>
																<td align="center">
																	<label><input type="checkbox" id="delete-{{$value->m_parent}}" class="checkbox delete-{{$value->m_id}}"> <span></span></label>
																	<input type="hidden" name="delete[]" id="inputdelete1-{{$value->m_parent}}" value="N">
																</td>
																<td align="center">
																	<label><input type="checkbox" id="print-{{$value->m_parent}}" class="checkbox print-{{$value->m_id}}"> <span></span></label>
																	<input type="hidden" name="print[]" id="inputprint1-{{$value->m_parent}}" value="N">
																</td>
															</tr>
														@endif
													@endforeach
													</form>
												</tbody>
											</table>
										</div>
										<div class="widget-footer">
											<button type="button" class="btn btn-primary" onclick="simpan()">Simpan</button>
											<a href="{{route('user_index')}}" class="btn btn-default">Kembali</a>
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

		function klikview(id){
			if ($('#pview-'+id).prop('checked')) {
				$('#view-'+id).prop('checked', true);
				$('#inputview-'+id).val('Y');
				$('#inputview1-'+id).val('Y');
			} else {
				$('#view-'+id).prop('checked', false);
				$('#inputview-'+id).val('N');
				$('#inputview1-'+id).val('N');
			}
		}

		function klikcreate(id){
			if ($('#pcreate-'+id).prop('checked')) {
				$('#create-'+id).prop('checked', true);
				$('#inputcreate-'+id).val('Y');
				$('#inputcreate1-'+id).val('Y');
			} else {
				$('#create-'+id).prop('checked', false);
				$('#inputcreate-'+id).val('N');
				$('#inputcreate1-'+id).val('N');
			}
		}

		function klikupdate(id){
			if ($('#pupdate-'+id).prop('checked')) {
				$('#update-'+id).prop('checked', true);
				$('#inputupdate-'+id).val('Y');
				$('#inputupdate1-'+id).val('Y');
			} else {
				$('#update-'+id).prop('checked', false);
				$('#inputupdate-'+id).val('N');
				$('#inputupdate1-'+id).val('N');
			}
		}

		function klikdelete(id){
			if ($('#pdelete-'+id).prop('checked')) {
				$('#delete-'+id).prop('checked', true);
				$('#inputdelete-'+id).val('Y');
				$('#inputdelete1-'+id).val('Y');
			} else {
				$('#delete-'+id).prop('checked', false);
				$('#inputdelete-'+id).val('Y');
				$('#inputdelete1-'+id).val('Y');
			}
		}

		function klikprint(id){
			if ($('#pprint-'+id).prop('checked')) {
				$('#print-'+id).prop('checked', true);
				$('#inputprint-'+id).val('Y');
				$('#inputprint1-'+id).val('Y');
			} else {
				$('#print-'+id).prop('checked', false);
				$('#inputprint-'+id).val('N');
				$('#inputprint1-'+parrent).val('N');
			}
		}

		function klikgroup(id){
			var html = '';
			if ($('#klikgroup-'+id).prop('checked')) {
				$.ajax({
					type: 'get',
					url: baseUrl + '/user/user/getgroup',
					dataType: 'JSON',
					data: {id:id},
					success : function(response){
						for (var i = 0; i < response.length; i++) {
							if (response[i].gm_read == "Y") {
									$('#viewmd-'+response[i].gm_menu).prop('checked', true);
							}
							if (response[i].gm_insert == "Y") {
									$('#createmd-'+response[i].gm_menu).prop('checked', true);
							}
							if (response[i].gm_update == "Y") {
									$('#updatemd-'+response[i].gm_menu).prop('checked', true);
							}
							if (response[i].gm_print == "Y") {
									$('#printmd-'+response[i].gm_menu).prop('checked', true);
							}
						}
						$('#detail_grub').modal('show');
					}
				});
				$('#group-'+id).val(id);
			} else {
				$('#group-'+id).val('');
			}
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
					data: 'akses=simpan&'+$('#formakses').serialize()+'&'+$('#formpegawai').serialize()+'&'+$('#formgroup').serialize(),
					dataType: 'json',
					url : baseUrl + '/setting/hak-akses-pengguna/simpan',
					success : function(response){
						if (response == 'berhasil') {
							$.smallBox({
								title : "Info!",
								content : "<i class='fa fa-clock-o'></i> <i>Berhasil Disimpan!</i>",
								color : "#659265",
								iconSmall : "fa fa-check fa-2x fadeInRight animated",
								timeout : 4000
							});
							window.location.href = baseUrl + '/user/user/user';
						} else {
							$.smallBox({
								title : "Info!",
								content : "<i class='fa fa-clock-o'></i> <i>Gagal Disimpan</i>",
								color : "#C46A69",
								iconSmall : "fa fa-times fa-2x fadeInRight animated",
								timeout : 4000
							});
						}
						overlayhide();
					}
				});
			}
		}

		function validation(){
			var nama = $('input[name="m_name"]').val();
			var nik = $('input[name="m_nik"]').val();
			var address = $('textarea[name="m_address"]').val();
			var username = $('input[name="m_username"]').val();
			var nohp = $('input[name="m_nohp"]').val();
			var email = $('input[name="m_email"]').val();
			var password = $('input[name="m_passwd"]').val();

			if (nama == "") {
				$('#divm_name').addClass('has-error');
				return false;
			} else {
				$('#divm_name').css('box-shadow', '0 0 5px green');
				$('#divm_name').removeClass('has-error');
			}

			if (nik == "") {
				$('#divm_nik').addClass('has-error');
				return false;
			} else {
				$('#divm_nik').css('box-shadow', '0 0 5px green');
				$('#divm_nik').removeClass('has-error');
			}

			if (address == "") {
				$('#divm_address').css('box-shadow', '0 0 5px red');
				$('#divm_address').addClass('has-error');
				return false;
			} else {
				$('#divm_address').css('box-shadow', '0 0 5px green');
				$('#divm_address').removeClass('has-error');
			}

			if (username == "") {
				$('#divm_username').addClass('has-error');
				return false;
			} else {
				$('#divm_username').css('box-shadow', '0 0 5px green');
				$('#divm_username').removeClass('has-error');
			}

			if (nohp == "") {
				$('#divm_nohp').addClass('has-error');
				return false;
			} else {
				$('#divm_nohp').css('box-shadow', '0 0 5px green');
				$('#divm_nohp').removeClass('has-error');
			}

			if (email == "") {
				$('#divm_email').css('box-shadow', '0 0 5px red');
				return false;
			} else {
  			var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				if (regex.test(email)) {
					$('#divm_email').css('box-shadow', '0 0 5px green');
					$('#divm_email').removeClass('has-error');
				} else {
					$('#divm_email').css('box-shadow', '0 0 5px red');
					return false;
				}
			}

			if (password == "") {
				$('#divm_passwd').addClass('has-error');
				return false;
			} else {
				$('#divm_passwd').css('box-shadow', '0 0 5px green');
				$('#divm_passwd').removeClass('has-error');
			}

			return true;
		}
</script>
@endsection
