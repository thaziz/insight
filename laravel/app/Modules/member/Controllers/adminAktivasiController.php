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

class adminAktivasiController extends Controller
{
    function index(){        
    	return view('member::admin-aktifasi.index');
    }
    function data(){         
         $getdata = DB::table('member')->where('m_role','member')->get();         
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
                      return '<span class="label label-primary">Sudah</span>';
                  }
                  else if($getdata->m_status_verifikasi=='N'){
                    return '<span class="label label-danger">Belum</span>'; 
                  }
                 
              })   
               ->addColumn('status_trial', function ($getdata) {
                 if($getdata->m_status_trial=='Y'){
                      return '<span class="label label-primary">Aktif</span>';
                  }
                  else if($getdata->m_status_trial=='N'){
                    return '<span class="label label-danger">Trial</span>'; 
                  }
              })
              ->addColumn('status_aktif', function ($getdata) {
                  if($getdata->m_status_active=='Y'){
                      return '<span class="label label-primary">Aktif</span>';
                  }
                  if($getdata->m_status_active=='N'){
                      return '<div  style="text-align: center;" ><button class="btn btn-danger btn-xs" tooltip="true" title="Lakukan Perpanjangan" >Non Aktif</button></div>';
                  }
                   if($getdata->m_status_active=='B'){
                      return '<div  style="text-align: center;" ><button class="btn btn-warning btn-xs" tooltip="true" title="Klik Untuk Aktifasi" onclick="verifikasiAdmin('.$getdata->m_id.',\''.md5($getdata->m_email).'\')" >Sudah Membayar</button></div>';
                  }
              })                
              ->rawColumns(['action','status_verifikasi','status_trial','status_aktif'])
              ->make(true); 
    }


    
    function data_verifikasi(Request $req){

      $mem=DB::table('member')->where('m_id',$req->m_id)->first();
      $u_id=Pengguna::where('u_member',$req->m_id)->first()->u_id;
      $invoice=DB::table('invoice')
                  ->join('master_paket','mp_id','=','i_type')
                  ->join('bank_account','ba_id','=','i_bank')
                  ->where('i_user_id',$u_id)->where('i_status','N')->first();
                /*dd($invoice);*/

      $historyinvoice=DB::table('invoice')->where('i_user_id',$u_id)->where('i_status','Y')->get();
      $data=['status'=>'sukses','mem'=>$mem,'invoice'=>$invoice,'historyinvoice'=>$historyinvoice];

      return json_encode($data);



      
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


  
    function simpanStatus(Request $req){
    	DB::beginTransaction();
        try {      
          /*dd(strtotime('2019-09-07 18:44:53'));*/
          /*dd(date('Y-m-d H:i:s',1567856693));*/
      DB::table('member')->where('m_id',$req->member)->update([
          'm_status_active'=>'Y',
      ]);

      DB::table('invoice')->where('i_user_id',$req->user)->update([
          'i_status'=>'Y',
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

