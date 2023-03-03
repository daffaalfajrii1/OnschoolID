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

class TimController extends Controller
{
	public function index(Request $request)
    { 
        $tim = DB::table('tim');
        if($request->cari){
            $tim->where('nama','like','%'.$request->get('cari').'%');  
            $tim->orWhere('id','like','%'.$request->get('cari').'%');
        }
        if($request->sort){
            $tim->orderBy($request->sort, 'ASC');
        }
        else {
            $tim->orderBy('id', 'DESC');
        }
        $dt_base= $tim->paginate(10);
        $data['tim'] = $dt_base;
    	return view('admin.tim.list', $data)->with('title','List Tim'); 
    }

    public function tambah()
    { 
        return view('admin.tim.tambah')->with('title','Tambah Tim'); 
    }

    public function simpan(Request $request){
        $message = [
            'gambar.nimes' => 'Extensi foto tidak diperkenankan',
            'gambar.max' => 'Maksimal size 2MB',
            'gambar.image' => 'Pastikan foto berupa file gambar'
        ];
        $valid['nama'] = 'required';
        $valid['jabatan'] = 'required';
        $valid['gambar'] = 'required|mimes:jpeg,png,jpg|max:2048';
        $validator = Validator::make($request->all(), $valid);

        if ($validator->fails()) {
            return redirect()->route('admin.tim.tambah')->withErrors($validator)->withInput();
        } else {
            $obj = [
                'nama' => $request->nama,
                'jabatan' => $request->jabatan,
            ];
            if($request->file('gambar'))
            {  
                $image = $request->file('gambar');
                $obj['gambar'] = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/adm/images/tim');
                $image->move($destinationPath, $obj['gambar']);
            }
            DB::table('tim')->insert($obj);

            return redirect()->route('admin.tim')->with('status', 'Berhasil Menambah Data Tim Baru');
        }
    }

    public function edit($id){
        $data['tim'] = DB::table('tim')->where('id', $id)->first();

        return view('admin.tim.edit', $data)->with('title','Edit Tim'); 
    }

    public function update(Request $request){
        $message = [
            'gambar.nimes' => 'Extensi foto tidak diperkenankan',
            'gambar.max' => 'Maksimal size 2MB',
            'gambar.image' => 'Pastikan foto berupa file gambar'
        ];
        $valid['nama'] = 'required';
        $valid['jabatan'] = 'required';
        $valid['gambar'] = 'mimes:jpeg,png,jpg|max:2048';
        $validator = Validator::make($request->all(), $valid);

        if ($validator->fails()) {
            return redirect()->route('admin.tim.edit', $request->id)->withErrors($validator)->withInput();
        } else {
            $obj = [
                'nama' => $request->nama,
                'jabatan' => $request->jabatan,
            ];
            if($request->file('gambar'))
            {  
                $image = $request->file('gambar');
                $obj['gambar'] = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/adm/images/tim');
                $image->move($destinationPath, $obj['gambar']);
                $tim = DB::table('tim')->where('id', $request->id)->first();
                if($tim->gambar != null){
                    $image_path = app_path("adm/images/tim/".$tim->gambar);
                    if (File::exists($image_path)) {
                        unlink($image_path);
                    }
                }
            }
            DB::table('tim')->where('id', $request->id)->update($obj);

            return redirect()->route('admin.tim')->with('status', 'Berhasil Mengubah Data Tim');
        }
    }

    public function hapus($id){
        DB::table('tim')->where('id', $id)->delete();

        return redirect()->route('admin.tim')->with('status', 'Berhasil Menghapus Data Tim');
    }
}