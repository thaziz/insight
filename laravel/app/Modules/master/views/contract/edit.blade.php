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
	                	<a href="{{route('index_contract')}}" class="btn btn-default pull-right"><i class="fa fa-back"></i> Kembali</a>
                		</div>
                	</div>
                	<br>
                <div class="row">                	
                    
                    		<legend>Tambah Unit</legend>
                    		

											
													<form id="form">
														<input type="hidden" name="id" value="{{$data->c_id}}">
														<div class="col-md-2 col-sm-6 col-xs-12">
															<label>Nama Unit<span style="color: red"> *</span></label>
														</div>
														<div class="col-md-4 col-sm-6 col-xs-12">
															<div class="form-group form-group-sm" id="div_kategori">

                                     <select id="select_unit" name="unit" data-placeholder="pilih Unit..." class="chosen-select" style="width:100%;" tabindex="2">
                
										</select>



																
															</div>
														</div>

														<div class="col-md-2 col-sm-6 col-xs-12">
															<label>Nama Vendor<span style="color: red"> *</span></label>
														</div>
														<div class="col-md-4 col-sm-6 col-xs-12">
															<div class="form-group form-group-sm" id="div_kategori">
																

                                     <select id="select_vendor" name="vendor" data-placeholder="Pilih Vendor..." class="chosen-select" style="width:100%;" tabindex="2">
                
										</select>

															</div>
														</div>

														<div class="col-md-2 col-sm-6 col-xs-12">
															<label>Pekerjaan<span style="color: red"> *</span></label>
														</div>
														<div class="col-md-4 col-sm-6 col-xs-12">
															<div class="form-group form-group-sm" id="div_kategori">
																<input value="{{$data->c_pekerjaan}}" type="text" class="form-control reset" name="pekerjaan" required autocomplete="off">
															</div>
														</div>

														<div class="col-md-2 col-sm-6 col-xs-12">
															<label>Nomor Kontrak<span style="color: red"> *</span></label>
														</div>
														<div class="col-md-4 col-sm-6 col-xs-12">
															<div class="form-group form-group-sm" id="div_kategori">
																<input type="text" class="form-control reset" name="no_kontrak" value="{{$data->c_nomor_kontrak}}" required autocomplete="off">
															</div>
														</div>

														<div class="col-md-2 col-sm-6 col-xs-12">
															<label>Tanggal Kontrak<span style="color: red"> *</span></label>
														</div>
														<div class="col-md-4 col-sm-6 col-xs-12">
															<div class="form-group form-group-sm" id="div_kategori">
																<input id="tgl" type="text" class="form-control reset" name="tanggal_kontrak" value="{{date('d-m-Y',strtotime($data->c_tgl_kontrak))}}" required autocomplete="off">
															</div>
														</div>

														<div class="col-md-2 col-sm-6 col-xs-12">
															<label>Durasi Kontak<span style="color: red"> *</span></label>
														</div>
														<div class="col-md-4 col-sm-6 col-xs-12">
															<div class="form-group form-group-sm" id="div_kategori">
																<input value="{{$data->c_durasi_kontrak}}" type="text" class="form-control reset" name="durasi_kontrak" required autocomplete="off">
															</div>
														</div>


<table class="table" width="100%">
	<td><input placeholder="Nama Barang" id="dt_nama" style="width:100%" type="" name="dt_nama" class="form-control reset1" autocomplete="off"></td>
	<td><input placeholder="Jumlah" id="dt_jumlah" style="width:100%" type="number" name="dt_jumlah"class="form-control reset1" autocomplete="off"></td>
	<td><input placeholder="Satuan" id="dt_satuan" style="width:100%" type="" name="dt_satuan" class="form-control reset1" autocomplete="off"></td>
	<td>
		<button class="btn btn-primary btn-sm" id="btn_click"  type="button"><i class="fa fa-plus-square"></i></button>
	</td>
</table>


<table class="table" width="100%" id="table">
	<thead>
		<th>Nama</th>
		<th>Jumlah</th>
		<th>Satuan</th>
		<th>-</th>
	</thead>
	<tbody>
		@foreach($data_dt as $dt)
		<tr>
			<td><input type="text"  name="namabarang[]" class="form-control form-control-sm" value="{{$dt->cdt_nama}}" ></td>
			<td><input type="number" name="jumlah[]" class="form-control form-control-sm" onkeyup="qty()" value="{{$dt->cdt_jumlah}}"></td>
			<td><input type="text" name="satuan[]" class="form-control form-control-sm"  value="{{$dt->cdt_satuan}}"></td>
			<td><button class="btn btn-danger btn-sm btn-delete" type="button"  data-title="Delete"  rel="tooltip" data-placement="bottom" data-original-title="Delete"><i class="fa fa-trash-o"></i></button></td>
		</tr>
		@endforeach
	</tbody>
</table>



													</form>												
											
											
								
				</div>
					
					<div class="row">
										<div class="widget-footer enter pull-right">											
											<button type="button" class="btn btn-primary" onclick="simpan()">Simpan</button>
											<a href="{{route('index_contract')}}" class="btn btn-default">Kembali</a>
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
$('#tgl').datepicker({
	    todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        format: "dd-mm-yyyy",
});

var addr_url = '{{ url("master-induk/select-induk") }}';	

var table=$('#table').DataTable({
     /*responsive: true,*/
     "aLengthMenu": [[1, 50, 75, -1], [1, 50, 75, "All"]],
     /*searching: false,*/
     "searching": false,
		"bPaginate": false,
		"bInfo": false,
     "columnDefs": [
		            { responsivePriority: 1, targets: 0 },
		           
		        ]    
});

$('#dt_satuan').keypress(function(e){
	if (e.which === 13 || e.keyCode === 13) {
		datatable_append();
	}
});

$('#btn_click').click(function(){
	datatable_append();
});


$('#table tbody').on('click', '.btn-delete', function(){
	table.row($(this).parents('tr')).remove().draw();			
});

var counter = 0;

	function datatable_append(){
		var dt_nama   = $('#dt_nama').val();		
		var dt_jumlah = $('#dt_jumlah').val();
		var dt_satuan = $('#dt_satuan').val();

		if(dt_nama=='' || dt_jumlah=='' || dt_satuan==''){
				iziToast.error({							    
							    message: "Ma'af, Data Anda Belum Lengkap",
							    position: 'topRight',
				});
		} else {
			table.row.add([
				'<input type="text"  name="namabarang[]" class="form-control form-control-sm" value="'+dt_nama+'" >',				
				'<input type="number" name="jumlah[]" class="form-control form-control-sm" onkeyup="qty()" value="'+dt_jumlah+'">',
				'<input type="text" name="satuan[]" class="form-control form-control-sm"  value="'+dt_satuan+'">',
				'<button class="btn btn-danger btn-sm btn-delete" type="button"  data-title="Delete"  rel="tooltip" data-placement="bottom" data-original-title="Delete"><i class="fa fa-trash-o"></i></button>'
			]).draw(false);
			$('.reset1').val('');
		}		

		counter++;

		
		
	}


$.getJSON("{{route('select_unit')}}", function(json){
    var $select_elem = $("#select_unit");
    $select_elem.empty();
    $.each(json, function (idx, obj) {
    	console.log(obj.length)
    	for(x = 0;x < obj.length;x++) {  
        				$select_elem.append('<option value="' + obj[x].u_id + '">' + obj[x].u_nama_unit+ '</option>');        		
        				$select_elem.val("{{$data->c_unit}}").trigger("chosen:updated");
        }


        
    });
    $select_elem.chosen({ width: "100%" });
})

             
$.getJSON("{{route('select_vendor')}}", function(json){
    var $select_elem = $("#select_vendor");
    $select_elem.empty();
    $.each(json, function (idx, obj) {
    	console.log(obj.length)
    	for(x = 0;x < obj.length;x++) {  
        				$select_elem.append('<option value="' + obj[x].v_id + '">' + obj[x].v_nama+ '</option>');
        	$select_elem.val("{{$data->c_vendor}}").trigger("chosen:updated");
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
					url : '{{route('update_contract')}}',
					success : function(response){
						if (response.status == 'berhasil') {
							iziToast.success({							    
							    message: "<i class='fa fa-clock-o'></i> <i>Berhasil Disimpan!</i>",
							    position: 'topRight',
							});
							setTimeout(function () {
							window.location.href = "{{route('index_contract')}}";	
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
