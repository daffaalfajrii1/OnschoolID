@extends('layout.app_dashboard') @section('content')
<div class="page-content-wrapper" style="min-height: 100vh!important;
    overflow: auto!important;">
    <div class="container-fluid custom-container" style="margin-top: -50px!important;">
        <div class="admin-courses-tab">
            <h3 class="title">Kelas Saya</h3>

            <div class="courses-tab-wrapper">
                <div class="tab-btn">
                    
                </div>
            </div>
        </div>
        <div class="engagement-courses table-responsive">
            @if(session('status_nya'))
                        <div class="alert alert-success" role="alert">
                         {{session('status_nya')}}
                        </div>
                        @endif
            @if(session('gagal'))
                        <div class="alert alert-danger" role="alert">
                         {{session('gagal')}}
                        </div>
                        @endif
            <table class="table">
                <thead style="background-color: #e5f4eb; border-radius: 10px;">
                    <tr>
                        <th style="font-size: 18px; color: #212832; padding: 15px;">Tanggal Bergabung</th>
                        <th style="font-size: 18px; color: #212832; padding: 15px;">Kelas</th>
                        <th style="font-size: 18px; color: #212832; padding: 15px;">Status</th>
                        <th style="font-size: 18px; color: #212832; padding: 15px;">Sertifikat</th>
                        <th style="font-size: 18px; color: #212832; padding: 15px;">Nilai Akhir</th>
                        <th style="font-size: 18px; color: #212832; padding: 15px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($kelas) > 0) @foreach($kelas as $item)
                    <tr>
                        <th scope="row">{{UserHelp::tanggal_indo($item->tgl_join, true)}}</th>
                        <td>{{$item->kelas}}</td>
                        <td>
                            @if($item->status_kelas == 'Berjalan')
                                            <div class="badge bg-primary text-white">{{$item->status_kelas}}</div>
                                            @else
                                            <div class="badge bg-success text-white">{{$item->status_kelas}}</div>
                                            @endif
                        </td>
                        <td>
                            @if($item->status_kelas == 'Berjalan')
                                            <div class="badge bg-dark text-white">Belum Ada</div>
                                            @else
                                            <a href="{{ route('member.kelas.sertifikat') }}"
                                                onclick="event.preventDefault();
                                                     document.getElementById('sertifikat-form{{$item->id}}').submit();" class="btn btn-danger">Download</a>
                                            <form id="sertifikat-form{{$item->id}}" action="{{ route('member.kelas.sertifikat') }}" method="POST" style="display: none;">
                                                @csrf
                                                <input type="hidden" name="id_kelas" value="{{$item->id}}">
                                            </form>
                                            @endif
                        </td>
                        <td>
                            @if($item->nilai_akhir)
                            {{$item->nilai_akhir}}
                            @else
                                Belum Ada Nilai
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-primary" href="{{route('member.kelas.detail', $item->id)}}" class="btn btn-sm btn-info-soft">Masuk Kelas</a>
                        </td>
                    </tr>
                    @endforeach @else
                    <tr>
                        <td colspan="5">Belum ada data pembelian</td>
                    </tr>
                    @endif
                </tbody>
            </table>
            {!!@$kelas->appends(['cari'=>@$_GET['cari']])->links()!!}
        </div>
    </div>
</div>
@endsection