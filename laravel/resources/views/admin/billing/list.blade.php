@extends('admin.layout.app') @section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Billing</h3>
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
                    		<div class="col-sm-9">
                    			<h2>Billing</h2>
                    		</div>
                    		<div class="col-sm-3">
                    			<div class="input-group">
									<input type="text" class="form-control" name="cari" placeholder="Pencarian">
									<span class="input-group-btn">
										<button type="submit" class="btn btn-dark">Cari</button>
									</span>
								</div>
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
                        @if(session('status_gagal'))
                        <div class="alert alert-danger" role="alert">
                         {{session('status_gagal')}}
                        </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action">
                                <thead>
                                    <tr class="headings">
                                        <th class="column-title">ID Invoice</th>
                                        <th class="column-title">Nama</th>
                                        <th class="column-title">Kelas</th>
                                        <th class="column-title">Harga</th>
                                        <th class="column-title">Status</th>
                                        <th class="column-title">Bukti Transfer</th>
                                        <th class="column-title">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                	@php $no=1; @endphp
                                	@if(count($billing) > 0)
									@foreach($billing as $item)
									<tr class="<?= $no % 2 == 0 ? 'even pointer' : 'odd pointer'?>">
										<td>{{$item->id}}</td>
                                        <td>{{$item->nama}}</td>
                                        <td>{{$item->kelas}}</td>
                                        <td>{{UserHelp::rupiah($item->total)}}</td>
                                        <td>
                                            @if($item->status == 'Belum Bayar')
                                            <div class="badge bg-danger bg-opacity-10 text-white">{{$item->status}}</div>
                                            @elseif($item->status == 'Terbayar')
                                            <div class="badge bg-success bg-opacity-10 text-white">{{$item->status}}</div>
                                            @else
                                            <div class="badge bg-secondary bg-opacity-10" style="color: white">{{$item->status}}</div>
                                            @endif
                                        </td>
                                        <td>
                                            @if($item->bukti_transfer == null)
                                            <div class="badge bg-warning bg-opacity-10 text-white">Belum Ada</div>
                                            @else
                                            <a href="#bukti" class="btn btn-sm btn-primary-soft bukti" data-bukti="{{asset('assets/images/bukti/'.$item->bukti_transfer)}}">Lihat Bukti</a>
                                            @endif
                                        </td>
                                        <td>
                                            @if($item->status != 'Terbayar')
                                            <a href="{{route('admin.billing.terima', $item->id)}}" class="btn btn-sm btn-success">Konfirmasi</a>
                                            <a href="#tolak" class="btn btn-sm btn-danger tolak" data-id_billing="{{$item->id}}">Tolak</a>
                                            @else
                                            <div class="badge bg-success bg-opacity-10 text-white">Sudah Membayar</div>
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
                            {!!@$billing->appends(['cari'=>@$_GET['cari'],'sort'=>@$_GET['sort']])->links('admin.pagination')!!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="appBukti" tabindex="-1" aria-labelledby="appBuktilabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            
            <!-- Modal header -->
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white" id="appBuktilabel">Bukti Tranfer</h5>
                <button type="button" class="btn btn-sm btn-light mb-0 tutup" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body p-5">
                <center>
                    <img id="bukti_trasfernya">
                </center>
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
        $(".bukti").click(function(){ 
            $("#bukti_trasfernya").attr("src",$(this).data('bukti'));
            $('#appBukti').modal('show');
        });
        $(".tutup").click(function(){ 
            $('#appBukti').modal('toggle');
        });
    });
</script>
<div class="modal fade" id="appTolak" tabindex="-1" aria-labelledby="appTolaklabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            
            <!-- Modal header -->
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white" id="appTolaklabel">Tolak Pembayaran</h5>
                <button type="button" class="btn btn-sm btn-light mb-0 tutup2" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body p-5">
                <form method="post" action="{{route('admin.billing.tolak')}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id_billing">
                    <div class="row g-4">
                        <div class="col-12">
                            <label class="form-label">Alasan Tolak</label>
                            <textarea class="form-control" name="alasan" required="" placeholder="Alasan Tolak"></textarea>
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
                <button type="button" class="btn btn-danger tutup2" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div> 
<script type="text/javascript">
    $(document).ready(function(){
        $(".tolak").click(function(){ 
            $("#id_billing").val($(this).data('id_billing'));
            $('#appTolak').modal('show');
        });
        $(".tutup2").click(function(){ 
            $('#appTolak').modal('toggle');
        });
    });
</script>
@endsection
