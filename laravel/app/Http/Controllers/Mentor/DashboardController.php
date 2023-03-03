<?php

namespace App\Http\Controllers\Mentor;
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

class DashboardController extends Controller
{
	public function index(){

		$data['total_kelas'] = DB::table('kelas')->where('id_mentor', Session::get('id'))->count();
		$data['total_siswa'] = DB::table('billing')->where('status_kelas', '!=', 'Tidak Aktif')->where('id_mentor', Session::get('id'))->count();
		$data['total_pemasukan'] = DB::table('billing')->where('status', 'Terbayar')->where('id_mentor', Session::get('id'))->sum('total');
		$data['kelas'] = DB::table('kelas')->where('id_mentor', Session::get('id'))->orderBy('terjual', 'DESC')->paginate(10);
		$data['pengaturan'] = DB::table('pengaturan')->first(); 
		return view('home_mentor',$data)->with('title','Dashboard'); 
	}

	public function penghasilan(){
		$data['total_penarikan_bulan_ini'] = DB::table('penarikan')->where('status', 'Berhasil')->where('id_mentor', Session::get('id'))->whereMonth('created_at', Carbon::now()->month)->sum('nominal');
		$data['total_penarikan_bulan_kemaren'] = DB::table('penarikan')->where('status', 'Berhasil')->where('id_mentor', Session::get('id'))->whereMonth('created_at', Carbon::now()->subMonth()->month)->sum('nominal');
		$data['total_pemasukan'] = DB::table('billing')->where('status', 'Terbayar')->where('id_mentor', Session::get('id'))->sum('total');
		$data['total_pemasukan_hari_ini'] = DB::table('billing')->where('status', 'Terbayar')->where('id_mentor', Session::get('id'))->whereDate('created_at', Carbon::today())->sum('total');
		$data['total_pemasukan_bulan_ini'] = DB::table('billing')->where('status', 'Terbayar')->where('id_mentor', Session::get('id'))->whereMonth('created_at', Carbon::now()->month)->sum('total');
		$data['total_pemasukan_bulan_kemaren'] = DB::table('billing')->where('status', 'Terbayar')->where('id_mentor', Session::get('id'))->whereMonth('created_at', Carbon::now()->subMonth()->month)->sum('total');
		$mentor_saldo = DB::table('mentor_saldo')->where('id_mentor', Session::get('id'))->first();
		if($mentor_saldo){
			$data['saldo'] = $mentor_saldo->saldo;
		}
		else {
			$data['saldo'] = 0;
		}

		$now = new DateTime( "11 months ago", new DateTimeZone('Asia/jakarta'));
		$interval = new DateInterval( 'P1M');
		$period = new DatePeriod( $now, $interval, 11);
		$datagrafik = array();
		$months = array();
		foreach ($period as $day) {
			@$bulan              =  UserHelp::Bulan_tahun(@$day->format('Y-m-d'), true);
			$penghasilan_bulan   = DB::table('billing')->where('status', 'Terbayar')->where('id_mentor', Session::get('id'))->whereMonth('created_at', $day->format('m'))->whereYear('created_at',$day->format('Y'))->sum('total');
		    $datagrafik[]        = @$penghasilan_bulan;
		    $months[]            = @$bulan;
		}
		$data['penghasilan'] = json_encode($datagrafik);
		$data['bulan'] = json_encode($months);
		$data['pengaturan'] = DB::table('pengaturan')->first();
		$data['penarikan'] = DB::table('penarikan')->where('id_mentor', Session::get('id'))->orderBy('id', 'DESC')->paginate(10);
		return view('mentor.penghasilan',$data)->with('title','Penghasilan'); 
	}

	public function penarikan(){

		$data['total_penarikan_bulan_ini'] = DB::table('penarikan')->where('status', 'Berhasil')->where('id_mentor', Session::get('id'))->whereMonth('created_at', Carbon::now()->month)->sum('nominal');
		$data['total_penarikan_bulan_kemaren'] = DB::table('penarikan')->where('status', 'Berhasil')->where('id_mentor', Session::get('id'))->whereMonth('created_at', Carbon::now()->subMonth()->month)->sum('nominal');
		$mentor_saldo = DB::table('mentor_saldo')->where('id_mentor', Session::get('id'))->first();
		if($mentor_saldo){
			$data['saldo'] = $mentor_saldo->saldo;
		}
		else {
			$data['saldo'] = 0;
		}
		$data['pengaturan'] = DB::table('pengaturan')->first();
		$data['penarikan'] = DB::table('penarikan')->where('id_mentor', Session::get('id'))->orderBy('id', 'DESC')->paginate(10);

		return view('mentor.penarikan',$data)->with('title','Penarikan'); 
	}

	public function aksipenarikan(Request $request){
		$valid['nama_rekening'] = 'required';
		$valid['bank'] = 'required';
		$valid['no_rekening'] = 'required';
		$valid['nominal'] = 'required';
		$validator = Validator::make($request->all(), $valid);
        if ($validator->fails()) {
            return redirect()->route('mentor.penarikan')->withErrors($validator)->withInput();
        } else {
        	$obj = [
        		'id_mentor' => Session::get('id'),
                'nama_rekening' => $request->nama_rekening,
                'bank' => $request->bank,
                'no_rekening' => $request->no_rekening,
                'nominal' => $request->nominal,
                'admin' => ($request->nominal*5)/100,
                'diterima' => $request->nominal-(($request->nominal*5)/100),
                'status' => 'Proses'
            ];
            DB::table('penarikan')->insertGetId($obj);
            return redirect()->route('mentor.penghasilan')->with('status_nya', 'Berhasil mengajukan penarikan saldo, silahkan tunggu konfirmasi dari kami.');
        }
	}

	public function profil(){

		return view('mentor.profil')->with('title','Profil'); 
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
        $valid['email'] = 'required|unique:mentor,email,'.Session::get('id');
        $valid['no_hp'] = 'required|unique:mentor,no_hp,'.Session::get('id');
        $valid['foto'] = 'mimes:jpeg,png,jpg|max:2048';
        $valid['deskripsi'] = 'required';
        $valid['alamat'] = 'required';
        $valid['pendidikan'] = 'required';
        $validator = Validator::make($request->all(), $valid, $message);
        if ($validator->fails()) {
            return redirect()->route('mentor.profil')->withErrors($validator)->withInput();
        } else {
            $obj = [
            	'nama' => $request->nama,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'alamat' => $request->alamat,
                'pendidikan' => $request->pendidikan,
                'deskripsi' => $request->deskripsi,
            ];
            if($request->file('foto'))
            {  
                $image = $request->file('foto');
                $obj['foto'] = time().'.'.$image->getClientOriginalExtension();
             
           
                $destinationPath = public_path('/assets/images/instructor');
                $image->move($destinationPath, $obj['foto']);
                if(Session::get('foto') != null){
                    $image_path = app_path("assets/images/instructor/".Session::get('foto'));
                    if (File::exists($image_path)) {
                        unlink($image_path);
                    }
                }
            }
            if($request->password){
                $obj['password'] = Hash::make($request->password);
            }
            DB::table('mentor')->where('id', Session::get('id'))->update($obj);
            Session::put('email', $obj['email']); 
            Session::put('no_hp', $obj['no_hp']); 
            Session::put('deskripsi', $obj['deskripsi']); 
            Session::put('alamat', $obj['alamat']); 
            if(@$obj['foto']){
            	Session::put('foto', $obj['foto']); 
            }
            Session::put('nama', $obj['nama']);

            return redirect()->route('mentor.profil')->with('status_nya', 'Berhasil Menyimpan');
        }
    }

    public function siswa(Request $request){

		$siswa = DB::table('billing')->select('billing.id as id_billing', 'billing.updated_at as tgl_join', 'billing.id_kelas', 'member.*', 'billing.nilai_akhir');
		$siswa->join('member', 'member.id', 'billing.id_member');
		$siswa->where('billing.id_mentor', Session::get('id'));
		$siswa->where('billing.status_kelas', '!=', 'Tidak Aktif');
        if($request->cari){
            $siswa->where('member.nama','like','%'.$request->get('cari').'%');  
        }
        $siswa->orderBy('billing.id', 'DESC');
        $dt_base= $siswa->paginate(10);
        $data['siswa'] = $dt_base;
		return view('mentor.siswa',$data)->with('title','Siswa'); 
	}
}