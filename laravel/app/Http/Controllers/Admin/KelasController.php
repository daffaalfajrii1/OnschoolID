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

class KelasController extends Controller
{
	public function index(Request $request)
    { 
        $kelas = DB::table('kelas')->select('kelas.*', 'kategori.kategori', 'mentor.nama');
        $kelas->join('kategori', 'kategori.id', 'kelas.id_kategori');
        $kelas->join('mentor', 'mentor.id', 'kelas.id_mentor');
        if($request->cari){
            $kelas->where('kelas.kelas','like','%'.$request->get('cari').'%');
            $kelas->orWhere('kategori.kategori','like','%'.$request->get('cari').'%');
        }
        if($request->sort){
            $kelas->orderBy($request->sort, 'ASC');
        }
        else {
            $kelas->orderBy('kelas.id', 'DESC');
        }
        $kelas->where('kelas.status', '!=', 'Pending');
        $dt_base= $kelas->paginate(10);
        $data['kelas'] = $dt_base;
    	return view('admin.kelas.list', $data)->with('title','List Kelas'); 
    }

    public function permintaan(Request $request)
    { 
        $kelas = DB::table('kelas')->select('kelas.*', 'kategori.kategori', 'mentor.nama');
        $kelas->join('kategori', 'kategori.id', 'kelas.id_kategori');
        $kelas->join('mentor', 'mentor.id', 'kelas.id_mentor');
        if($request->cari){
            $kelas->where('kelas.kelas','like','%'.$request->get('cari').'%');
            $kelas->orWhere('kategori.kategori','like','%'.$request->get('cari').'%');
        }
        if($request->sort){
            $kelas->orderBy($request->sort, 'ASC');
        }
        else {
            $kelas->orderBy('kelas.id', 'DESC');
        }
        $kelas->where('kelas.status', '=', 'Pending');
        $dt_base= $kelas->paginate(10);
        $data['kelas'] = $dt_base;
    	return view('admin.kelas.permintaan', $data)->with('title','List Permintaan Kelas'); 
    }

    public function detail($id)
    { 
        $kelas = DB::table('kelas')->select('kelas.*', 'kategori.kategori', 'mentor.nama', 'mentor.foto as foto_mentor', 'mentor.jenis_kelamin', 'mentor.email');
        $kelas->join('kategori', 'kategori.id', 'kelas.id_kategori');
        $kelas->join('mentor', 'mentor.id', 'kelas.id_mentor');
        $kelas->where('kelas.status', '!=', 'Pending');
        $kelas->where('kelas.id', '=', $id);
        $dt_base= $kelas->first();
        $data['kelas'] = $dt_base;
        $data['total_materi'] = DB::table('kelas_materi')->where('id_kelas', $id)->count();
        $data['total_tools'] = DB::table('kelas_tools')->where('id_kelas', $id)->count();
        $data['kelas_materi'] = DB::table('kelas_materi')->where('id_kelas', $id)->paginate(5);
        $data['kelas_faq'] = DB::table('kelas_faq')->where('id_kelas', $id)->get();
        $data['kelas_tools'] = DB::table('kelas_tools')->where('id_kelas', $id)->get();
        $data['kelas_soal'] = DB::table('kelas_soal')->where('id_kelas', $id)->get();
    	return view('admin.kelas.detail', $data)->with('title','Detail Kelas'); 
    }

    public function permintaandetail($id)
    { 
        $kelas = DB::table('kelas')->select('kelas.*', 'kategori.kategori', 'mentor.nama', 'mentor.foto as foto_mentor', 'mentor.jenis_kelamin', 'mentor.email');
        $kelas->join('kategori', 'kategori.id', 'kelas.id_kategori');
        $kelas->join('mentor', 'mentor.id', 'kelas.id_mentor');
        $kelas->where('kelas.status', '=', 'Pending');
        $kelas->where('kelas.id', '=', $id);
        $dt_base= $kelas->first();
        $data['kelas'] = $dt_base;
        $data['total_materi'] = DB::table('kelas_materi')->where('id_kelas', $id)->count();
        $data['total_tools'] = DB::table('kelas_tools')->where('id_kelas', $id)->count();
        $data['kelas_materi'] = DB::table('kelas_materi')->where('id_kelas', $id)->paginate(5);
        $data['kelas_faq'] = DB::table('kelas_faq')->where('id_kelas', $id)->get();
        $data['kelas_tools'] = DB::table('kelas_tools')->where('id_kelas', $id)->get();
        $data['kelas_soal'] = DB::table('kelas_soal')->where('id_kelas', $id)->get();
    	return view('admin.kelas.detail_permintaan', $data)->with('title','Detail Permintaan Kelas'); 
    }

    public function tolak(Request $request, $id){

    	$kelas = DB::table('kelas')->select('kelas.*', 'kategori.kategori', 'mentor.nama', 'mentor.foto as foto_mentor', 'mentor.jenis_kelamin', 'mentor.email');
        $kelas->join('kategori', 'kategori.id', 'kelas.id_kategori');
        $kelas->join('mentor', 'mentor.id', 'kelas.id_mentor');
        $kelas->where('kelas.status', '=', 'Pending');
        $kelas->where('kelas.id', '=', $id);
        $dt_base= $kelas->first();

        $data['token'] = 'kddnh3fuihtxf6lb';
        $data['nama_pengirim'] = 'Onschool';
        $data['email_pengirim'] = 'no-reply@onschool.com';
        $data['email_tujuan'] = $dt_base->email;
        $data['email_subject'] = 'Kelas Anda ditolak!';
        $data['email_message'] = 'Hallo '.$dt_base->nama.',<br> Mohon maaf kelas Anda dengan nama '.$dt_base->kelas.' telah ditolak, berikut alasan penolakannya : <br> '.$request->alasan;
        $curl = curl_init();
        $send_email = UserHelp::send_email($data);

        if($send_email == 'success'){
        	$obj = [
                'status' => 'Ditolak'
	        ];
	        DB::table('kelas')->where('id', $id)->update($obj);

	        return redirect()->route('admin.kelas.permintaan')->with('status', 'Berhasil Menolak Kelas');
        }
        else {
        	return redirect()->route('admin.kelas.permintaan.detail', $id)->with('status_gagal', 'Gagal Menolak Kelas, Email Tidak Terkirim');
        }
    }

    public function terima($id){

    	$kelas = DB::table('kelas')->select('kelas.*', 'kategori.kategori', 'mentor.nama', 'mentor.foto as foto_mentor', 'mentor.jenis_kelamin', 'mentor.email');
        $kelas->join('kategori', 'kategori.id', 'kelas.id_kategori');
        $kelas->join('mentor', 'mentor.id', 'kelas.id_mentor');
        $kelas->where('kelas.status', '=', 'Pending');
        $kelas->where('kelas.id', '=', $id);
        $dt_base= $kelas->first();

        $data['token'] = 'kddnh3fuihtxf6lb';
        $data['nama_pengirim'] = 'Onschool';
        $data['email_pengirim'] = 'no-reply@onschool.com';
        $data['email_tujuan'] = $dt_base->email;
        $data['email_subject'] = 'Kelas Anda diterima!';
        $data['email_message'] = 'Hallo '.$dt_base->nama.',<br> Selamat kelas Anda dengan nama '.$dt_base->kelas.' telah diterima, semoga kelas anda memberi manfaat yang banyak.';
        $curl = curl_init();
        $send_email = UserHelp::send_email($data);

        if($send_email == 'success'){
        	$obj = [
                'status' => 'Aktif'
	        ];
	        DB::table('kelas')->where('id', $id)->update($obj);

	        return redirect()->route('admin.kelas.permintaan')->with('status', 'Berhasil Terima Kelas');
        }
        else {
        	return redirect()->route('admin.kelas.permintaan.detail', $id)->with('status_gagal', 'Gagal Terima Kelas, Email Tidak Terkirim');
        }
    }

    public function suspend(Request $request){
        $id = $request->id;
        $kelas = DB::table('kelas')->select('kelas.*', 'kategori.kategori', 'mentor.nama', 'mentor.foto as foto_mentor', 'mentor.jenis_kelamin', 'mentor.email');
        $kelas->join('kategori', 'kategori.id', 'kelas.id_kategori');
        $kelas->join('mentor', 'mentor.id', 'kelas.id_mentor');
        $kelas->where('kelas.id', '=', $id);
        $dt_base= $kelas->first();

        $data['token'] = 'kddnh3fuihtxf6lb';
        $data['nama_pengirim'] = 'Onschool';
        $data['email_pengirim'] = 'no-reply@onschool.com';
        $data['email_tujuan'] = $dt_base->email;
        $data['email_subject'] = 'Kelas Anda disuspend!';
        $data['email_message'] = 'Hallo '.$dt_base->nama.',<br> Mohon Maaf Anda dengan nama '.$dt_base->kelas.' telah disuspend, dengan alasan sebagai berikut : <br>'.$request->alasan;
        $curl = curl_init();
        $send_email = UserHelp::send_email($data);
        if($send_email == 'success'){
            $obj = [
                'status' => 'Suspend'
            ];
            DB::table('kelas')->where('id', $id)->update($obj);

            return redirect()->route('admin.kelas')->with('status', 'Berhasil suspend kelas');
        }
        else {
            return redirect()->route('admin.kelas')->with('status_gagal', 'Gagal Suspend Kelas, Email Tidak Terkirim');
        }
    }

    public function unsuspend($id){
        $kelas = DB::table('kelas')->select('kelas.*', 'kategori.kategori', 'mentor.nama', 'mentor.foto as foto_mentor', 'mentor.jenis_kelamin', 'mentor.email');
        $kelas->join('kategori', 'kategori.id', 'kelas.id_kategori');
        $kelas->join('mentor', 'mentor.id', 'kelas.id_mentor');
        $kelas->where('kelas.id', '=', $id);
        $dt_base= $kelas->first();

        $data['token'] = 'kddnh3fuihtxf6lb';
        $data['nama_pengirim'] = 'Onschool';
        $data['email_pengirim'] = 'no-reply@onschool.com';
        $data['email_tujuan'] = $dt_base->email;
        $data['email_subject'] = 'Kelas Anda kembali aktif!';
        $data['email_message'] = 'Hallo '.$dt_base->nama.',<br> Selamat kelas Anda dengan nama '.$dt_base->kelas.' telah kembali aktif, semoga kelas anda memberi manfaat yang banyak.';
        $curl = curl_init();
        $send_email = UserHelp::send_email($data);
        if($send_email == 'success'){
            $obj = [
                'status' => 'Aktif'
            ];
            DB::table('kelas')->where('id', $id)->update($obj);

            return redirect()->route('admin.kelas')->with('status', 'Berhasil Unsuspend kelas');
        }
        else {
            return redirect()->route('admin.kelas')->with('status_gagal', 'Gagal Unsuspend Kelas, Email Tidak Terkirim');
        }
    }
}