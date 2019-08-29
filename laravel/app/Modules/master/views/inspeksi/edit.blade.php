@extends('main')

@section('content')

<style type="text/css">
	.cc thead {
		display: none;
	}
	@media screen and (max-width: 520px) {
	table.media {
		width: 100%;
	}
	.media thead {
		display: none;
	}
	.media td {
		width: 100%;
		display: block;
		text-align: right;
		border-right: 1px solid #e1edff;
	}
	.media td::before {
		float: left;
		text-transform: uppercase;
		font-weight: bold;
		content: attr(data-header);
	}
}
</style>


<div class="wrapper wrapper-content animated fadeIn">
<div class="p-w-md m-t-sm">
    
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">



                <div class="ibox-content">
                	<div class="row">
                		<div class="col-sm-12">
	                	<a href="{{route('index_inspeksi')}}" class="btn btn-default pull-right"><i class="fa fa-back"></i> Kembali</a>
                		</div>
                	</div>
                	<br>
                <div class="row">                	
                    
                    		<legend>Edit Inspeksi</legend>
                    		

											

<form  enctype="multipart/form-data" id="uploadForm" autocomplete="off">
											{{ csrf_field() }}
		<input type="hidden" name="m_id">
		<div class="col-md-2 col-sm-6 col-xs-12">
			<label>Kontrak<span style="color: red"> *</span></label>
		</div>
		<div class="col-md-4 col-sm-6 col-xs-12">
			<div class="form-group form-group-sm" id="div_kategori">

<!-- <select onchange="kt()"  id="select_kontrak" name="kontrak" data-placeholder="pilih Kontrak..." class="chosen-select" style="width:100%;" tabindex="2">

</select> -->
		<input type="text" name="kontrak" class="form-control" value="{{$master->c_nomor_kontrak}}" readonly="">



				
			</div>
		</div>

		<div class="col-md-2 col-sm-6 col-xs-12">
			<label>Nama Unit<span style="color: red"> *</span></label>
		</div>
		<div class="col-md-4 col-sm-6 col-xs-12">
			<div class="form-group form-group-sm" id="div_kategori">
				<input value="{{$master->i_id}}" type="hidden" name="id" class="form-control" readonly="">		<input value="{{$master->u_id}}" type="hidden" name="unit_id" id="unit_id" class="form-control" readonly="">					
				<input value="{{$master->u_nama_unit}}" type="text" name="vendor" id="unit" class="form-control" disabled="">				
			</div>
		</div>

		<div class="col-md-2 col-sm-6 col-xs-12">
			<label>Nama Vendor<span style="color: red"> *</span></label>
		</div>
		<div class="col-md-4 col-sm-6 col-xs-12">
			<div class="form-group form-group-sm" id="div_kategori">
				<input type="text" name="vendor" value="{{$master->v_nama}}" id="vendor" class="form-control" disabled="">				
			</div>
		</div>


		<div class="col-md-2 col-sm-6 col-xs-12">
			<label>Tanggal<span style="color: red"> *</span></label>
		</div>
		<div class="col-md-4 col-sm-6 col-xs-12">
			<div class="form-group form-group-sm" id="div_kategori">
				<input id="tgl" type="text" value="{{date('d-m-Y',strtotime($master->i_tgl))}}" class="form-control reset" name="tanggal" required autocomplete="off">
			</div>
		</div>

		<div class="col-md-2 col-sm-6 col-xs-12">
			<label>Triwulan<span style="color: red"> *</span></label>
		</div>
		<div class="col-md-4 col-sm-6 col-xs-12">
			<div class="form-group form-group-sm" id="div_kategori">
				<input value="{{$master->i_triwulan}}" type="text" class="form-control reset" name="triwulan" required autocomplete="off">
			</div>
		</div>

		<div class="col-md-2 col-sm-6 col-xs-12">
			<label>Tahun<span style="color: red"> *</span></label>
		</div>
		<div class="col-md-4 col-sm-6 col-xs-12">
			<div class="form-group form-group-sm" id="div_kategori">
				<input value="{{$master->i_tahun}}" id="tahun" type="text" class="form-control reset" name="tahun" required autocomplete="off">
			</div>
		</div>

		<div class="col-md-2 col-sm-6 col-xs-12">
			<label>Presentase<span style="color: red"> *</span></label>
		</div>
		<div class="col-md-4 col-sm-6 col-xs-12">
			<div class="form-group form-group-sm" id="div_kategori">
				<div class="input-group">
					<input id="mP" type="text" class="form-control reset" name="presentase" required autocomplete="off" readonly="">
					<span class="input-group-addon"><i class="">%</i></span>
				</div>
			</div>
		</div>


<div class="row">
<div class="col-md-12">
<div class="table-responsive">

<table id="d" class="table cc table-striped table-bordered " width="100%">
 <thead>
<th width="20%">Jumlah</th>
<th width="20%">Satuan</th>
<th width="20%">Ada</th>
<th width="20%">Tidak Ada</th>
<th width="20%">Rusak</th>
<th width="20%">Keterangan</th>
<th width="20%">Presentase</th>
<th width="20%">Foto</th>
<th width="20%">-</th>
</thead>
<tbody>

<td width="20%"><input placeholder="Nama" id="dt_nama" style="width:100%" type="" name="dt_nama" class="form-control reset1"></td>
<td width="10%"><input placeholder="Jumlah" id="dt_jumlah" style="width:100%" type="number" name="dt_jumlah"class="form-control reset1" onchange="id_hitung_p()" onkeyup="id_hitung_p()" ></td>
<td width="14%"><input placeholder="Satuan" id="dt_satuan" style="width:100%" type="" name="dt_satuan" class="form-control reset1"></td>
<td width="10%"><input placeholder="Ada" id="dt_ada" style="width:100%" type="number" name="dt_ada" class="form-control reset1" onchange="id_hitung_p()" onkeyup="id_hitung_p()"></td>
<td width="10%"><input placeholder="Tidak Ada" id="dt_tidak" style="width:100%" type="number" name="dt_tidak_ada" class="form-control reset1" onchange="id_hitung_p()" onkeyup="id_hitung_p()"></td>
<td width="10%"><input placeholder="Rusak" id="dt_rusak" style="width:100%" type="number" name="dt_rusak" class="form-control reset1" onchange="id_hitung_p()" onkeyup="id_hitung_p()"></td>
<td width="12%"><input placeholder="Keterangan" id="dt_ket" style="width:100%" type="" name="dt_ket" class="form-control reset1"></td>
<td width="10%"><input placeholder="Presentase" id="dt_presentase" style="width:100%" type="number" name="dt_presentase" class="form-control reset1" readonly=""></td>
<td width="5%">
<button class="btn btn-primary btn-sm" id="btn_click"  type="button"><i class="fa fa-plus-square"></i></button>
</td>
</tbody>
</table>
</div>
</div>
</div>


<div style="width:100%; padding-left:-10px">
<div class="table-responsive">
<table class="table "  id="table" cellspacing="0" width="100%">

<thead>
<th width="20%">Nama</th>
<th width="7%">Jumlah</th>
<th width="6%">Satuan</th>
<th width="6%">Ada</th>
<th width="6%">Tidak Ada</th>
<th width="6%">Rusak</th>
<th width="12%">Keterangan</th>
<th width="6%">Presentase</th>
<th width="10%">Foto</th>
<th width="10%">-</th>
</thead>
<tbody>
	@php
		$hi=0;
	@endphp
	@foreach($data_dt as $dt)
		<tr>
			<td>
				<input style="width: 100%" type="hidden"  name="detailid[]" class="form-control form-control-sm"
				value="{{$dt->idt_detailid}}">
				<input style="width: 100%" type="hidden"  name="inde[]" class="form-control form-control-sm"
				value="{{$hi}}">
				<input style="width: 100%" type="text"  name="namabarang[]" class="form-control form-control-sm"
				value="{{$dt->idt_nama}}" placeholder="Nama Barang">
			</td>
			<td>
				<input style="width: 100%" type="text" name="jumlah[]" class="form-control form-control-sm jumlah{{$hi}}" onkeyup="hitung_p({{$hi}})" onchange="hitung_p({{$hi}})" value="{{$dt->idt_jumlah}}" placeholder="Jumlah">
			</td>
			<td>
				<input style="width: 100%" type="text" name="satuan[]" placeholder="Satuan" class="form-control form-control-sm"  value="{{$dt->idt_satuan}}">
			</td>
			<td>
				<input style="width: 100%" placeholder="Ada" type="text" name="jumlah_ada[]" class="form-control form-control-sm ada{{$hi}}"  value="{{$dt->idt_ada}}" onkeyup="hitung_p({{$hi}})" onchange="hitung_p({{$hi}})">
			</td>
			<td>
				<input style="width: 100%" type="text" name="jumlah_tidak_ada[]" class="form-control form-control-sm tidak{{$hi}}"  value="{{$dt->idt_tidak}}" onkeyup="hitung_p({{$hi}})" onchange="hitung_p({{$hi}})" placeholder="Tidak Ada">
			</td>
			<td>
				<input style="width: 100%" type="text" name="jumlah_rusak[]" class="form-control form-control-sm r rusak{{$hi}}" value="{{$dt->idt_rusak}}" onkeyup="hitung_p({{$hi}})" onchange="hitung_p({{$hi}})" placeholder="Rusak">
			</td>			
			<td>
				<input style="width: 100%" type="text" name="keterangan[]" class="form-control form-control-sm"  value="{{$dt->idt_ket}}" placeholder="Keterangan">
			</td>
			<td>
				<input style="width: 100%" type="text" name="presentases[]" class="form-control form-control-sm persen{{$hi}}"value="{{$dt->idt_presentase}}" placeholder="Presentase" readonly="">
			</td>
			<td>



<img id="output{{$hi}}" src="{{ url('/') }}/{{$dt->idt_foto}}" width="100px" height="100px"><input style="width: 100%" type="file" class="form-control form-control-sm uploadimage poto{{$hi}}" name="foto[]" accept="image/*" onchange="loadFile(event,'{{$hi}}')" id="chooseFile{{$hi}}" multiple value="{{$dt->idt_foto}}">
<input class="awal{{$hi}}" type="hidden" name="awal[]" value="{{$dt->idt_foto}}">
</td>
			<td>
				<button class="btn btn-danger btn-sm btn-delete" type="button"  data-title="Delete"  rel="tooltip" data-placement="bottom" data-original-title="Delete"><i class="fa fa-trash-o"></i></button>
			</td>
			
		</tr>
		@php
			$hi++;
		@endphp
	@endforeach
</tbody>
</table>

</div>
</div>





											
											
											
								
				</div>
					
					<div class="row">
										<div class="widget-footer enter pull-right">											
											<button type="submit" class="btn btn-primary" >Simpan</button>
											<a href="{{route('index_inspeksi')}}" class="btn btn-default">Kembali</a>
										</div>

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


$("#d").DataTable({
		"searching": false,
		"bPaginate": false,
		"bInfo": false,
	});


var hitung='{{$hi}}';
var addr_url = '{{ url("master-induk/select-induk") }}';	

 $('#tgl').datepicker({
 	    todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        format: "dd-mm-yyyy",

 	});

function kt(){	
	overlayshow();

	$.ajax({
					type: 'POST',
					data: 'id='+$('#select_kontrak').val()+"&_token={{ csrf_token() }}",
					dataType: 'json',
					url : '{{route('get_unit_vendor')}}',
					success : function(response){		

					if(response!=null){										
						$('#unit').val(response.u_nama_unit);
						$('#vendor').val(response.v_nama);
						}else{
							$('#unit').val('');
						$('#vendor').val('');
						}

					}
				});

				$.ajax({
					type: 'POST',
					data: 'id='+$('#select_kontrak').val()+"&_token={{ csrf_token() }}",
					dataType: 'json',
					url : '{{route('get_unit_vendor_dt')}}',
					success : function(response){						
						overlayhide();
		table.clear().draw();

					 $.each(response,function(i,item){
        				table.row.add([
				'<input style="width: 100%" type="text"  name="namabarang[]" class="form-control form-control-sm nama'+hitung+'" value="'+item.cdt_nama+'" readonly>',				
				'<input style="width: 100%" type="text" name="jumlah[]" class="form-control form-control-sm jumlah'+hitung+'" onkeyup="qty('+hitung+')" value="'+item.cdt_jumlah+'" readonly>',
				'<input style="width: 100%" type="text" name="satuan[]" class="form-control form-control-sm satuan'+hitung+'"  value="'+item.cdt_satuan+'" readonly>',
				'<input style="width: 100%" type="number" name="jumlah_ada[]" onkeyup="hitung_p('+hitung+')" onchange="hitung_p('+hitung+')" class="form-control form-control-sm ada'+hitung+'"  >',
				'<input style="width: 100%" type="number" name="jumlah_tidak_ada[]" class="form-control form-control-sm tidak'+hitung+'" onkeyup="hitung_p('+hitung+')" onchange="hitung_p('+hitung+')" >',
				'<input style="width: 100%" type="number" name="jumlah_rusak[]" class="form-control form-control-sm r rusak'+hitung+'"  onkeyup="hitung_p('+hitung+')" onchange="hitung_p('+hitung+')" >',
				'<input style="width: 100%" type="text" name="keterangan[]" class="form-control form-control-sm">',
				'<div class="input-group"><input style="width: 100%" type="number" name="presentases[]" class="form-control form-control-sm persen'+hitung+'"><span class="input-group-addon"><i class="">%</i></span></div>',
				'<button class="btn btn-danger btn-sm btn-delete" type="button"  data-title="Delete"  rel="tooltip" data-placement="bottom" data-original-title="Delete"><i class="fa fa-trash-o"></i></button>'
			]).draw(false);
        				hitung++;

    					});
					 total_p();
					}
				});
}
$('#tgl').datepicker({
	    todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true,
        format: "dd-mm-yyyy",
});

var table=$('#table').DataTable({     
     "aLengthMenu": [[1, 50, 75, -1], [1, 50, 75, "All"]],     
     "searching": false,
		"bPaginate": false,
		"bInfo": false
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
	/*var data = table.row($(this).closest('tr')).data();
    alert(data[Object.keys(data)[0]]+' s phone: '+data[Object.keys(data)[1]]);*/
    console.log(table.row($(this).parents('tr')));
	table.row($(this).parents('tr')).remove().draw();	
	total_p();	

});

var counter = 0;

	function datatable_append(){
		var dt_nama   = $('#dt_nama').val();		
		var dt_jumlah = $('#dt_jumlah').val();
		var dt_satuan = $('#dt_satuan').val();
		var dt_ada = $('#dt_ada').val();
		var dt_tidak = $('#dt_tidak').val();
		var dt_rusak = $('#dt_rusak').val();
		var dt_ket = $('#dt_ket').val();
		var dt_presentase = $('#dt_presentase').val();


	if(dt_nama=='' || dt_jumlah=='' || dt_satuan=='' || dt_ada=='' || dt_tidak=='' || dt_rusak=='' || dt_ket==''){
				iziToast.error({							    
							    message: "Ma'af, Data Anda Belum Lengkap",
							    position: 'topRight',
				});
		} else {

			table.row.add([				
				'<input style="width: 100%" type="hidden"  name="inde[]" class="form-control form-control-sm" value="'+hitung+'"><input style="width: 100%" type="hidden"  name="detailid[]" class="form-control form-control-sm" value="0"><input style="width: 100%" type="text"  name="namabarang[]" class="form-control form-control-sm" value="'+dt_nama+'" placeholder="Nama Barang" >',				
				'<input style="width: 100%" type="text" name="jumlah[]" class="form-control form-control-sm jumlah'+hitung+'" onkeyup="qty()" value="'+dt_jumlah+'" onkeyup="hitung_p('+hitung+')" onchange="hitung_p('+hitung+')" placeholder="Jumlah" >',
				'<input style="width: 100%" type="text" name="satuan[]" class="form-control form-control-sm"  value="'+dt_satuan+'" placeholder="Satuan">',
				'<input style="width: 100%" type="text" name="jumlah_ada[]" class="form-control form-control-sm ada'+hitung+'"  value="'+dt_ada+'" onkeyup="hitung_p('+hitung+')" onchange="hitung_p('+hitung+')" placeholder="Ada">',
				'<input style="width: 100%" type="text" name="jumlah_tidak_ada[]" class="form-control form-control-sm tidak'+hitung+'"  value="'+dt_tidak+'" onkeyup="hitung_p('+hitung+')" onchange="hitung_p('+hitung+')" placeholder="Tidak Ada">',
				'<input style="width: 100%" type="text" name="jumlah_rusak[]" class="form-control form-control-sm rusak'+hitung+'"  value="'+dt_rusak+'" onkeyup="hitung_p('+hitung+')" onchange="hitung_p('+hitung+')" placeholder="Rusak">',
				'<input style="width: 100%" type="text" name="keterangan[]" class="form-control form-control-sm"  value="'+dt_ket+'" placeholder="Keterangan">',
				'<div class="input-group"><input style="width: 100%" type="text" name="presentases[]" class="form-control form-control-sm persen'+hitung+'"  value="'+dt_presentase+'" readonly placeholder="Presentase"><span class="input-group-addon"><i class="">%</i></span></div>',
				'<img id="output'+hitung+'" width="100px" height="100px"><input style="width: 100%" type="file" class="form-control form-control-sm uploadimage poto'+hitung+'" name="foto[]" accept="image/*" onchange="loadFile(event,'+hitung+')" id="chooseFile'+hitung+'" multiple><input class="awal'+hitung+'" type="hidden" name="awal[]" value="">',				
				'<button class="btn btn-danger btn-sm btn-delete" type="button"  data-title="Delete"  rel="tooltip" data-placement="bottom" data-original-title="Delete"><i class="fa fa-trash-o"></i></button>'
			]).draw(false);
			hitung++;
			$('.reset1').val('');
			$('#dt_nama').focus();
			total_p();
		}		

		counter++;

		
		
	}


$.getJSON("{{route('select_contract')}}", function(json){
    var $select_elem = $("#select_kontrak");
    $select_elem.empty();
    $.each(json, function (idx, obj) {
    	console.log(obj.length)
    	$select_elem.append('<option value="">--Pilih--</option>');
    	for(x = 0;x < obj.length;x++) {  
        				$select_elem.append('<option value="' + obj[x].c_id + '"  data-unit="'+obj[x].c_nomor_kontrak+'">' + obj[x].c_nomor_kontrak+ '</option>');
        }
        $(".chosen-select").val("{{$master->i_contract}}").trigger("chosen:updated");

        
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
        }

        
    });
    $select_elem.chosen({ width: "100%" });
})

		 $(window).keydown(function(event){				 	
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });

$("#uploadForm").on('submit',(function(e) {	
				overlayshow();				
		e.preventDefault();
		$.ajax({
        	url : '{{route('update_inspeksi')}}',
			type: "POST",
			data:  new FormData(this),
			contentType: false,
			dataType: 'json',
    	    cache: false,
			processData:false,
					success : function(response){
						if (response.status == 'berhasil') {
							iziToast.success({							    
							    message: "<i class='fa fa-clock-o'></i> <i>Berhasil Disimpan!</i>",
							    position: 'topRight',
							});
							$('.reset').val('');
							setTimeout(function () {
							window.location.href = "{{route('index_inspeksi')}}";	
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
		}));

/*
		function simpan(){
			if (validation()) {
				overlayshow();
				
				$.ajax({
					type: 'get',
					data: $('#form').serialize()+"&_token={{ csrf_token() }}",
					dataType: 'json',
					url : '{{route('update_inspeksi')}}',
					success : function(response){
						if (response.status == 'berhasil') {
							iziToast.success({							    
							    message: "<i class='fa fa-clock-o'></i> <i>Berhasil Disimpan!</i>",
							    position: 'topRight',
							});
							$('.reset').val('');
							setTimeout(function () {
							window.location.href = "{{route('index_inspeksi')}}";	
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
		}*/





 /*function simpan(){
       $('#form').submit();
     
   }
*/
	
	setTimeout(function () {            
   			if ($(this).width() > 480) {
				$('body').addClass('mini-navbar');
   			}

   			else if ($(this).width() < 480) {
   				$('body').addClass('body-small');    
   				 $("#d").css('width','400%')
   				 $("#table").css('width','500%')
   			}
      }, 200);	
	/*	setTimeout(function () {
            
   $('body').addClass('mini-navbar');
      }, 200);*/

		function id_hitung_p(){			
		var a=0;
		var b=0;
		var c=0;
		var x=0;
		var p=0;
		if($('#dt_jumlah').val()!=''){
			a=parseInt($('#dt_jumlah').val());
		}
		if($('#dt_ada').val()!=''){
			b=parseInt($('#dt_ada').val());
		}
		if($('#dt_rusak').val()!=''){
			c=parseInt($('#dt_rusak').val());
		}

		x=b+c;
		p=(x/a)*100;
		$('#dt_presentase').val(parseInt(p))
	}


	function hitung_p(i){
		var a=0;
		var b=0;
		var c=0;
		var x=0;
		var p=0;
		if($('.jumlah'+i).val()!=''){
			a=parseInt($('.jumlah'+i).val());
		}
		if($('.ada'+i).val()!=''){
			b=parseInt($('.ada'+i).val());
		}
		if($('.rusak'+i).val()!=''){
			c=parseInt($('.rusak'+i).val());
		}

		x=b+c;
		p=(x/a)*100;
		$('.persen'+i).val(parseInt(p))
		total_p();
	}




	function total_p(){		
		var a=0;
		var b=0;
		var c=0;
		var p=0;
		var adaNRusak=0;
		var jumlah = $("input[name='jumlah[]']").map(function(){return $(this).val();}).get();
		var jumlah_ada = $("input[name='jumlah_ada[]']").map(function(){return $(this).val();}).get();
		var jumlah_rusak = $("input[name='jumlah_rusak[]']").map(function(){return $(this).val();}).get();


		for(var j = 0; j < jumlah_ada.length; j++){
			if(jumlah[j]!=''){
				a+=parseInt(jumlah[j]);
			}
			if(jumlah_ada[j]!=''){
				b+=parseInt(jumlah_ada[j]);
			}	
			if(jumlah_rusak[j]!=''){
			c+=parseInt(jumlah_rusak[j]);
			}
		}
		adaNRusak=b+c;
		p=(adaNRusak/a)*100;		
		$('#mP').val(parseInt(p));

	}

	var loadFile = function(event,id) {		
		$('.poto'+id).attr('name', 'foto'+id);
  var fsize = $('#chooseFile'+id)[0].files[0];
  if(!fsize){
  	  iziToast.warning({
        icon: 'fa fa-times',
        message: 'Belum Ada Foto!',
      });
      $("#output"+id).attr('src', baseUrl+'/'+$(".awal"+id).val());
  }
  else if(fsize.size>1048576) //do something if file size more than 1 mb (1048576)
  {
     /* iziToast.warning({
        icon: 'fa fa-times',
        message: 'File Is To Big!',
      });
      return false;*/
  }
  if(fsize){
  var reader = new FileReader();
  reader.onload = function(){
    var output = document.getElementById('output'+id);
    output.src = reader.result;
  };  
  reader.readAsDataURL(event.target.files[0]);
}
};


</script>
@endsection
