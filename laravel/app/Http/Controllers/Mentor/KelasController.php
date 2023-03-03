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


class KelasController extends Controller
{
	public function index(Request $request){
        $kelas = DB::table('kelas')->select('kelas.*', 'kategori.kategori');
        $kelas->join('kategori', 'kategori.id', 'kelas.id_kategori');
        if($request->cari){
            $kelas->where('kelas','like','%'.$request->get('cari').'%');
        }
        $kelas->where('kelas.id_mentor', '=', Session::get('id'));
        $kelas->orderBy('kelas.id', 'DESC');
        $dt_base= $kelas->paginate(10);
        $data['kelas'] = $dt_base;
		return view('mentor.kelas.list', $data)->with('title','Kelas Saya'); 
	}

	public function tambah(){
		$data['kategori'] = DB::table('kategori')->get();
		return view('mentor.kelas.buat_kelas', $data)->with('title','Tambahkan Kelas'); 
	}

    public function edit($id){
        $data['kategori'] = DB::table('kategori')->get();
        $data['kelas'] = DB::table('kelas')->where('id', $id)->first();
        $data['kelas_materi'] = DB::table('kelas_materi')->where('id_kelas', $id)->get();
        $data['kelas_tools'] = DB::table('kelas_tools')->where('id_kelas', $id)->get();
        $data['kelas_faq'] = DB::table('kelas_faq')->where('id_kelas', $id)->get();
        $data['kelas_soal'] = DB::table('kelas_soal')->where('id_kelas', $id)->get();

        return view('mentor.kelas.edit', $data)->with('title','Edit Kategori'); 
    }

    public function update(Request $request){
        $valid['kelas'] = 'required';
        $validator = Validator::make($request->all(), $valid);

        if ($validator->fails()) {
            return redirect()->route('mentor.kelas.edit', $request->id)->withErrors($validator)->withInput();
        } else {
            $obj = [
                'id_mentor' => Session::get('id'),
                'id_kategori' => $request->id_kategori,
                'kelas' => $request->kelas,
                'deskripsi_singkat' => $request->deskripsi_singkat,
                'deskripsi' => $request->deskripsi,
                'tipe' => $request->biaya > 0 ? 'Berbayar' : 'Gratis',
                'biaya' => $request->biaya,
                'sertifikat' => $request->sertifikat,
                'video_url' => $request->video_url,
                'pesan' => $request->pesan,
                'status' => 'Pending'
            ];
            if($request->file('my-image'))
            {  
                $image = $request->file('my-image');
                $obj['foto'] = time().'.'.$image->getClientOriginalExtension();
             
                $destinationPath = public_path('/assets/images/courses/thumbnail');
                $img = Image::make($image->getRealPath());
                $img->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.'/'.$obj['foto']);
           
                $destinationPath = public_path('/assets/images/courses');
                $image->move($destinationPath, $obj['foto']);
            }
            DB::table('kelas')->where('id', $request->id)->update($obj);
            DB::table('kelas_materi')->where('id_kelas', $request->id)->delete();
            DB::table('kelas_faq')->where('id_kelas', $request->id)->delete();
            DB::table('kelas_tools')->where('id_kelas', $request->id)->delete();
            DB::table('kelas_soal')->where('id_kelas', $request->id)->delete();

            $id_kelas = $request->id;

            $judul_materi = $request->judul_materi;
            $link_materi = $request->link_materi;
            if($judul_materi){
                for ($i=0; $i < count($judul_materi); $i++) { 
                    $obj_materi = [
                        'id_kelas' => $id_kelas,
                        'judul_materi' => $judul_materi[$i],
                        'video' => $link_materi[$i],
                    ];
                    DB::table('kelas_materi')->insertGetId($obj_materi);
                }
            }

            $nama_tools = $request->tools;
            $keterangan_tools = $request->keterangan;
            $download_tools = $request->download;
            if($nama_tools){
                for ($i=0; $i < count($nama_tools); $i++) { 
                    $obj_tools = [
                        'id_kelas' => $id_kelas,
                        'nama_tools' => $nama_tools[$i],
                        'keterangan' => $keterangan_tools[$i],
                        'download' => $download_tools[$i],
                    ];
                    DB::table('kelas_tools')->insertGetId($obj_tools);
                }
            }

            $soal = $request->soal;
            $a = $request->a;
            $b = $request->b;
            $c = $request->c;
            $d = $request->d;
            $e = $request->e;
            $jawaban = $request->jawaban;
            if($soal){
                for ($i=0; $i < count($soal); $i++) { 
                    $obj_soal = [
                        'id_kelas' => $id_kelas,
                        'soal' => $soal[$i],
                        'a' => $a[$i],
                        'b' => $b[$i],
                        'c' => $c[$i],
                        'd' => $d[$i],
                        'e' => $e[$i],
                        'jawaban' => $jawaban[$i],
                    ];
                    DB::table('kelas_soal')->insertGetId($obj_soal);
                }
            }

            $faq_pertanyaan = $request->pertanyaan;
            $faq_jawaban = $request->faq_jawaban;
            if($faq_pertanyaan){
                for ($i=0; $i < count($faq_pertanyaan); $i++) { 
                    $obj_faq = [
                        'id_kelas' => $id_kelas,
                        'pertanyaan' => $faq_pertanyaan[$i],
                        'jawaban' => $faq_jawaban[$i],
                    ];
                    DB::table('kelas_faq')->insertGetId($obj_faq);
                }
            }

            return redirect()->route('mentor.kelas')->with('status_nya', 'Berhasil Mengubah Kelas, Silahkan tunggu hasil review dari kami.');
        }
    }

	public function simpan(Request $request){
        // echo '<pre>'; print_r($request->all()); echo '</pre>';
        // exit;
		$valid['kelas'] = 'required';
        $validator = Validator::make($request->all(), $valid);

        if ($validator->fails()) {
            return redirect()->route('mentor.tambah_kelas')->withErrors($validator)->withInput();
        } else {
        	$obj = [
                'id_mentor' => Session::get('id'),
                'id_kategori' => $request->id_kategori,
                'kelas' => $request->kelas,
                'deskripsi_singkat' => $request->deskripsi_singkat,
                'deskripsi' => $request->deskripsi,
                'tipe' => $request->biaya > 0 ? 'Berbayar' : 'Gratis',
                'biaya' => $request->biaya,
                'sertifikat' => $request->sertifikat,
                'video_url' => $request->video_url,
                'pesan' => $request->pesan,
                'status' => 'Pending'
            ];
            if($request->file('my-image'))
            {  
                $image = $request->file('my-image');
                $obj['foto'] = time().'.'.$image->getClientOriginalExtension();
             
                $destinationPath = public_path('/assets/images/courses/thumbnail');
                $img = Image::make($image->getRealPath());
                $img->resize(300, 300, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.'/'.$obj['foto']);
           
                $destinationPath = public_path('/assets/images/courses');
                $image->move($destinationPath, $obj['foto']);
            }
            $id_kelas = DB::table('kelas')->insertGetId($obj);

            $judul_materi = $request->judul_materi;
            $link_materi = $request->link_materi;
            if($judul_materi){
                for ($i=0; $i < count($judul_materi); $i++) { 
                	$obj_materi = [
                		'id_kelas' => $id_kelas,
                		'judul_materi' => $judul_materi[$i],
                		'video' => $link_materi[$i],
                	];
                	DB::table('kelas_materi')->insertGetId($obj_materi);
                }
            }

            $nama_tools = $request->tools;
            $keterangan_tools = $request->keterangan;
            $download_tools = $request->download;
            if($nama_tools){
                for ($i=0; $i < count($nama_tools); $i++) { 
                	$obj_tools = [
                		'id_kelas' => $id_kelas,
                		'nama_tools' => $nama_tools[$i],
                		'keterangan' => $keterangan_tools[$i],
                		'download' => $download_tools[$i],
                	];
                	DB::table('kelas_tools')->insertGetId($obj_tools);
                }
            }

            $soal = $request->soal;
            $a = $request->a;
            $b = $request->b;
            $c = $request->c;
            $d = $request->d;
            $e = $request->e;
            $jawaban = $request->jawaban;
            if($soal){
                for ($i=0; $i < count($soal); $i++) { 
                    $obj_soal = [
                        'id_kelas' => $id_kelas,
                        'soal' => $soal[$i],
                        'a' => $a[$i],
                        'b' => $b[$i],
                        'c' => $c[$i],
                        'd' => $d[$i],
                        'e' => $e[$i],
                        'jawaban' => $jawaban[$i],
                    ];
                    DB::table('kelas_soal')->insertGetId($obj_soal);
                }
            }

            $faq_pertanyaan = $request->pertanyaan;
            $faq_jawaban = $request->faq_jawaban;
            if($faq_pertanyaan){
                for ($i=0; $i < count($faq_pertanyaan); $i++) { 
                    $obj_faq = [
                        'id_kelas' => $id_kelas,
                        'pertanyaan' => $faq_pertanyaan[$i],
                        'jawaban' => $faq_jawaban[$i],
                    ];
                    DB::table('kelas_faq')->insertGetId($obj_faq);
                }
            }

            return redirect()->route('mentor.kelas')->with('status_nya', 'Berhasil Menambah Kelas, Silahkan tunggu hasil review dari kami.');
        }
	}

    public function hapus($id){
        DB::table('kelas')->where('id', $id)->delete();
        DB::table('kelas_materi')->where('id_kelas', $id)->delete();
        DB::table('kelas_faq')->where('id_kelas', $id)->delete();
        DB::table('kelas_tools')->where('id_kelas', $id)->delete();
        DB::table('kelas_soal')->where('id_kelas', $id)->delete();

        return redirect()->route('mentor.kelas')->with('status_nya', 'Berhasil Menghapus Kelas');
    }
}