<style type="text/css">
	.demo-table {
            border-collapse: collapse;
            font-size: 13px;
        }
        .demo-table th, 
        .demo-table td {
            border: 1px solid ;
            padding: 7px 17px;
        }
        .demo-table .title {
            caption-side: bottom;
            margin-top: 12px;
        }
        
        /* Table Header */
        .demo-table thead th {
            background-color: #f7f7f7;
            /*color: #FFFFFF;*/
            /*border-color: #6ea1cc !important*/;
            text-transform: uppercase;
        }
        
        /* Table Body */
        .demo-table tbody td {
            /*color: #353535;*/
        }
        .demo-table tbody td:first-child,
        .demo-table tbody td:last-child,
        .demo-table tbody td:nth-child(4) {
            
        }
        .demo-table tbody tr:nth-child(odd) td {
            /*background-color: #f4fbff;*/
        }
        .demo-table tbody tr:hover td {
            /*background-color: #ffffa2;*/
            border-color: #ffff0f;
            transition: all .2s;
        }
        
        /* Table Footer */
        .demo-table tfoot th {
            background-color: #e5f5ff;
        }
        .demo-table tfoot th:first-child {
            text-align: left;
        }
        .demo-table tbody td:empty
        {
            /*background-color: #ffcccc;*/
        }

        table { page-break-inside:auto }
    tr    { page-break-inside:avoid; page-break-after:auto }
    thead { display:table-header-group }

</style>
<table width="100%">
	<thead>
		<tr>
			<th><img height="80px" width="60px" src="{{url('/')}}/image/1.png"></th>
			<th></th>
			<th style="text-align: right;" ><img height="80px" width="85px" src="{{url('/')}}/image/2.png"></th>
		</tr>
	</thead>
</table>
<br>
<br>
<table class="table" style="width:100%">
	<tr>
		<th width="20%">Unit</th>
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
<br>
<br>
<div class="table-responsive">
<table class="table table-striped table-bordered demo-table" style="width:100%">
	<thead>
		<tr>
		<th>Nama Barang</th>
		<th>Jumlah</th>
		<th>Satuan</th>
		<th>Ada</th>
		<th>Tidak Ada</th>
		<th>Rusak</th>
		<th>Keterangan</th>
		<th>Presentase</th>		
		</tr>
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
		<td></td>		
		</tr>
	</tfoot>
</table>
<br>
<br>
<br>
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
