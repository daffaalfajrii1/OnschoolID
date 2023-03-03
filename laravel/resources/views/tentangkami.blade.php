@extends('layout.app') @section('content')
<!-- Page Banner Start -->
<div class="section page-banner">
    <img class="shape-1 animation-round" src="assets/images/shape/shape-8.png" alt="Shape" />

    <img class="shape-2" src="assets/images/shape/shape-23.png" alt="Shape" />

    <div class="container">
        <!-- Page Banner Start -->
        <div class="page-banner-content">
            <ul class="breadcrumb">
                <li><a href="#">Beranda</a></li>
                <li class="active">Tentang Kami</li>
            </ul>
            <h2 class="title">Tentang <span>Kami.</span></h2>
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

<!-- About Start -->
<div class="section">
    <div class="section-padding-02 mt-n10">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <!-- About Images Start -->
                    <div class="about-images">
                        <div class="images">
                            <img src="{{asset('assets/images/aboutt.jpg')}}" alt="About" />
                        </div>

                        <div class="about-years">
                            <div class="years-icon">
                                <img src="{{asset('assets/images/logo-icon.png')}}" alt="About" />
                            </div>
                            <p><strong></strong> Expert Mentor</p>
                        </div>
                    </div>
                    <!-- About Images End -->
                </div>
                <div class="col-lg-6">
                    <!-- About Content Start -->
                    <div class="about-content">
                        <h5 class="sub-title">Selamat datang di {{$pengaturan->nama_web}}.</h5>
                        <h2 class="main-title">Anda dapat bergabung dengan {{$pengaturan->nama_web}} dan meningkatkan keterampilan Anda untuk <span>masa depan yang cerah.</span></h2>
                        <a href="{{route('allkelas')}}" class="btn btn-primary btn-hover-dark">Mulai Kelas</a>
                    </div>
                    <!-- About Content End -->
                </div>
            </div>
        </div>
    </div>

    <div class="section-padding-02 mt-n6">
        <div class="container">
            <!-- About Items Wrapper Start -->
            <div class="about-items-wrapper">
                <div class="row">
                    <div class="col-lg-4">
                        <!-- About Item Start -->
                        <div class="about-item">
                            <div class="item-icon-title">
                                <div class="item-icon">
                                    <i class="flaticon-tutor"></i>
                                </div>
                                <div class="item-title">
                                    <h3 class="title">Mentor Berpengalaman</h3>
                                </div>
                            </div>
                            <p>Menghadirkan mentor mentor yang berpengalaman dan tentunya pakar di bidangnya</p>
                            <p>Kesmpatan untuk bertemu mentor Impian Anda!</p>
                        </div>
                        <!-- About Item End -->
                    </div>
                    <div class="col-lg-4">
                        <!-- About Item Start -->
                        <div class="about-item">
                            <div class="item-icon-title">
                                <div class="item-icon">
                                    <i class="flaticon-coding"></i>
                                </div>
                                <div class="item-title">
                                    <h3 class="title">Belajar Secara Online</h3>
                                </div>
                            </div>
                            <p>Dengan student centered learning mempermudah belajar dimana saja dan kaoan saja.</p>
                            <p>Onschool menghadirkan media pembelajaran online yang nyaman.</p>
                        </div>
                        <!-- About Item End -->
                    </div>
                    <div class="col-lg-4">
                        <!-- About Item Start -->
                        <div class="about-item">
                            <div class="item-icon-title">
                                <div class="item-icon">
                                    <i class="flaticon-increase"></i>
                                </div>
                                <div class="item-title">
                                    <h3 class="title">Mudah dan Cepat</h3>
                                </div>
                            </div>
                            <p>Kemudahan dalam kelas onschool</p>
                            <p>.</p>
                        </div>
                        <!-- About Item End -->
                    </div>
                </div>
            </div>
            <!-- About Items Wrapper End -->
        </div>
    </div>
</div>
<!-- About End -->

<!-- Call to Action Start -->
<div class="section section-padding-02">
    <div class="container">
        <!-- Call to Action Wrapper Start -->
        <div class="call-to-action-wrapper">
            <img class="cat-shape-01 animation-round" src="assets/images/shape/shape-12.png" alt="Shape" />
            <img class="cat-shape-02" src="assets/images/shape/shape-13.svg" alt="Shape" />
            <img class="cat-shape-03 animation-round" src="assets/images/shape/shape-12.png" alt="Shape" />

            <div class="row align-items-center">
                <div class="col-md-6">
                    <!-- Section Title Start -->
                    <div class="section-title shape-02">
                        <h5 class="sub-title">Jadilah Mentor</h5>
                        <h2 class="main-title">Anda ingin bergabung dengan {{$pengaturan->nama_web}} <span>sebagai mentor?</span></h2>
                    </div>
                    <!-- Section Title End -->
                </div>
                <div class="col-md-6">
                    <div class="call-to-action-btn">
                        <a class="btn btn-primary btn-hover-dark" href="{{route('mentor.daftar')}}">Daftar Sekarang!</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Call to Action Wrapper End -->
    </div>
</div>
<!-- Call to Action End -->

<!-- Team Member's Start -->
<div class="section section-padding mt-n1">
    <div class="container">
        <!-- Section Title Start -->
        <div class="section-title shape-03 text-center">
            <h5 class="sub-title">Tim Kami</h5>
            <h2 class="main-title">Yang terus mendukung <span>Anda!</span></h2>
        </div>
        <!-- Section Title End -->

        <!-- Team Wrapper Start -->
        <div class="team-wrapper">
            <div class="row row-cols-lg-5 row-cols-sm-3 row-cols-2">
                @foreach($tim as $item)
                <div class="col">
                    <!-- Single Team Start -->
                    <div class="single-team">
                        <div class="team-thumb">
                            <img src="{{asset('adm/images/tim/'.$item->gambar)}}" alt="{{$item->nama}}" height="150" />
                        </div>
                        <div class="team-content">
                            <h4 class="name">{{$item->nama}}</h4>
                            <span class="designation">{{$item->jabatan}}</span>
                        </div>
                    </div>
                    <!-- Single Team End -->
                </div>
                @endforeach
            </div>
        </div>
        <!-- Team Wrapper End -->
    </div>
</div>
<!-- Team Member's End -->
@endsection
