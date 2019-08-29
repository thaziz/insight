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
	                		<a href="{{route('tambah_user')}}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Tambah</a>
                		</div>
                	</div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="product_name">Project Name</label>
                                <input type="text" id="product_name" name="product_name" value="" placeholder="Project Name" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label class="control-label" for="price">Name</label>
                                <input type="text" id="price" name="price" value="" placeholder="Name" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label class="control-label" for="quantity">Company</label>
                                <input type="text" id="quantity" name="quantity" value="" placeholder="Company" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="control-label" for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="1" selected="">Completed</option>
                                    <option value="0">Pending</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">                        						
						<table class="table table-striped table-bordered table-hover" id="table_user" width="100%">
							<thead>
								<tr>
									<th data-hide="size_phone" width="1%">No</th>
									<th data-class="expand">Nama</th>
									<th data-hide="size_phone">Username</th>
									<th data-hide="size_phone">E-mail</th>
									<th data-hide="size_phone,size_tablet">Alamat</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody id="showdata">
							</tbody>
						</table>
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
	var table;
	/* BASIC ;*/
		var responsiveHelper_dt_basic = undefined;
		var responsiveHelper_datatable_fixed_column = undefined;
		var responsiveHelper_datatable_col_reorder = undefined;
		var responsiveHelper_datatable_tabletools = undefined;

		var breakpointDefinition = {
			size_tablet : 1024,
			size_phone : 480
		};

		table = $('#table_user').DataTable({
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

		function tableuser(){
			overlayshow();
			$.ajax({
				type: 'get',
				dataType: 'json',
				url: baseUrl + '/user/user/getuser',
				success : function(response){
					table.clear();
					if (response.length == 0) {
						$('#showdata').html('<tr class="odd"><td valign="top" colspan="6" class="dataTables_empty">No data available in table</td></tr>');
					} else {
						for (var i = 0; i < response.length; i++) {
							table.row.add([
								(i + 1),
								response[i].m_name,
								response[i].m_username,
								response[i].m_email,
								response[i].m_address,
								'<center><div class="btn-group btn-group-sm">'+
									'<button class="btn btn-warning" type="button" title="Edit" onclick="edit('+response[i].m_id+')"><i class="fa fa-pencil"></i></button>'+
									'<button class="btn btn-danger" type="button" title="Delete" onclick="hapus('+response[i].m_id+')"><i class="fa fa-trash-o"></i></button>'+
								'</div></center>',
							]).draw(false);
					}
					}
					overlayhide();
				}
			});
		}

		$(document).ready(function(){
			tableuser();
		});

		function hapus(id){
			$.SmartMessageBox({
				title : "Confirm!",
				content : "Ingin menghapus data?",
				buttons : '[No][Yes]'
			}, function(ButtonPressed) {
				if (ButtonPressed === "Yes") {
					overlayshow();
					$.ajax({
						type: 'get',
						data: {id},
						dataType: 'JSON',
						url: baseUrl + '/user/user/hapususer',
						success : function(response){
							if (response == 'berhasil') {
								$.smallBox({
									title : "Info!",
									content : "<i class='fa fa-clock-o'></i> <i>Berhasil Dihapus!</i>",
									color : "#659265",
									iconSmall : "fa fa-check fa-2x fadeInRight animated",
									timeout : 4000
								});
								tableuser();
							} else {
								$.smallBox({
									title : "Info!",
									content : "<i class='fa fa-clock-o'></i> <i>Gagal Dihapus</i>",
									color : "#C46A69",
									iconSmall : "fa fa-times fa-2x fadeInRight animated",
									timeout : 4000
								});
							}
							overlayhide();
						}
					});
				}
		})
		e.preventDefault();
		}

		function edit(id){
			window.location.href = baseUrl + '/user/user/edituser/'+id;
		}
	/* END BASIC */
</script>
@endsection
