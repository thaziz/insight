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
                                            <label class="control-label" >Nama Unit</label>
                  </div>
                  <div class="col-md-3 col-sm-6 col-xs-12">                                            
                                        
                   <select id="select_unit" name="unit" data-placeholder="pilih Unit..." class="chosen-select" style="width:100%;" tabindex="2">                
                    </select>
                  </div>
                  <div class="col-md-4 col-sm-6 col-xs-12">                                            
                     <div class="form-group">
                          <div class="input-daterange input-group">
                            <input id="date1" class="form-control input-sm datepicker2" name="tanggal1" type="text" >
                            <span class="input-group-addon">-</span>
                            <input id="date2"" class="input-sm form-control datepicker2" name="tanggal2" type="text" >
                          </div>
                        </div>
                  </div>



                  <div class="col-md-3 col-sm-6 col-xs-12">                                            
                                    <button title="Cari" type="button" class="btn btn-success" onclick="kt()"><i class="fa fa-search"  ></i></button>
                      <button title="Reset" type="button" class="btn btn-danger" onclick="ulangi()"><i class="fa fa-undo"></i></button>
                      <button title="Download Excel" type="button" class="btn btn-primary" onclick="excel()"><i class="fa fa-file-excel-o "></i></button>
                    </div>
</div>


                    <div class="table-responsive enter">                                    
                      <div id="tables"  class="table-responsive"></div>
                    </div>
                    <br>
                    <hr>
                    <div id="chart"></div>
                </div>
            </div>
        </div>
    </div>

</div>
</div>

@endsection
@section('extra_scripts')
<script type="text/javascript">


$.getJSON("{{route('select_unit')}}", function(json){
    var $select_elem = $("#select_unit");
    $select_elem.empty();
    $.each(json, function (idx, obj) {      
      $select_elem.append('<option>--Pilih Unit--</option>');
      for(x = 0;x < obj.length;x++) {  
                $select_elem.append('<option value="' + obj[x].u_id + '">' + obj[x].u_nama_unit+ '</option>');
        }

        
    });
    $select_elem.chosen({ width: "100%" });
})



  /* END BASIC */

function excel(){
  
  var unit=$('#select_unit').val();
  var tgl1=$('#date1').val();
  var tgl2=$('#date2').val();
  window.location=baseUrl+'/report-inspeksi/generate-excel?id='+unit+'&tgl1='+tgl1+'&tgl2='+tgl2;
}
    function kt(){  
  var unit=$('#select_unit').val();
  var tgl1=$('#date1').val();
  var tgl2=$('#date2').val();
  overlayshow();

        $.ajax({
          type: 'get',
          data: 'id='+unit+'&tgl1='+tgl1+'&tgl2='+tgl2+"&_token={{ csrf_token() }}",          
          url : '{{route('reporttable_report')}}',
          success : function(response){                       
            $('#tables').html(response);
            

          }
        });
  

            $.ajax({
          type: 'get',
          data: 'id='+unit+'&tgl1='+tgl1+'&tgl2='+tgl2+"&_token={{ csrf_token() }}",          
          url : '{{route('chart_report')}}',          
          success : function(response){     
              $('#chart').html(response);  
            overlayhide();

          }
        });

}

tanggalAwal();
function tanggalAwal(){ 
  
        var d = new Date();
          d.setDate(d.getDate());
          $('#date1').datepicker({                
            format : "dd-mm-yyyy",
        changeMonth: true,
        prevText: '<i class="fa fa-chevron-left"></i>',
        nextText: '<i class="fa fa-chevron-right"></i>',
        option : "disabled",        
          }).datepicker( "setDate", d);

           $('#date2').datepicker({
            format : "dd-mm-yyyy",
        changeMonth: true,
        prevText: '<i class="fa fa-chevron-left"></i>',
        nextText: '<i class="fa fa-chevron-right"></i>',
        option : "disabled",             
          }).datepicker( "setDate", d);
}
function ulangi(){  
  tanggalAwal()
  $('#chart').html('');  
  $('#tables').html('');
}
</script>
@endsection
