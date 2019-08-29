<table class="table" style="width:100%">
	<tr>
		<th width="20%">Unit <input type="hidden" name="in_id" id="in_id" value="{{$master->i_id}}"></th>
		<th width="30%">:{{$master->u_nama_unit}}</th>
		<th width="20%">Vendor</th>
		<th width="30%">:{{$master->v_nama}}</th>
	</tr>
	<tr>
		<th>No. Kontrak</th>
		<th>:{{$master->c_nomor_kontrak}}</th>
		<th>Tanggal</th>
		<th>:{{$master->i_tgl}}</th>
	</tr>
	<tr>
		<th>Triwulan</th>
		<th>:{{$master->i_triwulan}}</th>
		<th>Tahun</th>
		<th>:{{$master->i_tahun}}</th>
	</tr>
	<tr>
		<th>Presentase</th>
		<th>:{{$master->i_presentase}}</th>
	</tr>
</table>
<hr>
<div class="table-responsive">
<table class="table table-striped table-bordered" style="width:100%">
	<thead>
		<th>Nama Barang</th>
		<th>Jumlah</th>
		<th>Satuan</th>
		<th>Ada</th>
		<th>Tidak Ada</th>
		<th>Rusak</th>
		<th>Keterangan</th>
		<th>Presentase</th>
	</thead>
	<tbody>
		@foreach($detail as $dt)
			<tr>
			<td>{{$dt->idt_nama}}</td>
			<td>{{$dt->idt_jumlah}}</td>
			<td>{{$dt->idt_satuan}}</td>
			<td>{{$dt->idt_ada}}</td>
			<td>{{$dt->idt_tidak}}</td>
			<td>{{$dt->idt_rusak}}</td>
			<td>{{$dt->idt_ket}}</td>
			<td>{{$dt->idt_presentase}}</td>
		</tr>
		@endforeach
	</tbody>
</table>
</div>
