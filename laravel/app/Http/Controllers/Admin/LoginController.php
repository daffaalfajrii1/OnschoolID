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
use Redirect;

class LoginController extends Controller
{
	public function index(){

		return view('admin.login')->with('title','Halaman Masuk Admin'); 
	}
	public function proses(Request $request){
		$customMessages = [
          'required' => 'Wajib Diisi.'
	      ];
	    $validator = Validator::make($request->all(),[
	            //......
	            'email' => 'required',
	            'password' => 'required'
	    ], $customMessages);
	    if ($validator->fails()) {
	      return redirect()->route('admin.masuk')->withErrors($validator)->withInput();
	    } else {
	    	$selectdb= DB::table('admin')->where('email',@$request->email)->first();
            if($selectdb)
            {
            	if(Hash::check(@$request->password,$selectdb->password))
                {
                	Session::put('admin_status', true);
                    Session::put('id', $selectdb->id);
                    Session::put('email', $selectdb->email);
                    Session::put('nama', $selectdb->nama); 
                    return redirect()->route('admin.beranda')->with('berhasil', 'Berhasil Masuk');
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


	public function keluar(Request $request){
		$request->session()->flush(); 

        return redirect()->route('admin.masuk')->with('berhasil', 'Berhasil Keluar');
	}
}