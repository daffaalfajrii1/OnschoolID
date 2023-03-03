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
use DateTimeZone;
use DateInterval;
use DatePeriod;
use UserHelp;
use Image;
use PDF;
use DateTime;


class KelasController extends Controller
{
	public function index(Request $request){
        $kelas = DB::table('billing')->select('billing.id as id_billing', 'billing.status_kelas', 'billing.updated_at as tgl_join', 'kelas.*', 'kategori.kategori', 'billing.nilai_akhir');
        $kelas->join('kelas', 'kelas.id', 'billing.id_kelas');
        $kelas->join('kategori', 'kategori.id', 'kelas.id_kategori');
        if($request->cari){
            $kelas->where('kelas','like','%'.$request->get('cari').'%');
        }
        $kelas->where('billing.id_member', '=', Session::get('id'));
        $kelas->where('billing.status_kelas', '!=', 'Tidak Aktif');
        $kelas->orderBy('billing.id', 'DESC');
        $dt_base= $kelas->paginate(10);
        $data['kelas'] = $dt_base;
        $data['total_kelas'] = DB::table('billing')->where('id_member', Session::get('id'))->where('status', 'Terbayar')->where('status_kelas', '!=', 'Tidak Aktif')->count();
		return view('member.kelas.list', $data)->with('title','Kelas Saya'); 
	}

    public function ujian($id){
        $kelas = DB::table('billing')->select('billing.id as id_billing', 'billing.status_kelas', 'billing.updated_at as tgl_join', 'kelas.*', 'kategori.kategori');
        $kelas->join('kelas', 'kelas.id', 'billing.id_kelas');
        $kelas->join('kategori', 'kategori.id', 'kelas.id_kategori');
        $kelas->where('billing.id_member', '=', Session::get('id'));
        $kelas->where('billing.status_kelas', '!=', 'Tidak Aktif');
        $kelas->where('billing.id_kelas', '=', $id);
        $dt_base= $kelas->first();
        if($dt_base){
            $data['kelas'] = $dt_base;
            $data['kelas_soal'] = DB::table('kelas_soal')->where('id_kelas', $id)->get();
            return view('member.kelas.ujian', $data)->with('title', 'Ujian '.$dt_base->kelas); 
        }
        else {
            return redirect()->route('home');
        }
    }

    public function kirimujian(Request $request){
        $benar = 0;
        $jumlah_soal = DB::table('kelas_soal')->where('id_kelas', $request->id_kelas)->count();
        $id_soal = $request->id_soal;
        $jawaban = $request->jawaban;
        if($id_soal){
            for ($i=0; $i < count($id_soal); $i++) { 
                $cek_jawaban = DB::table('kelas_soal')->where('id', $id_soal[$i])->where('jawaban', $jawaban[$id_soal[$i]])->count();
                $benar +=$cek_jawaban;
            }
        }
        $salah = $jumlah_soal-$benar;
        $hitung_nilai = (($jumlah_soal-$salah)/$jumlah_soal)*100;
        $obj = [
            'id_kelas' => $request->id_kelas,
            'id_member' => Session::get('id'),
            'nilai' => $hitung_nilai,
        ];
        DB::table('member_kelas_ujian')->insert($obj);
        $obj_billing['nilai_akhir'] = $hitung_nilai;
        if($hitung_nilai >= 60){
           $obj_billing['status_kelas'] = 'Selesai'; 
           $obj_materi['status'] = 'Selesai';
           DB::table('member_kelas_materi')->where('id_kelas', $request->id_kelas)->where('id_member', Session::get('id'))->update($obj_materi);
        }
        DB::table('billing')->where('id_kelas', $request->id_kelas)->where('id_member', Session::get('id'))->update($obj_billing);
        if($hitung_nilai >= 60){
            return redirect()->route('member.kelas.detail', $request->id_kelas)->with('lulus', 'Selamat anda telah lulus dalam kelas ini dengan nilai ujian akhir '.$hitung_nilai.'!');
        }
        else {
            return redirect()->route('member.kelas.detail', $request->id_kelas)->with('gagal', 'Mohon maaf anda belum lulus kelas ini, silahkan lakukan ujian ulang');
        }
    }

    public function detail($id){
        $kelas = DB::table('billing')->select('billing.id as id_billing', 'billing.status_kelas', 'billing.updated_at as tgl_join', 'kelas.*', 'kategori.kategori');
        $kelas->join('kelas', 'kelas.id', 'billing.id_kelas');
        $kelas->join('kategori', 'kategori.id', 'kelas.id_kategori');
        $kelas->where('billing.id_member', '=', Session::get('id'));
        $kelas->where('billing.status_kelas', '!=', 'Tidak Aktif');
        $kelas->where('billing.id_kelas', '=', $id);
        $dt_base= $kelas->first();
        if($dt_base->status == 'Suspend'){
            return redirect()->route('member.kelas')->with('gagal', 'Mohon maaf kelas sudah di suspend oleh sistem.');
            exit;
        }
        $data['kelas'] = $dt_base;
        $data['total_kelas'] = DB::table('billing')->where('id_member', Session::get('id'))->where('status', 'Terbayar')->where('status_kelas', '!=', 'Tidak Aktif')->count();
        $data['total_siswa'] = DB::table('billing')->where('status_kelas', '!=', 'Tidak Aktif')->where('id_kelas', $id)->count();
        $data['total_materi'] = DB::table('kelas_materi')->where('id_kelas', $id)->count();
        $data['total_tools'] = DB::table('kelas_tools')->where('id_kelas', $id)->count();
        $data['kelas_materi'] = DB::table('kelas_materi')->where('id_kelas', $id)->paginate(5);
        $data['kelas_faq'] = DB::table('kelas_faq')->where('id_kelas', $id)->get();
        $data['kelas_tools'] = DB::table('kelas_tools')->where('id_kelas', $id)->get();
        $data['mentor'] = DB::table('mentor')->where('id', $dt_base->id_mentor)->first();
        $data['kelas_materi'] = DB::table('member_kelas_materi')->select('member_kelas_materi.id as id_member_kelas_materi', 'member_kelas_materi.id_member', 'member_kelas_materi.status', 'kelas_materi.*')->join('kelas_materi', 'kelas_materi.id', 'member_kelas_materi.id_kelas_materi')->where('member_kelas_materi.id_kelas', '=', $id)->where('member_kelas_materi.id_member', '=', Session::get('id'))->get();
        return view('member.kelas.detail', $data)->with('title',$dt_base->kelas); 
        // echo '<pre>'; print_r($data); echo '</pre>';
    }

    public function materi(Request $request){
        $obj = [
            'status' => 'Selesai',
        ];
        DB::table('member_kelas_materi')->where('id_kelas_materi', '=', $request->id_kelas_materi)->where('id_kelas', '=', $request->id_kelas)->where('id_member', Session::get('id'))->update($obj);

        $cek_jumlah_materi = DB::table('member_kelas_materi')->where('id_kelas', '=', $request->id_kelas)->where('id_member', Session::get('id'))->count();
        $cek_jumlah_materi_selesai = DB::table('member_kelas_materi')->where('status', 'Selesai')->where('id_kelas', '=', $request->id_kelas)->where('id_member', Session::get('id'))->count();

        if($cek_jumlah_materi_selesai >= $cek_jumlah_materi){
            $obj_update = [
                'status_kelas' => 'Selesai',
            ];
            DB::table('billing')->where('id_kelas', '=', $request->id_kelas)->where('id_member', Session::get('id'))->update($obj_update);
        }

        print json_encode(array('error'=>false));
    }

    public function sertifikat(Request $request){
        $id_kelas = $request->id_kelas;

        $kelas = DB::table('billing')->select('billing.id as id_billing', 'billing.status_kelas', 'billing.created_at as tgl_join', 'billing.updated_at as update_billing', 'kelas.*', 'kategori.kategori', 'billing.nilai_akhir');
        $kelas->join('kelas', 'kelas.id', 'billing.id_kelas');
        $kelas->join('kategori', 'kategori.id', 'kelas.id_kategori');
        $kelas->where('billing.id_member', '=', Session::get('id'));
        $kelas->where('billing.status_kelas', '!=', 'Tidak Aktif');
        $kelas->where('billing.id_kelas', '=', $id_kelas);
        $dt_base= $kelas->first();

        $date = new DateTime($dt_base->update_billing);
        $result = $date->format('dmYhis');
        $data['kelas'] = $dt_base;
        $data['no_sertifikat'] = $id_kelas.Session::get('id').$result;
        $data['pengaturan'] = DB::table('pengaturan')->first();

        $pdf = PDF::loadview('pdf.sertifikat',$data)->setPaper('a4', 'landscape');
        return $pdf->stream('sertifikat-'.$id_kelas.Session::get('id').$result.'.pdf');

    }
}