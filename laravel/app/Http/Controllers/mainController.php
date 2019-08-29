<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;

use Validator;

use DB;

use App\Pengguna;

use App\Transaksi;

use App\Modules\master\model\m_kode;

use App\Modules\master\model\m_group_detail;

use Carbon\Carbon;







class mainController extends Controller
{
    public function authenticate(Request $req) {       
        return DB::transaction(function() use ($req){         
            
        $rules = array(
            'kode' => 'required|min:4', // make sure the email is an actual email
        );


        $validator = Validator::make($req->all(), $rules);

        if ($validator->fails()) {            
                $dataInfo=['status'=>'gagal','data'=>'Panjang Karakter Password atau Nama Harus Minimal 4 Karakter '];            
                return json_encode($dataInfo);
        } else {                  
                  /*$data=DB::select(DB::raw('SELECT TIMEDIFF(TIME_FORMAT(concat(masa_berlaku,":00:00"),"%H:%i:%s"),TIMEDIFF(NOW(),kode_created)) as total FROM m_kode WHERE kode=?
                        AND TIMEDIFF(NOW(),kode_created)<=TIME_FORMAT(concat(masa_berlaku,":00:00"),"%H:%i:%s")
                        '),[$req->kode]);*/
            $data=m_kode::chekKode($req->kode);
            if($data){
                Session::put('kode', $req->kode);
                 $url='/main/spin';   
                $dataInfo=['status'=>'sukses','nama'=>'','redirect'=>$url];     
                return json_encode($dataInfo);
            }else{
                $dataInfo=['status'=>'gagal','data'=>'Kode Tidak Ditemukan / Kode expired '];            
                return json_encode($dataInfo);
            }
        }
        });
    }
    function mainSpin(){
        $kode=Session::get('kode');
        $data=m_kode::chekKode($kode);
        $hadiah=m_group_detail::where('gd_group',$data[0]->group)->get();

                   
        $color=['#eae56f',
                '#89f26e',
                '#7de6ef',
                '#e7706f',
                '#eae56f',
                '#89f26e',
                '#7de6ef',
                '#e7706f',
                '#e7609f',
                '#e7116f',
                '#e8711f',
                '#e7705f',
               ];

        $h=[];
        $hitung=0;
        $set='';
        $segment='';
        $status=0;
        foreach ($hadiah as $key => $value) {
            if($value->gd_detailid==$data[0]->group_dt){
                $set=$key;
            }
            $h[$key]['fillStyle']=$color[$key];
            $h[$key]['text']=$value->gd_nama;
            $hitung++;
        }

        if($data[0]->group_dt!=0){        
            $status='1';
            $segment=(360/$hitung);
            $segment=$segment*$set+2;
        }




        
        return view('spin',compact('data','h','hitung','segment','status'));
    }

    function update_hadiah(Request $request){
    $barang=m_group_detail::where('gd_group',$request->group)->where('gd_nama',$request->hadiah)->first();
    $updatekode=m_kode::where('kode',$request->kode);
    $main=$updatekode;
    $updatekode->update([
                    'main'=>$main->first()->main+1
                    ]);
        Transaksi::create([
                't_kode'=>$request->kode,
                't_group'=>$request->group,
                't_group_dt'=>$barang->gd_detailid,
        ]);
        $data=m_kode::chekKode($request->kode);
        if($data){      
            $dataInfo=['status'=>'sukses','nama'=>'','redirect'=>'/main/spin'];     
            return json_encode($dataInfo); 
        }       
        else{
            session()->forget('kode');
            $dataInfo=['status'=>'sukses','nama'=>'','redirect'=>'/kode_user'];     
            return json_encode($dataInfo);    
        }
    }

}
