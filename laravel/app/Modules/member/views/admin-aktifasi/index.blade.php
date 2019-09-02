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
	                		 <div class="col-sm-12">
                          <!-- <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Tambah Team</button> -->
                        </div>
                		</div>
                	</div>
                
                    <div class="table-responsive enter">                        						
						<table class="table table-striped table-bordered table-hover" id="table_kategori" width="100%">
							<thead>
								<tr>									
									  <th data-class="expand">Nama</th>
                    <th data-class="expand">E-mail</th>
                    <th data-class="expand">No Telpon</th>                  
                    <th data-class="expand">Tanggal Expired</th>
                    <th data-class="expand">Status verifikasi</th>
                    <th data-class="expand">Status Trial</th>
                    <th data-class="expand">Status Member</th>
                    <!-- <th>Aksi</th> -->
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

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Aktifasi Member</h4>
      </div>
      <div class="modal-body">
        
         <form class="form-horizontal" role="form" id="fregister">
              <div class="form-group">      
              <div class="col-md-3 col-sm-6 col-xs-12">
                <label>Nama <span style="color: red"> *</span></label>
              </div>
              <div class="col-md-7 col-sm-6 col-xs-12">
                <div class="form-group form-group-sm" id="div_kategori">
                  <input type="hidden" name="m_id" >
                    <input class="form-control" type="text" name="user" id="user" readonly="">
                    <input class="form-control" type="text" name="member" id="member" readonly="">
                    <input class="form-control" type="text" name="invoice" id="invoice" readonly="">
                    <input class="form-control" type="text" name="nama" id="nama" readonly="">
                </div>
              </div>

              <div class="col-md-3 col-sm-6 col-xs-12">
                <label>E-mail <span style="color: red"> *</span></label>
              </div>
              <div class="col-md-7 col-sm-6 col-xs-12">
                <div class="form-group form-group-sm" id="div_kategori">
                    <input class="form-control" type="text" name="email" id="email" readonly="">
                </div>
              </div>

              <div class="col-md-3 col-sm-6 col-xs-12">
                <label>No. Telpon <span style="color: red"> *</span></label>
              </div>
              <div class="col-md-7 col-sm-6 col-xs-12">
                <div class="form-group form-group-sm" id="div_kategori">
                    <input class="form-control" type="text" name="no_telpon" id="no_telpon" readonly="">
                </div>
              </div>

              <div class="col-md-3 col-sm-6 col-xs-12">
                <label>Paket<span style="color: red"> *</span></label>
              </div>
              <div class="col-md-7 col-sm-6 col-xs-12">
                <div class="form-group form-group-sm" id="div_kategori">
                    <input class="form-control" type="text" name="paket" id="paket" readonly="">
                </div>
              </div>

              <div class="col-md-3 col-sm-6 col-xs-12">
                <label>Bank<span style="color: red"> *</span></label>
              </div>
              <div class="col-md-7 col-sm-6 col-xs-12">
                <div class="form-group form-group-sm" id="div_kategori">
                    <input class="form-control" type="text" name="bank" id="bank" readonly="">
                </div>
              </div>

              <div class="col-md-3 col-sm-6 col-xs-12">
                <label>No Rek<span style="color: red"> *</span></label>
              </div>
              <div class="col-md-7 col-sm-6 col-xs-12">
                <div class="form-group form-group-sm" id="div_kategori">
                    <input class="form-control" type="text" name="norek" id="norek" readonly="">
                </div>
              </div>


              <div class="col-md-3 col-sm-6 col-xs-12">
                <label>Bukti Pembayaran <span style="color: red"> *</span></label>
              </div>
              <div class="col-md-7 col-sm-6 col-xs-12">
                <div class="form-group form-group-sm" id="div_img">
                   <img src="" id="pic" >
                </div>
              </div>

              <div class="col-md-3 col-sm-6 col-xs-12">
                <label>Status Member<span style="color: red"> *</span></label>
              </div>
              <div class="col-md-7 col-sm-6 col-xs-12">
                <div class="form-group form-group-sm" id="div_kategori">
                    <select class="form-control" name="status">
                      <option value="Y">Aktif</option>
                      <option value="N">Non Aktif</option>
                    </select>
                </div>
              </div>

            </div>
            </form>  
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" type="button" onclick="aktifasi()">Simpan</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<!-- modal gambar -->


<div id="modalgambar" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Bukti Pembayaran</h4>
      </div>
      <div class="modal-body">
      <div id="lihatgambar" align="center">
        
      </div>  
      
      </div>
      <div class="modal-footer">        
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
              "url": "{{route('admin-aktifasi-data')}}",
              "type": "POST",
              data: {
                    "_token": "{{ csrf_token() }}",
                    "type"  :"toko",
                    "tanggal1" :$('#tanggal1').val(),
                    "tanggal2" :$('#tanggal2').val(),
                    },
              },
            columns: [
            
             {data: 'm_username', name: 'm_username'},
            {data: 'm_email', name: 'm_email'},
            {data: 'm_hp', name: 'm_hp'},
            {data: 'm_status_expired', name: 'm_status_expired'},
            {data: 'status_verifikasi', name: 'status_verifikasi'},
            {data: 'status_trial', name: 'status_trial'},
            {data: 'status_aktif', name: 'status_aktif'},
            /*{data: 'action', name: 'action'},*/
            
            ],
            //responsive: true,

            "pageLength": 10,
            "lengthMenu": [[10, 20, 50, - 1], [10, 20, 50, "All"]],
            
             
           
    });
}


    function lihatgambar(gambar){     

$("#lihatgambar").html('<img src="'+gambar+'" width="400px" height="400px">');
$('#modalgambar').modal('show')

    }

		function verifikasiAdmin(id,token){			
        $('.loader').css('display','')
        $(".loader").fadeIn("slow");
         $.ajax({
          /*url     :  baseUrl+'/verifikasi-admin/status',*/
          url     :  baseUrl+'/admin-aktifasi/data-verivikasi',
          type    : 'GET', 
          data    :  'm_id='+id+"&_token={{ csrf_token() }}",
          dataType: 'json',
          success : function(response){    
                    if(response.status=='sukses'){
                      console.log(response);
                      $('#nama').val(response.mem['m_username']);
                      $('#email').val(response.mem['m_email']);
                      $('#no_telpon').val(response.mem['m_hp']);                      
                      $('#user').val(response.invoice['i_user_id']);  
                      $('#member').val(response.mem['m_id']);                        
                      $('#invoice').val(response.invoice['i_id']);  
                      $('#paket').val(response.invoice['mp_paket']+'/ '+response.invoice['mp_nominal']+'/ '+response.invoice['mp_ket']);                      
                      $('#bank').val(response.invoice['ba_name']+'/ A.n'+response.invoice['ba_an']);
                      $('#norek').val(response.invoice['ba_no_rek']);
                      var a=baseUrl+'/'+response.invoice['i_image'];                      
                      $("#div_img").html('<img src="'+a+'" id="pic" onclick="lihatgambar(\''+a+'\')" >');
                      
                      
                      $('#myModal').modal('show')

                        $(".loader").fadeOut("slow");
                    }else if(response.status=='gagal'){
                        $('#myModal').modal('show')
                        iziToast.error({                  
                          message: response.konten,
                          position: 'topRight',
                        });                        
                        $(".loader").fadeOut("slow");
                    }                    
          },

          error: function(jqXHR, exception) {
            if (jqXHR.status === 0) {
                alert('Not connect.\n Verify Network.');
                $(".loader").fadeOut("slow");
            } else if (jqXHR.status == 404) {
                alert('Requested page not found. [404]');
                $(".loader").fadeOut("slow");
            } else if (jqXHR.status == 500) {
                $(".loader").fadeOut("slow");
                alert('Internal Server Error [500].');
            } else if (exception === 'parsererror') {
                $(".loader").fadeOut("slow");
                alert('Requested JSON parse failed.');                
            } else if (exception === 'timeout') {
                $(".loader").fadeOut("slow");
                alert('Time out error.');
            } else if (exception === 'abort') {
                $(".loader").fadeOut("slow");
                alert('Ajax request aborted.');
            } else {
                $(".loader").fadeOut("slow");
                alert('Uncaught Error.\n' + jqXHR.responseText);
            }
        }
      });
		}

  function aktifasi(){            
        $('.loader').css('display','')
        $(".loader").fadeIn("slow");
        var formInput=$('#fregister').serialize();        
         $.ajax({
          url     :  baseUrl+'/verifikasi-admin/simpan-status',
          type    : 'GET', 
          data    :  formInput+"&_token={{ csrf_token() }}",
          dataType: 'json',
          success : function(response){    
                    if(response.status=='sukses'){
                      iziToast.success({                  
                          message: "<i class='fa fa-clock-o'></i> <i>"+response.konten+"</i>",
                          position: 'topRight',
                      });
                      location.reload();
                        $('#selamat').css('display','')
                        $(".loader").fadeOut("slow");
                    }else if(response.status=='gagal'){
                        iziToast.error({                  
                          message: response.konten,
                          position: 'topRight',
                        });
                        $('#selamat').css('display','none')
                        $(".loader").fadeOut("slow");

                    }
                    
          },

          error: function(jqXHR, exception) {
            if (jqXHR.status === 0) {
                alert('Not connect.\n Verify Network.');
                $(".loader").fadeOut("slow");
            } else if (jqXHR.status == 404) {
                alert('Requested page not found. [404]');
                $(".loader").fadeOut("slow");
            } else if (jqXHR.status == 500) {
                $(".loader").fadeOut("slow");
                alert('Internal Server Error [500].');
            } else if (exception === 'parsererror') {
                $(".loader").fadeOut("slow");
                alert('Requested JSON parse failed.');                
            } else if (exception === 'timeout') {
                $(".loader").fadeOut("slow");
                alert('Time out error.');
            } else if (exception === 'abort') {
                $(".loader").fadeOut("slow");
                alert('Ajax request aborted.');
            } else {
                $(".loader").fadeOut("slow");
                alert('Uncaught Error.\n' + jqXHR.responseText);
            }
        }


      });
    }

</script>
@endsection
