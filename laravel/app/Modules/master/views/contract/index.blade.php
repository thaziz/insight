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
	                		<a href="{{route('tambah_contract')}}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Tambah</a>
                		</div>
                	</div>
              <div class="row">                    
                  <div class="col-md-2 col-sm-6 col-xs-12">
                                            <label class="control-label" >Nama Unit</label>
                  </div>
                  <div class="col-md-3 col-sm-6 col-xs-12">                                            
                                            <input id="nama_unit" class="form-control" type="text" placeholder="Cari Nama Unit...." value="" name="nama_unit" data-column="2"/>
                  </div>

                  <div class="col-md-2 col-sm-6 col-xs-12">
                                            <label class="control-label" >No Kontrak</label>
                  </div>
                  <div class="col-md-3 col-sm-6 col-xs-12">                                            
                                            <input id="kontrak" class="form-control" type="text" placeholder="Cari No Kontrak...." value="" name="kontrak" data-column="2"/>
                  </div>
            </div>
      <div class="table-responsive enter">                        						
						<table class="table table-striped table-bordered table-hover" id="table" width="100%">
							<thead>
								<tr>
									<th data-hide="size_phone" width="5%">No</th>                  
									<th data-class="expand" width="15%">Nama Unit</th>									
                  <th data-class="expand" width="13%">Nama Vendor</th>                  
                  <th data-class="expand" width="13%">Pekerjaan</th>                  
                  <th data-class="expand" width="10%">Nomor Kontrak</th>                  
                  <th data-class="expand" width="8%">Tanggal Kontrak</th>                  
                  <th data-class="expand" width="9%">Durasi Kontrak</th>                  
									<th width="15%">Aksi</th>
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





<div class="modal inmodal fade" id="myModal5" tabindex="-1" role="dialog"  aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <h4 class="modal-title">Data Detail</h4>
                                            <small class="font-bold">Kontrak</small>
                                        </div>
                                        <div class="modal-body">
                                          <div class="table-responsive">
                                              <div id="data">
                                              
                                                
                                              </div>
                                              
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                          
                                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>                                            
                                        </div>
                                    </div>
                                </div>
                            </div>


@endsection
@section('extra_scripts')
<script type="text/javascript">
function detail(id){

      
        overlayshow();
        $.ajaxSetup({
          headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
          type: 'POST',
          data: $('#form').serialize()+"&_token={{ csrf_token() }}",          
          url : baseUrl+'/master-contract/detail/'+id,
          success : function(response){
             $('#data').html(response);
            overlayhide();
            $('#myModal5').modal('show');

          }
        });
      
    
}
var tablex;
setTimeout(function () {
            
   table();
      }, 200);

function table(){
   $('#table').dataTable().fnDestroy();
   tablex = $("#table").DataTable({                 
        "language": dataTableLanguage,
        processing: true,
            serverSide: true,
            ajax: {
              "url": "{{route('data_contract') }}",
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
            {data: 'u_nama_unit', name: 'u_nama_unit'},
            {data: 'v_nama', name: 'v_nama'},                 
            {data: 'c_pekerjaan', name: 'c_pekerjaan'},     
            {data: 'c_nomor_kontrak', name: 'c_nomor_kontrak'},     
            {data: 'c_tgl_kontrak', name: 'c_tgl_kontrak'},     
            {data: 'c_durasi_kontrak', name: 'c_durasi_kontrak'},     
            {data: 'action', name: 'action', searchable : false},
            
            ],
            //responsive: true,

            "pageLength": 10,
            "lengthMenu": [[10, 20, 50, - 1], [10, 20, 50, "All"]],
            
             
           
    });
}


 $('#nama_unit').on( 'keyup', function () {
    tablex
        .columns( 1 )
        .search( this.value )
        .draw();
    } );


 $('#kontrak').on( 'keyup', function () {
    tablex
        .columns( 4 )
        .search( this.value )
        .draw();
    } );

		function edit(id){
			window.location.href = baseUrl + '/master-contract/edit/'+id;
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
          url : baseUrl + '/master-contract/delete',
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
