@extends('layout.app') @section('content')
<!-- Page Banner Start -->
        <div class="section page-banner">

            <img class="shape-1 animation-round" src="{{asset('assets/images/shape/shape-8.png')}}" alt="Shape">

            <img class="shape-2" src="{{asset('assets/images/shape/shape-23.png')}}" alt="Shape">

            <div class="container">
                <!-- Page Banner Start -->
                <div class="page-banner-content">
                    <ul class="breadcrumb">
                        <li><a href="{{route('home')}}">Beranda</a></li>
                        <li class="active">Pembelian Kelas</li>
                    </ul>
                    <h2 class="title">Pembelian <span>Kelas</span></h2>
                </div>
                <!-- Page Banner End -->
            </div>

            <!-- Shape Icon Box Start -->
            <div class="shape-icon-box">

                <img class="icon-shape-1 animation-left" src="{{asset('assets/images/shape/shape-5.png')}}" alt="Shape">

                <div class="box-content">
                    <div class="box-wrapper">
                        <i class="flaticon-badge"></i>
                    </div>
                </div>

                <img class="icon-shape-2" src="{{asset('assets/images/shape/shape-6.png')}}" alt="Shape">

            </div>
            <!-- Shape Icon Box End -->

            <img class="shape-3" src="{{asset('assets/images/shape/shape-24.png')}}" alt="Shape">

            <img class="shape-author" src="{{asset('assets/images/author/author-11.jpg')}}" alt="Shape">

        </div>
        <!-- Page Banner End -->

        <!-- Register & Login Start -->
        <div class="section section-padding">
            <div class="container">

                <!-- Register & Login Wrapper Start -->
                <div class="register-login-wrapper">
                    <div class="row align-items-center">
                        <div class="col-lg-6">

                            <!-- Register & Login Images Start -->
                            <div class="register-login-images">
                                <div class="shape-1">
                                    <img src="{{asset('assets/images/shape/shape-26.png')}}" alt="Shape">
                                </div>


                                <div class="images">
                                    <img src="{{asset('assets/images/courses/'.$kelas->foto)}}" alt="Register Login">
                                </div>
                            </div>
                            <!-- Register & Login Images End -->

                        </div>
                        <div class="col-lg-6">

                            <!-- Register & Login Form Start -->
                            <div class="register-login-form">
                                <h3 class="title">Pembelian <span>Kelas</span></h3>
                                <div class="form-wrapper">
                                    @if(Session::get('gagal'))
                                        <div class="alert alert-danger" role="alert">{{Session::get('gagal')}}</div>
                                    @endif
                                    @if(Session::get('berhasil'))
                                        <div class="alert alert-success" role="alert">{{Session::get('berhasil')}}</div>
                                    @endif
                                    <form action="{{route('member.invoice.buat')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="id_kelas" value="{{$kelas->id}}">
				            			<input type="hidden" name="kode_unik" value="{{$kode_unik}}">
                                        <div class="single-form">
                                            <label>Biaya</label>
                                            <input type="text" name="nama" required placeholder="Masukkan Biaya" disabled value="{{UserHelp::rupiah($kelas->biaya)}}" />
                                        </div>
                                        @if($kelas->biaya > 0)
                                        <div class="single-form">
                                            <label>Kode Unik</label>
                                            <input type="text" name="nama" required placeholder="Masukkan Biaya" disabled value="{{UserHelp::rupiah($kode_unik)}}"/>
                                        </div>
                                        @endif
                                        <div class="single-form">
                                            <label>Total</label>
                                            <input type="text" name="nama" required placeholder="Masukkan Biaya" disabled value="@if($kelas->biaya > 0) {{UserHelp::rupiah($kelas->biaya+$kode_unik)}} @else {{UserHelp::rupiah($kelas->biaya)}} @endif" />
                                        </div>
                            
                                        <div class="single-form">
                                            <button type="submit" class="btn btn-primary btn-hover-dark w-100">Beli</button>
                                        </div>
                                        <!-- Single Form End -->
                                    </form>
                                    <p class="small mb-0 mt-2 text-center">Dengan Melakukan Pembelian Anda Sudah Menyetujui <a href="#"><strong>Syarat & Ketentuan</strong></a></p>
                                </div>
                            </div>
                            <!-- Register & Login Form End -->

                        </div>
                    </div>
                </div>
                <!-- Register & Login Wrapper End -->

            </div>
        </div>
        <!-- Register & Login End -->
        @endsection