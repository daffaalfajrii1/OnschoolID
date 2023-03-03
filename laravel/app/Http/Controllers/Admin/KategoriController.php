<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use DB;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Redirect;
use DateTime;
use DateTimeZone;
use DateInterval;
use DatePeriod;
use UserHelp;

class KategoriController extends Controller
{
	public function index(Request $request)
    { 
        $kategori = DB::table('kategori');
        if($request->cari){
            $kategori->where('kategori','like','%'.$request->get('cari').'%');  
            $kategori->orWhere('id','like','%'.$request->get('cari').'%');
        }
        if($request->sort){
            $kategori->orderBy($request->sort, 'ASC');
        }
        else {
            $kategori->orderBy('id', 'DESC');
        }
        $dt_base= $kategori->paginate(10);
        $data['kategori'] = $dt_base;
    	return view('admin.kategori.list', $data)->with('title','List Kategori'); 
    }

    public function tambah()
    { 
        return view('admin.kategori.tambah')->with('title','Tambah Kategori'); 
    }

    public function simpan(Request $request){
        $valid['kategori'] = 'required';
        $validator = Validator::make($request->all(), $valid);

        if ($validator->fails()) {
            return redirect()->route('admin.kategori.tambah')->withErrors($validator)->withInput();
        } else {
            $obj = [
                'kategori' => $request->kategori,
                'slug' => UserHelp::slugify($request->kategori)
            ];
            DB::table('kategori')->insert($obj);

            return redirect()->route('admin.kategori')->with('status', 'Berhasil Menambah Data Kategori Baru');
        }
    }

    public function edit($id){
        $data['kategori'] = DB::table('kategori')->where('id', $id)->first();

        return view('admin.kategori.edit', $data)->with('title','Edit Kategori'); 
    }

    public function update(Request $request){
        $valid['kategori'] = 'required';
        $validator = Validator::make($request->all(), $valid);

        if ($validator->fails()) {
            return redirect()->route('admin.kategori.edit', $request->id)->withErrors($validator)->withInput();
        } else {
            $obj = [
                'kategori' => $request->kategori,
                'slug' => UserHelp::slugify($request->kategori)
            ];
            DB::table('kategori')->where('id', $request->id)->update($obj);

            return redirect()->route('admin.kategori')->with('status', 'Berhasil Mengubah Data Kategori');
        }
    }

    public function hapus($id){
        DB::table('kategori')->where('id', $id)->delete();

        return redirect()->route('admin.kategori')->with('status', 'Berhasil Menghapus Data kategori');
    }
}