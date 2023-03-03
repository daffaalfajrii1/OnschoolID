@extends('mentor.layout.app') @section('content')
<div class="page-content-wrapper" style="min-height: 100vh!important;
    overflow: auto!important;">
    <div class="container-fluid custom-container">
        <div class="row">
            <div class="col-md-4">
                <div class="overview-box">
                    <div class="single-box" style="width: 100%">
                        <h5 class="title">Total Kelas</h5>
                        <div class="count">{{$total_kelas}}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="overview-box">
                    <div class="single-box" style="width: 100%">
                        <h5 class="title">Total Siswa</h5>
                        <div class="count">{{$total_siswa}}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="overview-box">
                    <div class="single-box" style="width: 100%">
                        <h5 class="title">Total Penghasilan</h5>
                        <div class="count">{{UserHelp::rupiah($total_pemasukan)}}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="admin-courses-tab">
            <h3 class="title">Kelas Terlaris</h3>

            <div class="courses-tab-wrapper">
                <div class="tab-btn">
                    <a href="{{route('mentor.tambah_kelas')}}" class="btn btn-primary btn-hover-dark">Buat Kelas</a>
                </div>
            </div>
        </div>
        <div class="admin-courses-tab-content">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab1">

                                @if(count($kelas) > 0)
                                @foreach($kelas as $item)
                                <div class="courses-item">
                                    <div class="item-thumb">
                                        <a href="#">
                                            <img src="{{asset('assets/images/courses/'.$item->foto)}}" alt="{{$item->kelas}}" style="width: 25%">
                                        </a>
                                    </div>

                                    <div class="content-title">
                                        <h3 class="title"><a href="#">{{$item->kelas}}</a></h3>
                                    </div>

                                    <div class="content-wrapper">

                                        <div class="content-box">
                                            <p>Terjual</p>
                                            <span class="count">{{$item->terjual}}</span>
                                        </div>

                                        <div class="content-box">
                                            <p>Penghasilan</p>
                                            <span class="count"><?php
                                                    $billing = DB::table('billing')->where('id_kelas', $item->id)->sum('total');
                                                    ?>
                                                    {{UserHelp::rupiah($billing)}}</span>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @else
                                    <div class="courses-item"><center>Belum ada kelas</center></div>
                                @endif

                            </div>
                        </div>
                    </div>
    </div>
</div>
@endsection
