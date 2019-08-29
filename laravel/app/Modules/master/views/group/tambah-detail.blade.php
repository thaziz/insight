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
	                	<a href="{{route('index_group')}}" class="btn btn-default pull-right"><i class="fa fa-back"></i> Kembali</a>
                		</div>
                	</div>
                	<br>
                <div class="row">                	
                    
                    		<legend>Tambah Group / Nama Hadiah</legend>
                    		

											
													<form id="form">
														<input type="hidden" name="id" value="{{$data->g_id}}">
														<div class="col-md-2 col-sm-6 col-xs-12">
															<label>Nama Group<span style="color: red"> *</span></label>
														</div>
														<div class="col-md-4 col-sm-6 col-xs-12">
															<div class="form-group form-group-sm" id="div_kategori">
																<input type="text" class="form-control reset" name="pekerjaan" required autocomplete="off" value="{{$data->g_nama}}">
															</div>
														</div>

														
														
														


<table class="table" width="100%">
	<td><input placeholder="Nama Hadiah" id="dt_nama" style="width:100%" type="" name="dt_nama" class="form-control reset1"></td>
	<td>
<button class="btn btn-primary btn-sm" id="btn_click"  type="button"><i class="fa fa-plus-square"></i></button>
	</td>
</table>

<div>
<table class="table" width="100%" id="table">
	<thead>
		<th>Nama Hadiah</th>
		<th>-</th>
	</thead>
	<tbody>
		@php 
		$j=0;
		@endphp
		@foreach($data_dt as $val)
		<tr>
			<td>{{$val->gd_nama}}
				<input type="hidden"  name="namabarang[]" class="form-control form-control-sm" value="{{$val->gd_nama}}" >
			</td>
			<td>
				<button class="btn btn-danger btn-sm btn-delete" type="button"  data-title="Delete"  rel="tooltip" data-placement="bottom" data-original-title="Delete"><i class="fa fa-trash-o"></i></button>
			</td>
			@php 
					$j++;
			@endphp
		</tr>
		@endforeach
	</tbody>
</table>
</div>


													</form>												
											
											
								
				</div>
					
					<div class="row">
										<div class="widget-footer enter pull-right">											
											<button type="button" class="btn btn-primary" onclick="simpan()">Simpan</button>
											<a href="{{route('index_group')}}" class="btn btn-default">Kembali</a>
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
	counter--;
});

var counter = '{{$j}}';

	function datatable_append(){
		
		var dt_nama   = $('#dt_nama').val();		
		if(counter==12){
				iziToast.error({							    
							    message: "Ma'af, Hadiah Maksimal 12 Item",
							    position: 'topRight',
				});
				return false;
		}

		if(dt_nama==''){
				iziToast.error({							    
							    message: "Ma'af, Data Anda Belum Lengkap",
							    position: 'topRight',
				});
		}
		 else {
			table.row.add([
				'<input type="hidden"  name="namabarang[]" class="form-control form-control-sm" value="'+dt_nama+'" >'+dt_nama+'',				
				'<button class="btn btn-danger btn-sm btn-delete" type="button"  data-title="Delete"  rel="tooltip" data-placement="bottom" data-original-title="Delete"><i class="fa fa-trash-o"></i></button>'
			]).draw(false);
			$('.reset1').val('');
		}		

		counter++;

		
		
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
					url : '{{route('simpan_detail')}}',
					success : function(response){
						if (response.status == 'berhasil') {
							iziToast.success({							    
							    message: "<i class='fa fa-clock-o'></i> <i>Berhasil Disimpan!</i>",
							    position: 'topRight',
							});
							$('.reset').val('');
							setTimeout(function () {
							window.location.href = "{{route('index_group')}}";	
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
