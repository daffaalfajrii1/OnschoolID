@extends('admin.layout.app') @section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Edit Data Blog</h3>
            </div>

            <div class="title_right"></div>
        </div>
        <div class="row" style="display: block;">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <div class="row">
                            <div class="col-sm-12">
                                <h2>Formulir Edit Blog</h2>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <form method="post" action="{{route('admin.blog.update')}}" class="form-horizontal form-label-left" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="{{$blog->id}}">
							@csrf
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3">Judul Blog</label>
                                <div class="col-md-9 col-sm-9">
                                    <input type="text" class="form-control" placeholder="Masukkan Judul Blog" name="judul" required value="{{$blog->judul}}"/>
                                    @if($errors->has('judul'))
                                    <span style="color: red;">
                                      <strong>{{$errors->first('judul')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3">Isi Blog</label>
                                <div class="col-md-9 col-sm-9">
                                    <textarea class="form-control" id="isi" name="isi" placeholder="Isi Blog" required>{{$blog->isi}}</textarea>
                                    @if($errors->has('isi'))
                                    <span style="color: red;">
                                      <strong>{{$errors->first('isi')}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 col-sm-3">Gambar Blog</label>
                                <div class="col-md-9 col-sm-9">
                                    <input type="file" class="form-control" name="gambar" />
                                    <small>*Pilih jiki ingin merubah</small>
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
                                    <a href="{{route('admin.blog')}}" class="btn btn-primary">Kembali</a>
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
<script src="{{ asset('adm/vendors/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('adm/vendors/plugin.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){  
        CKEDITOR.replace( 'isi' );
    });
</script>
@endsection
