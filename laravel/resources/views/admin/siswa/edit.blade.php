@extends('admin.layout.app') @section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Edit Data Siswa</h3>
            </div>

            <div class="title_right"></div>
        </div>
        <div class="row" style="display: block;">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="row">
                            <div class="col-sm-12">
                                <h2>Formulir Edit Siswa</h2>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <form method="post" action="{{route('admin.siswa.update')}}" enctype="multipart/form-data" class="form-horizontal form-label-left">
                            <input type="hidden" name="id" value="{{@$siswa->id}}">
							@csrf
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3">Nama</label>
                                <div class="col-md-9 col-sm-9">
                                    <input class="form-control" type="text" name="nama" placeholder="Masukkan nama" required="" value="{{@$siswa->nama}}">
                                    @if($errors->has('nama'))
                                    <span style="color: red;">
                                      <strong>{{$errors->first('nama')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3">Email</label>
                                <div class="col-md-9 col-sm-9">
                                    <input class="form-control" type="email" name="email" placeholder="Masukkan Email" required="" value="{{@$siswa->email}}">
                                    @if($errors->has('email'))
                                    <span style="color: red;">
                                      <strong>{{$errors->first('email')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3">No HP</label>
                                <div class="col-md-9 col-sm-9">
                                    <input class="form-control" type="number" name="no_hp" placeholder="Masukkan No HP" required="" value="{{@$siswa->no_hp}}">
                                    @if($errors->has('no_hp'))
                                    <span style="color: red;">
                                      <strong>{{$errors->first('no_hp')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3">Pekerjaan</label>
                                <div class="col-md-9 col-sm-9">
                                    <input class="form-control" type="text" name="pekerjaan" placeholder="Masukkan Pekerjaan" value="{{@$siswa->pekerjaan}}">
                                    @if($errors->has('pekerjaan'))
                                    <span style="color: red;">
                                      <strong>{{$errors->first('pekerjaan')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3">Alamat</label>
                                <div class="col-md-9 col-sm-9">
                                    <textarea class="form-control" name="alamat" placeholder="Masukkan Alamat" required="">{{@$siswa->alamat}}</textarea>
                                    @if($errors->has('alamat'))
                                    <span style="color: red;">
                                      <strong>{{$errors->first('alamat')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3">Password</label>
                                <div class="col-md-9 col-sm-9">
                                    <input class="form-control" type="password" name="password" placeholder="Masukkan Password" value="{{@$siswa->pekerjaan}}">
                                    <small>Isi jika ingin merubah</small>
                                    @if($errors->has('password'))
                                    <br>
                                    <span style="color: red;">
                                      <strong>{{$errors->first('password')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3">Foto</label>
                                <div class="col-md-9 col-sm-9">
                                    <input class="form-control" type="file" name="foto">
                                    <small>Isi jika ingin merubah</small>
                                    @if($errors->has('foto'))
                                    <br>
                                    <span style="color: red;">
                                      <strong>{{$errors->first('foto')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9 offset-md-3">
                                    <a href="{{route('admin.siswa')}}" class="btn btn-primary">Kembali</a>
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
