<table class="table" style="width:100%">
	<tr>
		<th width="20%">Unit</th>
		<th width="30%">:{{$master->u_nama_unit}}</th>
		<th width="20%">Vendor</th>
		<th width="30%">:{{$master->v_nama}}</th>
	</tr>
	<tr>
		<th>Pekerjaan</th>
		<th>:{{$master->c_pekerjaan}}</th>
		<th>No Kontrak</th>
		<th>:{{$master->c_nomor_kontrak}}</th>
	</tr>
	<tr>
		<th>Tanggal Kontrak</th>
		<th>:{{$master->c_tgl_kontrak}}</th>
		<th>Durasi Kontrak</th>
		<th>:{{$master->c_durasi_kontrak}}</th>
	</tr>
</table>
<hr>
<table id="tb" class="table table-bordered" style="width:100%">
	<thead>
		<tr>
		<th>No</th>
		<th>Nama Barang</th>
		<th>Jumlah</th>
		<th>Satuan</th>
	</tr>
	</thead>
	<tbody>
		@foreach($detail as $index=> $dt)
			<tr>
			<td>{{$index+1}}</td>
			<td>{{$dt->cdt_nama}}</td>
			<td>{{$dt->cdt_jumlah}}</td>
			<td>{{$dt->cdt_satuan}}</td>
			</tr>
		@endforeach
	</tbody>
</table>
<script>
    $('#tb').dataTable();
</script>