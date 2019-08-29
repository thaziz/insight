@extends('main')

@section('content')
<!-- MAIN PANEL -->
		<div id="main" role="main">

			<!-- RIBBON -->
			<div id="ribbon">

				<span class="ribbon-button-alignment">
					<span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Warning! This will reset all your widget settings." data-html="true">
						<i class="fa fa-refresh"></i>
					</span>
				</span>

				<!-- breadcrumb -->
				<ol class="breadcrumb">
					<li>Home</li><li>User</li><li>User</li><li>Tambah User</li>
				</ol>
				<!-- end breadcrumb -->

				<!-- You can also add more buttons to the
				ribbon for further usability

				Example below:

				<span class="ribbon-button-alignment pull-right">
				<span id="search" class="btn btn-ribbon hidden-xs" data-title="search"><i class="fa-grid"></i> Change Grid</span>
				<span id="add" class="btn btn-ribbon hidden-xs" data-title="add"><i class="fa-plus"></i> Add</span>
				<span id="search" class="btn btn-ribbon" data-title="search"><i class="fa-search"></i> <span class="hidden-mobile">Search</span></span>
				</span> -->

			</div>
			<!-- END RIBBON -->

			@include('user.user.modal_grub')

			<!-- MAIN CONTENT -->
			<div id="content">

				<!-- row -->
				<div class="row">

					<!-- col -->
					<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
						<h1 class="page-title txt-color-blueDark">

							<!-- PAGE HEADER -->
							<i class="fa-fw fa fa-users"></i>
								User
							<span>>
								User > Edit User
							</span>
						</h1>
					</div>
					<!-- end col -->

					<!-- right side of the page with the sparkline graphs -->
					<!-- col -->
					{{-- <div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">

						<ul id="sparks">
							<li class="sparks-info">
								<h5> My Income <span class="txt-color-blue">$47,171</span></h5>
								<div class="sparkline txt-color-blue hidden-mobile hidden-md hidden-sm">
									1300, 1877, 2500, 2577, 2000, 2100, 3000, 2700, 3631, 2471, 2700, 3631, 2471
								</div>
							</li>
							<li class="sparks-info">
								<h5> Site Traffic <span class="txt-color-purple"><i class="fa fa-arrow-circle-up" data-rel="bootstrap-tooltip" title="Increased"></i>&nbsp;45%</span></h5>
								<div class="sparkline txt-color-purple hidden-mobile hidden-md hidden-sm">
									110,150,300,130,400,240,220,310,220,300, 270, 210
								</div>
							</li>
							<li class="sparks-info">
								<h5> Site Orders <span class="txt-color-greenDark"><i class="fa fa-shopping-cart"></i>&nbsp;2447</span></h5>
								<div class="sparkline txt-color-greenDark hidden-mobile hidden-md hidden-sm">
									110,150,300,130,400,240,220,310,220,300, 270, 210
								</div>
							</li>
						</ul>

					</div> --}}
					<!-- end col -->

				</div>
				<!-- end row -->
				<!--
					The ID "widget-grid" will start to initialize all widgets below
					You do not need to use widgets if you dont want to. Simply remove
					the <section></section> and you can use wells or panels instead
					-->

				<!-- widget grid -->
				<section id="widget-grid" class="">

					<!-- row -->
					<div class="row">

						<!-- NEW WIDGET START -->
						<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

							<!-- Widget ID (each widget will need unique ID)-->
							<div class="jarviswidget" id="wid-id-0">
								<!-- widget options:
									usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

									data-widget-colorbutton="false"
									data-widget-editbutton="false"
									data-widget-togglebutton="false"
									data-widget-deletebutton="false"
									data-widget-fullscreenbutton="false"
									data-widget-custombutton="false"
									data-widget-collapsed="true"
									data-widget-sortable="false"

								-->
								<header>
									<span class="widget-icon"> <i class="fa fa-users"></i> </span>
									<h2>Tambah User</h2>

								</header>

								<!-- widget div-->
								<div>

									<!-- widget edit box -->
									<div class="jarviswidget-editbox">
										<!-- This area used as dropdown edit box -->
										<input class="form-control" type="text">
									</div>
									<!-- end widget edit box -->

									<!-- widget content -->
									<div class="widget-body">
										<fieldset>
											<div class="row">
											<form id="formpegawai">
												<input type="hidden" name="m_id" value="{{$id}}">
												<div class="col-md-3 col-sm-6 col-xs-12">
													<label>Nama Pegawai</label>
												</div>
												<div class="col-md-3 col-sm-6 col-xs-12">
													<div class="form-group form-group-sm" id="divm_name">
														<input type="text" class="form-control required" id="m_name" name="m_name" value="{{$data->m_name}}" required>
													</div>
												</div>

												<div class="col-md-3 col-sm-6 col-xs-12">
													<label>No. HP</label>
												</div>
												<div class="col-md-3 col-sm-6 col-xs-12">
													<div class="form-group form-group-sm" id="divm_nohp">
														<input type="text" class="form-control" readonly name="m_nohp" value="{{$data->m_nohp}}" required>
													</div>
												</div>

												<div class="col-md-3 col-sm-6 col-xs-12">
													<label>NIK</label>
												</div>
												<div class="col-md-3 col-sm-6 col-xs-12">
													<div class="form-group form-group-sm" id="divm_nik">
														<input type="text" class="form-control" readonly name="m_nik" value="{{$data->m_nik}}" required>
													</div>
												</div>
												<div class="col-md-3 col-sm-6 col-xs-12">
													<label>E-mail</label>
												</div>
												<div class="col-md-3 col-sm-6 col-xs-12">
													<div class="form-group form-group-sm" id="divm_email">
														<input type="text" class="form-control" readonly name="m_email" value="{{$data->m_email}}" required>
													</div>
												</div>

												<div class="col-md-3 col-sm-6 col-xs-12">
													<label>Address</label>
												</div>
												<div class="col-md-9 col-sm-6 col-xs-12">
													<div class="form-group" id="divm_address">
														<textarea rows="3" class="form-control" readonly name="m_address" required>{{$data->m_address}}</textarea>
													</div>
												</div>
												<div class="col-md-3 col-sm-6 col-xs-12">
													<label>Username</label>
												</div>
												<div class="col-md-3 col-sm-6 col-xs-12">
													<div class="form-group form-group-sm" id="divm_username">
														<input type="text" class="form-control" name="m_username" value="{{$data->m_username}}" required>
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

										<fieldset class="mt-3">
											<div class="row">

												<form id="formgroup">
														@for($i=0;$i<count($group);$i++)
															@if(count($aksesgroup) != 0)
															@if(count($aksesgroup) == count($group))
																<div class="col-xl-1 col-lg-2 col-md-3 col-sm-4 col-xs-12">

																	<div class="form-group">
																		<label><input type="checkbox" onchange="klikgroup({{$group[$i]->g_id}})" @if($group[$i]->g_id == $aksesgroup[$i]->mm_group) checked @endif id="klikgroup-{{$group[$i]->g_id}}" class="checkbox"> <span class="btn-grup-detail">{{$group[$i]->g_name}}</span></label>
																		<input type="hidden" name="group[]" id="group-{{$group[$i]->g_id}}" @if($group[$i]->g_id == $aksesgroup[$i]->mm_group) value="{{$group[$i]->g_id}}" @endif>
																	</div>
																</div>
															@else
																@for($x=0; $x<count($aksesgroup); $x++)
																	<?php $id = $aksesgroup[$x]->mm_group; ?>
																@endfor
																<div class="col-xl-1 col-lg-2 col-md-3 col-sm-4 col-xs-12">

																	<div class="form-group">
																		<label><input type="checkbox" onchange="klikgroup({{$group[$i]->g_id}})" @if($group[$i]->g_id == $id) checked @endif id="klikgroup-{{$group[$i]->g_id}}" class="checkbox"> <span class="btn-grup-detail">{{$group[$i]->g_name}}</span></label>
																		<input type="hidden" name="group[]" id="group-{{$group[$i]->g_id}}" @if($group[$i]->g_id == $id) value="{{$group[$i]->g_id}}" @endif>
																	</div>
																</div>
															@endif
														@else
															<div class="col-xl-1 col-lg-2 col-md-3 col-sm-4 col-xs-12">

																<div class="form-group">
																	<label><input type="checkbox" onchange="klikgroup({{$group[$i]->g_id}})" id="klikgroup-{{$group[$i]->g_id}}" class="checkbox"> <span class="btn-grup-detail">{{$group[$i]->g_name}}</span></label>
																	<input type="hidden" name="group[]" id="group-{{$group[$i]->g_id}}">
																</div>
															</div>
														@endif
														@endfor
												</form>


											</div>
										</fieldset>

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
													@foreach ($akses as $key => $value)
														@if ($value->m_parent == null)
															<tr>
																<td class="font-weight-bold">
																	{{$value->m_name}}
																	<input type="hidden" name="id_access[]" value="{{$value->m_id}}">
																</td>
																<td align="center">
																	<label><input type="checkbox" onchange="klikview({{$value->m_id}})" @if($value->mm_read == 'Y') checked @endif id="pview-{{$value->m_id}}" class="checkbox"> <span></span></label>
																	<input type="hidden" name="view[]" id="inputview-{{$value->m_id}}" @if($value->mm_read == 'Y') value="Y" @else value="N" @endif>
																</td>
																<td align="center">
																	<label><input type="checkbox" onchange="klikcreate({{$value->m_id}})" id="pcreate-{{$value->m_id}}" @if($value->mm_insert == 'Y') checked @endif class="checkbox"> <span></span></label>
																	<input type="hidden" name="create[]" id="inputcreate-{{$value->m_id}}" @if($value->mm_insert == 'Y') value="Y" @else value="N" @endif>
																</td>
																<td align="center">
																	<label><input type="checkbox" onchange="klikupdate({{$value->m_id}})" id="pupdate-{{$value->m_id}}" @if($value->mm_update == 'Y') checked @endif class="checkbox"> <span></span></label>
																	<input type="hidden" name="update[]" id="inputupdate-{{$value->m_id}}" @if($value->mm_update == 'Y') value="Y" @else value="N" @endif>
																</td>
																<td align="center">
																	<label><input type="checkbox" onchange="klikdelete({{$value->m_id}})" id="pdelete-{{$value->m_id}}" @if($value->mm_delete == 'Y') checked @endif class="checkbox"> <span></span></label>
																	<input type="hidden" name="delete[]" id="inputdelete-{{$value->m_id}}" @if($value->mm_delete == 'Y') value="Y" @else value="N" @endif>
																</td>
																<td align="center">
																	<label><input type="checkbox" onchange="klikprint({{$value->m_id}})" id="pprint-{{$value->m_id}}" @if($value->mm_print == 'Y') checked @endif class="checkbox"> <span></span></label>
																	<input type="hidden" name="print[]" id="inputprint-{{$value->m_id}}" @if($value->mm_print == 'Y') value="Y" @else value="N" @endif>
																</td>
															</tr>
														@else
															<tr>
																<td>&nbsp; {{' '}} {{$value->m_name}} <input type="hidden" name="id_access[]" value="{{$value->m_id}}"></td>
																<td align="center">
																	<label><input type="checkbox" id="view-{{$value->m_parent}}" @if($value->mm_read == 'Y') checked @endif class="checkbox view-{{$value->m_id}}"> <span></span></label>
																	<input type="hidden" name="view[]" id="inputview1-{{$value->m_parent}}" @if($value->mm_read == 'Y') value="Y" @else value="N" @endif>
																</td>
																<td align="center">
																	<label><input type="checkbox" id="create-{{$value->m_parent}}" @if($value->mm_insert == 'Y') checked @endif class="checkbox create-{{$value->m_id}}"> <span></span></label>
																	<input type="hidden" name="create[]" id="inputcreate1-{{$value->m_parent}}" @if($value->mm_insert == 'Y') value="Y" @else value="N" @endif>
																</td>
																<td align="center">
																	<label><input type="checkbox" id="update-{{$value->m_parent}}" @if($value->mm_update == 'Y') checked @endif class="checkbox update-{{$value->m_id}}"> <span></span></label>
																	<input type="hidden" name="update[]" id="inputupdate1-{{$value->m_parent}}" @if($value->mm_update == 'Y') value="Y" @else value="N" @endif>
																</td>
																<td align="center">
																	<label><input type="checkbox" id="delete-{{$value->m_parent}}" @if($value->mm_delete == 'Y') checked @endif class="checkbox delete-{{$value->m_id}}"> <span></span></label>
																	<input type="hidden" name="delete[]" id="inputdelete1-{{$value->m_parent}}" @if($value->mm_delete == 'Y') value="Y" @else value="N" @endif>
																</td>
																<td align="center">
																	<label><input type="checkbox" id="print-{{$value->m_parent}}" @if($value->mm_print == 'Y') checked @endif class="checkbox print-{{$value->m_id}}"> <span></span></label>
																	<input type="hidden" name="print[]" id="inputprint1-{{$value->m_parent}}" @if($value->mm_print == 'Y') value="Y" @else value="N" @endif>
																</td>
															</tr>
														@endif
													@endforeach
													</form>
												</tbody>
											</table>

										<div class="widget-footer">
											<button type="button" class="btn btn-primary" onclick="simpan()">Simpan</button>
											<a href="{{route('user_index')}}" class="btn btn-default">Kembali</a>
										</div>
									</div>
									<!-- end widget content -->

								</div>
								<!-- end widget div -->

							</div>
							<!-- end widget -->

						</article>
						<!-- WIDGET END -->

					</div>

					<!-- end row -->

					<!-- row -->

					<div class="row">

						<!-- a blank row to get started -->
						<div class="col-sm-12">
							<!-- your contents here -->
						</div>

					</div>

					<!-- end row -->

				</section>
				<!-- end widget grid -->

			</div>
			<!-- END MAIN CONTENT -->

		</div>
		<!-- END MAIN PANEL -->
@endsection
@section('extra_scripts')
<script type="text/javascript">
	/* BASIC ;*/
		var responsiveHelper_dt_basic = undefined;
		var responsiveHelper_datatable_fixed_column = undefined;
		var responsiveHelper_datatable_col_reorder = undefined;
		var responsiveHelper_datatable_tabletools = undefined;

		var breakpointDefinition = {
			size_tablet : 1024,
			size_phone : 480
		};

		$('#table_user').dataTable({
			"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
				"t"+
				"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
			"autoWidth" : true,
			"preDrawCallback" : function() {
				// Initialize the responsive datatables helper once.
				if (!responsiveHelper_dt_basic) {
					responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#table_user'), breakpointDefinition);
				}
			},
			"rowCallback" : function(nRow) {
				responsiveHelper_dt_basic.createExpandIcon(nRow);
			},
			"drawCallback" : function(oSettings) {
				responsiveHelper_dt_basic.respond();
			}
		});

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
				var id = $('input[name=id]').val();
				$.ajaxSetup({
					headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				$.ajax({
					type: 'get',
					data: 'id='+id+'&'+$('#formakses').serialize()+'&'+$('#formpegawai').serialize()+'&'+$('#formgroup').serialize(),
					dataType: 'json',
					url : baseUrl + '/user/user/updateuser',
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
				$('#divm_email').addClass('has-error');
				return false;
			} else {
  			var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				if (regex.test(email)) {
					$('#divm_email').css('box-shadow', '0 0 5px green');
					$('#divm_email').removeClass('has-error');
				} else {
					$('#divm_email').addClass('has-error');
					return false;
				}
			}

			if (password == "") {
				$('#divm_passwd').css('box-shadow', '0 0 5px red');
				return false;
			} else {
				$('#divm_passwd').css('box-shadow', '0 0 5px green');
				$('#divm_passwd').removeClass('has-error');
			}

			return true;
		}
</script>
@endsection
