@extends('layout.app_dashboard') @section('content')
<div class="page-content-wrapper" style="min-height: 100vh!important;
    overflow: auto!important;">
    <div class="container-fluid custom-container">
        <div class="row">
            <div class="col-md-6">
                <div class="overview-box">
                    <div class="single-box" style="width: 100%">
                        <h5 class="title">Total Kelas</h5>
                        <div class="count">{{$total_kelas}}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="overview-box">
                    <div class="single-box" style="width: 100%">
                        <h5 class="title">Sertifikat Diterima</h5>
                        <div class="count">{{$total_sertifikat}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection