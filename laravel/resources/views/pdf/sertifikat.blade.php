
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body, html {
  height: 100%;
  margin: 0;
}

.bg {
  /* The image used */
  background-image: url(<?= asset('assets/images/bg.jpg') ?>);

  /* Full height */
  height: 100%; 

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  text-align: center;
}
@page { margin: 0px; }
body { margin: 0px; }
</style>
</head>
<body>
<div class="bg">
    <br><br><br><br>
    <img src="{{asset('adm/images/'.$pengaturan->logo_web)}}" style="width: 100px; margin-top: 10px;"></img><br><br>
       <span style="font-size:40px; font-weight:bold">SERTIFIKAT {{strtoupper(@$pengaturan->nama_web)}}</span>
       <br><br>
       <span style="font-size:25px"><i>Diberikan Kepada</i></span>
       <br><br>
       <span style="font-size:30px"><b>{{Session::get('nama')}}</b></span><br/><br/>
       <span style="font-size:25px"><i>Telah Menyelesaikan Kelas di Onschool</i></span> <br/><br/>
       <span style="font-size:30px">{{$kelas->kelas}}</span> <br/><br/>
       <span style="font-size:20px">dengan nilai <b>{{$kelas->nilai_akhir}}</b></span> <br/><br/><br/>
       <span style="font-size:25px"><i>Tanggal</i></span><br>
      <span style="font-size:30px">{{UserHelp::tanggal_indo($kelas->update_billing, true)}}</span>
</div>

</body>
</html>