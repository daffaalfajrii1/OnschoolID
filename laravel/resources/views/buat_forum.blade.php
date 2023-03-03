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
                        <li><a href="{{route('forum')}}">Forum Diskusi</a></li>
                        <li class="active">Buat</li>
                    </ul>
                    <h2 class="title">Buat <span>Forum Diskusi</span></h2>
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
                        <div class="col-lg-12">

                            <!-- Register & Login Form Start -->
                            <!-- <div class="register-login-form"> -->
                                <h3 class="title">Buat <span>Forum Diskusi</span></h3>
                                <div class="form-wrapper">
                                    <form action="{{route('forum.simpan')}}" method="post">
                                        @csrf
                                        <div class="single-form">
                                            <label>Judul</label>
                                            <input type="text" name="judul" required placeholder="Masukkan Judul Diskusi" value="{{old('judul')}}">
                                            @if($errors->has('judul'))
                                            <br>
                                            <span style="color: red;">
                                              <strong>{{$errors->first('judul')}}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="single-form">
                                            <label>Isi</label>
                                            <textarea name="isi" required></textarea>
                                            @if($errors->has('isi'))
                                            <span style="color: red;">
                                              <strong>{{$errors->first('isi')}}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        </div>
                                        <div class="single-form">
                                            <button type="submit" class="btn btn-primary btn-hover-dark w-100">Mulai Diskusi</button>
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
        <script src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('assets/ckeditor/plugin.js') }}"></script>
<script type="text/javascript">
    CKEDITOR.replace( 'isi' );
</script>
        @endsection