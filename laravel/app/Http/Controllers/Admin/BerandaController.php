<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use DB;
use Session;
use Helpers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DateTimeZone;
use DateInterval;
use DatePeriod;
use UserHelp;
use Image;
use DateTime;

class BerandaController extends Controller
{
	public function index(){
        $data['kelas'] = DB::table('kelas')->count();
        $data['mentor'] = DB::table('mentor')->count();
        $data['siswa'] = DB::table('member')->count();
        $data['total_penghasilan'] = DB::table('penarikan')->where('status', 'Berhasil')->sum('admin');

        $now = new DateTime( "11 months ago", new DateTimeZone('Asia/jakarta'));
        $interval = new DateInterval( 'P1M');
        $period = new DatePeriod( $now, $interval, 11);
        $datagrafik = array();
        $months = array();
        foreach ($period as $day) {
            @$bulan              =  UserHelp::Bulan_tahun(@$day->format('Y-m-d'), true);
            $penghasilan_bulan   = DB::table('penarikan')->where('status', 'Berhasil')->whereMonth('updated_at', $day->format('m'))->whereYear('updated_at',$day->format('Y'))->sum('admin');
            $datagrafik[]        = @$penghasilan_bulan;
            $months[]            = @$bulan;
        }
        $data['penghasilan'] = json_encode($datagrafik);
        $data['bulan'] = json_encode($months);

		return view('admin.beranda', $data)->with('title','Beranda'); 
	}

    public function akun(){
        return view('admin.akun')->with('title','Pengaturan Akun'); 
    }

    public function simpanakun(Request $request){
        $valid['nama'] = 'required';
        $valid['email'] = 'required';
        $validator = Validator::make($request->all(), $valid);
        if ($validator->fails()) {
            return redirect()->route('admin.akun')->withErrors($validator)->withInput();
        } else {
            $obj = [
                'email' => $request->email,
                'nama' => $request->nama
            ];
            if($request->password){
                $obj['password'] = Hash::make($request->password);
            }
            DB::table('admin')->where('id', Session::get('id'))->update($obj);
            Session::put('email', $request->email);
            Session::put('nama', $request->nama);
            return redirect()->route('admin.akun')->with('status', 'Berhasil Menyimpan');
        }
    }

	public function pengaturan(){
		$data['pengaturan'] = DB::table('pengaturan')->first();
		return view('admin.pengaturan', $data)->with('title','Pengaturan');
	}

	public function simpanpengaturan(Request $request){
		$message = [
            'logo_web.nimes' => 'Extensi foto tidak diperkenankan',
            'logo_web.max' => 'Maksimal size 2MB',
            'logo_web.image' => 'Pastikan foto berupa file gambar'
        ];
        $valid['logo_web'] = 'mimes:jpeg,png,jpg|max:2048';
        $validator = Validator::make($request->all(), $valid, $message);
        if ($validator->fails()) {
            return redirect()->route('admin.pengaturan')->withErrors($validator)->withInput();
        } else {
        	$obj = [
                'nama_web' => $request->nama_web,
                'email_web' => $request->email_web,
                'deskripsi_web' => $request->deskripsi_web,
                'alamat_web' => $request->alamat_web,
                'embed_map' => $request->embed_map,
                'no_wa' => $request->no_wa,
                'nama_rekening1' => $request->nama_rekening1,
                'no_rekenging1' => $request->no_rekenging1,
                'bank1' => $request->bank1,
                'nama_rekening2' => $request->nama_rekening2,
                'no_rekenging2' => $request->no_rekenging2,
                'bank2' => $request->bank2,
                'biaya_penarikan' => $request->biaya_penarikan,
                'minimal_penarikan' => $request->minimal_penarikan,
                'mercant_id' => $request->mercant_id,
                'client_key' => $request->client_key,
                'server_key' => $request->server_key,
                'title_kecil_home' => $request->title_kecil_home,
                'title_besar_home' => $request->title_besar_home,
                'penjelasan_home' => $request->penjelasan_home,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'instagram' => $request->instagram,
            ];
            if($request->file('logo_web'))
            {  
                $image = $request->file('logo_web');
                $obj['logo_web'] = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/adm/images');
                $image->move($destinationPath, $obj['logo_web']);
            }
            $pengaturan = DB::table('pengaturan')->first();
            if($pengaturan){
            	DB::table('pengaturan')->where('id', $pengaturan->id)->update($obj);
            }
            else {
            	DB::table('pengaturan')->insert($obj);
            }
            return redirect()->route('admin.pengaturan')->with('status', 'Berhasil Menyimpan Pengaturan');
        }
	}
}