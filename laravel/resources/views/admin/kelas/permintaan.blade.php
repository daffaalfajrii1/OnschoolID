@extends('admin.layout.app') @section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Data Permintaan Kelas</h3>
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
                    			<h2>Data Permintaan Kelas</h2>
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
                                        <th class="column-title">Mentor</th>
                                        <th class="column-title">Kelas</th>
                                        <th class="column-title">Kategori</th>
                                        <th class="column-title">Biaya</th>
                                        <th class="column-title">Tanggal Daftar</th>
                                        <th class="column-title">Status</th>
                                        <th class="column-title">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                	@php $no=1; @endphp
                                	@if(count($kelas) > 0)
									@foreach($kelas as $item)
									<tr class="<?= $no % 2 == 0 ? 'even pointer' : 'odd pointer'?>">
										<td>{{$no}}</td>
										<td>{{$item->nama}}</td>
                                        <td>{{$item->kelas}}</td>
                                        <td>{{$item->kategori}}</td>
                                        <td>{{UserHelp::rupiah($item->biaya)}}</td>
                                        <td>{{UserHelp::tanggal_indo($item->created_at, true)}}</td>
                                        <td>
                                            @if($item->status == 'Suspend')
                                            <span class="badge bg-danger text-white">{{$item->status}}</span>
                                            @elseif($item->status == 'Aktif')
                                            <span class="badge bg-success text-white">{{$item->status}}</span>
                                            @else
                                            <span class="badge bg-dark text-white">{{$item->status}}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('admin.kelas.permintaan.detail', $item->id)}}" class="btn btn-sm btn-info-soft mb-0">Detail Kelas</a>
                                        </td>
									</tr>
									@php $no++; @endphp
									@endforeach
									@else
									@if(@$_GET['cari'])
									<tr><td colspan="8"><center>Data tidak ditemukan</center></td></tr>
									@else
									<tr><td colspan="8"><center>Belum ada permintaan</center></td></tr>
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
@endsection
