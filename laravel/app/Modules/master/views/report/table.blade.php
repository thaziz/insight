@if(count($date)>0)
<table class="table" width="100%">
	<thead>
			<tr>
			<th rowspan="2">No</th>
			<th rowspan="2">Nama Item</th>
			<th rowspan="2">Qty</th>
			@foreach($date as  $tgl)			
					<th>Inspeksi Triwulan {{$tgl->tgl}}</th>											
			@endforeach			
			</tr>
			@foreach($date as  $tgl)			
					<th>Keterangan</th>
			@endforeach			

		
	</thead>
	<tbody>
		@foreach($nama as $index => $n)		
			<tr>
				<td>{{$index+1}}</td>
				<td>{{$n->idt_nama}}</td>
				<td>{{$n->qty}}</td>
				@foreach($date as  $tgl)			
					<td>{{$n[$tgl->tgl]}}</td>					
				@endforeach
			</tr>
		@endforeach
	</tbody>
</table>
<br>
<hr>
@else
<h2>Data Tidak Ada</h2>
@endif