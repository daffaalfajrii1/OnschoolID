@extends('admin.layout.app') @section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Data Permintaan Mentor</h3>
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
                    			<h2>Data Permintaan Mentor</h2>
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
                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action">
                                <thead>
                                    <tr class="headings">
                                        <th class="column-title">No</th>
                                        <th class="column-title">Nama</th>
                                        <th class="column-title">Email</th>
                                        <th class="column-title">No Handphone</th>
                                        <th class="column-title">Tanggal Permintaan</th>
                                        <th class="column-title">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                	@php $no=1; @endphp
                                	@if(count($mentor) > 0)
									@foreach($mentor as $item)
									<tr class="<?= $no % 2 == 0 ? 'even pointer' : 'odd pointer'?>">
										<td>{{$no}}</td>
                                        <td>{{$item->nama}}</td>
                                        <td>{{$item->email}}</td>
                                        <td>{{$item->no_hp}}</td>
                                        <td>{{UserHelp::tanggal_indo($item->created_at, true)}}</td>
										<td>
                                            <a href="#" class="btn btn-sm btn-primary lihatdata" data-bs-toggle="modal" data-nama="{{@$item->nama}}" data-email="{{@$item->email}}" data-no_hp="{{@$item->no_hp}}" data-jk="{{@$item->jenis_kelamin}}" data-pendidikan="{{@$item->pendidikan}}" data-deskripsi="{{@$item->deskripsi}}">Lihat Data Diri</a>
                                            <a href="{{route('admin.mentor.permintaan.terima', $item->id)}}" class="btn btn-sm btn-success">Terima</a>
                                            <a href="#tolak" class="btn btn-sm btn-danger tolak" data-id_mentor="{{$item->id}}">Tolak</a>
										</td>
									</tr>
									@php $no++; @endphp
									@endforeach
									@else
									@if(@$_GET['cari'])
									<tr><td colspan="7"><center>Data tidak ditemukan</center></td></tr>
									@else
									<tr><td colspan="7"><center>Belum ada permintaan</center></td></tr>
									@endif
									@endif
                                </tbody>
                            </table>
                            {!!@$mentor->appends(['cari'=>@$_GET['cari'],'sort'=>@$_GET['sort']])->links('admin.pagination')!!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="appDetail" tabindex="-1" aria-labelledby="appDetaillabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            
            <!-- Modal header -->
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white" id="appDetaillabel">Data Diri</h5>
                <button type="button" class="btn btn-sm btn-light mb-0 tutupdetail" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body p-5">
                                                    <!-- Name -->
                                                    <span class="small">Nama:</span>
                                                    <h6 class="mb-3" id="nama_detail"></h6>

                                                    <!-- Email -->
                                                    <span class="small">Email:</span>
                                                    <h6 class="mb-3" id="email_detail"></h6>

                                                    <!-- Phone number -->
                                                    <span class="small">No Handphone:</span>
                                                    <h6 class="mb-3" id="no_hp_detail"></h6>

                                                    <!-- Phone number -->
                                                    <span class="small">Jenis Kelamin:</span>
                                                    <h6 class="mb-3" id="jk_detail"></h6>

                                                    <!-- Summary -->
                                                    <span class="small">Riwayat Pendidikan:</span>
                                                    <p class="text-dark mb-2" id="pendidikan_detail"></p>

                                                    <!-- Summary -->
                                                    <span class="small">Deskripsi Diri:</span>
                                                    <p class="text-dark mb-2" id="deskripsi_detail"></p>
                                                </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger tutupdetail">Tutup</button>
            </div>
        </div>
    </div>
</div> 
<script type="text/javascript">
    $(document).ready(function(){
        $(".lihatdata").click(function(){
            $("#nama_detail").html($(this).data('nama')); 
            $("#email_detail").html($(this).data('email')); 
            $("#no_hp_detail").html($(this).data('no_hp')); 
            $("#jk_detail").html($(this).data('jk')); 
            $("#pendidikan_detail").html($(this).data('pendidikan')); 
            $("#deskripsi_detail").html($(this).data('deskripsi')); 
            $('#appDetail').modal('show');
        });
        $(".tutupdetail").click(function(){
            $('#appDetail').modal('toggle');
        });
    });
</script>
<div class="modal fade" id="appTolak" tabindex="-1" aria-labelledby="appTolaklabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            
            <!-- Modal header -->
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white" id="appTolaklabel">Tolak Mentor</h5>
                <button type="button" class="btn btn-sm btn-light mb-0 tutuptolak" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body p-5">
                <form method="post" action="{{route('admin.mentor.permintaan.tolak')}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id_mentor">
                    <div class="row g-4">
                        <div class="col-12">
                            <label class="form-label">Alasan Tolak</label>
                            <textarea class="form-control" name="alasan" required="" placeholder="Alasan Tolak"></textarea>
                        </div>
                        <div class="col-12 gap-2">
                            <div class="d-grid gap-2">
                                <br>
                                <button class="btn btn-success" type="submit">Kirim</button>
                            </div>
                        </div>
                    </div>      
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger tutuptolak">Tutup</button>
            </div>
        </div>
    </div>
</div> 
<script type="text/javascript">
    $(document).ready(function(){
        $(".tolak").click(function(){ 
            $("#id_mentor").val($(this).data('id_mentor'));
            $('#appTolak').modal('show');
        });
        $(".tutuptolak").click(function(){
            $("#id_mentor").val('');
            $('#appTolak').modal('toggle');
        });
    });
</script>
@endsection
