@extends('layout.app') @section('content')
<?php
                        $komentar = DB::table('forum_komentar')->where('id_forum', $forum->id)->count();
                        $status_hapus = false;

                        if($forum->tipe_user == 'admin'){
                            $foto = asset('adm/images/icon-admin.jpg');
                            $nama = 'Administrator';
                            $status_hapus = true;
                        }
                        else if($forum->tipe_user == 'member'){
                            $member = DB::table('member')->where('id', $forum->id_user)->first();
                            $foto = $member->foto != null ? asset('assets/images/students/'.$member->foto) : asset('assets/images/students/user.png');
                            $nama = $member->nama;
                            if(Session::get('member_status')){
                                if($forum->id_user == Session::get('id')){
                                    $status_hapus = true;
                                }
                            }
                        }
                        else {
                            $mentor = DB::table('mentor')->where('id', $forum->id_user)->first();
                            if($mentor->foto){
                                $foto = asset('assets/images/instructor/'.$mentor->foto);
                            }
                            else {
                                if($mentor->jenis_kelamin == 'Laki - Laki'){
                                    $foto = asset('adm/images/instructor/man.png');
                                }
                                else {
                                    $foto = asset('adm/images/instructor/woman.png');
                                }
                            }
                            $nama = $mentor->nama;
                            if(Session::get('mentor_status')){
                                if($forum->id_user == Session::get('id')){
                                    $status_hapus = true;
                                }
                            }
                        }
                        ?>
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
                        <li class="active">{{$forum->judul}}</li>
                    </ul>
                    <h2 class="title">{{$forum->judul}}</h2>
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

        <!-- Blog Start -->
        <div class="section section-padding mt-n10">
            <div class="container">
                <div class="row gx-10">
                    <div class="col-lg-12">
                        <div class="blog-details-wrapper">
                            <div class="blog-details-admin-meta">
                                <div class="author">
                                    <div class="author-thumb">
                                        <a href="#"><img src="{{$foto}}" alt="Author"></a>
                                    </div>
                                    <div class="author-name">
                                        <a class="name" href="#">{{$nama}}</a>
                                    </div>
                                </div>
                                <div class="blog-meta">
                                    <span> <i class="icofont-calendar"></i> {{UserHelp::tanggal_indo($forum->created_at, true)}}</span>
                                    <span> <i class="icofont-chat"></i> {{$komentar}} </span>
                                    <!-- <span class="tag"><a href="#">Science</a></span> -->
                                    @if($status_hapus)
                                        <div class="btn btn-danger">
                                            <a href="{{route('forum.hapus', $forum->id)}}">Hapus</a>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <h2 class="title">{{$forum->judul}}</h2>

                            <div class="blog-details-description">
                                {!!$forum->isi!!}
                            </div>

                        </div>
                        <div class="blog-details-comment">
                            <div class="comment-wrapper">
                                <h3 class="title">Komentar ({{$komentar}})</h3>

                                <ul class="comment-items">
                                    @foreach($list_komentar as $item)
                                    <?php 
                                    $status_hapus = false;

                                    if($item->tipe_user == 'admin'){
                                        $foto = asset('adm/images/icon-admin.jpg');
                                        $nama = 'Administrator';
                                        $status_hapus = true;
                                    }
                                    else if($item->tipe_user == 'member'){
                                        $member = DB::table('member')->where('id', $item->id_user)->first();
                                        $foto = $member->foto != null ? asset('assets/images/students/'.$member->foto) : asset('assets/images/students/user.png');
                                        $nama = $member->nama;
                                        if(Session::get('member_status')){
                                            if($item->id_user == Session::get('id')){
                                                $status_hapus = true;
                                            }
                                        }
                                    }
                                    else {
                                        $mentor = DB::table('mentor')->where('id', $item->id_user)->first();
                                        if($mentor->foto){
                                            $foto = asset('assets/images/instructor/'.$mentor->foto);
                                        }
                                        else {
                                            if($mentor->jenis_kelamin == 'Laki - Laki'){
                                                $foto = asset('adm/images/instructor/man.png');
                                            }
                                            else {
                                                $foto = asset('adm/images/instructor/woman.png');
                                            }
                                        }
                                        $nama = $mentor->nama;
                                        if(Session::get('mentor_status')){
                                            if($item->id_user == Session::get('id')){
                                                $status_hapus = true;
                                            }
                                        }
                                    }
                                    ?>
                                    <li>
                                        <!-- Single Comment Start -->
                                        <div class="single-comment">
                                            <div class="comment-author">
                                                <div class="author-thumb">
                                                    <img src="{{$foto}}" alt="Author">
                                                </div>
                                                <div class="author-content">
                                                    <h4 class="name">{{$nama}}</h4>
                                                    <div class="meta">
                                                        <span class="designation">{{ucwords($item->tipe_user)}}</span>
                                                        <span class="time">{{UserHelp::waktu_history($item->created_at)}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            {!!$item->komentar!!}
                                            @if($status_hapus)
                                            <a href="{{route('forum.komentar.hapus', $item->id)}}" class="reply" style="background-color: #dc3545; color: white;"> <i class="icofont-trash"></i> Hapus</a>
                                            @endif
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="comment-form">
                                <h3 class="title">Tinggalkan Komentar</h3>

                                <!-- Form Wrapper Start -->
                                <div class="form-wrapper">
                                    @if(session('status_komentar'))
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="alert alert-success" role="alert">
                                                {{session('status_komentar')}}
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <form action="{{route('forum.komentar', $forum->id)}}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-12">
                                                <!-- Form Wrapper Start -->
                                                <div class="single-form">
                                                    <textarea id="komentar" name="komentar" required></textarea>
                                                </div>
                                                <!-- Form Wrapper End -->
                                            </div>
                                            <div class="col-md-12">
                                                <!-- Form Wrapper Start -->
                                                <div class="single-form text-center">
                                                    <button type="submit" class="btn btn-primary btn-hover-dark">Submit</button>
                                                </div>
                                                <!-- Form Wrapper End -->
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- Form Wrapper End -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<script src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('assets/ckeditor/plugin.js') }}"></script>
<script type="text/javascript">
    CKEDITOR.replace( 'komentar' );
</script>
@endsection