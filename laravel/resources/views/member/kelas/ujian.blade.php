@extends('layout.app_dashboard_kelas') @section('content')
<div class="section">
    <div class="courses-enroll-wrapper" style="min-height: 100vh!important;
    overflow: auto!important;">
        <div class="courses-video-player" style="width: 100%">
            <div class="row">
                <div class="col-md-3">
                    
                </div>
                <div class="col-md-6">
                    <div class="courses-enroll-content">
                        <form action="{{route('member.kelas.ujian.kirim')}}" method="post">
                            <input type="hidden" name="id_kelas" value="{{$kelas->id}}">
                            @csrf
                        <br>
                        <h3>Ujian Kelas {{$kelas->kelas}}</h3>
                        @php $no = 1; @endphp
                        @foreach($kelas_soal as $item)
                        <div class="courses-enroll-tab-content">
                            <input type="hidden" name="id_soal[]" value="{{$item->id}}">
                            <div style="margin-bottom: 10px;">{{$no}}. {{$item->soal}}</div>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="jawaban[{{$item->id}}]" id="flexRadioDefault1{{$item->id}}" value="A">
                              <label class="form-check-label" for="flexRadioDefault1{{$item->id}}">
                                A. {{$item->a}}
                              </label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="jawaban[{{$item->id}}]" id="flexRadioDefault2{{$item->id}}" value="B">
                              <label class="form-check-label" for="flexRadioDefault2{{$item->id}}">
                                B. {{$item->b}}
                              </label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="jawaban[{{$item->id}}]" id="flexRadioDefault3{{$item->id}}" value="C">
                              <label class="form-check-label" for="flexRadioDefault3{{$item->id}}">
                                C. {{$item->c}}
                              </label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="jawaban[{{$item->id}}]" id="flexRadioDefault4{{$item->id}}" value="D">
                              <label class="form-check-label" for="flexRadioDefault4{{$item->id}}">
                                D. {{$item->d}}
                              </label>
                            </div>
                            <div class="form-check">
                              <input class="form-check-input" type="radio" name="jawaban[{{$item->id}}]" id="flexRadioDefault5{{$item->id}}" value="E">
                              <label class="form-check-label" for="flexRadioDefault5{{$item->id}}">
                                E. {{$item->e}}
                              </label>
                            </div>
                        </div>
                        @php $no++; @endphp
                        @endforeach
                        <br>
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </div>
                <div class="col-md-3">
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection