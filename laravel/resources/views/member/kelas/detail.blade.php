@extends('layout.app_dashboard_kelas') @section('content')
<div class="section">

            <!-- Courses Enroll Wrapper Start -->
            <div class="courses-enroll-wrapper">

                <!-- Courses Video Player Start -->
                <div class="courses-video-player">

                    <!-- Courses Video Container Start -->
                    <div class="vidcontainer">
                        <iframe id="playmateri" style="width: 100%; height: 100%;" ></iframe>

                        <div class="loading" id="loading">
                            <div class="spinner-border spinner">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>

                    </div>
                    <!-- Courses Video Container End -->

                    <!-- Courses Enroll Content Start -->
                    <div class="courses-enroll-content">
                        @if(session('lulus'))
                        <br>
                        <div class="alert alert-success" role="alert">
                         {{session('lulus')}}
                        </div>
                        @endif
                        @if(session('gagal'))
                        <br>
                        <div class="alert alert-danger" role="alert">
                         {{session('gagal')}}
                        </div>
                        @endif

                        <!-- Courses Enroll Title Start -->
                        <div class="courses-enroll-title">
                            <h2 class="title">{{$kelas->kelas}}</h2>
                            <p><i class="icofont-users"></i> <span>{{$total_siswa}}</span> Siswa</p>
                        </div>
                        <!-- Courses Enroll Title End -->

                        <!-- Courses Enroll Tab Start -->
                        <div class="courses-enroll-tab">
                            <div class="enroll-tab-menu">
                                <ul class="nav">
                                    <li><button class="active" data-bs-toggle="tab" data-bs-target="#tab1">Overview</button></li>
                                    <li><button data-bs-toggle="tab" data-bs-target="#tab2">Deskripsi</button></li>
                                    <li><button data-bs-toggle="tab" data-bs-target="#tab3">Mentor</button></li>
                                    <li><button data-bs-toggle="tab" data-bs-target="#tab4">Tools</button></li>
                                    <li><button data-bs-toggle="tab" data-bs-target="#tab5">Faq</button></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Courses Enroll Tab End -->

                        <!-- Courses Enroll Tab Content Start -->
                        <div class="courses-enroll-tab-content">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="tab1">

                                    <!-- Overview Start -->
                                    <div class="overview">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="enroll-tab-title">
                                                    <h3 class="title">Detail Kelas</h3>
                                                </div>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="enroll-tab-content">
                                                    <p>{{$kelas->deskripsi_singkat}}</p>

                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <th>Mentor <span>:</span></th>
                                                                <td>{{$mentor->nama}}</td>
                                                            </tr>
                                                            <tr>
                                                                <th>Materi <span>:</span></th>
                                                                <td>{{$total_materi}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="enroll-tab-title">
                                                    <h3 class="title">Ujian Kelas</h3>
                                                </div>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="enroll-tab-content">
                                                    <?php 
                                                    $member_kelas_ujian = DB::table('member_kelas_ujian')->where('id_kelas', $kelas->id)->where('id_member', Session::get('id'))->orderBy('id', 'DESC')->first();
                                                    ?>
                                                    @if($member_kelas_ujian)
                                                    <?php $start_date = new DateTime($member_kelas_ujian->created_at);
                                                    $since_start = $start_date->diff(new DateTime(date('Y-m-d H:i:s'))); ?>
                                                        @if($member_kelas_ujian->nilai >= 60)
                                                        <div class="alert alert-success" role="alert">
                                                            Anda berhasil menyelesaikan ujian kelas ini dengan nilai {{$member_kelas_ujian->nilai}}.
                                                        </div>
                                                        @else
                                                        <div class="alert alert-danger" role="alert">
                                                            Anda belum menyelesaikan ujian kelas ini, silahkan lakukan ujian ulang.
                                                        </div>
                                                        <p>Apabila anda sudah mengerti semua materi yang sudah disampaikan silahkan lakukan ujian soal dengan menekan tombol dibawah ini : </p>

                                                        @if($since_start->i >= 2)
                                                        <a href="{{route('member.kelas.ujian', $kelas->id)}}" class="btn btn-primary">Mulai Ujian Ulang</a>
                                                        @else
                                                        <b>Tunggu 2 menit sebelum melakukan ujian ulang</b>
                                                        @endif
                                                        @endif
                                                    @else
                                                    <p>Apabila anda sudah mengerti semua materi yang sudah disampaikan silahkan lakukan ujian soal dengan menekan tombol dibawah ini : </p>

                                                    <a href="{{route('member.kelas.ujian', $kelas->id)}}" class="btn btn-primary">Mulai Ujian</a>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Overview End -->

                                </div>
                                <div class="tab-pane fade" id="tab2">

                                    <!-- Description Start -->
                                    <div class="description">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="enroll-tab-title">
                                                    <h3 class="title">Deskripsi</h3>
                                                </div>
                                            </div>
                                            <div class="col-lg-8">
                                                <div class="enroll-tab-content">
                                                    {!!$kelas->deskripsi!!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Description End -->

                                </div>
                                <div class="tab-pane fade" id="tab3">

                                    <div class="tab-instructors">
                                        <h3 class="tab-title">Mentor:</h3>

                                        <div class="row">
                                            <div class="col-md-12 col-12">
                                                <!-- Single Team Start -->
                                                <div class="single-team">
                                                    <div class="team-thumb">
                                                        @if($mentor->foto)
                                            <img src="{{asset('assets/images/instructor/'.@$mentor->foto)}}" width="200">
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

                                </div>
                                <div class="tab-pane fade" id="tab4">

                                    <!-- Instructor Start -->
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
                                    <!-- Instructor End -->

                                </div>
                                <div class="tab-pane fade" id="tab5">
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
                                </div>
                            </div>
                        </div>
                        <!-- Courses Enroll Tab Content End -->

                    </div>
                    <!-- Courses Enroll Content End -->
                </div>
                <!-- Courses Video Player End -->

                <!-- Courses Video Playlist Start -->
                <div class="courses-video-playlist">
                    <div class="playlist-title">
                        <h3 class="title">Materi Kelas</h3>
                        <span>{{$total_materi}} materi</span>
                    </div>

                    <!-- Video Playlist Start  -->
                    <div class="video-playlist">
                    	<div class="accordion" id="videoPlaylist">
                    		<nav class="vids">
                    			@php $no =1; @endphp
                    			@php $url = ''; @endphp
                    			@foreach($kelas_materi as $item)
                    			@if($no == 1)
                    			@php $url = $item->video; @endphp
                    			@endif
                                <a class="link lihatmateri <?= $no == 1 ? 'active playing' : ''?>" href="{{$item->video}}" data-video="{{$item->video}}">
                                    <p>{{$item->judul_materi}}</p>
                                </a>
                                @php $no++; @endphp
                                @endforeach
                            </nav>
                        </div>
                    </div>
                    <!-- Video Playlist End  -->

                </div>
                <!-- Courses Video Playlist End -->

            </div>
            <!-- Courses Enroll Wrapper End -->

        </div>
<script type="text/javascript">
    $(document).ready(function () {
    	$("#playmateri").attr("src", '{{$url}}');
        $("#loading").hide();
        $(".lihatmateri").click(function () {
            let video = $(this).data("video");
            $("#playmateri").attr("src", video);
            $("#loading").hide();
        });
    });
</script>
@endsection