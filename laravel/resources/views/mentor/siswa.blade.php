@extends('mentor.layout.app') @section('content')
<div class="page-content-wrapper" style="min-height: 100vh !important; overflow: auto !important;">
    <div class="container-fluid custom-container" style="margin-top: -50px !important;">
        <div class="admin-courses-tab">
            <h3 class="title">Siswa Saya</h3>

            <div class="courses-tab-wrapper">
                <div class="tab-btn"></div>
            </div>
        </div>
        <div class="engagement-courses table-responsive">
            <table class="table">
                <thead style="background-color: #e5f4eb; border-radius: 10px;">
                    <tr>
                        <th style="font-size: 18px; color: #212832; padding: 15px;">Nama</th>
                        <th style="font-size: 18px; color: #212832; padding: 15px;">Materi</th>
                        <th style="font-size: 18px; color: #212832; padding: 15px;">Nilai Akhir</th>
                        <th style="font-size: 18px; color: #212832; padding: 15px;">Tanggal Bergabung</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($siswa) > 0) @foreach($siswa as $item)
                    <tr>
                        <th scope="row">{{$item->nama}}</th>
                        <td><?php 
                                            $total_materi = DB::table('kelas_materi')->where('id_kelas', $item->id_kelas)->count(); echo $total_materi; ?></td>
                        <td>@if($item->nilai_akhir)
                        {{$item->nilai_akhir}}
                            @else
                                Belum Ada Nilai
                            @endif</td>
                        <td>{{UserHelp::tanggal_indo($item->tgl_join, true)}}</td>
                    </tr>
                    @endforeach @else
                    <tr>
                        <td colspan="4">Belum ada siswa</td>
                    </tr>
                    @endif
                </tbody>
            </table>
            {!!@$siswa->appends(['cari'=>@$_GET['cari']])->links()!!}
        </div>
    </div>
</div>
@endsection
