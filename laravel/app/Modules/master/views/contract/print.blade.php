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
            color: #353535;
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
            background-color: #ffcccc;
        }

        table { page-break-inside:auto }
    tr    { page-break-inside:avoid; page-break-after:auto }
    thead { display:table-header-group }

</style>
<br>
<br>
<br>
<table class="table" style="width:100%">
	<tr>
		<th width="20%">Unit</th>
		<td width="30%">:{{$master->u_nama_unit}}</td>
		<th width="20%">Vendor</th>
		<td width="30%">:{{$master->v_nama}}</td>
	</tr>
	<tr>
		<th>Pekerjaan</th>
		<td> :{{$master->c_pekerjaan}}</th>
		<th>No Kontrak</th>
		<td>:{{$master->c_nomor_kontrak}}</th>
	</tr>
	<tr>
		<th>Tanggal Kontrak</th>
		<td> :{{$master->c_tgl_kontrak}}</th>
		<th>Durasi Kontrak</th>
		<td>:{{$master->c_durasi_kontrak}}</th>
	</tr>
</table>
<br>
<table class="table table-bordered demo-table" style="width:100%">
	<thead>
		<tr>
		<th>Nama Barang</th>
		<th>Jumlah</th>
		<th>Satuan</th>
	</tr>
	</thead>
	<tbody>
		@foreach($detail as $dt)
			<tr>
			<td>{{$dt->cdt_nama}}</td>
			<td>{{$dt->cdt_jumlah}}</td>
			<td>{{$dt->cdt_satuan}}</td>
			</tr>
		@endforeach
	</tbody>
</table>
