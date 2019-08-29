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
		<th>:{{$master->i_presentase}} %</th>
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
		<th>Foto</th>
	</thead>
	<tbody>
		@php
		$jumlah=0;
		$ada=0;
		$tidak=0;
		$rusak=0;
		@endphp
		@foreach($detail as $dt)
		@php
		$jumlah+=$dt->idt_jumlah;
		$ada+=$dt->idt_ada;
		$tidak+=$dt->idt_tidak;
		$rusak+=$dt->idt_rusak;
		@endphp
			<tr>
			<td>{{$dt->idt_nama}}</td>
			<td>{{$dt->idt_jumlah}}</td>
			<td>{{$dt->idt_satuan}}</td>
			<td>{{$dt->idt_ada}}</td>
			<td>{{$dt->idt_tidak}}</td>
			<td>{{$dt->idt_rusak}}</td>
			<td>{{$dt->idt_ket}}</td>
			<td>{{$dt->idt_presentase}}</td>
			<td><span align="center"><img src="{{ url('/') }}/{{$dt->idt_foto}}" alt="..." width="100px" height="100px" align="center" class="img-rounded"></span></td>
		</tr>
		@endforeach
	</tbody>
	<tfoot>
		<tr>
		<td></td>
		<td>{{$jumlah}}</td>
		<td></td>
		<td>{{$ada}}</td>
		<td>{{$ada+$rusak}}</td>
		<td>{{$rusak}}</td>
		<td></td>
		<td>{{$master->i_presentase}} %</td>
		<td></td>
		</tr>
	</tfoot>
</table>
<table width="100%" class="demo-table">
	<thead>
		<tr>
	<th style="text-align: center;">Manager Unit</th>
	<th style="text-align: center;">Manager Vendor</th>	
	<th style="text-align: center;">K3 Unit</th>
	<th style="text-align: center;">K3 Vendor</th>
	<th style="text-align: center;">Pemeriksa</th>
		</tr>
	</thead>
	<tbody>
		<tr>
		<td style="height: 100px"></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		</tr>
		<tr>
		<td style="text-align: center;">( {{$master->u_manager}} )</td>
		<td style="text-align: center;">( {{$master->v_manager}} )</td>
		<td style="text-align: center;">( {{$master->u_k3}} )</td>
		<td style="text-align: center;">( {{$master->v_k3}} )</td>
		<td style="text-align: center;">( {{Auth::user()->m_name}} )</td>
		</tr>
	</tbody>
</table>
</div>
