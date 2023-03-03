@extends('admin.layout.app') @section('content')
<div class="right_col" role="main">
    <div class="row">
        <div class="animated flipInY col-md-3">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-bookmark-o"></i></div>
                <div class="count">{{$kelas}}</div>
                <h3>Kelas</h3>
            </div>
        </div>
        <div class="animated flipInY col-md-3">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-black-tie"></i></div>
                <div class="count">{{$mentor}}</div>
                <h3>Mentor</h3>
            </div>
        </div>
        <div class="animated flipInY col-md-3">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-graduation-cap"></i></div>
                <div class="count">{{$siswa}}</div>
                <h3>Siswa</h3>
            </div>
        </div>
        <div class="animated flipInY col-md-3">
            <div class="tile-stats">
                <div class="icon"><i class="fa fa-money"></i></div>
                <div class="count">{{UserHelp::rupiah($total_penghasilan)}}</div>
                <h3>Total Penghasilan</h3>
            </div>
        </div>
    </div>
</div>
@endsection
