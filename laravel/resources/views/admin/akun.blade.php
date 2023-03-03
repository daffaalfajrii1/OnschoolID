@extends('admin.layout.app') @section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Pengaturan Akun</h3>
            </div>

            <div class="title_right"></div>
        </div>
        <div class="row" style="display: block;">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="row">
                            <div class="col-sm-12">
                                <h2>Pengaturan Akun</h2>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        @if(session('status'))
                <div class="alert alert-success" role="alert">
                 {{session('status')}}
                </div>
                @endif
                        <form method="post" action="{{route('admin.akun.simpan')}}" class="form-horizontal form-label-left">
                            <input type="hidden" name="id" value="{{Session::get('id')}}">
							@csrf
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3">Nama</label>
                                <div class="col-md-9 col-sm-9">
                                    <input class="form-control" type="text" name="nama" placeholder="Masukkan nama" required="" value="{{Session::get('nama')}}">
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
                                    <input class="form-control" type="email" name="email" placeholder="Masukkan email" required="" value="{{Session::get('email')}}">
                                    @if($errors->has('email'))
                                    <span style="color: red;">
                                      <strong>{{$errors->first('email')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3">Password</label>
                                <div class="col-md-9 col-sm-9">
                                    <input class="form-control" type="password" name="password" placeholder="Masukkan password">
                                    <small>Silahkan isi jika ingin merubah</small>
                                    @if($errors->has('password'))
                                    <br>
                                    <span style="color: red;">
                                      <strong>{{$errors->first('password')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9 offset-md-3">
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
