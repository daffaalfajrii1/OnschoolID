@extends('layout.app') @section('content')
<div class="section page-banner">

            <img class="shape-1 animation-round" src="{{asset('assets/images/shape/shape-8.png')}}" alt="Shape">

            <img class="shape-2" src="{{asset('assets/images/shape/shape-23.png')}}" alt="Shape">

            <div class="container">
                <!-- Page Banner Start -->
                <div class="page-banner-content">
                    <ul class="breadcrumb">
                        <li><a href="{{route('home')}}">Beranda</a></li>
                        @if(Request::segment(2) == '')
                        <li class="active">Kelas</li>
                        @else
                        <li><a href="{{route('allkelas')}}">Kelas</a></li>
                        <?php 
                        $kategori = DB::table('kategori')->where('slug', Request::segment(2))->first();
                        ?>
                        <li class="active">{{$kategori->kategori}}</li>
                        @endif
                    </ul>
                    @if(Request::segment(2) == '')
                    <h2 class="title"><span>Kelas</span></h2>
                    @else
                    <?php 
                        $kategori = DB::table('kategori')->where('slug', Request::segment(2))->first();
                        ?>
                    <h2 class="title"><span>{{$kategori->kategori}}</span></h2>
                    @endif
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

        <!-- Courses Start -->
        <div class="section section-padding">
            <div class="container">

                <!-- Courses Category Wrapper Start  -->
                <div class="courses-category-wrapper">
                    <div class="courses-search search-2">
                        <form action="" method="get">
                            <input type="text" placeholder="Cari Disini" name="cari" required value="{{@$_GET['cari']}}">
                            <button type="submit"><i class="icofont-search"></i></button>
                        </form>
                    </div>

                    <ul class="category-menu">
                        @if(Request::segment(2) == '')
                        <li><a class="active" href="{{route('allkelas')}}">Semua Kelas</a></li>
                        @else
                        <?php 
                        $kategori = DB::table('kategori')->where('slug', Request::segment(2))->first();
                        ?>
                        <li><a class="active" href="#">{{$kategori->kategori}}</a></li>
                        @endif
                    </ul>
                </div>
                <div class="courses-wrapper-02">
                    <div class="row">
                        @foreach($kelas as $item)
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
                                            <span class="sale-parice">{{UserHelp::rupiah($item->biaya)}}</span>
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
        </div>
            
@endsection