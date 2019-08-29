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
	                		<a href="{{route('tambah_user')}}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Tambah</a>
                		</div>
                	</div>
                
    <div class="row">                    
                  <div class="col-md-2 col-sm-6 col-xs-12">
                                            <label class="control-label" >Nama</label>
                  </div>
                  <div class="col-md-3 col-sm-6 col-xs-12">                                            
                                            <input id="nama" class="form-control" type="text" placeholder="Cari Nama...." value="" name="nama" data-column="2"/>
                  </div>

                  <div class="col-md-2 col-sm-6 col-xs-12">
                                            <label class="control-label" >NIP</label>
                  </div>
                  <div class="col-md-3 col-sm-6 col-xs-12">                                            
                                            <input id="nip" class="form-control" type="text" placeholder="Cari NIP...." value="" name="nip" data-column="2"/>
                  </div>
      </div>

                    <div class="table-responsive enter">                        						
						<table class="table table-striped table-bordered table-hover" id="table" width="100%">
							<thead>
								<tr>
									<th data-hide="size_phone" width="5%">No</th>
                  <th data-class="expand" width="20%">Nama</th>                  
									<th data-class="expand" width="15%">NIP</th>									
                  <th data-class="expand" width="15%">Bidang</th>                  
                  <th data-class="expand" width="15%">E-mail</th>                  
                  <th data-class="expand" width="13%">Handphone</th>                  
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
              "url": "{{route('data_user') }}",
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
            {data: 'm_name', name: 'm_name'},
            {data: 'm_nip', name: 'm_nip'},
            {data: 'm_bidang', name: 'm_bidang'},
            {data: 'm_email', name: 'm_email'},
            {data: 'm_hp', name: 'm_hp'},
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

  $('#nip').on( 'keyup', function () {
    tablex
        .columns( 2 )
        .search( this.value )
        .draw();
    } );

		function edit(id){
			window.location.href = baseUrl + '/master-user/edit/'+id;
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
          url : baseUrl + '/master-user/delete',
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
