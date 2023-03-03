@extends('layout.app') @section('content')
<div class="section page-banner">
    <img class="shape-1 animation-round" src="{{asset('assets/images/shape/shape-8.png')}}" alt="Shape" />

    <img class="shape-2" src="{{asset('assets/images/shape/shape-23.png')}}" alt="Shape" />

    <div class="container">
        <!-- Page Banner Start -->
        <div class="page-banner-content">
            <ul class="breadcrumb">
                <li><a href="{{route('home')}}">Beranda</a></li>
                <li><a href="{{route('allkelas')}}">Kelas</a></li>
                <li class="active">{{$kelas->kelas}}</li>
            </ul>
            <h2 class="title"><span>{{$kelas->kelas}}</span></h2>
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
<div class="section section-padding mt-n10">
    <div class="container">
        <div class="row gx-10">
            <div class="col-lg-8">
                <!-- Courses Details Start -->
                <div class="courses-details">
                    <div class="courses-details-images">
                        <img src="{{asset('assets/images/courses/'.$kelas->foto)}}" alt="{{$kelas->kelas}}" />
                        <span class="tags">{{$kelas->kategori}}</span>

                        <div class="courses-play">
                            <img src="{{asset('assets/images/courses/circle-shape.png')}}" alt="Play" />
                            <a class="play video-popup" href="{{$kelas->video_url}}"><i class="flaticon-play"></i></a>
                        </div>
                    </div>

                    <h2 class="title">{{$kelas->kelas}}</h2>

                    <div class="courses-details-admin">
                        <div class="admin-author">
                            <div class="author-thumb">
                                @if($mentor->foto)
                                            <img src="{{asset('assets/images/instructor/'.@$mentor->foto)}}" >
                                            @else
                                            @if(@$mentor->jenis_kelamin == 'Laki - Laki')
                                            <img src="{{asset('adm/images/instructor/man.png')}}" >
                                            @else
                                            <img src="{{asset('adm/images/instructor/woman.png')}}" >
                                            @endif
                                            @endif
                            </div>
                            <div class="author-content">
                                <a class="name" href="#">{{$mentor->nama}}</a>
                                <span class="Enroll">{{$total_siswa}} Siswa</span>
                            </div>
                        </div>
                    </div>

                    <!-- Courses Details Tab Start -->
                    <div class="courses-details-tab">
                        <!-- Details Tab Menu Start -->
                        <div class="details-tab-menu">
                            <ul class="nav justify-content-center">
                                <li><button class="active" data-bs-toggle="tab" data-bs-target="#description">Deskripsi</button></li>
                                <li><button data-bs-toggle="tab" data-bs-target="#instructors">Mentor</button></li>
                                <li><button data-bs-toggle="tab" data-bs-target="#tools">Tools</button></li>
                                <li><button data-bs-toggle="tab" data-bs-target="#faq">FAQ</button></li>
                            </ul>
                        </div>
                        <!-- Details Tab Menu End -->

                        <!-- Details Tab Content Start -->
                        <div class="details-tab-content">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="description">
                                    <!-- Tab Description Start -->
                                    <div class="tab-description">
                                        <div class="description-wrapper">
                                            <h3 class="tab-title">Deskripsi Singkat:</h3>
                                            <p>
                                                {{$kelas->deskripsi_singkat}}
                                            </p>
                                        </div>
                                        <div class="description-wrapper">
                                            <h3 class="tab-title">Deskripsi Lengkap:</h3>
                                            {!!$kelas->deskripsi!!}
                                        </div>
                                    </div>
                                    <!-- Tab Description End -->
                                </div>
                                <div class="tab-pane fade" id="instructors">
                                    <!-- Tab Instructors Start -->
                                    <div class="tab-instructors">
                                        <h3 class="tab-title">Mentor:</h3>

                                        <div class="row">
                                            <div class="col-md-12 col-12">
                                                <!-- Single Team Start -->
                                                <div class="single-team">
                                                    <div class="team-thumb">
                                                        @if($mentor->foto)
                                            <img src="{{asset('adm/images/instructor/'.@$mentor->foto)}}" width="200">
                                            @else
                                            @if(@$mentor->jenis_kelamin == 'Laki - Laki')
                                            <img src="{{asset('adm/images/instructor/man.png')}}" width="200">
                                            @else
                                            <img src="{{asset('adm/images/instructor/woman.png')}}" width="200">
                                            @endif
                                            @endif
                                                    </div>
                                                    <div class="team-content">
                                                        <h4 class="name">{{$mentor->nama}}</h4>
                                                        <span class="designation">{{$mentor->email}}</span>
                                                    </div>
                                                </div>
                                                <!-- Single Team End -->
                                            </div>
                                        </div>

                                        <div class="row gx-10">
                                            <div class="col-lg-12">
                                                <div class="tab-rating-content">
                                                    <h3 class="tab-title">Bio:</h3>
                                                    <p>
                                                        {{$mentor->deskripsi}}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Tab Instructors End -->
                                </div>
                                <div class="tab-pane fade" id="tools">
                                    <!-- Tab Reviews Start -->
                                    <div class="tab-reviews">
                                        <h3 class="tab-title">Tool yang digunakan:</h3>
                                        <div class="engagement-courses table-responsive">
                                            <div class="courses-top">
                                                <ul>
                                                    <li>Nama Tools</li>
                                                    <li>Link Download</li>
                                                </ul>
                                            </div>
                                            <div class="courses-list">
                                            <ul>
                                                @if($total_tools > 0)
                                                @foreach($kelas_tools as $item)
                                                <li>
                                                    <div class="student">
                                                        <span>{{$item->nama_tools}}</span>
                                                    </div>
                                                    <div class="button">
                                                        <a class="btn" target="_blank" href="{{$item->download}}">Download Disini</a>
                                                    </div>
                                                </li>
                                                @endforeach
                                                @else
                                                <li>Tidak ada tools</li>
                                                @endif
                                            </ul>
                                        </div>
                                        </div>
                                        <!-- Reviews Form Modal End -->
                                    </div>
                                    <!-- Tab Reviews End -->
                                </div>
                                <div class="tab-pane fade" id="faq">
                                    <!-- Tab Reviews Start -->
                                    <div class="tab-reviews">
                                        <h3 class="tab-title">Frequently Asked Questions:</h3>
                                        <div class="engagement-courses table-responsive">
                                            <div class="courses-top">
                                                <ul>
                                                    <li>Pertanyaan</li>
                                                    <li>Jawaban</li>
                                                </ul>
                                            </div>
                                            <div class="courses-list">
                                            <ul>
                                                @foreach($kelas_faq as $item)
                                                <li>
                                                    <div class="student">
                                                        <span>{{$item->pertanyaan}}</span>
                                                    </div>
                                                    <div class="student">
                                                        <span>{{$item->jawaban}}</span>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        </div>
                                        <!-- Reviews Form Modal End -->
                                    </div>
                                    <!-- Tab Reviews End -->
                                </div>
                            </div>
                        </div>
                        <!-- Details Tab Content End -->
                    </div>
                    <!-- Courses Details Tab End -->
                </div>
                <!-- Courses Details End -->
            </div>
            <div class="col-lg-4">
                <!-- Courses Details Sidebar Start -->
                <div class="sidebar">
                    <!-- Sidebar Widget Information Start -->
                    <div class="sidebar-widget widget-information">
                        <div class="info-price">
                            <span class="price">{{UserHelp::rupiah($kelas->biaya)}}</span>
                        </div>
                        <div class="info-list">
                            <ul>
                                <li><i class="icofont-man-in-glasses"></i> <strong>Mentor</strong> <span>{{$mentor->nama}}</span></li>
                                <li><i class="icofont-ui-video-play"></i> <strong>Materi</strong> <span>{{$total_materi}}</span></li>
                                <li><i class="icofont-bars"></i> <strong>Tools</strong> <span>{{$total_tools}}</span></li>
                                <li><i class="icofont-certificate-alt-1"></i> <strong>Sertifikat</strong> <span>{{$kelas->sertifikat}}</span></li>
                            </ul>
                        </div>
                        <?php 
                            $cek_kelas = DB::table('billing')->where('id_kelas', $kelas->id)->where('id_member', Session::get('id'))->first();
                        ?>
                        @if($cek_kelas)
                        <div class="info-btn">
                            <a href="{{route('member.billing')}}" class="btn btn-primary btn-hover-dark">Menunggu Pembayaran (Masuk Ke Billing)</a>
                        </div>
                        @else
                        <div class="info-btn">
                            <a href="{{route('member.belikelas', $kelas->id)}}" class="btn btn-primary btn-hover-dark">Beli Kelas</a>
                        </div>
                        @endif
                    </div>
                    <!-- Sidebar Widget Information End -->

                    <!-- Sidebar Widget Share Start -->
                    <div class="sidebar-widget">
                        <h4 class="widget-title">Share Course:</h4>

                        <ul class="social">
                            <li>
                                <a href="#"><i class="flaticon-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="flaticon-linkedin"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="flaticon-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="flaticon-skype"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="flaticon-instagram"></i></a>
                            </li>
                        </ul>
                    </div>
                    <!-- Sidebar Widget Share End -->
                </div>
                <!-- Courses Details Sidebar End -->
            </div>
        </div>
    </div>
</div>
@endsection
