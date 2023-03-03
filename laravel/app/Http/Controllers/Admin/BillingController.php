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

class BillingController extends Controller
{
	public function index(Request $request)
    { 
    	$billing = DB::table('billing')->select('billing.*', 'kelas.kelas', 'member.nama', 'member.email');
        $billing->join('member', 'member.id', 'billing.id_member');
        $billing->join('kelas', 'kelas.id', 'billing.id_kelas');
        if($request->cari){
            $billing->where('billing.id','like','%'.$request->get('cari').'%');
        }
        if($request->sort){
            $billing->orderBy($request->sort, 'ASC');
        }
        else {
            $billing->orderBy('id', 'DESC');
        }
        $billing->orderBy('billing.id', 'DESC');
        $dt_base= $billing->paginate(10);
        $data['billing'] = $dt_base;
        return view('admin.billing.list', $data)->with('title','Billing'); 
    }

    public function terima($id){
        $billing = DB::table('billing')->select('billing.*', 'member.nama', 'member.email')->join('member', 'member.id', 'billing.id_member')->where('billing.id', $id)->first();

        $data['token'] = 'kddnh3fuihtxf6lb';
        $data['nama_pengirim'] = 'Learnwithme';
        $data['email_pengirim'] = 'no-reply@learnwithme.com';
        $data['email_tujuan'] = $billing->email;
        $data['email_subject'] = 'Pembayaran Kelas Anda Telah Diterma!';
        $data['email_message'] = 'Hallo '.$billing->nama.',<br> Pembayaran untuk invoice #'.$billing->id.' telah diterima. selamat belajar.';
        $curl = curl_init();
        $send_email = UserHelp::send_email($data);
        if($send_email == 'success'){
            $obj = [
                'status' => 'Terbayar',
                'status_kelas' => 'Berjalan'
            ];
            DB::table('billing')->where('id', $id)->update($obj);

            $mentor_saldo = DB::table('mentor_saldo')->where('id_mentor', $billing->id_mentor)->first();
            if($mentor_saldo){
                $obj_saldo = [
                    'saldo' => $mentor_saldo->saldo+$billing->total,
                ];
                DB::table('mentor_saldo')->where('id_mentor', $billing->id_mentor)->update($obj_saldo);
            }
            else {
                $obj_saldo = [
                    'id_mentor' => $billing->id_mentor,
                    'saldo' => $billing->total,
                ];
                DB::table('mentor_saldo')->insert($obj_saldo);
            }

            $kelas_materi = DB::table('kelas_materi')->where('id_kelas', $billing->id_kelas)->get();
            foreach ($kelas_materi as $key) {
                $obj_member_kelas_materi = [
                    'id_member' => $billing->id_member,
                    'id_kelas' => $billing->id_kelas,
                    'id_kelas_materi' => $key->id
                ];
                DB::table('member_kelas_materi')->insert($obj_member_kelas_materi);
            }

            $kelasnya = DB::table('kelas')->where('id', $billing->id_kelas)->first();
            if($kelasnya){
                $terjual = $kelasnya->terjual+1;
                $obj_kelas = [
                    'terjual' => $terjual
                ];
                DB::table('kelas')->where('id', $billing->id_kelas)->update($obj_kelas);
            }

            return redirect()->route('admin.billing')->with('status', 'Berhasil Terima Pemmbayaran');
        }
        else {
            return redirect()->route('admin.billing')->with('status_gagal', 'Gagal Terima Pemmbayaran, Email Tidak Terkirim.');
        }
    }

    public function tolak(Request $request){
        $id = $request->id;
        $billing = DB::table('billing')->select('billing.*', 'member.nama', 'member.email')->join('member', 'member.id', 'billing.id_member')->where('billing.id', $id)->first();

        $data['token'] = 'kddnh3fuihtxf6lb';
        $data['nama_pengirim'] = 'Learnwithme';
        $data['email_pengirim'] = 'no-reply@learnwithme.com';
        $data['email_tujuan'] = $billing->email;
        $data['email_subject'] = 'Bukti Pembayaran Anda Ditolak!';
        $data['email_message'] = 'Hallo '.$billing->nama.',<br> Mohon maaf bukti pembayaran untuk invoice #'.$billing->id.' telah ditolak. Berikut alasan penolakannya : <br> '.$request->alasan.' <br>Silahkan melampirkan bukti transfer ulang.';
        $curl = curl_init();
        $send_email = UserHelp::send_email($data);
        if($send_email == 'success'){
            $obj = [
                'status' => 'Belum Bayar',
                'bukti_transfer' => null,
            ];
            DB::table('billing')->where('id', $id)->update($obj);

            return redirect()->route('admin.billing')->with('status', 'Berhasil Menolak Pemmbayaran');
        }
        else {
            return redirect()->route('admin.billing')->with('status_gagal', 'Gagal Menolak Pemmbayaran, Email Tidak Terkirim.');
        }
    }

    public function penarikan(){

        $data['total_penarikan_bulan_ini'] = DB::table('penarikan')->where('status', 'Berhasil')->whereMonth('created_at', Carbon::now()->month)->sum('nominal');
        $data['total_penarikan_bulan_kemaren'] = DB::table('penarikan')->where('status', 'Berhasil')->whereMonth('created_at', Carbon::now()->subMonth()->month)->sum('nominal');
        $data['pengaturan'] = DB::table('pengaturan')->first();
        $data['penarikan'] = DB::table('penarikan')->select('penarikan.*', 'mentor.nama')->join('mentor', 'mentor.id', 'penarikan.id_mentor')->orderBy('penarikan.id', 'DESC')->paginate(10);

        return view('admin.penarikan.list',$data)->with('title','Penarikan'); 
    }

    public function terimapenarikan(Request $request){
        $id = $request->id;
        $penarikan = DB::table('penarikan')->select('penarikan.*', 'mentor.nama', 'mentor.email')->join('mentor', 'mentor.id', 'penarikan.id_mentor')->where('penarikan.id', $id)->first();

        $data['token'] = 'kddnh3fuihtxf6lb';
        $data['nama_pengirim'] = 'Learnwithme';
        $data['email_pengirim'] = 'no-reply@learnwithme.com';
        $data['email_tujuan'] = $penarikan->email;
        $data['email_subject'] = 'Bukti Pembayaran Anda Ditolak!';
        $data['email_message'] = 'Hallo '.$penarikan->nama.',<br> Selamat penarikan saldo anda sebesar '.UserHelp::rupiah($penarikan->nominal).' dikurangi biaya penarikan '.UserHelp::rupiah($penarikan->admin).' menjadi '.UserHelp::rupiah($penarikan->diterima).'  ID panerikan #'.$penarikan->id.' telah berhasil.';
        $curl = curl_init();
        $send_email = UserHelp::send_email($data);
        if($send_email == 'success'){
            $obj = [
                'status' => 'Berhasil'
            ];
            DB::table('penarikan')->where('id', $id)->update($obj);

            $mentor_saldo = DB::table('mentor_saldo')->where('id_mentor', $penarikan->id_mentor)->first();
            $obj_saldo = [
                'saldo' => $mentor_saldo->saldo-$penarikan->nominal,
            ];
            DB::table('mentor_saldo')->where('id_mentor', $penarikan->id_mentor)->update($obj_saldo);

            return redirect()->route('admin.penarikan')->with('status', 'Berhasil Konfirmasi Penarikan');
        }
        else {
            return redirect()->route('admin.penarikan')->with('status_gagal', 'Gagal Konfirmasi Penarikan, Email Tidak Terkirim.');
        }
    }

    public function tolakpenarikan(Request $request){
        $id = $request->id;
        $penarikan = DB::table('penarikan')->select('penarikan.*', 'mentor.nama', 'mentor.email')->join('mentor', 'mentor.id', 'penarikan.id_mentor')->where('penarikan.id', $id)->first();

        $data['token'] = 'kddnh3fuihtxf6lb';
        $data['nama_pengirim'] = 'Learnwithme';
        $data['email_pengirim'] = 'no-reply@learnwithme.com';
        $data['email_tujuan'] = $penarikan->email;
        $data['email_subject'] = 'Bukti Pembayaran Anda Ditolak!';
        $data['email_message'] = 'Hallo '.$penarikan->nama.',<br> Mohon maaf penarikan saldo dengan ID panerikan #'.$penarikan->id.' telah ditolak. Berikut alasan penolakannya : <br> '.$request->alasan.'. <br> Silahkan lalukan penarikan kembali';
        $curl = curl_init();
        $send_email = UserHelp::send_email($data);
        if($send_email == 'success'){
            $obj = [
                'status' => 'Gagal'
            ];
            DB::table('penarikan')->where('id', $id)->update($obj);

            return redirect()->route('admin.penarikan')->with('status', 'Berhasil Menolak Penarikan');
        }
        else {
            return redirect()->route('admin.penarikan')->with('status_gagal', 'Gagal Menolak Penarikan, Email Tidak Terkirim.');
        }
    }
}