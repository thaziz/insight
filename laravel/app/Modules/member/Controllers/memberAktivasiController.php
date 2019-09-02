<?php




namespace App\Modules\member\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pengguna;
use DB;
use Auth;
use Carbon\Carbon;
use App\Modules\master\model\m_kode;
use App\Modules\master\model\m_group;
use Yajra\Datatables\Datatables;
use Validator;
use File;

class memberAktivasiController extends Controller
{
    function index(){  
      $m_id=Auth::user()->u_member;  	
    	return view('member::member.index',compact('m_id'));
    }
    function data(){
         $m_id=Auth::user()->u_member;
         $getdata = DB::table('member')->where('m_id',$m_id)->get();         
          return Datatables::of($getdata)
              ->addIndexColumn()
              ->addColumn('action', function ($getdata) {

                if($getdata->m_status_trial=='Y' and $getdata->m_status_active=='Y'){
                      return '<center><div class="btn-group btn-group-sm">
                      <button class="btn btn-primary" onclick="daftar('.$getdata->m_id.')" rel="tooltip" data-placement="top" data-original-Approve="Daftar Member"><i class="fa fa-list-o"></i></button>';
                }
                else if($getdata->m_status_trial=='Y' and $getdata->m_status_active=='N'){
                    return '<center><div class="btn-group btn-group-sm">
                      <button class="btn btn-info" onclick="verifikasi('.$getdata->m_id.',\''.md5($getdata->m_email).'\')" rel="tooltip" data-placement="top" title="Aktivasi Member"><i class="glyphicon glyphicon-check"></i></button>
                      <button class="btn btn-warning" onclick="daftar('.$getdata->m_id.')" rel="tooltip" data-placement="top" title="Daftar Member"><i class="fa fa-list"></i></button>';
                }              
              })    
                  ->addColumn('status_verifikasi', function ($getdata) {
                  if($getdata->m_status_verifikasi=='Y'){
                      return '<div  style="text-align: center;" ><span class="label label-primary">Sudah</span></div>';
                  }
                  else if($getdata->m_status_verifikasi=='N'){
                    return '<div  style="text-align: center;" ><span class="label label-danger">Belum</span></div>'; 
                  }
                 
              })   
               ->addColumn('status_trial', function ($getdata) {
                 if($getdata->m_status_trial=='Y'){
                      return '<div  style="text-align: center;" ><span class="label label-primary">Trial</span></div>';
                  }
                  else if($getdata->m_status_trial=='N'){
                    return '<div  style="text-align: center;" ><span class="label label-danger">Trial</span></div>'; 
                  }
              })
              ->addColumn('status_aktif', function ($getdata) {
                  if($getdata->m_status_active=='Y'){
                      return '<div  style="text-align: center;" ><span class="label label-primary">Aktif</span></div>';
                  }
                  if($getdata->m_status_active=='N'){
                      return '<div  style="text-align: center;" ><button class="btn btn-danger btn-xs" tooltip="true" title="Klik Untuk Aktifasi" onclick="verifikasi('.$getdata->m_id.',\''.md5($getdata->m_email).'\')" >Tidak</button></div>';
                  }
                   if($getdata->m_status_active=='B'){
                      return '<div  style="text-align: center;" ><span class="label label-warning btn-xs" tooltip="true" title="Klik Untuk Aktifasi">Sudah Membayar</span></div>';
                  }
              })                
              ->rawColumns(['action','status_verifikasi','status_trial','status_aktif'])
              ->make(true); 
    }


    function dataChild(){
         $m_id=Auth::user()->u_member;
         $getdata = DB::table('member')->where('m_parrent_m_id',$m_id)->get();
          return Datatables::of($getdata)
              ->addIndexColumn()
              ->addColumn('action', function ($getdata) {

                if($getdata->m_status_trial=='Y' and $getdata->m_status_active=='Y'){
                      return '<center><div class="btn-group btn-group-sm">
                      <button class="btn btn-primary" onclick="daftar('.$getdata->m_id.')" rel="tooltip" data-placement="top" data-original-Approve="Daftar Member"><i class="fa fa-list-o"></i></button>';
                }
                else if($getdata->m_status_trial=='Y' and $getdata->m_status_active=='N'){
                    return '<center><div class="btn-group btn-group-sm">
                      <button class="btn btn-info" onclick="verifikasi('.$getdata->m_id.',\''.md5($getdata->m_email).'\')" rel="tooltip" data-placement="top" title="Aktivasi Member"><i class="glyphicon glyphicon-check"></i></button>
                      <button class="btn btn-warning" onclick="daftar('.$getdata->m_id.')" rel="tooltip" data-placement="top" title="Daftar Member"><i class="fa fa-list"></i></button>';
                }   
                           
              }) 
              ->addColumn('status_verifikasi', function ($getdata) {
                  if($getdata->m_status_verifikasi=='Y'){
                      return '<div  style="text-align: center;" ><span class="label label-primary">Sudah</span></div>';
                  }
                  else if($getdata->m_status_verifikasi=='N'){
                    return '<div  style="text-align: center;" ><span class="label label-danger">Belum</span></div>'; 
                  }
                 
              })   
               ->addColumn('status_trial', function ($getdata) {
                 if($getdata->m_status_trial=='Y'){
                     return '<div  style="text-align: center;" ><span class="label label-primary">Trial</span></div>';
                  }
                  else if($getdata->m_status_trial=='N'){
                    return '<div  style="text-align: center;" ><span class="label label-danger">Trial</span></div>'; 
                  }
              })
              ->addColumn('status_aktif', function ($getdata) {
                  if($getdata->m_status_active=='Y'){
                      return '<div  style="text-align: center;" ><span class="label label-primary">Aktif</span></div>';
                  }
                  if($getdata->m_status_active=='N'){
                      return '<div  style="text-align: center;" ><button class="btn btn-danger btn-xs" tooltip="true" title="Lakukan Perpanjangan" onclick="verifikasi('.$getdata->m_id.',\''.md5($getdata->m_email).'\')" >Non Aktif</button></div>';
                  }
                   if($getdata->m_status_active=='B'){
                      return '<div  style="text-align: center;" ><span class="label label-warning btn-xs" tooltip="true" title="Klik Untuk Aktifasi">Sudah Membayar</span></div>';
                  }
              })                
              ->rawColumns(['action','status_verifikasi','status_trial','status_aktif'])
              ->make(true); 
    }
    function data_verifikasi($id,$token){

      $data=Pengguna::where('u_member',$id)
            ->leftjoin('member','m_id','=','u_member')
            ->leftjoin('session','u_id','=','s_user_id')
            ->first();
      if($data->m_parrent_m_id==0){
        $no=$this->getCodeGenerated('TR-');
      }else{
        $no=$this->getCodeGenerated('AT-');  
      }

      if($token==md5($data->u_username)){               
        $paket=DB::table('master_paket')->get();
        $bank=DB::table('bank_account')->get();
        return view('member::member.tambah',compact('data','paket','bank','no')); 
      }else{
        return '404';
      }
    }  

public function getCodeGenerated($kode){
        $no=DB::SELECT("SELECT 
        substring(max(i_invoice),4) as no 
        FROM invoice");

        $index = $no[0]->no + 1;
        $index = str_pad($index, 4, '0' , STR_PAD_LEFT);
        $nota = $kode . $index;        
        return $nota;
    }


  
    function simpan(Request $req){
    	DB::beginTransaction();
        try {      
          
        $rules = array(
            'bank' => 'required',
            'paket' => 'required',
            'no' => 'required',
        );
        $custom=[
                  'required'             => ':Attribute Wajib Di isi.',
                  'numeric'             => ':Attribute Wajib Angka',
                  'email'                => 'Alamat E-Mail belum benar.',                    
                  'min'                  => [
                        'numeric' => ':Attribute Minimal :min Karakter.',                        
                        'string'  => ':Attribute Minimal :min Karakter.',    
                        'file'  => ':Attribute Tidak Boleh Kosong.',    

                        
                    ],

                ];
        $validator = Validator::make($req->all(), $rules,$custom);
        

        if ($validator->fails()) {                          
        $eror='';

          foreach ($validator->errors()->all() as $key => $value) {

                  $eror.=$value;



                  if($eror!='')
                    $eror=$eror.'<br>';

          }


                $dataInfo=['status'=>'gagal','konten'=>$eror];            
                return json_encode($dataInfo);
        
        }

       $imgPath = null;
            $tgl = Carbon::now('Asia/Jakarta');            
            $dir = 'image/uploads';
            $childPath = $dir . '/';
            $path = $childPath;
            $file = $req->file('lbukti_transfer');
            $name = null;            
            if ($file != null) {
                  $name = time() .'.'. $file->getClientOriginalExtension();
                        $file->move($path, $name);
                        $imgPath = $childPath . $name;
            } else {
                    $imgPath = null;
                    $dataInfo=['status'=>'gagal','konten'=>'File Bukti Transfer Harus diupload'];            
                    return json_encode($dataInfo);
            }


                
    	DB::table('invoice')->insert([                
    						'i_user_id' =>$req->u_id,    						
                'i_invoice' =>$req->no,
                'i_nominal' =>$req->nominal,
                'i_type' =>$req->paket,
                'i_tanggal' =>date('Y-m-d H:i:s'),
                'i_status' =>'N',
                'i_image' =>$imgPath,                             
    					  ]);
      $mem=Pengguna::where('u_id',$req->u_id)->first()->u_member;
      DB::table('member')->where('m_id',$mem)->update([
        'm_status_active'=>'B',   
      ]);
      

      DB::table('notif')->insert([                                
                'n_type' =>'Invoice',
                'n_no' =>$req->no,
                'n_userid' =>$req->u_id,
                'n_read' =>'N',                           
                ]);
    	 DB::commit();
    	 $data=['status'=>'berhasil','konten'=>''];
          return json_encode($data);
          
        } catch (\Exception $e) {
          DB::rollback();

          $data=['status'=>'gagal','konten'=>$e->getMessage()];
          return json_encode($data);
        }

    }

    function lnotif(){
      $d1=Pengguna::notif();
      $d2=Pengguna::datanotif();
      


      $html='';
      $html.='<a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">';
      $html.='<i class="fa fa-bell"></i>  <span class="label label-primary">'.$d1.'</span></a>';
      $html.='<ul class="dropdown-menu dropdown-alerts" style="height: 200px;overflow: hidden; overflow-y: scroll;" >';
      $html.='<li><b>List Invoice</b></li>';
            foreach($d2 as $n){
      $html.='<li>';
      $html.='<a onclick="statusNotif('.$n->n_no.')" class="dropdown-item">';
      $html.='<div>';
      $html.='<i class="fa fa-envelope fa-fw"></i>'.$n->n_type.'';
      $html.='<span class="float-right text-muted small">'.$n->n_no.'</span>';
      $html.='</div>';
      $html.='</a>';
      $html.='</li>';
           
              }
       $html.='<li class="dropdown-divider"></li>';
      $html.='<li>';
      $html.='<div class="text-center link-block">';
      $html.='<a onclick="lihatSemua()" class="dropdown-item">'.
      $html.='<strong>Lihat Semua</strong>';
      $html.='<i class="fa fa-angle-right"></i>';
      $html.='</a>
              </div>
              </li>
              </ul>';        

      return $html;


    }


}

