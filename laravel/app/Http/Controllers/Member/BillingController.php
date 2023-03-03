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
use Redirect;
use DateTime;
use DateTimeZone;
use DateInterval;
use DatePeriod;
use UserHelp;
use Image;
use App\Services\Midtrans\CreateSnapTokenService;

class BillingController extends Controller
{

    public function index(Request $request){

        $billing = DB::table('billing')->select('billing.*', 'kelas.kelas');
        $billing->join('kelas', 'kelas.id', 'billing.id_kelas');
        if($request->cari){
            $billing->where('billing.id','like','%'.$request->get('cari').'%');
        }
        $billing->where('billing.id_member', '=', Session::get('id'));
        $billing->orderBy('billing.id', 'DESC');
        $dt_base= $billing->paginate(10);
        $data['billing'] = $dt_base;
        $data['pengaturan'] = DB::table('pengaturan')->first();
        $data['total_kelas'] = DB::table('billing')->where('id_member', Session::get('id'))->where('status', 'Terbayar')->where('status_kelas', '!=', 'Tidak Aktif')->count();
        return view('member.billing.list', $data)->with('title','Billing Saya'); 
    }
    public function konfirmasi(Request $request){

        $valid['file'] = 'mimes:jpeg,png,jpg|max:2048';
        $validator = Validator::make($request->all(), $valid);

        if ($validator->fails()) {
            return redirect()->back()->with('gagal_upload', 'File Bukti Pembayaran Tidak Valid, Pastikan Berformat Gambar.');
        } else {
            if($request->file('file'))
            {  
                $image = $request->file('file');
                $obj['bukti_transfer'] = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/assets/images/bukti');
                $image->move($destinationPath, $obj['bukti_transfer']);
                $obj['status'] = 'Menunggu Konfirmasi';
                DB::table('billing')->where('id', $request->id)->update($obj);
                return redirect()->route('member.billing')->with('status_nya', 'Berhasil Mengirim Bukti Transfer, Silahkan Tunggu Konfirmasi Dari Kami.');
            }
        }
    }

    public function buat_invoice(Request $request){
        $kelas = DB::table('kelas')->where('id', $request->id_kelas)->first();
        $obj = [
            'id_member' => Session::get('id'),
            'id_mentor' => $kelas->id_mentor,
            'id_kelas' => $request->id_kelas,
            'biaya' => $kelas->biaya,
            'kode_unik' => $kelas->biaya > 0 ? $request->kode_unik : 0,
            'total' => $kelas->biaya > 0 ? $kelas->biaya+$request->kode_unik : $kelas->biaya,
            'status' => 'Belum Bayar',
            'status_kelas' => 'Tidak Aktif',
        ];

        $id_billing = DB::table('billing')->insertGetId($obj);

        $billing = DB::table('billing')->select('billing.*', 'kelas.kelas', 'member.email', 'member.nama', 'member.no_hp')->join('kelas', 'kelas.id', 'billing.id_kelas')->join('member', 'member.id', 'billing.id_member')->where('billing.id', $id_billing)->first();
        
        if($billing->biaya > 0){
            $midtrans = new CreateSnapTokenService($billing);
            $snapToken = $midtrans->getSnapToken();
            $obj_update['snap_token'] = $snapToken;
            DB::table('billing')->where('id', $billing->id)->update($obj_update);
        }
        else {
            $obj_update['status'] = 'Terbayar';
            $obj_update['status_kelas'] = 'Berjalan';
            DB::table('billing')->where('id', $billing->id)->update($obj_update);
            
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
        }


        return redirect()->route('member.billing')->with('status_nya', 'Berhasil Menambahkan, Silahkan Membayar');
        
    }

}