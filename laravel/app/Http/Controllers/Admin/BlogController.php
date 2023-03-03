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
use File;

class BlogController extends Controller
{
	public function index(Request $request)
    { 
        $blog = DB::table('blog');
        if($request->cari){
            $blog->where('blog','like','%'.$request->get('cari').'%');  
            $blog->orWhere('id','like','%'.$request->get('cari').'%');
        }
        if($request->sort){
            $blog->orderBy($request->sort, 'ASC');
        }
        else {
            $blog->orderBy('id', 'DESC');
        }
        $dt_base= $blog->paginate(10);
        $data['blog'] = $dt_base;
    	return view('admin.blog.list', $data)->with('title','List Blog'); 
    }

    public function tambah()
    { 
        return view('admin.blog.tambah')->with('title','Tambah Blog'); 
    }

    public function simpan(Request $request){

        $message = [
            'gambar.nimes' => 'Extensi tidak diperkenankan',
            'gambar.max' => 'Maksimal size 2MB',
            'gambar.image' => 'Pastikan berupa file gambar'
        ];

        $valid['judul'] = 'required';
        $valid['isi'] = 'required';
        $valid['gambar'] = 'mimes:jpeg,png,jpg|max:2048';
        $validator = Validator::make($request->all(), $valid, $message);

        if ($validator->fails()) {
            return redirect()->route('admin.blog.tambah')->withErrors($validator)->withInput();
        } else {
            $obj = [
                'judul' => $request->judul,
                'isi' => $request->isi,
                'slug' => UserHelp::slugify($request->judul)
            ];
            if($request->file('gambar'))
            {  
                $image = $request->file('gambar');
                $obj['gambar'] = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/adm/images/blog');
                $image->move($destinationPath, $obj['gambar']);
            }
            DB::table('blog')->insert($obj);

            return redirect()->route('admin.blog')->with('status', 'Berhasil Menambah Data Blog Baru');
        }
    }

    public function edit($id){
        $data['blog'] = DB::table('blog')->where('id', $id)->first();

        return view('admin.blog.edit', $data)->with('title','Edit Blog'); 
    }

    public function update(Request $request){
        $message = [
            'gambar.nimes' => 'Extensi tidak diperkenankan',
            'gambar.max' => 'Maksimal size 2MB',
            'gambar.image' => 'Pastikan berupa file gambar'
        ];

        $valid['judul'] = 'required';
        $valid['isi'] = 'required';
        $valid['gambar'] = 'mimes:jpeg,png,jpg|max:2048';
        $validator = Validator::make($request->all(), $valid, $message);

        if ($validator->fails()) {
            return redirect()->route('admin.blog.edit', $request->id)->withErrors($validator)->withInput();
        } else {
            $obj = [
                'judul' => $request->judul,
                'isi' => $request->isi,
                'slug' => UserHelp::slugify($request->judul)
            ];
            if($request->file('gambar'))
            {  
                $image = $request->file('gambar');
                $obj['gambar'] = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/adm/images/blog');
                $image->move($destinationPath, $obj['gambar']);
                $blog = DB::table('blog')->where('id', $request->id)->first();
                if($blog->gambar != null){
                    $image_path = app_path("adm/images/blog/".$blog->gambar);
                    if (File::exists($image_path)) {
                        unlink($image_path);
                    }
                }
            }
            DB::table('blog')->where('id', $request->id)->update($obj);

            return redirect()->route('admin.blog')->with('status', 'Berhasil Mengubah Data Blog');
        }
    }

    public function hapus($id){
        DB::table('blog')->where('id', $id)->delete();

        return redirect()->route('admin.blog')->with('status', 'Berhasil Menghapus Data Blog');
    }
}