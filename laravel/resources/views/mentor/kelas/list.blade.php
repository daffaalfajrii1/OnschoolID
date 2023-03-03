@extends('mentor.layout.app') @section('content')
<div class="page-content-wrapper" style="min-height: 100vh!important;
    overflow: auto!important;">
    <div class="container-fluid custom-container" style="margin-top: -50px!important;">
        <div class="admin-courses-tab">
            <h3 class="title">Kelas Saya</h3>

            <div class="courses-tab-wrapper">
                <div class="tab-btn">
                    <a href="{{route('mentor.tambah_kelas')}}" class="btn btn-primary btn-hover-dark">Buat Kelas</a>
                </div>
            </div>
        </div>
        <div class="engagement-courses table-responsive">
            @if(session('status_nya'))
                <div class="alert alert-success" role="alert">
                    {{session('status_nya')}}
                </div>
            @endif
            <table class="table">
                <thead style="background-color: #e5f4eb; border-radius: 10px;">
                    <tr>
                        <th style="font-size: 18px; color: #212832; padding: 15px;">Nama kelas</th>
                        <th style="font-size: 18px; color: #212832; padding: 15px;">Kategori</th>
                        <th style="font-size: 18px; color: #212832; padding: 15px;">Status</th>
                        <th style="font-size: 18px; color: #212832; padding: 15px;">Biaya</th>
                        <th style="font-size: 18px; color: #212832; padding: 15px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($kelas) > 0) @foreach($kelas as $item)
                    <tr>
                        <th scope="row"><img src="{{asset('assets/images/courses/'.$item->foto)}}" alt="{{$item->kelas}}" style="width: 25%; margin-right: 10px;">{{$item->kelas}}</th>
                        <td>{{$item->kategori}}</td>
                        <td>@if($item->status == 'Pending')
                            <div class="badge bg-warning bg-opacity-10 text-warning">{{$item->status}}</div>
                                @elseif($item->status == 'Suspend')
                                            <div class="badge bg-danger text-white">{{$item->status}}</div>
                                            @elseif($item->status == 'Aktif')
                                            <div class="badge bg-success text-white">{{$item->status}}</div>
                                            @else
                                            <div class="badge bg-dark text-white">{{$item->status}}</div>
                                            @endif
                        </td>
                        <td>{{UserHelp::rupiah($item->biaya)}}</td>
                        <td><a class="btn btn-dark" href="{{route('mentor.kelas.edit', $item->id)}}">Edit</a>
                            <a class="btn btn-danger" href="{{route('mentor.kelas.hapus', $item->id)}}">Hapus</a>
                        </td>
                    </tr>
                    @endforeach @else
                    <tr>
                        <td colspan="5">Belum ada kelas</td>
                    </tr>
                    @endif
                </tbody>
            </table>
            {!!@$kelas->appends(['cari'=>@$_GET['cari']])->links()!!}
        </div>
    </div>
</div>
@endsection