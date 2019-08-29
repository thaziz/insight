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
                		</div>
                	</div>
                
 <div class="row">                    
                  <div class="col-md-2 col-sm-6 col-xs-12">
                                            <label class="control-label" >Nama</label>
                  </div>
                  <div class="col-md-3 col-sm-6 col-xs-12">                                            
                                            <input id="nama" class="form-control" type="text" placeholder="Cari history...." value="" name="nama" data-column="2"/>
                  </div>
      </div>


                    <div class="table-responsive enter">                        						
						<table class="table table-striped table-bordered table-hover" id="table" width="100%">
							<thead>
								<tr>
									<th data-hide="size_phone" width="5%">No</th>
									<th data-class="expand" width="8%">Kode</th>									
                  <th data-class="expand" width="10%">Jumlah Main</th>                 
                  <th data-class="expand" width="10%">Hadiah</th>                 
                  <th data-class="expand" width="10%">Jam</th>        
									<!-- <th width="10%">Aksi</th> -->
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
              "url": "{{ url("master-history/data") }}",
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
            {data: 'kode', name: 'kode'},            
            {data: 'main', name: 'main'},            
            {data: 'hadiah', name: 'hadiah'},            
            {data: 'jam', name: 'jam'},            
            /*{data: 'action', name: 'action', searchable : false},*/
            
            ],
            //responsive: true,

            "pageLength": 10,
            "lengthMenu": [[10, 20, 50, - 1], [10, 20, 50, "All"]],
            
             
           
    });
}


 $('#nama').on( 'keyup', function () {
    tablex
        .columns( 3 )
        .search( this.value )
        .draw();
    } );


		function edit(id){
			window.location.href = baseUrl + '/master-history/edit/'+id;
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
          url : baseUrl + '/master-history/delete',
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
