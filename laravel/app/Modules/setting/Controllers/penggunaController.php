<?php 
namespace App\Modules\setting\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\mMember;
use DB;
use Auth;
use Carbon\Carbon;
class penggunaController extends Controller {
	public function __construct(){
        $this->middleware('auth');
    }

	public function index()
	{
		return view('setting::pengguna.index');
	}
	  public function tambah_user(){      
	   
        $group = DB::table('m_group')
                    ->get();

        $menu = DB::table('m_menu')
                  ->OrderBy('m_id')
                  ->get();

        return view('setting::pengguna.tambah', compact('group', 'menu'));
    }
    public function getpegawai(Request $request){    	
      $keyword = $request->term;
      $results=[];

            $data = DB::table('m_mem')
                      ->where('m_name', 'LIKE', '%'.$keyword.'%')
                      ->get();

                  if ($data->count() == 0) {
                      $results[] = ['id' => null, 'label' => 'Tidak ditemukan data terkait'];
                  } else {

                      foreach ($data as $query) {
                          $results[] = ['id' => $query->m_id, 'label' => $query->m_name];
                      }
                  }

     return response()->json($results);
    }


     public function getdetailpegawai(Request $request){
      $data = DB::table('m_mem')
                ->where('m_id', $request->id)
                ->get();

      return response()->json($data);
    }

     public function simpan_akses_pengguna(Request $req){
      
      DB::beginTransaction();
        try {

          DB::table('m_mem')
              ->where('m_id', $req->m_id)
              ->update([
                'm_username' => $req->m_username,
                'm_passwd' => sha1(md5('passwordAllah').$req->m_passwd),
                'm_name' => $req->m_name,
                'm_nik' => $req->m_nik,
                'm_address' => $req->m_address,
                'm_nohp' => $req->m_nohp,
                'm_email' => $req->m_email,
                'm_insert' => Carbon::now('Asia/Jakarta'),
              ]);

          $group = DB::table('d_group_menu')
                      ->whereIn('gm_group', $req->group)
                      ->get();

          for ($i=0; $i < count($req->id_access); $i++) {
            $idakses = DB::table('d_mem_menu')->max('mm_id')+1;
            DB::table('d_mem_menu')
              ->insert([
                'mm_id' => $idakses,
                'mm_mem' => $req->m_id,
                'mm_menu' => $req->id_access[$i],
                'mm_type' => 'M',
                'mm_read' => $req->view[$i],
                'mm_insert' => $req->create[$i],
                'mm_update' => $req->update[$i],
                'mm_delete' => $req->delete[$i],
                'mm_print' => $req->print[$i],
              ]);
          }

          for ($i=0; $i < count($group); $i++) {
            $idakses = DB::table('d_mem_menu')->max('mm_id')+1;
            DB::table('d_mem_menu')
              ->insert([
                'mm_id' => $idakses,
                'mm_mem' => $req->m_id,
                'mm_menu' => $group[$i]->gm_menu,
                'mm_group' => $group[$i]->gm_group,
                'mm_type' => 'G',
                'mm_read' => $group[$i]->gm_read,
                'mm_insert' => $group[$i]->gm_insert,
                'mm_update' => $group[$i]->gm_update,
                'mm_delete' => $group[$i]->gm_delete,
                'mm_print' => $group[$i]->gm_print,
              ]);
          }

          DB::commit();
          return response()->json([
            'berhasil'
          ]);
        } catch (\Exception $e) {
          DB::rollback();
          return response()->json([
            'gagal'
          ]);
        }

    }
}