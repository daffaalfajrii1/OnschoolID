@extends('layout.app') @section('content')
<!-- Slider Start -->
<div class="section slider-section">
    <!-- Slider Shape Start -->
    <div class="slider-shape">
        <img class="shape-1 animation-round" src="assets/images/shape/shape-8.png" alt="Shape" />
    </div>
    <!-- Slider Shape End -->

    <div class="container">
        <!-- Slider Content Start -->
        <div class="slider-content">
            <h4 class="sub-title">{{@$pengaturan->title_kecil_home}}</h4>
            <h2 class="main-title">{{@$pengaturan->title_besar_home}}</h2>
            <p>{{@$pengaturan->penjelasan_home}}</p>
            
            <a class="btn btn-primary btn-hover-dark" href="{{route('allkelas')}}">Mulai Kelas</a>
        </div>
        <!-- Slider Content End -->
    </div>

    <!-- Slider Courses Box Start -->
    <div class="slider-courses-box">
        <img class="shape-1 animation-left" src="assets/images/shape/shape-5.png" alt="Shape" />

        <div class="box-content">
            <div class="box-wrapper">
                <i class="flaticon-open-book"></i>
                <span class="count">{{$jumlah_kelas}}</span>
                <p>kelas</p>
            </div>
        </div>

        <img class="shape-2" src="assets/images/shape/shape-6.png" alt="Shape" />
    </div>
    <!-- Slider Courses Box End -->

    <!-- Slider Rating Box Start -->
    <div class="slider-rating-box">
        <div class="box-rating">
            <div class="box-wrapper">
                <span class="count">{{$jumlah_mentor}}</span>
                <p>Mentor</p>
            </div>
        </div>

        <img class="shape animation-up" src="assets/images/shape/shape-7.png" alt="Shape" />
    </div>
    <!-- Slider Rating Box End -->

    <!-- Slider Images Start -->
    <div class="slider-images">
        <div class="images">
            <img src="assets/images/slider/slider-1.png" alt="Slider" />
        </div>
    </div>
    <!-- Slider Images End -->

    <!-- Slider Video Start -->
    <div class="slider-video">
        <img class="shape-1" src="assets/images/shape/shape-9.png" alt="Shape" />

        <div class="video-play">
            <img src="assets/images/shape/shape-10.png" alt="Shape" />
            <a href="https://www.youtube.com/watch?v=sq2shbdktyc" class="play video-popup"><i class="flaticon-play"></i></a>
        </div>
    </div>
    <!-- Slider Video End -->
</div>
<!-- Slider End -->

<!-- All Courses Start -->
<div class="section section-padding-02">
    <div class="container">
        <!-- All Courses Top Start -->
        <div class="courses-top">
            <!-- Section Title Start -->
            <div class="section-title shape-01">
                <h2 class="main-title">Semua <span>kelas</span> di {{@$pengaturan->nama_web}}</h2>
            </div>
            <!-- Section Title End -->

            <!-- Courses Search Start -->
            <div class="courses-search">
                <form action="#">
                    <input type="text" placeholder="Cari kelas mu" />
                    <button><i class="flaticon-magnifying-glass"></i></button>
                </form>
            </div>
            <!-- Courses Search End -->
        </div>
        <!-- All Courses Top End -->

        <!-- All Courses Tabs Menu Start -->
        <div class="courses-tabs-menu courses-active">
            <div class="swiper-container">
                <ul class="swiper-wrapper nav">
                    @php $no = 1 @endphp @foreach($kategori as $item) @if($no == '1')
                    <li class="swiper-slide"><button class="active" data-bs-toggle="tab" data-bs-target="#tabs{{$no}}">{{$item->kategori}}</button></li>
                    @else
                    <li class="swiper-slide"><button data-bs-toggle="tab" data-bs-target="#tabs{{$no}}">{{$item->kategori}}</button></li>
                    @endif @php $no++ @endphp @endforeach
                </ul>
            </div>

            <!-- Add Pagination -->
            <div class="swiper-button-next"><i class="icofont-rounded-right"></i></div>
            <div class="swiper-button-prev"><i class="icofont-rounded-left"></i></div>
        </div>
        <!-- All Courses Tabs Menu End -->

        <!-- All Courses tab content Start -->
        <div class="tab-content courses-tab-content">
            @php $no = 1 @endphp @foreach($kategori as $item) @if($no == '1')
            <div class="tab-pane fade show active" id="tabs{{$no}}">
                <?php 
                $kelas = DB::table('kelas')->select('kelas.*', 'kategori.kategori', 'mentor.nama', 'mentor.foto as foto_mentor', 'mentor.jenis_kelamin'); $kelas->join('kategori', 'kategori.id', 'kelas.id_kategori'); $kelas->join('mentor',
                'mentor.id', 'kelas.id_mentor'); $kelas->where('kelas.id_kategori', $item->id); $kelas->where('kelas.status', 'Aktif'); $dt_base= $kelas->limit(9)->get(); ?>
                <div class="courses-wrapper">
                    <div class="row">
                        @foreach($dt_base as $item)
                        <div class="col-lg-4 col-md-6">
                            <!-- Single Courses Start -->
                            <div class="single-courses">
                                <div class="courses-images">
                                    <a href="{{route('kelas.detail', $item->id)}}"><img src="{{asset('assets/images/courses/'.$item->foto)}}" alt="Courses" /></a>
                                </div>
                                <div class="courses-content">
                                    <div class="courses-author">
                                        <div class="author">
                                            <div class="author-thumb">
                                                @if($item->foto_mentor)
                                                <img src="{{asset('assets/images/instructor/'.@$item->foto_mentor)}}" alt="" width="35" />
                                                @else @if(@$item->jenis_kelamin == 'Laki - Laki')
                                                <img src="{{asset('adm/images/instructor/man.png')}}" alt="" width="35" />
                                                @else
                                                <img src="{{asset('adm/images/instructor/woman.png')}}" alt="" width="35" />
                                                @endif @endif
                                            </div>
                                            <div class="author-name">
                                                <a class="name" href="{{route('kelas.detail', $item->id)}}">{{$item->nama}}</a>
                                            </div>
                                        </div>
                                    </div>

                                    <h4 class="title"><a href="{{route('kelas.detail', $item->id)}}">{{$item->kelas}}</a></h4>
                                    <div class="courses-meta">
                                        <?php $total_materi = DB::table('kelas_materi')->where('id_kelas', $item->id)->count(); ?>
                                        <span> <i class="icofont-read-book"></i> {{$total_materi}} Materi </span>
                                    </div>
                                    <div class="courses-price-review">
                                        <div class="courses-price">
                                            @if($item->biaya == '0')
                                            <span class="sale-parice">Gratis</span>
                                            @else
                                            <span class="sale-parice">{{UserHelp::rupiah($item->biaya)}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Single Courses End -->
                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- All Courses Wrapper End -->
            </div>
            @else
            <div class="tab-pane fade" id="tabs{{$no}}">
                <?php 
                $kelas = DB::table('kelas')->select('kelas.*', 'kategori.kategori', 'mentor.nama', 'mentor.foto as foto_mentor', 'mentor.jenis_kelamin'); $kelas->join('kategori', 'kategori.id', 'kelas.id_kategori'); $kelas->join('mentor',
                'mentor.id', 'kelas.id_mentor'); $kelas->where('kelas.id_kategori', $item->id); $dt_base= $kelas->limit(9)->get(); ?>
                <div class="courses-wrapper">
                    <div class="row">
                        @foreach($dt_base as $item)
                        <div class="col-lg-4 col-md-6">
                            <!-- Single Courses Start -->
                            <div class="single-courses">
                                <div class="courses-images">
                                    <a href="{{route('kelas.detail', $item->id)}}"><img src="{{asset('assets/images/courses/'.$item->foto)}}" alt="Courses" /></a>
                                </div>
                                <div class="courses-content">
                                    <div class="courses-author">
                                        <div class="author">
                                            <div class="author-thumb">
                                                @if($item->foto_mentor)
                                                <img src="{{asset('adm/images/instructor/'.@$item->foto_mentor)}}" alt="" width="35" />
                                                @else @if(@$item->jenis_kelamin == 'Laki - Laki')
                                                <img src="{{asset('adm/images/instructor/man.png')}}" alt="" width="35" />
                                                @else
                                                <img src="{{asset('adm/images/instructor/woman.png')}}" alt="" width="35" />
                                                @endif @endif
                                            </div>
                                            <div class="author-name">
                                                <a class="name" href="">{{$item->nama}}</a>
                                            </div>
                                        </div>
                                    </div>

                                    <h4 class="title"><a href="{{route('kelas.detail', $item->id)}}">{{$item->kelas}}</a></h4>
                                    <div class="courses-meta">
                                        <?php $total_materi = DB::table('kelas_materi')->where('id_kelas', $item->id)->count(); ?>
                                        <span> <i class="icofont-read-book"></i> {{$total_materi}} Materi </span>
                                    </div>
                                    <div class="courses-price-review">
                                        <div class="courses-price">
                                            @if($item->biaya == '0')
                                            <span class="sale-parice">Gratis</span>
                                            @else
                                            <span class="sale-parice">{{UserHelp::rupiah($item->biaya)}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Single Courses End -->
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif @php $no++ @endphp @endforeach
        </div>
        <!-- All Courses tab content End -->

        <!-- All Courses BUtton Start -->
        <div class="courses-btn text-center">
            <a href="{{route('allkelas')}}" class="btn btn-secondary btn-hover-primary">Lihat Kelas Lainnya</a>
        </div>
        <!-- All Courses BUtton End -->
    </div>
</div>
<!-- All Courses End -->

<!-- Call to Action Start -->
<div class="section section-padding-02">
    <div class="container">
        <!-- Call to Action Wrapper Start -->
        <div class="call-to-action-wrapper">
            <img class="cat-shape-01 animation-round" src="{{asset('assets/images/shape/shape-12.png')}}" alt="Shape" />
            <img class="cat-shape-02" src="{{asset('assets/images/shape/shape-13.svg')}}" alt="Shape" />
            <img class="cat-shape-03 animation-round" src="{{asset('assets/images/shape/shape-12.png')}}" alt="Shape" />

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

<!-- How It Work End -->
<div class="section section-padding mt-n1">
    <div class="container">
        <!-- Section Title Start -->
        <div class="section-title shape-03 text-center">
            <h5 class="sub-title">Lebih dari {{$jumlah_kelas}}+ kelas</h5>
            <h2 class="main-title">Bagaimana cara mengikuti<span> kelas?</span></h2>
        </div>
        <!-- Section Title End -->

        <!-- How it Work Wrapper Start -->
        <div class="how-it-work-wrapper">
            <!-- Single Work Start -->
            <div class="single-work">
                <img class="shape-1" src="assets/images/shape/shape-15.png" alt="Shape" />

                <div class="work-icon">
                    <i class="flaticon-transparency"></i>
                </div>
                <div class="work-content">
                    <h3 class="title">Pilih kelas mu</h3>
                    <p>Pilih sesuai kebutuhan dan kemampuanmu!</p>
                </div>
            </div>
            <!-- Single Work End -->

            <!-- Single Work Start -->
            <div class="work-arrow">
                <img class="arrow" src="assets/images/shape/shape-17.png" alt="Shape" />
            </div>
            <!-- Single Work End -->

            <!-- Single Work Start -->
            <div class="single-work">
                <img class="shape-2" src="assets/images/shape/shape-15.png" alt="Shape" />

                <div class="work-icon">
                    <i class="flaticon-forms"></i>
                </div>
                <div class="work-content">
                    <h3 class="title">Lakukan pemesanan</h3>
                    <p>Pemesanan kelas dan pembayaran otomatis</p>
                </div>
            </div>
            <!-- Single Work End -->

            <!-- Single Work Start -->
            <div class="work-arrow">
                <img class="arrow" src="assets/images/shape/shape-17.png" alt="Shape" />
            </div>
            <!-- Single Work End -->

            <!-- Single Work Start -->
            <div class="single-work">
                <img class="shape-3" src="assets/images/shape/shape-16.png" alt="Shape" />

                <div class="work-icon">
                    <i class="flaticon-badge"></i>
                </div>
                <div class="work-content">
                    <h3 class="title">Dapatkan sertifikat</h3>
                    <p>Setelah menyelesaikan kelas akan mendapatkan sertifikat</p>
                </div>
            </div>
            <!-- Single Work End -->
        </div>
    </div>
</div>
<!-- How It Work End -->

<!-- Blog Start -->
<div class="section section-padding mt-n1">
    <div class="container">
        <!-- Section Title Start -->
        <div class="section-title shape-03 text-center">
            <h5 class="sub-title">Blog Terakhir</h5>
        </div>
        <!-- Section Title End -->

        <!-- Blog Wrapper Start -->
        <div class="blog-wrapper">
            <div class="row">
                @foreach($blog as $item)
                <div class="col-lg-4 col-md-6">
                    <!-- Single Blog Start -->
                    <div class="single-blog">
                        <div class="blog-image">
                            <a href="{{route('blog.detail', $item->slug)}}"><img src="{{asset('adm/images/blog/'.$item->gambar)}}" style="height: 200px !important;" alt="Blog" /></a>
                        </div>
                        <div class="blog-content">
                            <div class="blog-author">
                                <div class="author">
                                    <div class="author-thumb">
                                        <a href="#"><img src="{{asset('adm/images/icon-admin.jpg')}}" alt="Author" /></a>
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
        <!-- Blog Wrapper End -->
    </div>
</div>
<!-- Blog End -->
@endsection
