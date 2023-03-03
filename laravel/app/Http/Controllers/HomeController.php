<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use DB;
use Session;
use Helpers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Redirect;
use UserHelp;

class HomeController extends Controller
{
	public function index(){

		$data['jumlah_member'] = DB::table('member')->count();
		$data['jumlah_mentor'] = DB::table('mentor')->where('status', '1')->count();
		$data['jumlah_kelas'] = DB::table('kelas')->where('status', 'Aktif')->count();
		$data['jumlah_sertifikat'] = DB::table('billing')->where('status_kelas', 'Selesai')->count();

		$data['kategori'] = DB::table('kategori')->get();
        $data['pengaturan'] = DB::table('pengaturan')->first();
        $data['blog'] = DB::table('blog')->limit(3)->get();

		return view('home', $data)->with('title','Home'); 
	}
	
	public function privasi(){

		$data['kategori'] = DB::table('kategori')->get();
        $data['pengaturan'] = DB::table('pengaturan')->first();
        $data['blog'] = DB::table('blog')->limit(3)->get();

		return view('privasi', $data)->with('title','Kebijakan Privasi'); 
	}

    public function forum(){
        if(Session::get('id')){
            $data['pengaturan'] = DB::table('pengaturan')->first();
            $data['forum'] = DB::table('forum')->orderBy('updated_at', 'DESC')->paginate(10);
            return view('forum', $data)->with('title','Forum Diskusi'); 
        }else {
            return redirect()->route('masuk')->with('gagal', 'Silahkan masuk terlebih dahulu'); 
        }
        
    }
    public function buatforum(){
        $data['pengaturan'] = DB::table('pengaturan')->first();
        return view('buat_forum', $data)->with('title','Buat Forum Diskusi'); 
    }

    public function viewforum($slug){
        $forum = DB::table('forum')->where('slug', $slug)->first();
        $data['pengaturan'] = DB::table('pengaturan')->first();
        $data['forum'] = $forum;
        $data['list_komentar'] = DB::table('forum_komentar')->where('id_forum', $forum->id)->orderBy('id', 'ASC')->paginate(10);
        // echo '<pre>';print_r($data); echo '</pre>';exit;

        return view('forum_detail', $data)->with('title',$forum->judul); 
    }

    public function hapusforum($id){
        DB::table('forum_komentar')->where('id_forum', $id)->delete();
        DB::table('forum')->where('id', $id)->delete();

        return redirect()->route('forum')->with('status', 'Berhasil Menghapus Data Forum'); 
    }

    public function hapuskomentarforum($id){
        DB::table('forum_komentar')->where('id', $id)->delete();

        return redirect()->back()->with('status_komentar', 'Berhasil Menghapus Komentar'); 
    }

    public function komentarforum(Request $request, $id){
        $valid['komentar'] = 'required';
        $validator = Validator::make($request->all(), $valid);
        $forum = DB::table('forum')->where('id', $id)->first();

        if ($validator->fails()) {
            return redirect()->route('forum.view', $forum->slug)->withErrors($validator)->withInput();
        } else {
            $id_user = Session::get('id');
            if(Session::get('admin_status')){
                $tipe_user = 'admin';
            }
            else if(Session::get('member_status')){
                $tipe_user = 'member';
            }
            else {
                $tipe_user = 'mentor';
            }
            $obj = [
                'id_forum' => $id,
                'komentar' => $request->komentar,
                'id_user' => $id_user,
                'tipe_user' => $tipe_user
            ];
            DB::table('forum_komentar')->insert($obj);

            return redirect()->route('forum.view', $forum->slug)->with('status_komentar', 'Berhasil Menambah Komentar');
        }
    }

    public function simpanforum(Request $request){
        $valid['judul'] = 'required';
        $valid['isi'] = 'required';
        $validator = Validator::make($request->all(), $valid);

        if ($validator->fails()) {
            return redirect()->route('forum.buat')->withErrors($validator)->withInput();
        } else {
            $id_user = Session::get('id');
            if(Session::get('admin_status')){
                $tipe_user = 'admin';
            }
            else if(Session::get('member_status')){
                $tipe_user = 'member';
            }
            else {
                $tipe_user = 'mentor';
            }
            $obj = [
                'judul' => $request->judul,
                'isi' => $request->isi,
                'slug' => UserHelp::slugify($request->judul),
                'id_user' => $id_user,
                'tipe_user' => $tipe_user
            ];
            DB::table('forum')->insert($obj);

            return redirect()->route('forum')->with('status', 'Berhasil Menambah Diskusi');
        }
    }

    public function blog(){
        $data['pengaturan'] = DB::table('pengaturan')->first();
        $data['blog'] = DB::table('blog')->paginate(9);
        return view('blog', $data)->with('title','Blog'); 
    }

    public function detailblog($slug)
    { 
        $blog = DB::table('blog')->where('slug', $slug)->first();
        $obj = [
            'view' => $blog->view+1
        ];
        DB::table('blog')->where('slug', $slug)->update($obj);
        $blog = DB::table('blog')->where('slug', $slug)->first();
        $data['blog'] = $blog;
        return view('blog_detail', $data)->with('title',$blog->judul); 
    }

    public function tentangkami(){
        $data['pengaturan'] = DB::table('pengaturan')->first();
        $data['tim'] = DB::table('tim')->get();
        return view('tentangkami', $data)->with('title','Tentang Kami'); 
    }

    public function kontak(){
        $data['pengaturan'] = DB::table('pengaturan')->first();
        return view('kontak', $data)->with('title','Kontak'); 
    }

    public function syarat(){
        $data['pengaturan'] = DB::table('pengaturan')->first();
        return view('syarat', $data)->with('title','Syarat & Ketentuan'); 
    }

	public function masuk(){

		return view('login')->with('title','Halaman Masuk'); 
	}

	public function prosesmasuk(Request $request){
		$customMessages = [
          'required' => 'Wajib Diisi.'
	      ];
	    $validator = Validator::make($request->all(),[
	            //......
	            'email' => 'required',
	            'password' => 'required'
	    ], $customMessages);
	    if ($validator->fails()) {
	      return redirect()->route('masuk')->withErrors($validator)->withInput();
	    } else {
	    	$selectdb= DB::table('member')->where('email',@$request->email)->first();
            if($selectdb)
            {
            	if(Hash::check(@$request->password,$selectdb->password))
                {
                	Session::put('member_status', true);
                    Session::put('id', $selectdb->id);
                    Session::put('email', $selectdb->email);
                    Session::put('nama', $selectdb->nama); 
                    Session::put('no_hp', $selectdb->no_hp); 
                    Session::put('pekerjaan', $selectdb->pekerjaan); 
                    Session::put('alamat', $selectdb->alamat); 
                    Session::put('foto', $selectdb->foto); 
                    return redirect()->route('member.dashboard')->with('berhasil', 'Berhasil Masuk');
                    // return redirect::back()->with('berhasil', 'Berhasil Masuk, tapi halaman dashboard masih dalam proses pembuatan.');
                    // echo $selectdb->id;
                }
                else {
                	return redirect::back()->with('gagal', 'Password Salah');
                }
            }
            else {
            	$selectdb_mentor= DB::table('mentor')->where('email',@$request->email)->first();
            	if($selectdb_mentor)
            	{
            		if(Hash::check(@$request->password,$selectdb_mentor->password))
	                {
	                	Session::put('mentor_status', true);
	                    Session::put('id', $selectdb_mentor->id);
	                    Session::put('email', $selectdb_mentor->email);
	                    Session::put('nama', $selectdb_mentor->nama); 
	                    Session::put('pendidikan', $selectdb_mentor->pendidikan); 
	                    Session::put('jenis_kelamin', $selectdb_mentor->jenis_kelamin); 
	                    Session::put('alamat', $selectdb_mentor->alamat); 
	                    Session::put('deskripsi', $selectdb_mentor->deskripsi); 
	                    Session::put('status', $selectdb_mentor->status); 
	                    Session::put('no_hp', $selectdb_mentor->no_hp); 
	                    Session::put('foto', $selectdb_mentor->foto); 
	                    return redirect()->route('mentor.dashboard')->with('berhasil', 'Berhasil Masuk');
                        // return redirect::back()->with('berhasil', 'Berhasil Masuk, tapi halaman dashboard masih dalam proses pembuatan.');
	                }
	                else {
	                	return redirect::back()->with('gagal', 'Password Salah');
	                }

            	}
            	else {
            		return redirect::back()->with('gagal', 'Email Salah');
            	}
            }
	    }
	}

	public function daftarmentor(){
	    $data['jumlah_member'] = DB::table('member')->count();
		$data['jumlah_mentor'] = DB::table('mentor')->where('status', '1')->count();
		$data['jumlah_kelas'] = DB::table('kelas')->where('status', 'Aktif')->count();
		$data['jumlah_sertifikat'] = DB::table('billing')->where('status_kelas', 'Selesai')->count();

		return view('register_mentor', $data)->with('title','Jadilah Mentor'); 
	}

	public function prosesdaftarmentor(Request $request){
		$message = [
            'email.unique' => 'Email sudah terdaftar',
            'no_hp.unique' => 'No HP sudah terdaftar',
            'no_hp.numeric' => 'No HP tidak valid',
        ];
        $valid['nama'] = 'required';
        $valid['email'] = 'required|unique:mentor';
        $valid['no_hp'] = 'required|unique:mentor|numeric';
        $valid['pendidikan'] = 'required';
        $valid['alamat'] = 'required';
        $valid['deskripsi'] = 'required';
        $validator = Validator::make($request->all(), $valid, $message);

        if ($validator->fails()) {
            return Redirect::to('jadilah-mentor#fill-mentor-form')->withErrors($validator)->withInput();
        } else {
            $obj = [
                'nama' => $request->nama,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'pendidikan' => $request->pendidikan,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat,
                'deskripsi' => $request->deskripsi,
                'status' => 0,
            ];
            DB::table('mentor')->insert($obj);

            return Redirect::to('jadilah-mentor#fill-mentor-form')->with('berhasil', 'Berhasil mengajukan, silahkan tunggu konfirmasi dari kami.');
        }
	}

	public function daftar(){

		return view('register')->with('title','Halaman Daftar'); 
	}

	public function prosesdaftar(Request $request){

		$customMessages = [
          	'required' => 'Wajib Diisi.',
          	'email.unique' => 'Email sudah terdaftar',
            'no_hp.unique' => 'No HP sudah terdaftar',
            'no_hp.numeric' => 'No HP tidak valid',
            'password.min' => 'Password minimal 8 karakter',
	    ];
	    $validator = Validator::make($request->all(),[
	            'nama' => 'required',
	            'email' => 'required|unique:member',
	            'no_hp' => 'required|numeric|unique:member',
	            'password' => 'required|min:8'
	    ], $customMessages);

	    if ($validator->fails()) {
            return redirect()->route('daftar')->withErrors($validator)->withInput();
        } else {
        	$obj = [
                'nama' => $request->nama,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'password' => Hash::make($request->password)
            ];
            DB::table('member')->insert($obj);

            return redirect()->route('masuk')->with('berhasil', 'Berhasil mendaftar, silahkan masuk');
        }
	}

	public function keluar(Request $request){
		$request->session()->flush(); 

        return redirect()->route('home')->with('berhasil', 'Berhasil Keluar');
	}

	public function kelas(Request $request, $slug = null)
    { 
        $kelas = DB::table('kelas')->select('kelas.*', 'kategori.kategori', 'mentor.nama', 'mentor.foto as foto_mentor', 'mentor.jenis_kelamin');
        $kelas->join('kategori', 'kategori.id', 'kelas.id_kategori');
        $kelas->join('mentor', 'mentor.id', 'kelas.id_mentor');
        if($request->cari){
            $kelas->where('kelas.kelas','like','%'.$request->get('cari').'%');
        }
        if($request->tipe){
        	$kelas->where('kelas.tipe', '=', $request->tipe);
        }
        if($slug != null){
            $kelas->where('kategori.slug', '=', $slug);
        }
        $kelas->where('kelas.status', '=', 'Aktif');
        $kelas->orderBy('kelas.id', 'DESC');
        $dt_base= $kelas->paginate(12);
        $data['kelas'] = $dt_base;
    	return view('kelas', $data)->with('title','List Kelas'); 
    }

    public function detailkelas($id)
    { 
        $cek_kelas = DB::table('billing')->where('id_kelas', $id)->where('id_member', Session::get('id'))->where('status', 'Terbayar')->first();
        if($cek_kelas){
            return redirect()->route('member.kelas.detail', $id);
        }
        $cek_kelas = DB::table('billing')->where('id_kelas', $id)->where('id_member', Session::get('id'))->first();
        if($cek_kelas){
            return redirect()->route('member.billing');
        }
        $kelas = DB::table('kelas')->select('kelas.*', 'kategori.kategori', 'mentor.nama', 'mentor.foto as foto_mentor', 'mentor.jenis_kelamin', 'mentor.email');
        $kelas->join('kategori', 'kategori.id', 'kelas.id_kategori');
        $kelas->join('mentor', 'mentor.id', 'kelas.id_mentor');
        $kelas->where('kelas.status', '!=', 'Pending');
        $kelas->where('kelas.id', '=', $id);
        $dt_base= $kelas->first();
        $data['kelas'] = $dt_base;
        $data['total_siswa'] = DB::table('billing')->where('status_kelas', '!=', 'Tidak Aktif')->where('id_kelas', $id)->count();
        $data['total_materi'] = DB::table('kelas_materi')->where('id_kelas', $id)->count();
        $data['total_tools'] = DB::table('kelas_tools')->where('id_kelas', $id)->count();
        $data['kelas_materi'] = DB::table('kelas_materi')->where('id_kelas', $id)->paginate(5);
        $data['kelas_faq'] = DB::table('kelas_faq')->where('id_kelas', $id)->get();
        $data['kelas_tools'] = DB::table('kelas_tools')->where('id_kelas', $id)->get();
        $data['mentor'] = DB::table('mentor')->where('id', @$dt_base->id_mentor)->first();
        $data['total_siswa_mentor'] = DB::table('billing')->where('id_mentor', $dt_base->id_mentor)->count();
        $data['total_kelas_mentor'] = DB::table('kelas')->where('kelas.id_mentor', $dt_base->id_mentor)->count();
    	return view('kelas_detail', $data)->with('title','Detail Kelas'); 
    }

    public function konfirmasi(Request $request){
        $id = $request->id;
        $billing = DB::table('billing')->select('billing.*', 'member.nama', 'member.email')->join('member', 'member.id', 'billing.id_member')->where('billing.id', $id)->first();

        $data['token'] = 'kddnh3fuihtxf6lb';
        $data['nama_pengirim'] = 'Onschool';
        $data['email_pengirim'] = 'no-reply@onschool.com';
        $data['email_tujuan'] = $billing->email;
        $data['email_subject'] = 'Pembayaran Kelas Anda Telah Diterma!';
        $data['email_message'] = 'Hallo '.$billing->nama.',<br> Pembayaran untuk invoice #'.$billing->id.' telah diterima. selamat belajar.';
        $curl = curl_init();
        $send_email = UserHelp::send_email($data);
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

            print json_encode(array('error'=>false));
    }
}