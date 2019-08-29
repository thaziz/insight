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
	                		<a href="{{route('tambah_inspeksi')}}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Tambah</a>
                		</div>
                	</div>

      <div class="row enter">                    
          <div class="col-md-1 col-sm-6 col-xs-12">
            <label class="control-label" >Unit</label>
          </div>
          <div class="col-md-3 col-sm-6 col-xs-12">                                            
            <input id="nama" class="form-control" type="text" placeholder="Cari Nama Unit...." value="" name="nama" data-column="2"/>
          </div>
          <div class="col-md-1 col-sm-6 col-xs-12">
            <label class="control-label" >Kontrak</label>
          </div>
          <div class="col-md-3 col-sm-6 col-xs-12">                                            
            <input id="no" class="form-control" type="text" placeholder="Cari No Kontrak...." value="" name="nama" data-column="2"/>
          </div>
          <div class="col-md-1 col-sm-6 col-xs-12">
            <label class="control-label" >Tanggal</label>
          </div>
          <div class="col-md-3 col-sm-6 col-xs-12">                                            
            <input id="tgl" class="form-control" type="text" placeholder="Cari Tanggal...." value="" name="nama" data-column="2"/>
          </div>
      </div>
 
                
                    <div class="table-responsive enter">                        						
						<table class="table table-striped table-bordered table-hover" id="table" width="100%">
							<thead>
								<tr>
									<th data-hide="size_phone" width="5%">No</th>                  
									<th data-class="expand" width="10%">Nama Unit</th>									
                  <th data-class="expand" width="12%">Kontrak</th>                  
                  <th data-class="expand" width="10%">Nama Vendor</th>                  
                  <th data-class="expand" width="8%">Tanggal</th>                  
                  <th data-class="expand" width="4%">Triwulan</th>                  
                  <th data-class="expand" width="9%">Tahun</th>                  
									<th width="13%">Aksi</th>
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
                                            <small class="font-bold">Inspeksi</small>
                                        </div>
                                        <div class="modal-body">
                                            <div id="data">
                                              
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-danger" onclick="pdf()">Print PDF</button>    
                                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>                                            
                                        </div>
                                    </div>
                                </div>
                            </div>


@endsection
@section('extra_scripts')
<script type="text/javascript">
function pdf(){
  var id=$('#in_id').val();  
  window.location=baseUrl+'/master-inspeksi/generate-pdf/'+id;
  
}
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
          /*dataType: 'json',*/
          url : baseUrl+'/master-inspeksi/detail/'+id,
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
         responsive: true,
        "language": dataTableLanguage,
        processing: true,
            serverSide: true,
            ajax: {
              "url": "{{route('data_inspeksi') }}",
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
            {data: 'c_nomor_kontrak', name: 'c_nomor_kontrak'},                 
            {data: 'v_nama', name: 'v_nama'},                 
            {data: 'i_tgl', name: 'i_tgl'},     
            {data: 'i_triwulan', name: 'i_triwulan'},     
            {data: 'i_tahun', name: 'i_tahun'},     
            {data: 'action', name: 'action', searchable : false},
            
            ],
            //responsive: true,

            "pageLength": 10,
            "lengthMenu": [[10, 20, 50, - 1], [10, 20, 50, "All"]],
            
             
           
    });
}

 $('#nama').on( 'keyup', function () {
    tablex
        .columns( 1 )
        .search( this.value )
        .draw();
    } );

 $('#no').on( 'keyup', function () {
    tablex
        .columns( 2 )
        .search( this.value )
        .draw();
    } );

  $('#tgl').on( 'keyup', function () {
    tablex
        .columns( 4 )
        .search( this.value )
        .draw();
    } );


		function edit(id){
			window.location.href = baseUrl + '/master-inspeksi/edit/'+id;
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
          url : baseUrl + '/master-inspeksi/delete',
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
