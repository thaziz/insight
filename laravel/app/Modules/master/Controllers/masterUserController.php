<?php




namespace App\Modules\master\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Pengguna;
use DB;
use Auth;
use Carbon\Carbon;
use Validator;


class masterUserController extends Controller
{
    function index(){    
      if(Auth::user()->punyaAkses()){
    	 return view('master::user.index');
      }
      return 'Tidak Punya Akses';
    }
    function data(){
      if(Auth::user()->punyaAkses()){
	      return Pengguna::datatables();
      }
      return 'Tidak Punya Akses';

    }
    function tambah(){
      if(Auth::user()->punyaAkses()){
      	return view('master::user.tambah');
      }
      return 'Tidak Punya Akses';
    }
    function simpan(Request $request){
    	DB::beginTransaction();
      /*dd($request->all());*/
        try {        	

        $rules = array(
            'nama' => 'required',
            'nip' => 'required|min:4',
            'bidang' => 'required|min:1',
            'email' => 'required|email|min:4',
            'hp' => 'required|min:11',
            'password' => 'required|min:6',
        );
        $custom=[
                  'required'             => ':Attribute Wajib Di isi.',
                  'email'                => 'Alamat E-Mail belum benar.',                    
                  'min'                  => [
                        'numeric' => ':Attribute Minimal :min Karakter.',                        
                        'string'  => ':Attribute Minimal :min Karakter.',    
                        'file'  => ':Attribute Tidak Boleh Kosong.',    

                        
                    ],

                ];
        $validator = Validator::make($request->all(), $rules,$custom);
        

        if ($validator->fails()) {                          
        $eror='';

          foreach ($validator->errors()->all() as $key => $value) {

                  $eror.=$value;



                  if($eror!='')
                    $eror=$eror.'<br>';

          }


                $dataInfo=['status'=>'gagal','pesan'=>$eror];            
                return json_encode($dataInfo);
        
        }

        $id=Pengguna::max('m_id')+1;
        
    	Pengguna::create([
                      'm_id' =>$id,                             
                      'm_name' =>$request->nama,
    						      'm_nip' =>$request->nip,    						
                      'm_bidang' =>$request->bidang,
                      'm_email' =>$request->email,
                      'm_hp' =>$request->hp,
                      'm_passwd' =>md5($request->password),
                      'm_role' =>$request->role,

    					       ]);
    	 DB::commit();
    	 $data=['status'=>'berhasil','pesan'=>''];
          return json_encode($data);
          
        } catch (\Exception $e) {
          DB::rollback();

          $data=['status'=>'gagal','pesan'=>$e->getMessage()];
          return json_encode($data);
        }

    }

   public function edit($id){
      $data=Pengguna::where('m_id',$id)->first();      
      return view('master::user.edit',compact('data'));
    }
     function update(Request $request){
        DB::beginTransaction();
        try {           

        if($request->chekpassword=='Ya'){
          $rules = array(
            'nama' => 'required',
            'nip' => 'required|min:4',
            'bidang' => 'required|min:1',
            'email' => 'required|min:4|email',
            'hp' => 'required|min:11',
              'password_baru' => 'required',            
            );
              
        }else{          
        $rules = array(
            'nama' => 'required',
            'nip' => 'required|min:4',
            'bidang' => 'required|min:1',
            'email' => 'required|min:4|email',
            'hp' => 'required|min:11',
            /*'password' => 'required|min:6',*/
        );
      }
        
        $custom=[
                  'required'             => ':Attribute Wajib Di isi.',
                  'email'                => 'Alamat E-Mail belum benar.',                    
                  'min'                  => [
                        'numeric' => ':Attribute Minimal :min Karakter.',                        
                        'string'  => ':Attribute Minimal :min Karakter.',    
                        'file'  => ':Attribute Tidak Boleh Kosong.',    

                        
                    ],

                ];
        $validator = Validator::make($request->all(), $rules,$custom);
        

        if ($validator->fails()) {                          
        $eror='';

          foreach ($validator->errors()->all() as $key => $value) {

                  $eror.=$value;



                  if($eror!='')
                    $eror=$eror.'<br>';

          }


                $dataInfo=['status'=>'gagal','pesan'=>$eror];            
                return json_encode($dataInfo);
        
        }


        $update=Pengguna::where('m_id',$request->id);        

        if($request->chekpassword=='Ya'){
                $password=md5($request->password_baru);
                $data=[                            
                              'm_name' =>$request->nama,
                              'm_nip' =>$request->nip,                
                              'm_bidang' =>$request->bidang,
                              'm_email' =>$request->email,
                              'm_hp' =>$request->hp,
                              'm_passwd' => $password,
                              'm_role' =>$request->role,
                          ];
                  
                  


            }else{
                $data=[                            
                              'm_name' =>$request->nama,
                              'm_nip' =>$request->nip,                
                              'm_bidang' =>$request->bidang,
                              'm_email' =>$request->email,
                              'm_hp' =>$request->hp,
                              'm_role' =>$request->role,
                          ];
            }






        
        $update->update($data);
         DB::commit();
         $data=['status'=>'berhasil','pesan'=>''];
          return json_encode($data);
          
        } catch (\Exception $e) {
          DB::rollback();

          $data=['status'=>'gagal','pesan'=>$e->getMessage()];
          return json_encode($data);
        }

    }

    function delete(Request $request){
      if(Auth::user()->punyaAkses()){
        DB::beginTransaction();
        try {           

            
         Pengguna::where('m_id',$request->id)->delete();

         DB::commit();
         $data=['status'=>'berhasil','pesan'=>''];
          return json_encode($data);
          
        } catch (\Exception $e) {
          DB::rollback();

          $data=['status'=>'gagal','pesan'=>$e->getMessage()];
          return json_encode($data);
        }
        }
      return 'Tidak Punya Akses';
    }

    function select_unit(){
        $lokasi=Pengguna::get();              
        $res = ['data' => $lokasi];
        return json_encode($res);
    }
}

