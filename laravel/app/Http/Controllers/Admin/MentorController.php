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
use Image;
use File;

class MentorController extends Controller
{
	public function index(Request $request)
    { 
        $mentor = DB::table('mentor');
        if($request->cari){
            $mentor->where('nama','like','%'.$request->get('cari').'%');  
            $mentor->orWhere('email','like','%'.$request->get('cari').'%');
            $mentor->orWhere('no_hp','like','%'.$request->get('cari').'%');
            $mentor->orWhere('pendidikan','like','%'.$request->get('cari').'%');
            $mentor->orWhere('alamat','like','%'.$request->get('cari').'%');
            $mentor->orWhere('deskripsi','like','%'.$request->get('cari').'%');
        }
        if($request->sort){
            $mentor->orderBy($request->sort, 'ASC');
        }
        else {
            $mentor->orderBy('id', 'DESC');
        }
        $mentor->where('status', '!=', '0');
        $mentor->where('status', '!=', '3');
        $dt_base= $mentor->paginate(10);
        $data['mentor'] = $dt_base;
    	return view('admin.mentor.list', $data)->with('title','List Mentor'); 
    }

    public function permintaan(Request $request)
    { 
        $mentor = DB::table('mentor');
        if($request->cari){
            $mentor->where('nama','like','%'.$request->get('cari').'%');  
            $mentor->orWhere('email','like','%'.$request->get('cari').'%');
            $mentor->orWhere('no_hp','like','%'.$request->get('cari').'%');
            $mentor->orWhere('pendidikan','like','%'.$request->get('cari').'%');
            $mentor->orWhere('alamat','like','%'.$request->get('cari').'%');
            $mentor->orWhere('deskripsi','like','%'.$request->get('cari').'%');
        }
        if($request->sort){
            $mentor->orderBy($request->sort, 'ASC');
        }
        else {
            $mentor->orderBy('id', 'DESC');
        }
        $mentor->where('status', '=', '0');
        $dt_base= $mentor->paginate(10);
        $data['mentor'] = $dt_base;
        return view('admin.mentor.permintaan', $data)->with('title','Permintaan Mentor'); 
    }

    public function tambah()
    { 
        return view('admin.mentor.tambah')->with('title','Tambah Mentor'); 
    }

    public function simpan(Request $request){
        $message = [
            'email.unique' => 'Email sudah terdaftar',
            'no_hp.unique' => 'No HP sudah terdaftar',
            'password.min' => 'Password minimal 8 karakter',
            'foto.nimes' => 'Extensi foto tidak diperkenankan',
            'foto.max' => 'Maksimal size 2MB',
            'foto.image' => 'Pastikan foto berupa file gambar'
        ];
        $valid['nama'] = 'required';
        $valid['email'] = 'required|unique:mentor';
        $valid['no_hp'] = 'required|unique:mentor';
        $valid['pendidikan'] = 'required';
        $valid['alamat'] = 'required';
        $valid['password'] = 'required|min:8';
        $valid['deskripsi'] = 'required';
        $valid['foto'] = 'mimes:jpeg,png,jpg|max:2048';
        $validator = Validator::make($request->all(), $valid, $message);

        if ($validator->fails()) {
            return redirect()->route('admin.mentor.tambah')->withErrors($validator)->withInput();
        } else {
            $obj = [
                'nama' => $request->nama,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'password' => Hash::make($request->password),
                'pendidikan' => $request->pendidikan,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat,
                'deskripsi' => $request->deskripsi,
                'status' => 1,
            ];
            if($request->file('foto'))
            {  
                $image = $request->file('foto');
                $obj['foto'] = time().'.'.$image->getClientOriginalExtension();
             
                $destinationPath = public_path('/adm/images/instructor/thumbnail');
                $img = Image::make($image->getRealPath());
                $img->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.'/'.$obj['foto']);
           
                $destinationPath = public_path('/adm/images/instructor');
                $image->move($destinationPath, $obj['foto']);
            }
            DB::table('mentor')->insert($obj);

            return redirect()->route('admin.mentor')->with('status', 'Berhasil Menambah Data Mentor Baru');
        }
    }

    public function edit($id)
    { 
        $data['mentor'] = DB::table('mentor')->where('id', $id)->first();
        return view('admin.mentor.edit',$data)->with('title','Edit Mentor'); 
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
        $valid['email'] = 'required|unique:mentor,email,'.$request->id;
        $valid['no_hp'] = 'required|unique:mentor,no_hp,'.$request->id;
        $valid['pendidikan'] = 'required';
        $valid['alamat'] = 'required';
        $valid['deskripsi'] = 'required';
        $valid['foto'] = 'mimes:jpeg,png,jpg|max:2048';
        $validator = Validator::make($request->all(), $valid, $message);

        if ($validator->fails()) {
            return redirect()->route('admin.mentor.edit', $request->id)->withErrors($validator)->withInput();
        } else {
            $obj = [
                'nama' => $request->nama,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'pendidikan' => $request->pendidikan,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat,
                'deskripsi' => $request->deskripsi,
            ];
            if($request->password){
                $obj['password'] = Hash::make($request->password);
            }
            if($request->file('foto'))
            {  
                $image = $request->file('foto');
                $obj['foto'] = time().'.'.$image->getClientOriginalExtension();
             
                $destinationPath = public_path('/adm/images/instructor/thumbnail');
                $img = Image::make($image->getRealPath());
                $img->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.'/'.$obj['foto']);
           
                $destinationPath = public_path('/adm/images/instructor');
                $image->move($destinationPath, $obj['foto']);
                $mentor = DB::table('mentor')->where('id', $request->id)->first();
                if($mentor->foto != null){
                    $image_path = app_path("adm/images/instructor/".$mentor->foto);
                    if (File::exists($image_path)) {
                        unlink($image_path);
                    }
                    $image_path = app_path("adm/images/instructor/thumbnail/".$mentor->foto);
                    if (File::exists($image_path)) {
                        unlink($image_path);
                    }
                }
            }
            DB::table('mentor')->where('id', $request->id)->update($obj);
            return redirect()->route('admin.mentor')->with('status', 'Berhasil Mengubah');
        }
    }

    public function detail($id){
        $data['mentor'] = DB::table('mentor')->where('id', $id)->first();
        $data['kelas'] = DB::table('kelas')->where('id_mentor', $id)->paginate(10);

        return view('admin.mentor.detail', $data)->with('title','Detail Mentor'); 
    }

    public function suspend($id){

        $obj = [
                'status' => '2'
        ];
        DB::table('mentor')->where('id', $id)->update($obj);

        return redirect()->route('admin.mentor')->with('status', 'Berhasil suspend mentor');
    }

    public function unsuspend($id){

        $obj = [
                'status' => '1'
        ];
        DB::table('mentor')->where('id', $id)->update($obj);

        return redirect()->route('admin.mentor')->with('status', 'Berhasil unsuspend mentor');
    }

    public function terima($id){

        $password = UserHelp::randomPassword();
        $mentor = DB::table('mentor')->where('id', $id)->first();
        $pengaturan = DB::table('pengaturan')->first();

        $data['token'] = 'kddnh3fuihtxf6lb';
        $data['nama_pengirim'] = $pengaturan->nama_web;
        $data['email_pengirim'] = $pengaturan->email_web;
        $data['email_tujuan'] = $mentor->email;
        $data['email_subject'] = 'Selamat Anda Diterima Sebagai Mentor!';
        $data['email_message'] = 'Hallo '.$mentor->nama.',<br> Selamat Anda telah diterima sebagai mentor di Onschool Indonesia. Berikut Data akses masuk Anda : <br> Email : '.$mentor->email.'<br> Password : '.$password;
        $curl = curl_init();
        $send_email = UserHelp::send_email($data);

        if($send_email == 'success'){
            $obj = [
                'status' => '1',
                'password' => Hash::make($password),
            ];
            DB::table('mentor')->where('id', $id)->update($obj);
            return redirect()->route('admin.mentor.permintaan')->with('status', 'Berhasil Menerima Mentor');
        }
        else {
            return redirect()->route('admin.mentor.permintaan')->with('status_gagal', 'Gagal Menerima Mentor, Email Tidak Terkirim.');
        }
    }

    public function tolak(Request $request){
        $id = $request->id;
        $mentor = DB::table('mentor')->where('id', $id)->first();

        $data['token'] = 'kddnh3fuihtxf6lb';
        $data['nama_pengirim'] = 'Learnwithme';
        $data['email_pengirim'] = 'no-reply@learnwithme.com';
        $data['email_tujuan'] = $mentor->email;
        $data['email_subject'] = 'Pendaftaran Sebagai Mentor Ditolak!';
        $data['email_message'] = 'Hallo '.$mentor->nama.',<br> Mohon maaf anda telah ditolak sebagai mentor di Learnwithme. Berikut alasan penolakannya : <br> '.$request->alasan.' <br>Silahkan mendaftar kembali jika masih ingin mendaftar sebagai mentor.';
        $curl = curl_init();
        $send_email = UserHelp::send_email($data);
        if($send_email == 'success'){
            DB::table('mentor')->where('id', $id)->delete();

            return redirect()->route('admin.mentor.permintaan')->with('status', 'Berhasil Menolak Mentor');
        }
        else {
            return redirect()->route('admin.mentor.permintaan')->with('status', 'Gagal Menolak Mentor, Email Tidak Terkirim.');
        }
    }
}