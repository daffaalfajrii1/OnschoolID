<div style="width:975px; height:625px; padding:20px; text-align:center; border: 10px solid #309255">
<div style="width:925px; height:570px; padding:20px; text-align:center; border: 5px solid #eefbf3">
      <img src="{{asset('adm/images/'.$pengaturan->logo_web)}}" style="width: 100px; margin-top: 10px;"></img><br><br>
       <span style="font-size:40px; font-weight:bold">SERTIFIKAT {{strtoupper(@$pengaturan->nama_web)}}</span>
       <br><br>
       <span style="font-size:25px"><i>Diberikan Kepada</i></span>
       <br><br>
       <span style="font-size:30px"><b>{{Session::get('nama')}}</b></span><br/><br/>
       <span style="font-size:25px"><i>Telah Menyelesaikan Kelas di Onschool</i></span> <br/><br/>
       <span style="font-size:30px">{{$kelas->kelas}}</span> <br/><br/>
       <span style="font-size:20px">dengan nilai <b>{{$kelas->nilai_akhir}}</b></span> <br/><br/><br/><br/>
       <span style="font-size:25px"><i>Tanggal</i></span><br>
      <span style="font-size:30px">{{UserHelp::tanggal_indo($kelas->update_billing, true)}}</span>
</div>
</div>