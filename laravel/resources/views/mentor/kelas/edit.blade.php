@extends('mentor.layout.app') @section('content')
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
            @if(Session::get('gagal'))
            <div class="alert alert-danger" role="alert">{{Session::get('gagal')}}</div>
            @endif @if(Session::get('berhasil'))
            <div class="alert alert-success" role="alert">{{Session::get('berhasil')}}</div>
            @endif
            <form method="post" action="{{route('mentor.kelas.update')}}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{$kelas->id}}">
                <h3 class="title">Detail <span>Kelas</span></h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="single-form">
                            <label>Nama Kelas</label>
                            <input type="text" name="kelas" required placeholder="Masukkan Nama Kelas" value="{{$kelas->kelas}}" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="single-form">
                            <label>Kategori</label><br />
                            <select name="id_kategori" id="id_kategori" required="" class="selectnya">
                                @foreach($kategori as $item)
                                    <option value="{{$item->id}}" {{$kelas->id_kategori == $item->id ? 'selected' : ''}}>{{$item->kategori}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="single-form">
                            <label>Deskripsi Singkat</label>
                            <textarea type="text" placeholder="Deskripsi Singkat" name="deskripsi_singkat" required>{{$kelas->deskripsi_singkat}}</textarea>
                            @if($errors->has('deskripsi_singkat'))
                                <span style="color: red;">
                                    <strong>{{$errors->first('deskripsi_singkat')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="single-form">
                            <label>Biaya Kelas</label>
                            <input type="number" name="biaya" required placeholder="Masukkan Biaya Kelas" value="{{$kelas->biaya}}" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="single-form">
                            <label>Sertifikat</label><br />
                            <select name="sertifikat" id="sertifikat" required="" class="selectnya">
                                <option value="Ada" {{$kelas->sertifikat == 'Ada' ? 'selected' : ''}}>Ada</option>
                                <option value="Tidak Ada" {{$kelas->sertifikat == 'Tidak Ada' ? 'selected' : ''}}>Tidak Ada</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="single-form">
                            <label>Deskripsi Lengkap</label>
                            <textarea type="text" placeholder="Deskripsi Singkat" id="deskripsi" name="deskripsi" required>{{$kelas->deskripsi}}</textarea>
                            @if($errors->has('deskripsi'))
                                <span style="color: red;">
                                    <strong>{{$errors->first('deskripsi')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <br>
                <hr>
                <h3 class="title">Media <span>Kelas</span></h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="single-form">
                            <label>Upload Gambar</label>
                            <input type="file" name="my-image" id="image" accept="image/gif, image/jpeg, image/png" />
                            <small style="font-size: 10px;"><b>Note:</b> Kosongkan jika tidak ingin mengubah dan hanya untuk JPG, JPEG dan PNG. kami menyarankan ukuran 600px * 450px.</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="single-form">
                            <label>Upload Video</label>
                            <input type="text" name="video_url" required placeholder="Masukkan URL Video" value="{{$kelas->video_url}}" />
                        </div>
                    </div>
                </div>
                <br>
                <hr>
                <h3 class="title">Materi <span>Kelas</span></h3>
                @php $no = 1 @endphp
                @foreach($kelas_materi as $item)
                @if($no == 1)
                <div class="row after-add-more-materi">
                    <div class="col-md-5">
                        <div class="single-form">
                            <label>Judul Materi</label>
                            <input type="text" name="judul_materi[]" placeholder="Silahkan isi judul materi" value="{{$item->judul_materi}}" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="single-form">
                            <label>Upload Video</label>
                            <input type="text" name="link_materi[]" required placeholder="Silahkan isi link video materi" value="{{$item->video}}" />
                            <small style="font-size: 10px;">Contoh Linknya : <b>https://www.youtube.com/watch?v=reghrehg546y45</b>, <br>maka silahkan isi : <b>https://www.youtube.com/embed/reghrehg546y45</b></small>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="single-form">
                            <br>
                            <button type="button" class="btn btn-primary w-100 add-more-materi" style="margin-top: 10px;"><i class="icofont-plus" style="margin-left: 0px!important;"></i></button>
                        </div>
                    </div>
                </div>
                @else
                <div class="row more-materi">
                    <div class="col-md-5">
                        <div class="single-form">
                            <label>Judul Materi</label>
                            <input type="text" name="judul_materi[]" placeholder="Silahkan isi judul materi" value="{{$item->judul_materi}}"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="single-form">
                            <label>Upload Video</label>
                            <input type="text" name="link_materi[]" required placeholder="Silahkan isi link video materi" value="{{$item->video}}"/>
                            <small style="font-size: 10px;">Contoh Linknya : <b>https://www.youtube.com/watch?v=reghrehg546y45</b>, <br>maka silahkan isi : <b>https://www.youtube.com/embed/reghrehg546y45</b></small>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="single-form">
                            <br>
                            <button type="button" class="btn btn-danger w-100 remove-materi" style="margin-top: 10px;"><i class="icofont-trash" style="margin-left: 0px!important;"></i></button>
                        </div>
                    </div>
                </div>
                @endif
                @php $no++ @endphp
                @endforeach
                <br>
                <hr>
                <h3 class="title">Tools <span>Kelas</span></h3>
                @php $no = 1 @endphp
                @foreach($kelas_tools as $item)
                @if($no == 1)
                <div class="row after-add-more-tool">
                    <div class="col-md-3">
                        <div class="single-form">
                            <label>Nama Tools</label>
                            <input type="text" name="tools[]" placeholder="Silahkan isi nama tools" value="{{$item->nama_tools}}" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-form">
                            <label>Keterangan</label>
                            <input type="text" name="keterangan[]" required placeholder="Silahkan isi keterangan tools" value="{{$item->keterangan}}" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-form">
                            <label>Link Download Tools</label>
                            <input type="text" name="download[]" required placeholder="Silahkan isi link download tools" value="{{$item->download}}" />
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="single-form">
                            <br>
                            <button type="button" class="btn btn-primary w-100 add-more-tool" style="margin-top: 10px;"><i class="icofont-plus" style="margin-left: 0px!important;"></i></button>
                        </div>
                    </div>
                </div>
                @else
                <div class="row more-tool">
                    <div class="col-md-3">
                        <div class="single-form">
                            <label>Nama Tools</label>
                            <input type="text" name="tools[]" placeholder="Silahkan isi nama tools" value="{{$item->nama_tools}}"/>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-form">
                            <label>Keterangan</label>
                            <input type="text" name="keterangan[]" required placeholder="Silahkan isi keterangan tools" value="{{$item->keterangan}}" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-form">
                            <label>Link Download Tools</label>
                            <input type="text" name="download[]" required placeholder="Silahkan isi link download tools" value="{{$item->download}}" />
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="single-form">
                            <br>
                            <button type="button" class="btn btn-danger w-100 remove-tool" style="margin-top: 10px;"><i class="icofont-trash" style="margin-left: 0px!important;"></i></button>
                        </div>
                    </div>
                </div>
                @endif
                @php $no++ @endphp
                @endforeach
                <br>
                <hr>
                <h3 class="title">Soal Ujian <span>Kelas</span></h3>
                @php $no = 1 @endphp
                @foreach($kelas_soal as $item)
                @if($no == 1)
                <div class="row after-add-more-ujian">
                    <div class="col-md-11">
                        <div class="single-form">
                            <label>Soal</label>
                            <input type="text" name="soal[]" required placeholder="Silahkan isi" value="{{$item->soal}}">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="single-form">
                            <br>
                            <button type="button" class="btn btn-primary w-100 add-more-ujian" style="margin-top: 10px;"><i class="icofont-plus" style="margin-left: 0px!important;"></i></button>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="single-form">
                            <label>A</label>
                            <input type="text" name="a[]" required placeholder="Pilihan A" value="{{$item->a}}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="single-form">
                            <label>B</label>
                            <input type="text" name="b[]" required placeholder="Pilihan B" value="{{$item->b}}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="single-form">
                            <label>C</label>
                            <input type="text" name="c[]" required placeholder="Pilihan C" value="{{$item->c}}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="single-form">
                            <label>D</label>
                            <input type="text" name="d[]" required placeholder="Pilihan D" value="{{$item->d}}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="single-form">
                            <label>E</label>
                            <input type="text" name="e[]" required placeholder="Pilihan E" value="{{$item->e}}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="single-form">
                            <label>Jawaban</label><br />
                            <select name="jawaban[]" required="" class="selectnya">
                                <option value="A" <?= $item->jawaban == 'A' ? 'selected' : '' ?>>A</option>
                                <option value="B" <?= $item->jawaban == 'B' ? 'selected' : '' ?>>B</option>
                                <option value="C" <?= $item->jawaban == 'C' ? 'selected' : '' ?>>C</option>
                                <option value="D" <?= $item->jawaban == 'D' ? 'selected' : '' ?>>D</option>
                                <option value="E" <?= $item->jawaban == 'E' ? 'selected' : '' ?>>E</option>
                            </select>
                        </div>
                    </div>
                </div>
                @else
                <div class="row more-ujian">
                    <div class="col-md-11">
                        <div class="single-form">
                            <label>Soal</label>
                            <input type="text" name="soal[]" required placeholder="Silahkan isi" value="{{$item->soal}}">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="single-form">
                            <br>
                            <button type="button" class="btn btn-danger w-100 remove-ujian" style="margin-top: 10px;"><i class="icofont-trash" style="margin-left: 0px!important;"></i></button>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="single-form">
                            <label>A</label>
                            <input type="text" name="a[]" required placeholder="Pilihan A" value="{{$item->a}}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="single-form">
                            <label>B</label>
                            <input type="text" name="b[]" required placeholder="Pilihan B" value="{{$item->b}}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="single-form">
                            <label>C</label>
                            <input type="text" name="c[]" required placeholder="Pilihan C" value="{{$item->c}}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="single-form">
                            <label>D</label>
                            <input type="text" name="d[]" required placeholder="Pilihan D" value="{{$item->d}}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="single-form">
                            <label>E</label>
                            <input type="text" name="e[]" required placeholder="Pilihan E" value="{{$item->e}}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="single-form">
                            <label>Jawaban</label><br />
                            <select name="jawaban[]" required="" class="selectnya">
                                <option value="A" <?= $item->jawaban == 'A' ? 'selected' : '' ?>>A</option>
                                <option value="B" <?= $item->jawaban == 'B' ? 'selected' : '' ?>>B</option>
                                <option value="C" <?= $item->jawaban == 'C' ? 'selected' : '' ?>>C</option>
                                <option value="D" <?= $item->jawaban == 'D' ? 'selected' : '' ?>>D</option>
                                <option value="E" <?= $item->jawaban == 'E' ? 'selected' : '' ?>>E</option>
                            </select>
                        </div>
                    </div>
                </div>
                @endif
                @php $no++ @endphp
                @endforeach
                <br>
                <hr>
                <h3 class="title">FAQ <span>Kelas</span></h3>
                @php $no = 1 @endphp
                @foreach($kelas_faq as $item)
                @if($no == 1)
                <div class="row after-add-more-faq">
                    <div class="col-md-5">
                        <div class="single-form">
                            <label>Pertanyaan</label>
                            <input type="text" name="pertanyaan[]" placeholder="Silahkan isi pertanyaan" value="{{$item->pertanyaan}}" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="single-form">
                            <label>Jawaban</label>
                            <input type="text" name="faq_jawaban[]" required placeholder="Silahkan isi jawaban" value="{{$item->jawaban}}" />
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="single-form">
                            <br>
                            <button type="button" class="btn btn-primary w-100 add-more-faq" style="margin-top: 10px;"><i class="icofont-plus" style="margin-left: 0px!important;"></i></button>
                        </div>
                    </div>
                </div>
                @else
                <div class="row more-faq">
                    <div class="col-md-5">
                        <div class="single-form">
                            <label>Pertanyaan</label>
                            <input type="text" name="pertanyaan[]" placeholder="Silahkan isi pertanyaan" value="{{$item->pertanyaan}}" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="single-form">
                            <label>Jawaban</label>
                            <input type="text" name="jawaban[]" required placeholder="Silahkan isi jawaban" value="{{$item->jawaban}}" />
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="single-form">
                            <br>
                            <button type="button" class="btn btn-danger w-100 remove-faq" style="margin-top: 10px;"><i class="icofont-trash" style="margin-left: 0px!important;"></i></button>
                        </div>
                    </div>
                </div>
                @endif
                @php $no++ @endphp
                @endforeach
                <div class="row">
                    <div class="col-md-12">
                        <div class="single-form">
                            <label>Pesan Untuk Administrator</label>
                            <textarea name="pesan" placeholder="Silahkan isi pesan anda untuk Administrator sebagai bahan pertimbangan tambahan">{{$kelas->pesan}}</textarea>
                        </div>
                    </div>
                </div>
                <div class="single-form">
                    <button type="submit" class="btn btn-primary w-100">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
</div>
<script src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('assets/ckeditor/plugin.js') }}"></script>
<script type="text/javascript">
    CKEDITOR.replace( 'deskripsi' );
    $(".add-more-materi").click(function(){ 
        var html = `<div class="row more-materi">
                    <div class="col-md-5">
                        <div class="single-form">
                            <label>Judul Materi</label>
                            <input type="text" name="judul_materi[]" placeholder="Silahkan isi judul materi" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="single-form">
                            <label>Upload Video</label>
                            <input type="text" name="link_materi[]" required placeholder="Silahkan isi link video materi" />
                            <small style="font-size: 10px;">Contoh Linknya : <b>https://www.youtube.com/watch?v=reghrehg546y45</b>, <br>maka silahkan isi : <b>https://www.youtube.com/embed/reghrehg546y45</b></small>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="single-form">
                            <br>
                            <button type="button" class="btn btn-danger w-100 remove-materi" style="margin-top: 10px;"><i class="icofont-trash" style="margin-left: 0px!important;"></i></button>
                        </div>
                    </div>
                </div>`;
        $(".after-add-more-materi").after(html);
    });

    $("body").on("click",".remove-materi",function(){ 
        $(this).parents(".more-materi").remove();
    });

    $(".add-more-tool").click(function(){ 
        var html = `<div class="row more-tool">
                    <div class="col-md-3">
                        <div class="single-form">
                            <label>Nama Tools</label>
                            <input type="text" name="tools[]" placeholder="Silahkan isi nama tools" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-form">
                            <label>Keterangan</label>
                            <input type="text" name="keterangan[]" required placeholder="Silahkan isi keterangan tools" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-form">
                            <label>Link Download Tools</label>
                            <input type="text" name="download[]" required placeholder="Silahkan isi link download tools" />
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="single-form">
                            <br>
                            <button type="button" class="btn btn-danger w-100 remove-tool" style="margin-top: 10px;"><i class="icofont-trash" style="margin-left: 0px!important;"></i></button>
                        </div>
                    </div>
                </div>`;
        $(".after-add-more-tool").after(html);
    });

    $("body").on("click",".remove-tool",function(){ 
        $(this).parents(".more-tool").remove();
    });

    let no_soal = 1;
    $(".add-more-ujian").click(function(){ 
        no_soal++;
        var html = `<div class="row more-ujian">
                    <div class="col-md-11">
                        <div class="single-form">
                            <label>Soal</label>
                            <input type="text" name="soal[]" required placeholder="Silahkan isi">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="single-form">
                            <br>
                            <button type="button" class="btn btn-danger w-100 remove-ujian" style="margin-top: 10px;"><i class="icofont-trash" style="margin-left: 0px!important;"></i></button>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="single-form">
                            <label>A</label>
                            <input type="text" name="a[]" required placeholder="Pilihan A">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="single-form">
                            <label>B</label>
                            <input type="text" name="b[]" required placeholder="Pilihan B">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="single-form">
                            <label>C</label>
                            <input type="text" name="c[]" required placeholder="Pilihan C">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="single-form">
                            <label>D</label>
                            <input type="text" name="d[]" required placeholder="Pilihan D">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="single-form">
                            <label>E</label>
                            <input type="text" name="e[]" required placeholder="Pilihan E">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="single-form">
                            <label>Jawaban</label><br />
                            <select name="jawaban[]" required="" class="selectnya">
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                                <option value="E">E</option>
                            </select>
                        </div>
                    </div>
                </div>`;
        $(".after-add-more-ujian").append(html);
    });

    $("body").on("click",".remove-ujian",function(){ 
        $(this).parents(".more-ujian").remove();
    });

    $(".add-more-faq").click(function(){ 
        var html = `<div class="row more-faq">
                    <div class="col-md-5">
                        <div class="single-form">
                            <label>Pertanyaan</label>
                            <input type="text" name="pertanyaan[]" placeholder="Silahkan isi pertanyaan" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="single-form">
                            <label>Jawaban</label>
                            <input type="text" name="jawaban[]" required placeholder="Silahkan isi jawaban" />
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="single-form">
                            <br>
                            <button type="button" class="btn btn-danger w-100 remove-faq" style="margin-top: 10px;"><i class="icofont-trash" style="margin-left: 0px!important;"></i></button>
                        </div>
                    </div>
                </div>`;
        $(".after-add-more-faq").after(html);
    });

    $("body").on("click",".remove-faq",function(){ 
        $(this).parents(".more-faq").remove();
    });
</script>
@endsection
