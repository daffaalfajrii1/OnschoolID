@extends('admin.layout.app') @section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Detail Kelas</h3>
            </div>

            <div class="title_right">
            </div>
        </div>
        <div class="row" style="display: block;">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="row">
                            <div class="col-sm-12">
                                <h2>Informasi Umum</h2>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <div class="col-md-4 col-sm-4 profile_left">
                            <div class="profile_img">
                                <div id="crop-avatar">
                                    <img class="img-responsive avatar-view" src="{{asset('assets/images/courses/'.$kelas->foto)}}" alt="" style="width: 100%;" />
                                </div>
                            </div>
                            <h3>{{$kelas->kelas}}</h3>

                            <ul class="list-unstyled user_data">
                                <li><b>Deskripsi Singkat:</b> {{$kelas->deskripsi_singkat}}</li>
                                <li><b>Biaya:</b> {{UserHelp::rupiah($kelas->biaya)}}</li>
                                <li><b>Nama Mentor:</b> {{$kelas->nama}}</li>
                                <li><b>Email Mentor:</b> {{@$kelas->email}}</li>
                                <li><b>Tanggal Daftar:</b> {{UserHelp::tanggal_indo(@$kelas->created_at, true)}}</li>
                                <li><b>Total Materi:</b> {{@$total_materi}}</li>
                                <li><b>Total Tools:</b> {{@$total_tools}}</li>
                                <li><b>Sertifikat:</b> {{$kelas->sertifikat}}</li>
                            </ul>
                            <div>
                                <h4>Deskripsi:</h4>
                                {!!@$kelas->deskripsi!!}
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
                                                        <h2>Materi Kelas</h2>
                                                    </div>
                                                    <div class="col-sm-3"></div>
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
                                                            <th class="column-title">Materi</th>
                                                            <th class="column-title">Video</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        @php $no=1; @endphp @if($total_materi > 0) @foreach($kelas_materi as $item)
                                                        <tr class="<?= $no % 2 == 0 ? 'even pointer' : 'odd pointer'?>">
                                                            <td>
                                                                {{$item->judul_materi}}
                                                            </td>
                                                            <td>
                                                                <a class="lihat_video" href="#" data-video="{{$item->video}}">Lihat Video</a>
                                                            </td>
                                                        </tr>
                                                        @endforeach @else
                                                        <tr>
                                                            <td colspan="2"><center>Tidak Ada Materi</center></td>
                                                            @endif
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <br />
                                                {!!@$kelas_materi->links()!!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="display: block;">
                                <div class="col-md-12 col-sm-12">
                                    <div class="x_panel">
                                        <div class="x_title">
                                            <form method="get" action="">
                                                <div class="row">
                                                    <div class="col-sm-9">
                                                        <h2>Tools Kelas</h2>
                                                    </div>
                                                    <div class="col-sm-3"></div>
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
                                                            <th class="column-title">Nama Tools</th>
                                                            <th class="column-title">Keterangan</th>
                                                            <th class="column-title">Link Download</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        @if($total_tools > 0)
                                                        @foreach($kelas_tools as $item)
                                                        <tr>
                                                            <td>
                                                                {{$item->nama_tools}}
                                                            </td>
                                                            <td>
                                                                {{$item->keterangan}}
                                                            </td>
                                                            <td>
                                                                <a target="_blank" href="{{$item->download}}">Download Disini</a>
                                                            </td>
                                                            
                                                        </tr>
                                                        @endforeach
                                                        @else
                                                        <tr><td colspan="3"><center>Tidak Ada Tools Yang Dibutuhkan</center></td></tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                                <br />
                                                {!!@$kelas_materi->links()!!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="display: block;">
                                <div class="col-md-12 col-sm-12">
                                    <div class="x_panel">
                                        <div class="x_title">
                                            <form method="get" action="">
                                                <div class="row">
                                                    <div class="col-sm-9">
                                                        <h2>Materi Kelas</h2>
                                                    </div>
                                                    <div class="col-sm-3"></div>
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
                                                            <th class="column-title">Materi</th>
                                                            <th class="column-title">Video</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        @php $no=1; @endphp @if($total_materi > 0) @foreach($kelas_materi as $item)
                                                        <tr class="<?= $no % 2 == 0 ? 'even pointer' : 'odd pointer'?>">
                                                            <td>
                                                                {{$item->judul_materi}}
                                                            </td>
                                                            <td>
                                                                <a class="lihat_video" href="#" data-video="{{$item->video}}">Lihat Video</a>
                                                            </td>
                                                        </tr>
                                                        @endforeach @else
                                                        <tr>
                                                            <td colspan="2"><center>Tidak Ada Materi</center></td>
                                                            @endif
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="display: block;">
                                <div class="col-md-12 col-sm-12">
                                    <div class="x_panel">
                                        <div class="x_title">
                                            <form method="get" action="">
                                                <div class="row">
                                                    <div class="col-sm-9">
                                                        <h2>Soal Ujian Kelas</h2>
                                                    </div>
                                                    <div class="col-sm-3"></div>
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
                                                            <th class="column-title">Soal</th>
                                                            <th class="column-title">Pilihan</th>
                                                            <th class="column-title">Jawaban</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        @if(count($kelas_soal) > 0)
                                                        @foreach($kelas_soal as $item)
                                                        <tr>
                                                            <td>
                                                                {{$item->soal}}
                                                            </td>
                                                            <td>
                                                                <ol type="A">
                                                                  <li>{{$item->a}}</li>
                                                                  <li>{{$item->b}}</li>
                                                                  <li>{{$item->c}}</li>
                                                                  <li>{{$item->d}}</li>
                                                                  <li>{{$item->e}}</li>
                                                                </ol>
                                                            </td>
                                                            <td>
                                                                {{$item->jawaban}}
                                                            </td>
                                                            
                                                        </tr>
                                                        @endforeach
                                                        @else
                                                        <tr><td colspan="3"><center>Tidak Ada Soal</center></td></tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="display: block;">
                                <div class="col-md-12 col-sm-12">
                                    <div class="x_panel">
                                        <div class="x_title">
                                            <form method="get" action="">
                                                <div class="row">
                                                    <div class="col-sm-9">
                                                        <h2>FAQ Kelas</h2>
                                                    </div>
                                                    <div class="col-sm-3"></div>
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
                                                            <th class="column-title">Pertanyaan</th>
                                                            <th class="column-title">Jawaban</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        @php $no=1; @endphp @if(count($kelas_faq) > 0) @foreach($kelas_faq as $items)
                                                        <tr class="<?= $no % 2 == 0 ? 'even pointer' : 'odd pointer'?>">
                                                            <td>
                                                                {{$items->pertanyaan}}
                                                            </td>
                                                            <td>
                                                                {{$items->jawaban}}
                                                            </td>
                                                        </tr>
                                                        @endforeach @else
                                                        <tr>
                                                            <td colspan="2"><center>Tidak Ada FAQ</center></td>
                                                            @endif
                                                        </tr>
                                                    </tbody>
                                                </table>
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
<div class="modal fade bd-example-modal-lg" id="modalvideo" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Video</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe style="width: 100%; height: 500px;" id="iframe"></iframe>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $(".lihat_video").click(function () {
            let video = $(this).data("video");
            $("#iframe").attr("src", video);
            $("#modalvideo").modal("show");
        });
    });
</script>
@endsection
