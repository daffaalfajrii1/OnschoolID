@extends('admin.layout.app') @section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Detail Mentor</h3>
            </div>

            <div class="title_right"></div>
        </div>
        <div class="row" style="display: block;">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="row">
                            <div class="col-sm-12">
                                <h2>Data Diri Mentor</h2>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <div class="col-md-4 col-sm-4 profile_left">
                            <div class="profile_img">
                                <div id="crop-avatar">
                                    @if($mentor->foto)
                                    <img class="img-responsive avatar-view" src="{{asset('assets/images/instructor/'.@$mentor->foto)}}" alt="" width="100">
                                    @else
                                    @if(@$mentor->jenis_kelamin == 'Laki - Laki')
                                    <img class="img-responsive avatar-view" src="{{asset('adm/images/instructor/man.png')}}" alt="" width="100">
                                    @else
                                    <img class="img-responsive avatar-view" src="{{asset('adm/images/instructor/woman.png')}}" alt="" width="100">
                                    @endif
                                    @endif
                                </div>
                            </div>
                            <h3>{{@$mentor->nama}}</h3>

                            <ul class="list-unstyled user_data">
                                <li><b>Jenis Kelamin:</b> {{@$mentor->jenis_kelamin}}</li>
                                <li><b>Nomor Kontak:</b> {{@$mentor->no_hp}}</li>
                                <li><b>Email:</b> {{@$mentor->email}}</li>
                                <li><b>Alamat:</b> {{@$mentor->alamat}}</li>
                                <li><b>Tanggal Bergabung:</b> {{UserHelp::tanggal_indo(@$mentor->created_at)}}</li>
                                <li><b>Pendidikan:</b> {{@$mentor->pendidikan}}</li>
                            </ul>
                            <div>
                                <h4>Deskripsi Diri:</h4>
                                {{@$mentor->deskripsi}}
                            </div>
                            
                        </div>
                        <div class="col-md-8 col-sm-8">
                            <div class="row" style="display: block;">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <form method="get" action="">
                        <div class="row">
                            <div class="col-sm-9">
                                <h2>Data Kelas</h2>
                            </div>
                            <div class="col-sm-3">
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        </form>
                    </div>

                    <div class="x_content">
                        @if(session('status'))
                        <div class="alert alert-success" role="alert">
                         {{session('status')}}
                        </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action">
                                <thead>
                                    <tr class="headings">
                                        <th class="column-title">No</th>
                                        <th class="column-title">Nama Kelas</th>
                                        <th class="column-title">Jumlah Siswa</th>
                                        <th class="column-title">Status</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php $no=1; @endphp
                                    @if(count($kelas) > 0)
                                    @foreach($kelas as $item)
                                    <tr class="<?= $no % 2 == 0 ? 'even pointer' : 'odd pointer'?>">
                                        <td>{{$no}}</td>
                                        <td>{{$item->kelas}}</td>
                                        <td><?php
                                        $siswa = DB::table('billing')->where('id_kelas', $item->id)->where('id_mentor', $mentor->id)->where('status', 'Terbayar')->count();
                                        echo $siswa;
                                        ?></td>
                                        <td>
                                            @if($item->status == 'Suspend')
                                            <span class="badge bg-danger text-white">{{$item->status}}</span>
                                            @elseif($item->status == 'Aktif')
                                            <span class="badge bg-success text-white">{{$item->status}}</span>
                                            @else
                                            <span class="badge bg-dark text-white">{{$item->status}}</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @php $no++; @endphp
                                    @endforeach
                                    @else
                                    @if(@$_GET['cari'])
                                    <tr><td colspan="4"><center>Data tidak ditemukan</center></td></tr>
                                    @else
                                    <tr><td colspan="4"><center>Belum ada kelas</center></td></tr>
                                    @endif
                                    @endif
                                </tbody>
                            </table>
                            {!!@$kelas->appends(['cari'=>@$_GET['cari'],'sort'=>@$_GET['sort']])->links('admin.pagination')!!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
