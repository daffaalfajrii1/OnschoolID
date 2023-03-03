@extends('layout.app_dashboard') @section('content')
<style type="text/css">
    .selectnya {
        width: 100%;
        height: 60px;
        padding: 0 25px;
        font-size: 15px;
        color: #52565b;
        -webkit-transition: all 0.3s ease 0s;
        transition: all 0.3s ease 0s;
        border: 1px solid rgba(48, 146, 85, 0.2);
        border-radius: 10px;
        background-color: #fff;
        padding-top: 10px;
    }
    .list {
        width: 100%;
    }
</style>
<div class="page-content-wrapper" style="min-height: 100vh !important; overflow: auto !important;">
    <div class="container-fluid custom-container">
        <div class="form-wrapper">
            @if(Session::get('status'))
            <div class="alert alert-success" role="alert">{{Session::get('status')}}</div>
            @endif
            <form action="{{route('member.profil.simpan')}}" method="post" enctype="multipart/form-data">
                @csrf
                <h3 class="title">Edit <span>Profil</span></h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="single-form">
                            <label>Nama</label>
                            <input type="text" name="nama" value="{{Session::get('nama')}}" placeholder="Nama" required="" readonly=""/>
                            <small style="font-size: 10px">Perubahan nama hanya dapat dilakukan dengan cara menghubungi admin.</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="single-form">
                            <label>Email</label>
                            <input type="email" name="email" value="{{Session::get('email')}}" placeholder="Email" required=""/>
                            @if($errors->has('email'))
                                <span style="color: red;">
                                  <strong>{{$errors->first('email')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="single-form">
                            <label>Pekerjaan</label>
                            <input type="text" name="pekerjaan" value="{{Session::get('pekerjaan')}}" placeholder="Pekerjaan" required=""/>
                            @if($errors->has('pekerjaan'))
                                <span style="color: red;">
                                  <strong>{{$errors->first('pekerjaan')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="single-form">
                            <label>No HP</label>
                            <input type="text" name="no_hp" value="{{Session::get('no_hp')}}" placeholder="No HP" required=""/>
                            @if($errors->has('no_hp'))
                                <span style="color: red;">
                                  <strong>{{$errors->first('no_hp')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="single-form">
                            <label>Alamat</label>
                            <textarea name="alamat" placeholder="Alamat">{{Session::get('alamat')}}</textarea>
                            @if($errors->has('alamat'))
                                <span style="color: red;">
                                  <strong>{{$errors->first('alamat')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="single-form">
                            <label>Password</label>
                            <input type="password" name="password" placeholder="Password Baru">
                            <small style="font-size: 10px;">Isi Jika Ingin Merubah Password.</small>
                            @if($errors->has('password'))
                                <span style="color: red;">
                                  <strong>{{$errors->first('password')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="single-form">
                            <label>Foto</label>
                            <input type="file" name="foto" id="image" accept="image/gif, image/jpeg, image/png" />
                            <small style="font-size: 10px;"><b>Note:</b> Pilih Jika Ingin Merubah. Hanya untuk JPG, JPEG dan PNG.</small>
                            @if($errors->has('foto'))
                            <br>
                                <span style="color: red;">
                                  <strong>{{$errors->first('foto')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="single-form">
                    <button type="submit" class="btn btn-primary w-100">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection