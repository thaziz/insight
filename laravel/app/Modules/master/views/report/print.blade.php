<table class="table table-striped" width="100%">
	<thead>
			<tr>
			<th rowspan="2" width="5%">No</th>
			<th rowspan="2" width="15%">Nama Item</th>
			<th rowspan="2" width="5%">Qty</th>
			@foreach($users['date'] as  $tgl)			
					<th colspan="5" width="55%">Inspeksi Triwulan {{$tgl->tgl}}</th>											
			@endforeach			
			</tr>
			<tr>
			@foreach($users['date'] as  $tgl)			
					<th>Ada</th>
					<th>Tidak Ada</th>
					<th>Rusak</th>					
					<th>Presentase</th>
					<th>Keterangan</th>
			@endforeach		
			</tr>	

		
	</thead>
	<tbody>
		@foreach($users['nama'] as $index => $n)		
			<tr>
				<td>{{$index+1}}</td>
				<td>{{$n->idt_nama}}</td>
				<td>{{$n->qty}}</td>
				@foreach($users['date'] as  $tgl)			
					{!!$n[$tgl->tgl]!!}
				@endforeach
			</tr>
		@endforeach
	</tbody>
</table>

