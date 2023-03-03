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
                        <li class="active">Forum Diskusi</li>
                    </ul>
                    <h2 class="title">Forum <span>Diskusi</span></h2>
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

                <!-- Blog Wrapper Start -->
                <div class="blog-wrapper">
                	<div class="row">
                		<div class="offset-md-9 col-md-3">
                			<a href="{{route('forum.buat')}}" class="btn btn-primary btn-hover-dark" style="width: 100%;">Buat Diskusi</a>
                		</div>
                		@if(session('status'))
                		<div class="col-md-12">
                			<br>
		                	<div class="alert alert-success" role="alert">
		                    	{{session('status')}}
		                	</div>
		                </div>
		            @endif
                	</div>
                    <div class="row">
                    	@if(count($forum) > 0)
                        @foreach($forum as $item)
                        <?php
                        $komentar = DB::table('forum_komentar')->where('id_forum', $item->id)->count();
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
                        <div class="col-lg-12 col-md-12">

                            <!-- Single Blog Start -->
                            <div class="single-blog">
                                <div class="blog-content">
                                    <div class="blog-author">
                                        <div class="author">
                                            <div class="author-thumb">
                                                <a href="#"><img src="{{$foto}}" alt="Author"></a>
                                            </div>
                                            <div class="author-name">
                                                <a class="name" href="#">{{$nama}}</a>
                                            </div>
                                        </div>
                                        @if($status_hapus)
                                        <div class="btn btn-danger">
                                            <a href="{{route('forum.hapus', $item->id)}}">Hapus</a>
                                        </div>
                                        @endif
                                    </div>

                                    <h4 class="title"><a href="{{route('forum.view', $item->slug)}}">{{$item->judul}}</a></h4>

                                    <div class="blog-meta">
                                        <span> <i class="icofont-calendar"></i> {{UserHelp::tanggal_indo($item->updated_at, true)}}</span>
                                        <span> <i class="icofont-chat"></i> {{$komentar}}</span>
                                    </div>

                                    <a href="{{route('forum.view', $item->slug)}}" class="btn btn-secondary btn-hover-primary">Ikut Diskusi</a>
                                </div>
                            </div>
                            <!-- Single Blog End -->

                        </div>
                        @endforeach
                        @else
                        <div class="col-lg-12 col-md-12">

                            <!-- Single Blog Start -->
                            <div class="single-blog">
                                <div class="blog-content">
                                	<center>Belum ada diskusi yang dibuat</center>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                {!!@$forum->appends(['cari'=>@$_GET['cari']])->links('pagination')!!}
                <!-- <div class="page-pagination">
                    <ul class="pagination justify-content-center">
                        <li><a href="#"><i class="icofont-rounded-left"></i></a></li>
                        <li><a class="active" href="#">1</a></li>
                        <li><a href="#">2</a></li>
                        <li><a href="#">3</a></li>
                        <li><a href="#"><i class="icofont-rounded-right"></i></a></li>
                    </ul>
                </div> -->
                

            </div>
        </div>
        <!-- Blog End -->
        @endsection