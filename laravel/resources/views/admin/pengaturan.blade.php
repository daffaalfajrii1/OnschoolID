@extends('admin.layout.app') @section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Tambah Pengaturan</h3>
            </div>

            <div class="title_right"></div>
        </div>
        <div class="row" style="display: block;">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="row">
                            <div class="col-sm-12">
                                <h2>Formulir Pengaturan</h2>
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
                        <form method="post" action="{{route('admin.pengaturan.simpan')}}" enctype="multipart/form-data" class="form-horizontal form-label-left">
							@csrf
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3">Nama Web</label>
                                <div class="col-md-9 col-sm-9">
                                    <input type="text" class="form-control" placeholder="Masukkan Nama Web" name="nama_web" required value="{{@$pengaturan->nama_web}}"/>
                                    @if($errors->has('nama_web'))
                                    <span style="color: red;">
                                      <strong>{{$errors->first('nama_web')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3">Email Web</label>
                                <div class="col-md-9 col-sm-9">
                                    <input type="email" class="form-control" placeholder="Masukkan Email Web" name="email_web" required value="{{@$pengaturan->email_web}}"/>
                                    @if($errors->has('email_web'))
                                    <span style="color: red;">
                                      <strong>{{$errors->first('email_web')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3">Deskripsi Web</label>
                                <div class="col-md-9 col-sm-9">
                                    <input type="text" class="form-control" placeholder="Masukkan Deskripsi Web" name="deskripsi_web" required value="{{@$pengaturan->deskripsi_web}}"/>
                                    @if($errors->has('deskripsi_web'))
                                    <span style="color: red;">
                                      <strong>{{$errors->first('deskripsi_web')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3">Embed Map</label>
                                <div class="col-md-9 col-sm-9">
                                    <textarea class="form-control" name="embed_map" placeholder="Masukkan Embed Maps Lokasi">{{@$pengaturan->embed_map}}</textarea>
                                    @if($errors->has('embed_map'))
                                    <span style="color: red;">
                                      <strong>{{$errors->first('embed_map')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3">Alamat</label>
                                <div class="col-md-9 col-sm-9">
                                    <textarea class="form-control" name="alamat_web" placeholder="Masukkan Alamat">{{@$pengaturan->alamat_web}}</textarea>
                                    @if($errors->has('alamat_web'))
                                    <span style="color: red;">
                                      <strong>{{$errors->first('alamat_web')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3">Nomor Whatsapp</label>
                                <div class="col-md-9 col-sm-9">
                                    <input class="form-control" type="number" name="no_wa" placeholder="Masukkan Nomor Whatapps" value="{{@$pengaturan->no_wa}}">
                                    @if($errors->has('no_wa'))
                                    <span style="color: red;">
                                      <strong>{{$errors->first('no_wa')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3">Nama Rekening Pembayaran 1</label>
                                <div class="col-md-9 col-sm-9">
                                    <input class="form-control" type="text" name="nama_rekening1" placeholder="Masukkan nama rekening pembayaran 1" value="{{@$pengaturan->nama_rekening1}}">
                                    @if($errors->has('nama_rekening1'))
                                    <span style="color: red;">
                                      <strong>{{$errors->first('nama_rekening1')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3">Nomor Rekening Pembayaran 1</label>
                                <div class="col-md-9 col-sm-9">
                                    <input class="form-control" type="number" name="no_rekenging1" placeholder="Masukkan nomor rekening pembayaran 1" value="{{@$pengaturan->no_rekenging1}}">
                                    @if($errors->has('no_rekenging1'))
                                    <span style="color: red;">
                                      <strong>{{$errors->first('no_rekenging1')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3">Bank Pembayaran 1</label>
                                <div class="col-md-9 col-sm-9">
                                    <select class="form-control" name="bank1">
                                        <option value="BNI" {{@$pengaturan->bank1 == 'BNI' ? 'selected' : ''}}>BNI</option>
                                        <option value="BRI" {{@$pengaturan->bank1 == 'BRI' ? 'selected' : ''}}>BRI</option>
                                        <option value="BCA" {{@$pengaturan->bank1 == 'BCA' ? 'selected' : ''}}>BCA</option>
                                        <option value="Mandiri" {{@$pengaturan->bank1 == 'Mandiri' ? 'selected' : ''}}>Mandiri</option>
                                        <option value="Danamon" {{@$pengaturan->bank1 == 'Danamon' ? 'selected' : ''}}>Danamon</option>
                                    </select>
                                    @if($errors->has('bank1'))
                                    <span style="color: red;">
                                      <strong>{{$errors->first('bank1')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3">Nama Rekening Pembayaran 2</label>
                                <div class="col-md-9 col-sm-9">
                                    <input class="form-control" type="text" name="nama_rekening2" placeholder="Masukkan nama rekening pembayaran 2" value="{{@$pengaturan->nama_rekening2}}">
                                    @if($errors->has('nama_rekening2'))
                                    <span style="color: red;">
                                      <strong>{{$errors->first('nama_rekening2')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3">Nomor Rekening Pembayaran 2</label>
                                <div class="col-md-9 col-sm-9">
                                    <input class="form-control" type="number" name="no_rekenging2" placeholder="Masukkan nomor rekening pembayaran 2" value="{{@$pengaturan->no_rekenging2}}">
                                    @if($errors->has('no_rekenging2'))
                                    <span style="color: red;">
                                      <strong>{{$errors->first('no_rekenging2')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3">Bank Pembayaran 2</label>
                                <div class="col-md-9 col-sm-9">
                                    <select class="form-control" name="bank2">
                                        <option value="BNI" {{@$pengaturan->bank2 == 'BNI' ? 'selected' : ''}}>BNI</option>
                                        <option value="BRI" {{@$pengaturan->bank2 == 'BRI' ? 'selected' : ''}}>BRI</option>
                                        <option value="BCA" {{@$pengaturan->bank2 == 'BCA' ? 'selected' : ''}}>BCA</option>
                                        <option value="Mandiri" {{@$pengaturan->bank2 == 'Mandiri' ? 'selected' : ''}}>Mandiri</option>
                                        <option value="Danamon" {{@$pengaturan->bank2 == 'Danamon' ? 'selected' : ''}}>Danamon</option>
                                    </select>
                                    @if($errors->has('bank2'))
                                    <span style="color: red;">
                                      <strong>{{$errors->first('bank2')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3">Biaya Penarikan (%)</label>
                                <div class="col-md-9 col-sm-9">
                                    <input class="form-control" type="number" name="biaya_penarikan" placeholder="Masukkan biaya penarikan" value="{{@$pengaturan->biaya_penarikan}}">
                                    @if($errors->has('biaya_penarikan'))
                                    <span style="color: red;">
                                      <strong>{{$errors->first('biaya_penarikan')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3">Minimal Penarikan</label>
                                <div class="col-md-9 col-sm-9">
                                    <input class="form-control" type="number" name="minimal_penarikan" placeholder="Masukkan minimal penarikan" value="{{@$pengaturan->minimal_penarikan}}">
                                    @if($errors->has('minimal_penarikan'))
                                    <span style="color: red;">
                                      <strong>{{$errors->first('minimal_penarikan')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3">Logo Web</label>
                                <div class="col-md-9 col-sm-9">
                                    <input class="form-control" type="file" name="logo_web">
                                    <small>Silahkan pilih jika ingin merubah.</small>
                                    @if($errors->has('logo_web'))
                                    <br>
                                    <span style="color: red;">
                                      <strong>{{$errors->first('logo_web')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3">ID Merchant Midtrans</label>
                                <div class="col-md-9 col-sm-9">
                                    <input class="form-control" type="text" name="mercant_id" placeholder="Masukkan ID Merchant Midtrans" value="{{@$pengaturan->mercant_id}}">
                                    @if($errors->has('mercant_id'))
                                    <span style="color: red;">
                                      <strong>{{$errors->first('mercant_id')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3">Client Key Midtrans</label>
                                <div class="col-md-9 col-sm-9">
                                    <input class="form-control" type="text" name="client_key" placeholder="Masukkan Client Key Midtrans" value="{{@$pengaturan->client_key}}">
                                    @if($errors->has('client_key'))
                                    <span style="color: red;">
                                      <strong>{{$errors->first('client_key')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3">Server Key Midtrans</label>
                                <div class="col-md-9 col-sm-9">
                                    <input class="form-control" type="text" name="server_key" placeholder="Masukkan Server Key Midtrans" value="{{@$pengaturan->server_key}}">
                                    @if($errors->has('server_key'))
                                    <span style="color: red;">
                                      <strong>{{$errors->first('server_key')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3">Judul Kecil Beranda</label>
                                <div class="col-md-9 col-sm-9">
                                    <input class="form-control" type="text" name="title_kecil_home" placeholder="Masukkan Judul Kecil Beranda" value="{{@$pengaturan->title_kecil_home}}">
                                    @if($errors->has('title_kecil_home'))
                                    <span style="color: red;">
                                      <strong>{{$errors->first('title_kecil_home')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3">Judul Besar Beranda</label>
                                <div class="col-md-9 col-sm-9">
                                    <input class="form-control" type="text" name="title_besar_home" placeholder="Masukkan Judul Besar Beranda" value="{{@$pengaturan->title_besar_home}}">
                                    @if($errors->has('title_besar_home'))
                                    <span style="color: red;">
                                      <strong>{{$errors->first('title_besar_home')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3">Penjelasan Beranda</label>
                                <div class="col-md-9 col-sm-9">
                                    <input class="form-control" type="text" name="penjelasan_home" placeholder="Masukkan Penjelasan Beranda" value="{{@$pengaturan->penjelasan_home}}">
                                    @if($errors->has('penjelasan_home'))
                                    <span style="color: red;">
                                      <strong>{{$errors->first('penjelasan_home')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3">Facebook</label>
                                <div class="col-md-9 col-sm-9">
                                    <input class="form-control" type="text" name="facebook" placeholder="Masukkan Facebook" value="{{@$pengaturan->facebook}}">
                                    @if($errors->has('facebook'))
                                    <span style="color: red;">
                                      <strong>{{$errors->first('facebook')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3">Instagram</label>
                                <div class="col-md-9 col-sm-9">
                                    <input class="form-control" type="text" name="instagram" placeholder="Masukkan Instagram" value="{{@$pengaturan->instagram}}">
                                    @if($errors->has('instagram'))
                                    <span style="color: red;">
                                      <strong>{{$errors->first('instagram')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div><div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3">Twitter</label>
                                <div class="col-md-9 col-sm-9">
                                    <input class="form-control" type="text" name="twitter" placeholder="Masukkan Twitter" value="{{@$pengaturan->twitter}}">
                                    @if($errors->has('twitter'))
                                    <span style="color: red;">
                                      <strong>{{$errors->first('twitter')}}</strong>
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
