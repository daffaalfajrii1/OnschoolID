@extends('admin.layout.app') @section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Edit Data Mentor</h3>
            </div>

            <div class="title_right"></div>
        </div>
        <div class="row" style="display: block;">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="row">
                            <div class="col-sm-12">
                                <h2>Formulir Edit Mentor</h2>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <form method="post" action="{{route('admin.mentor.update')}}" class="form-horizontal form-label-left"  enctype="multipart/form-data">
                            <input type="hidden" value="{{$mentor->id}}" name="id">
							@csrf
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3">Nama</label>
                                <div class="col-md-9 col-sm-9">
                                    <input class="form-control" type="text" name="nama" placeholder="Masukkan nama mentor" required="" value="{{$mentor->nama}}">
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
                                    <input class="form-control" type="email" name="email" placeholder="Masukkan email mentor" required="" value="{{$mentor->email}}">
                                    @if($errors->has('email'))
                                    <span style="color: red;">
                                      <strong>{{$errors->first('email')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3">Jenis Kelamin</label>
                                <div class="col-md-9 col-sm-9">
                                    <select  class="form-control" name="jenis_kelamin" id="jenis_kelamin" required="">
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="Laki - Laki" <?= $mentor->jenis_kelamin == 'Laki - Laki' ? 'selected' : ''?>>Laki - Laki</option>
                                        <option value="Perempuan" <?= $mentor->jenis_kelamin == 'Perempuan' ? 'selected' : ''?>>Perempuan</option>
                                    </select>
                                    @if($errors->has('jenis_kelamin'))
                                    <span style="color: red;">
                                      <strong>{{$errors->first('jenis_kelamin')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3">No HP</label>
                                <div class="col-md-9 col-sm-9">
                                    <input class="form-control" type="text" name="no_hp" placeholder="Masukkan No HP mentor" required="" onkeypress="return hanyaAngka(event)" value="{{$mentor->no_hp}}">
                                    @if($errors->has('no_hp'))
                                    <span style="color: red;">
                                      <strong>{{$errors->first('no_hp')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3">Password</label>
                                <div class="col-md-9 col-sm-9">
                                    <input class="form-control" type="password" name="password" placeholder="Masukkan password mentor">
                                    <small>*Kosongkan Jika Tidak Ingin Merubah</small>
                                    @if($errors->has('password'))
                                    <br>
                                    <span style="color: red;">
                                      <strong>{{$errors->first('password')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3">Pendidikan</label>
                                <div class="col-md-9 col-sm-9">
                                    <textarea class="form-control" name="pendidikan" required="" placeholder="Masukkan pendidikan mentor">{{$mentor->pendidikan}}</textarea>
                                    @if($errors->has('pendidikan'))
                                    <span style="color: red;">
                                      <strong>{{$errors->first('pendidikan')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3">Alamat</label>
                                <div class="col-md-9 col-sm-9">
                                    <textarea class="form-control" name="alamat" required="" placeholder="Masukkan alamat mentor">{{$mentor->alamat}}</textarea>
                                    @if($errors->has('alamat'))
                                    <span style="color: red;">
                                      <strong>{{$errors->first('alamat')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3">Deskripsi Diri</label>
                                <div class="col-md-9 col-sm-9">
                                    <textarea class="form-control" name="deskripsi" required="" placeholder="Masukkan deskripsi diri mentor">{{$mentor->deskripsi}}</textarea>
                                    @if($errors->has('deskripsi'))
                                    <span style="color: red;">
                                      <strong>{{$errors->first('deskripsi')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3">Foto</label>
                                <div class="col-md-9 col-sm-9">
                                    <input class="form-control" type="file" name="foto" id="foto">
                                    <small>*Kosongkan Jika Tidak Ingin Merubah</small>
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
                                    <a href="{{route('admin.mentor')}}" class="btn btn-primary">Kembali</a>
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
