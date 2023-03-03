@extends('admin.layout.app') @section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Edit Data Tim</h3>
            </div>

            <div class="title_right"></div>
        </div>
        <div class="row" style="display: block;">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="row">
                            <div class="col-sm-12">
                                <h2>Formulir Edit Tim</h2>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <form method="post" action="{{route('admin.tim.update')}}" class="form-horizontal form-label-left" enctype="multipart/form-data">
                            <input type="hidden" value="{{$tim->id}}" name="id">
							@csrf
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3">Nama</label>
                                <div class="col-md-9 col-sm-9">
                                    <input type="text" class="form-control" placeholder="Masukkan Nama" name="nama" required value="{{$tim->nama}}"/>
                                    @if($errors->has('nama'))
                                    <span style="color: red;">
                                      <strong>{{$errors->first('nama')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3">Jabatan</label>
                                <div class="col-md-9 col-sm-9">
                                    <input type="text" class="form-control" placeholder="Masukkan Jabatan" name="jabatan" required value="{{$tim->jabatan}}" />
                                    @if($errors->has('jabatan'))
                                    <span style="color: red;">
                                      <strong>{{$errors->first('jabatan')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3">Foto</label>
                                <div class="col-md-9 col-sm-9">
                                    <input type="file" class="form-control" name="gambar" />
                                    <small>Silahkan pilih jika ingin merubah.</small>
                                    @if($errors->has('gambar'))
                                    <br>
                                    <span style="color: red;">
                                      <strong>{{$errors->first('gambar')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9 offset-md-3">
                                    <a href="{{route('admin.tim')}}" class="btn btn-primary">Kembali</a>
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
