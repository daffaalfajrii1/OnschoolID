@extends('layout.app_dashboard') @section('content')
<div class="page-content-wrapper" style="min-height: 100vh!important;
    overflow: auto!important;">
    <div class="container-fluid custom-container" style="margin-top: -50px!important;">
        <div class="admin-courses-tab">
            <h3 class="title">Billing Saya</h3>

            <div class="courses-tab-wrapper">
                <div class="tab-btn">
                    
                </div>
            </div>
        </div>
        <div class="engagement-courses table-responsive">
            @if(session('status_nya'))
                        <div class="alert alert-success" role="alert">
                         {{session('status_nya')}}
                        </div>
                        @endif
            <p><b>Note : </b>Untuk Bayar Manual ke BANK BENGKULU <i> No Rek {{@$pengaturan->no_rekenging1}} A/n {{@$pengaturan->nama_rekening1}}</i> </p>
            <table class="table">
                <thead style="background-color: #e5f4eb; border-radius: 10px;">
                    <tr>
                        <th style="font-size: 18px; color: #212832; padding: 15px;">ID Invoice</th>
                        <th style="font-size: 18px; color: #212832; padding: 15px;">Kelas</th>
                        <th style="font-size: 18px; color: #212832; padding: 15px;">Harga</th>
                        <th style="font-size: 18px; color: #212832; padding: 15px;">Status</th>
                        <th style="font-size: 18px; color: #212832; padding: 15px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($billing) > 0) @foreach($billing as $item)
                    <tr>
                        <th scope="row">{{$item->id}}</th>
                        <td>{{$item->kelas}}</td>
                        <td>{{UserHelp::rupiah($item->total)}}</td>
                        <td>
                            @if($item->status == 'Belum Bayar')
                                            <div class="badge bg-danger text-white">{{$item->status}}</div>
                                            @elseif($item->status == 'Terbayar')
                                            <div class="badge bg-success text-white">{{$item->status}}</div>
                                            @else
                                            <div class="badge bg-dark text-white">{{$item->status}}</div>
                                            @endif
                        </td>
                        <td>
                            @if($item->status == 'Terbayar')
                                            <div class="badge bg-success text-white">Sudah Terbayar</div>
                                            @elseif($item->status != 'Menunggu Konfirmasi')
                                            <a class="btn btn-primary bayarmidtrans" href="#bayarmidtrans" data-snap_token="{{$item->snap_token}}">Bayar Dengan Midtrans</a>
                                            <a class="btn btn-dark konfirmasi" href="#konfirmasi" data-id_billing="{{$item->id}}">Konfirmasi Pembayaran</a>
                                            @else
                                            <div class="badge bg-primary text-white">Sudah Mengirim Bukti Pembayaran</div>
                                            @endif
                        </td>
                    </tr>
                    @endforeach @else
                    <tr>
                        <td colspan="5">Belum ada data pembelian</td>
                    </tr>
                    @endif
                </tbody>
            </table>
            {!!@$billing->appends(['cari'=>@$_GET['cari']])->links()!!}
        </div>
    </div>
</div>
<div class="modal fade" id="appKonfirmasi" tabindex="-1" aria-labelledby="appKonfirmasilabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            
            <!-- Modal header -->
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white" id="appKonfirmasilabel">Konfirmasi Pembayaran</h5>
                <button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal" aria-label="Close" style="padding-right: 15px;"><i class="icofont-close"></i></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body p-5">
                <form method="post" action="{{route('member.konfirmasi')}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="id_billing">
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="single-form">
                                <label>Bukti Transfer</label>
                                <input type="file" name="file" required style="padding-top: 15px;"/>
                            </div>
                            @if(session('gagal_upload'))
                            <small style="color: red;">{{session('gagal_upload')}}</small>
                            @endif
                        </div>
                        <div class="col-12 gap-2">
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary" type="submit">Kirim</button>
                            </div>
                        </div>
                    </div>      
                </form>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@if(session('gagal_upload'))
<script type="text/javascript">
    $(document).ready(function(){
        $('#appKonfirmasi').modal('show');
    });
</script>
@endif
<script src="https://app.midtrans.com/snap/snap.js" data-client-key="{{@$pengaturan->client_key}}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $(".konfirmasi").click(function(){ 
            $("#id_billing").val($(this).data('id_billing'));
            $('#appKonfirmasi').modal('show');
        });
        var _token='{{csrf_token()}}';
        $(".bayarmidtrans").click(function(e){
            e.preventDefault();

                snap.pay($(this).data('snap_token'), {
                    // Optional
                    onSuccess: function(result) {
                        /* You may add your own js here, this is just example */
                        // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                        // console.log(result);

                        if(result.status_code == '200'){
                            const Form_Data       = new FormData();
                            Form_Data.append('_token',_token);
                            Form_Data.append('id', result.order_id);
                            fetch('{{route('konfirmasi')}}', { method: 'POST',body:Form_Data}).then(res => res.json()).then(data => 
                            {
                                if(data.error == false){
                                    location.reload();
                                }

                            });
                        }
                    },
                    // Optional
                    onPending: function(result) {
                        /* You may add your own js here, this is just example */
                        // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                        // console.log(result)
                    },
                    // Optional
                    onError: function(result) {
                        /* You may add your own js here, this is just example */
                        // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                        // console.log(result)
                    }
                });
        });
    });
</script>
@endsection