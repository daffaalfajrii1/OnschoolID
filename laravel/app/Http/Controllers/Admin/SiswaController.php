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
use File;

class SiswaController extends Controller
{
	public function index(Request $request)
    { 
        $siswa = DB::table('member');
        if($request->cari){
            $siswa->where('nama','like','%'.$request->get('cari').'%');
        }
        if($request->sort){
            $siswa->orderBy($request->sort, 'ASC');
        }
        else {
            $siswa->orderBy('id', 'DESC');
        }
        $dt_base= $siswa->paginate(10);
        $data['siswa'] = $dt_base;
    	return view('admin.siswa.list', $data)->with('title','List Siswa'); 
    }

    public function edit($id){
        $data['siswa'] = DB::table('member')->where('id', $id)->first();

        return view('admin.siswa.edit', $data)->with('title','Edit Siswa'); 
    }

    public function update(Request $request){
        $message = [
            'email.unique' => 'Email sudah terdaftar',
            'no_hp.unique' => 'No HP sudah terdaftar',
            'password.min' => 'Password minimal 8 karakter',
            'foto.nimes' => 'Extensi foto tidak diperkenankan',
            'foto.max' => 'Maksimal size 2MB',
            'foto.image' => 'Pastikan foto berupa file gambar'
        ];
        $valid['nama'] = 'required';
        $valid['email'] = 'required|unique:member,email,'.$request->id;
        $valid['no_hp'] = 'required|unique:member,no_hp,'.$request->id;
        $valid['foto'] = 'mimes:jpeg,png,jpg|max:2048';
        $validator = Validator::make($request->all(), $valid, $message);
        if ($validator->fails()) {
            return redirect()->route('admin.siswa.edit', $request->id)->withErrors($validator)->withInput();
        } else {
            $obj = [
                'nama' => $request->nama,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'pekerjaan' => $request->pekerjaan,
            ];
            if($request->file('foto'))
            {  
                $image = $request->file('foto');
                $obj['foto'] = time().'.'.$image->getClientOriginalExtension();
             
                $destinationPath = public_path('/adm/images/students/thumbnail');
                $img = Image::make($image->getRealPath());
                $img->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.'/'.$obj['foto']);
           
                $destinationPath = public_path('/adm/images/students');
                $image->move($destinationPath, $obj['foto']);
                $member = DB::table('member')->where('id', $request->id)->first();
                if($member->foto != null){
                    $image_path = app_path("adm/images/students/".$member->foto);
                    if (File::exists($image_path)) {
                        unlink($image_path);
                    }
                    $image_path = app_path("adm/images/students/thumbnail/".$member->foto);
                    if (File::exists($image_path)) {
                        unlink($image_path);
                    }
                }
            }
            if($request->password){
                $obj['password'] = Hash::make($request->password);
            }
            DB::table('member')->where('id', $request->id)->update($obj);

            return redirect()->route('admin.siswa')->with('status', 'Berhasil Mengubah');
        }
    }

    public function hapus($id){
        DB::table('member')->where('id', $id)->delete();

        return redirect()->route('admin.siswa')->with('status', 'Berhasil Menghapus Data Siswa');
    }
}