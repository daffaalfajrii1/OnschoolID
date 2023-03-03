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
                        <li class="active">Blog</li>
                    </ul>
                    <h2 class="title">Blog <span>Kami</span></h2>
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
                        @foreach($blog as $item)
                        <div class="col-lg-4 col-md-6">

                            <!-- Single Blog Start -->
                            <div class="single-blog">
                                <div class="blog-image">
                                    <a href="{{route('blog.detail', $item->slug)}}"><img src="{{asset('adm/images/blog/'.$item->gambar)}}" style="height: 200px!important;" alt="Blog"></a>
                                </div>
                                <div class="blog-content">
                                    <div class="blog-author">
                                        <div class="author">
                                            <div class="author-thumb">
                                                <a href="#"><img src="{{asset('adm/images/icon-admin.jpg')}}" alt="Author"></a>
                                            </div>
                                            <div class="author-name">
                                                <a class="name" href="#">Administrator</a>
                                            </div>
                                        </div>
                                    </div>

                                    <h4 class="title"><a href="{{route('blog.detail', $item->slug)}}">{{$item->judul}}</a></h4>

                                    <div class="blog-meta">
                                        <span> <i class="icofont-calendar"></i> {{UserHelp::tanggal_indo($item->created_at, true)}}</span>
                                        <span> <i class="icofont-eye"></i> {{$item->view}}</span>
                                    </div>

                                    <a href="{{route('blog.detail', $item->slug)}}" class="btn btn-secondary btn-hover-primary">Baca Selengkapnya</a>
                                </div>
                            </div>
                            <!-- Single Blog End -->

                        </div>
                        @endforeach
                    </div>
                </div>
                {!!@$blog->appends(['cari'=>@$_GET['cari']])->links('pagination')!!}
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