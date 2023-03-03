@extends('admin.layout.app') @section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Data Penarikan</h3>
            </div>

            <div class="title_right">

            </div>
        </div>
        <div class="row" style="display: block;">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                    	<form method="get" action="">
                    	<div class="row">
                    		<div class="col-sm-12">
                    			<h2>Data Penarikan</h2>
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
                                        <th class="column-title">ID</th>
                                        <th class="column-title">Mentor</th>
                                        <th class="column-title">Penerima</th>
                                        <th class="column-title">Keterangan</th>
                                        <th class="column-title">Status</th>
                                        <th class="column-title">Tanggal</th>
                                        <th class="column-title">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                	@php $no=1; @endphp
                                	@if(count($penarikan) > 0)
									@foreach($penarikan as $item)
									<tr class="<?= $no % 2 == 0 ? 'even pointer' : 'odd pointer'?>">
										<td>#{{$item->id}}</td>
                                        <td>{{$item->nama}}</td>
                                        <!-- Table data -->
                                        <td>{{$item->bank}} {{$item->no_rekening}} a.n {{$item->nama_rekening}}</td>
                                        <td>Penarikan Saldo {{UserHelp::rupiah($item->nominal)}} dikurangi biaya penarikan {{UserHelp::rupiah($item->admin)}} menjadi {{UserHelp::rupiah($item->diterima)}}</td>
                                        <!-- Table data -->
                                        <td class="text-center text-sm-start">
                                            @if($item->status == 'Proses')
                                            <span class="badge bg-dark text-white">{{$item->status}}</span>
                                            @elseif($item->status == 'Gagal')
                                            <span class="badge bg-danger text-white">{{$item->status}}</span>
                                            @else
                                            <span class="badge bg-success text-white">{{$item->status}}</span>
                                            @endif
                                        </td>
                                        <td>{{UserHelp::tanggal_indo($item->updated_at, true)}}</td>
                                        <td>
                                            @if($item->status == 'Proses')
                                            <a href="{{route('admin.penarikan.terima', $item->id)}}" class="btn btn-sm btn-success">Konfirmasi</a>
                                            <a href="#tolak" class="btn btn-sm btn-danger tolak" data-id_penarikan="{{$item->id}}">Tolak</a>
                                            @else
                                            <span class="badge bg-primary text-white">Sudah Dikonfirmasi</span>
                                            @endif
                                        </td>
									</tr>
									@php $no++; @endphp
									@endforeach
									@else
									@if(@$_GET['cari'])
									<tr><td colspan="8"><center>Data tidak ditemukan</center></td></tr>
									@else
									<tr><td colspan="8"><center>Belum ada data</center></td></tr>
									@endif
									@endif
                                </tbody>
                            </table>
                            {!!@$penarikan->links('admin.pagination')!!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="appTolak" tabindex="-1" aria-labelledby="appTolaklabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            
            <!-- Modal header -->
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white" id="appTolaklabel">Tolak Penarikan</h5>
                <button type="button" class="btn btn-sm btn-light mb-0 tutup" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body p-5">
                <form method="post" action="{{route('admin.penarikan.tolak')}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id_penarikan">
                    <div class="row g-4">
                        <div class="col-12">
                            <label class="form-label">Alasan Tolak</label>
                            <textarea class="form-control" name="alasan" required="" placeholder="Alasan Tolak"></textarea>
                            <br>
                        </div>
                        <div class="col-12 gap-2">
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary" type="submit">Kirim</button>
                            </div>
                        </div>
                    </div>      
                </form>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger tutup" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div> 
<script type="text/javascript">
    $(document).ready(function(){
        $(".tolak").click(function(){ 
            $("#id_penarikan").val($(this).data('id_penarikan'));
            $('#appTolak').modal('show');
        });
        $(".tutup").click(function(){ 
            $('#appTolak').modal('toggle');
        });
    });
</script>
@endsection
