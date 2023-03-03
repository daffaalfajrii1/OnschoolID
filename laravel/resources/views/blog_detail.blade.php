@extends('layout.app') @section('content')
<div class="section page-banner">
    <img class="shape-1 animation-round" src="{{asset('assets/images/shape/shape-8.png')}}" alt="Shape" />

    <img class="shape-2" src="{{asset('assets/images/shape/shape-23.png')}}" alt="Shape" />

    <div class="container">
        <!-- Page Banner Start -->
        <div class="page-banner-content">
            <ul class="breadcrumb">
                <li><a href="{{route('home')}}">Beranda</a></li>
                <li class="active">Blog</li>
            </ul>
            <h2 class="title">{{$blog->judul}}</h2>
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

<!-- Blog Details Start -->
<div class="section section-padding mt-n10">
    <div class="container">
        <div class="row flex-row-reverse gx-10">
            <div class="col-lg-12">
                <!-- Blog Details Wrapper Start -->
                <div class="blog-details-wrapper">
                    <div class="blog-details-admin-meta">
                        <div class="author">
                            <div class="author-thumb">
                                <a href="#"><img src="{{asset('adm/images/icon-admin.jpg')}}" alt="Author" /></a>
                            </div>
                            <div class="author-name">
                                <a class="name" href="#">Administrator</a>
                            </div>
                        </div>
                        <div class="blog-meta">
                            <span> <i class="icofont-calendar"></i> {{UserHelp::tanggal_indo($blog->created_at, true)}}</span>
                            <span> <i class="icofont-eye"></i>{{$blog->view}}</span>
                        </div>
                    </div>

                    <h2 class="title">{{$blog->judul}}</h2>

                    <div class="blog-details-description">
                    	<img src="{{asset('adm/images/blog/'.$blog->gambar)}}" alt="Blog Details">
                        {!!$blog->isi!!}
                    </div>
                </div>
                <!-- Blog Details Wrapper End -->
            </div>
        </div>
    </div>
</div>
@endsection
