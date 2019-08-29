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
	                		<a href="{{route('tambah_unit')}}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Tambah</a>
                		</div>
                	</div>


 <div class="row">                    
                  <div class="col-md-2 col-sm-6 col-xs-12">
                                            <label class="control-label" >Nama Unit</label>
                  </div>
                  <div class="col-md-3 col-sm-6 col-xs-12">                                            
                                            <input id="nama" class="form-control" type="text" placeholder="Cari Nama...." value="" name="nama" data-column="2"/>
                  </div>
      </div>
                
                    <div class="table-responsive enter">                        						
						<table class="table table-striped table-bordered table-hover" id="table" width="100%">
							<thead>
		<tr>
			<th data-hide="size_phone" width="5%">No</th>
      <th data-class="expand" width="15%">Nama Induk</th>                  
			<th data-class="expand" width="15%">Nama Unit</th>	
			<th data-class="expand" width="15%">Manager</th>  
      <th data-class="expand" width="15%">K3</th>  
      <th data-class="expand" width="15%">Nama Alamat</th>                  
			<th width="10%">Aksi</th>
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
   $('#table').dataTable().fnDestroy();
   tablex = $("#table").DataTable({        
         responsive: true,
        "language": dataTableLanguage,
        processing: true,
            serverSide: true,
            ajax: {
              "url": "{{route('data_unit') }}",
              "type": "POST",
              data: {
                    "_token": "{{ csrf_token() }}",
                    "type"  :"toko",
                    "tanggal1" :$('#tanggal1').val(),
                    "tanggal2" :$('#tanggal2').val(),
                    },
              },
            columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'i_nama', name: 'i_nama'},            
            {data: 'u_nama_unit', name: 'u_nama_unit'},     
            {data: 'u_manager', name: 'u_manager'},     
            {data: 'u_k3', name: 'u_k3'},     
            {data: 'u_alamat', name: 'u_alamat'},     
            {data: 'action', name: 'action', searchable : false},
            
            ],
            //responsive: true,

            "pageLength": 10,
            "lengthMenu": [[10, 20, 50, - 1], [10, 20, 50, "All"]],
            
             
           
    });
}



 $('#nama').on( 'keyup', function () {
    tablex
        .columns( 2 )
        .search( this.value )
        .draw();
    } );



		function edit(id){
			window.location.href = baseUrl + '/master-unit/edit/'+id;
		}

     function hapus(id){      
        overlayshow();
        $.ajaxSetup({
          headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
          type: 'POST',
          data: 'id='+id+"&_token={{ csrf_token() }}",
          dataType: 'json',
          url : baseUrl + '/master-unit/delete',
          success : function(response){
            if (response.status == 'berhasil') {
              iziToast.success({                  
                  message: "<i class='fa fa-clock-o'></i> <i>Berhasil Dihapus!</i>",
                  position: 'topRight',
              });
              table();
              /*window.location.href = baseUrl + '/user/user/user';*/
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
	/* END BASIC */
</script>
@endsection
