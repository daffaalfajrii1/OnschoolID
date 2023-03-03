@extends('admin.layout.app') @section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Tambah Data Kategori</h3>
            </div>

            <div class="title_right"></div>
        </div>
        <div class="row" style="display: block;">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="row">
                            <div class="col-sm-12">
                                <h2>Formulir Tambah Kategori</h2>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <form method="post" action="{{route('admin.kategori.simpan')}}" class="form-horizontal form-label-left">
							@csrf
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3">Kategori</label>
                                <div class="col-md-9 col-sm-9">
                                    <input type="text" class="form-control" placeholder="Masukkan Nama Kategori" name="kategori" required />
                                    @error('kategori')
			                        <span class="invalid-feedback" role="alert">
			                          <strong>Wajib Diisi</strong>
			                        </span>
			                        @enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9 offset-md-3">
                                    <a href="{{route('admin.kategori')}}" class="btn btn-primary">Kembali</a>
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
