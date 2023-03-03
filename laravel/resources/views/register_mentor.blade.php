@extends('layout.app') @section('content')
<style type="text/css">
	.selectnya {
		width: 100%;
	    height: 60px;
	    padding: 0 25px;
	    font-size: 15px;
	    color: #52565b;
	    -webkit-transition: all 0.3s ease 0s;
	    transition: all 0.3s ease 0s;
	    border: 1px solid rgba(48, 146, 85, 0.2);
	    border-radius: 10px;
	    background-color: #fff;
	    padding-top:  10px;
	}
</style>
<!-- Page Banner Start -->
<div class="section page-banner">
    <img class="shape-1 animation-round" src="{{asset('assets/images/shape/shape-8.png')}}" alt="Shape" />

    <img class="shape-2" src="{{asset('assets/images/shape/shape-23.png')}}" alt="Shape" />

    <div class="container">
        <!-- Page Banner Start -->
        <div class="page-banner-content">
            <ul class="breadcrumb">
                <li><a href="#">Beranda</a></li>
                <li class="active">Jadilah Mentor</li>
            </ul>
            <h2 class="title">Formulir Pendaftaran <span>Mentor</span></h2>
        </div>
        <!-- Page Banner End -->
    </div>

    <!-- Shape Icon Box Start -->
    <div class="shape-icon-box">
        <img class="icon-shape-1 animation-left" src="{{asset('assets/images/shape/shape-5.png')}}" alt="Shape" />

        <div class="box-content">
            <div class="box-wrapper">
                <i class="flaticon-badge"></i>
            </div>
        </div>

        <img class="icon-shape-2" src="{{asset('assets/images/shape/shape-6.png')}}" alt="Shape" />
    </div>
    <!-- Shape Icon Box End -->

    <img class="shape-3" src="{{asset('assets/images/shape/shape-24.png')}}" alt="Shape" />

    <img class="shape-author" src="{{asset('assets/images/author/author-11.jpg')}}" alt="Shape" />
</div>
<!-- Page Banner End -->

<!-- Register & Login Start -->
<div class="section section-padding">
    <div class="container">
        <!-- Register & Login Wrapper Start -->
        <div class="register-login-wrapper">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <!-- Register & Login Form Start -->
                    <!-- <div class="register-login-form"> -->
                        <h3 class="title">Daftar <span>Sekarang</span></h3>
                        @if(Session::get('gagal'))
					    <div class="alert alert-danger" role="alert">{{Session::get('gagal')}}</div>
						@endif
						@if(Session::get('berhasil'))
						    <div class="alert alert-success" role="alert">{{Session::get('berhasil')}}</div>
						@endif
                        <div class="form-wrapper">
                            <form action="{{route('mentor.daftar.proses')}}" method="post">
							@csrf
                                <!-- Single Form Start -->
                                <div class="single-form">
                                	<label>Nama</label>
                                    <input type="text" placeholder="Nama" name="nama" required value="{{old('nama')}}" />
                                    @if($errors->has('nama'))
                                    <span style="color: red;">
                                      <strong>{{$errors->first('nama')}}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="single-form">
                                    <label>Email</label>
                                    <input type="email" placeholder="Email" name="email" required value="{{old('email')}}" />
                                    @if($errors->has('email'))
                                    <span style="color: red;">
                                      <strong>{{$errors->first('email')}}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="single-form">
                                    <label>No Handphone</label>
                                    <input type="text" placeholder="No Handphone" name="no_hp" required value="{{old('no_hp')}}" onkeypress="return hanyaAngka(event)"/>
                                    <small>Pastikan wa aktif</small>
                                    @if($errors->has('no_hp'))
                                    <br>
                                    <span style="color: red;">
                                      <strong>{{$errors->first('no_hp')}}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="single-form">
                                    <label>Jenis Kelamin</label><br>
                                    <select name="jenis_kelamin" id="jenis_kelamin" required="" class="selectnya">
                                    	<option value="">-- Pilih Jenis Kelamin -- </option>
										<option value="Laki - Laki">Laki - Laki</option>
										<option value="Perempuan">Perempuan</option>
                                    </select>
                                </div>
                                <div class="single-form">
                                	<br>
                                	<br>
                                    <label>Alamat</label>
                                    <textarea type="text" placeholder="Alamat" name="alamat" required>{{old('alamat')}}</textarea>
                                    @if($errors->has('alamat'))
                                    <span style="color: red;">
                                      <strong>{{$errors->first('alamat')}}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="single-form">
                                    <label>Riwayat Pendidikan</label>
                                    <textarea type="text" placeholder="Riwayat Pendidikan" name="pendidikan" required>{{old('pendidikan')}}</textarea>
                                    @if($errors->has('pendidikan'))
                                    <span style="color: red;">
                                      <strong>{{$errors->first('pendidikan')}}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="single-form">
                                    <label>Deskripsi Diri</label>
                                    <textarea type="text" placeholder="Deskripsi Diri" name="deskripsi" required>{{old('deskripsi')}}</textarea>
                                    @if($errors->has('deskripsi'))
                                    <span style="color: red;">
                                      <strong>{{$errors->first('deskripsi')}}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="single-form">
                                    <button type="submit" class="btn btn-primary btn-hover-dark w-100">Daftar</button>
                                </div>
                                <!-- Single Form End -->
                            </form>
                        </div>
                    <!-- </div> -->
                    <!-- Register & Login Form End -->
                </div>
            </div>
        </div>
        <!-- Register & Login Wrapper End -->
    </div>
</div>
<!-- Register & Login End -->
@endsection
