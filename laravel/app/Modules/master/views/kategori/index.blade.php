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
	                		<a href="{{route('tambah_kategori')}}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Tambah</a>
                		</div>
                	</div>
                
                    <div class="table-responsive enter">                        						
						<table class="table table-striped table-bordered table-hover" id="table_kategori" width="100%">
							<thead>
								<tr>
									<th data-hide="size_phone" width="1%">No</th>
									<th data-class="expand">Nama</th>
									<th data-class="expand">Status</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody id="showdata">
							</tbody>
						</table>
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

var tablex;
setTimeout(function () {
            
   table();
      }, 200);

function table(){
   $('#table_kategori').dataTable().fnDestroy();
   tablex = $("#table_kategori").DataTable({        
         responsive: true,
        "language": dataTableLanguage,
    processing: true,
            serverSide: true,
            ajax: {
              "url": "{{ url("master/kategori-barang/data") }}",
              "type": "get",
              data: {
                    "_token": "{{ csrf_token() }}",
                    "type"  :"toko",
                    "tanggal1" :$('#tanggal1').val(),
                    "tanggal2" :$('#tanggal2').val(),
                    },
              },
            columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'k_name', name: 'k_name'},
            {data: 'k_status', name: 'k_status'},
            {data: 'action', name: 'action'},
            
            ],
            //responsive: true,

            "pageLength": 10,
            "lengthMenu": [[10, 20, 50, - 1], [10, 20, 50, "All"]],
            
             
           
    });
}


		function edit(id){
			window.location.href = baseUrl + '/user/user/edituser/'+id;
		}
	/* END BASIC */
</script>
@endsection
