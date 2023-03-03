<?php

namespace App\Http\Controllers\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use DB;
use Session;
use Helpers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DateTime;
use DateTimeZone;
use DateInterval;
use DatePeriod;
use UserHelp;
use Image;

class DashboardController extends Controller
{
	public function index(){

        $data['total_kelas'] = DB::table('billing')->where('id_member', Session::get('id'))->where('status', 'Terbayar')->where('status_kelas', '!=', 'Tidak Aktif')->count();
        $data['total_sertifikat'] = DB::table('billing')->where('id_member', Session::get('id'))->where('status', 'Terbayar')->where('status_kelas', '=', 'Selesai')->count();
		return view('home_member', $data)->with('title','Dashboard'); 
	}

	public function belikelas($id){
		$kelas = DB::table('kelas')->select('kelas.*', 'kategori.kategori', 'mentor.nama', 'mentor.foto as foto_mentor', 'mentor.jenis_kelamin', 'mentor.email');
        $kelas->join('kategori', 'kategori.id', 'kelas.id_kategori');
        $kelas->join('mentor', 'mentor.id', 'kelas.id_mentor');
        $kelas->where('kelas.status', '!=', 'Pending');
        $kelas->where('kelas.id', '=', $id);
        $dt_base= $kelas->first();
        $data['kelas'] = $dt_base;
        $data['total_siswa'] = DB::table('billing')->where('status', $id)->where('id_kelas', $id)->count();
        $data['total_materi'] = DB::table('kelas_materi')->where('id_kelas', $id)->count();
        $data['total_tools'] = DB::table('kelas_tools')->where('id_kelas', $id)->count();
        $data['kelas_materi'] = DB::table('kelas_materi')->where('id_kelas', $id)->paginate(5);
        $data['kelas_faq'] = DB::table('kelas_faq')->where('id_kelas', $id)->get();
        $data['kelas_tools'] = DB::table('kelas_tools')->where('id_kelas', $id)->get();
        $data['mentor'] = DB::table('mentor')->where('id', $dt_base->id_mentor)->first();
        $data['total_siswa_mentor'] = DB::table('billing')->where('id_mentor', $dt_base->id_mentor)->count();
        $data['total_kelas_mentor'] = DB::table('kelas')->where('kelas.id_mentor', $dt_base->id_mentor)->count();
        $data['kode_unik'] = rand(100,200);
    	return view('member.beli_kelas', $data)->with('title','Pembelian Kelas'); 
	}

    public function profil(){

        $data['total_kelas'] = DB::table('billing')->where('id_member', Session::get('id'))->where('status', 'Terbayar')->where('status_kelas', '!=', 'Tidak Aktif')->count();
        $data['total_sertifikat'] = DB::table('billing')->where('id_member', Session::get('id'))->where('status', 'Terbayar')->where('status_kelas', '=', 'Selesai')->count();
        return view('member.profile', $data)->with('title','Edit Profil'); 
    }

    public function simpanprofil(Request $request){
        $message = [
            'email.unique' => 'Email sudah terdaftar',
            'no_hp.unique' => 'No HP sudah terdaftar',
            'password.min' => 'Password minimal 8 karakter',
            'foto.nimes' => 'Extensi foto tidak diperkenankan',
            'foto.max' => 'Maksimal size 2MB',
            'foto.image' => 'Pastikan foto berupa file gambar'
        ];
        $valid['nama'] = 'required';
        $valid['email'] = 'required|unique:member,email,'.Session::get('id');
        $valid['no_hp'] = 'required|unique:member,no_hp,'.Session::get('id');
        $valid['foto'] = 'mimes:jpeg,png,jpg|max:2048';
        $validator = Validator::make($request->all(), $valid, $message);
        if ($validator->fails()) {
            return redirect()->route('member.profil')->withErrors($validator)->withInput();
        } else {
            $obj = [
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'pekerjaan' => $request->pekerjaan,
            ];
            if($request->file('foto'))
            {  
                $image = $request->file('foto');
                $obj['foto'] = time().'.'.$image->getClientOriginalExtension();
           
                $destinationPath = public_path('/assets/images/students');
                $image->move($destinationPath, $obj['foto']);
                if(Session::get('foto') != null){
                    $image_path = app_path("assets/images/students/".Session::get('foto'));
                    if (File::exists($image_path)) {
                        unlink($image_path);
                    }
                }
            }
            if($request->password){
                $obj['password'] = Hash::make($request->password);
            }
            DB::table('member')->where('id', Session::get('id'))->update($obj);
            Session::put('email', $obj['email']); 
            Session::put('no_hp', $obj['no_hp']); 
            Session::put('pekerjaan', $obj['pekerjaan']); 
            Session::put('alamat', $obj['alamat']); 
            if(@$obj['foto']){
                Session::put('foto', $obj['foto']); 
            }

            return redirect()->route('member.profil')->with('status', 'Berhasil Menyimpan');
        }
    }

}