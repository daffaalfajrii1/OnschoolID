@extends('admin.layout.app') @section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Data Siswa</h3>
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
                    			<h2>Data Siswa</h2>
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
                                        <th class="column-title">Tanggal Daftar</th>
                                        <th class="column-title">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                	@php $no=1; @endphp
                                	@if(count($siswa) > 0)
									@foreach($siswa as $item)
									<tr class="<?= $no % 2 == 0 ? 'even pointer' : 'odd pointer'?>">
										<td>{{$no}}</td>
										<td>{{$item->nama}}</td>
                                        <td>{{$item->email}}</td>
										<td>{{UserHelp::tanggal_indo($item->created_at, true)}}</td>
										<td>
											<a href="{{route('admin.siswa.edit', $item->id)}}" class="btn btn-sm btn-info">Edit</a>
											<a href="{{route('admin.siswa.hapus', $item->id)}}" class="btn btn-sm btn-danger">Hapus</a>
										</td>
									</tr>
									@php $no++; @endphp
									@endforeach
									@else
									@if(@$_GET['cari'])
									<tr><td colspan="4"><center>Data tidak ditemukan</center></td></tr>
									@else
									<tr><td colspan="4"><center>Belum ada data</center></td></tr>
									@endif
									@endif
                                </tbody>
                            </table>
                            {!!@$siswa->appends(['cari'=>@$_GET['cari'],'sort'=>@$_GET['sort']])->links('admin.pagination')!!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
