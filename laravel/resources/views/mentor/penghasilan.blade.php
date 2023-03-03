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
        <div class="row">
            <div class="col-md-3">
                <div class="overview-box">
                    <div class="single-box" style="width: 100%;">
                        <h5 class="title">Penghasilan Hari ini</h5>
                        <div class="count">{{UserHelp::rupiah($total_pemasukan_hari_ini)}}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="overview-box">
                    <div class="single-box" style="width: 100%;">
                        <h5 class="title">Penghasilan Keseluruhan</h5>
                        <div class="count">{{UserHelp::rupiah($total_pemasukan)}}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="overview-box">
                    <div class="single-box" style="width: 100%;">
                        <h5 class="title">Penarikan Bulan Kemaren</h5>
                        <div class="count">{{UserHelp::rupiah($total_penarikan_bulan_kemaren)}}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="overview-box">
                    <div class="single-box" style="width: 100%;">
                        <h5 class="title">Penarikan Bulan Ini</h5>
                        <div class="count">{{UserHelp::rupiah($total_penarikan_bulan_ini)}}</div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="overview-box">
                    <div class="single-box row" style="width: 100%;">
                        <div class="col-md-8">
                            <h5 class="title">Saldo</h5>
                            <div class="count">{{UserHelp::rupiah($saldo)}}</div>
                        </div>
                        <div class="col-md-4">
                            <a href="#tariksaldo" class="btn btn-sm btn-warning tariksaldo" style="color: white; padding: 0px; width: 100%;">Tarik Saldo</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="admin-courses-tab">
            <h3 class="title">Riwayat Penarikan</h3>

            <div class="courses-tab-wrapper">
                <div class="tab-btn"></div>
            </div>
        </div>
        <div class="engagement-courses table-responsive">
            @if(session('status_nya'))
            <div class="alert alert-success" role="alert">
                {{session('status_nya')}}
            </div>
            @endif
            <table class="table">
                <thead style="background-color: #e5f4eb; border-radius: 10px;">
                    <tr>
                        <th style="font-size: 18px; color: #212832; padding: 15px;">ID</th>
                        <th style="font-size: 18px; color: #212832; padding: 15px;">Penerima</th>
                        <th style="font-size: 18px; color: #212832; padding: 15px;">Keterangan</th>
                        <th style="font-size: 18px; color: #212832; padding: 15px;">Status</th>
                        <th style="font-size: 18px; color: #212832; padding: 15px;">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($penarikan) > 0) @foreach($penarikan as $item)
                    <tr>
                        <th scope="row">#{{$item->id}}</th>
                        <td>{{$item->bank}} {{$item->no_rekening}} a.n {{$item->nama_rekening}}</td>
                        <td>Penarikan Saldo {{UserHelp::rupiah($item->nominal)}} dikurangi biaya penarikan {{UserHelp::rupiah($item->admin)}} menjadi {{UserHelp::rupiah($item->diterima)}}</td>
                        <td>
                            @if($item->status == 'Proses')
                            <span class="badge bg-dark text-white">{{$item->status}}</span>
                            @elseif($item->status == 'Gagal')
                            <span class="badge bg-danger text-white">{{$item->status}}</span>
                            @else
                            <span class="badge bg-success text-white">{{$item->status}}</span>
                            @endif
                        </td>
                        <td>{{UserHelp::tanggal_indo($item->updated_at, true)}}</td>
                    </tr>
                    @endforeach @else
                    <tr>
                        <td colspan="5">Belum ada penarikan penghasilan</td>
                    </tr>
                    @endif
                </tbody>
            </table>
            {!!@$penarikan->appends(['cari'=>@$_GET['cari']])->links()!!}
        </div>
    </div>
</div>
<div class="modal fade" id="TariksaldoModal" tabindex="-1" aria-labelledby="TariksaldoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white" id="TariksaldoLabel">Penarikan Saldo</h5>
                <button type="button" class="btn btn-sm btn-light mb-0" data-bs-dismiss="modal" aria-label="Close"><i class="icofont-close"></i></button>
            </div>
            <form method="post" action="{{route('mentor.penarikan.aksi')}}">
                @csrf
                <div class="modal-body">
                    <div class="row text-start g-3">
                        <!-- Question -->
                        <div class="col-12">
                            <div class="single-form">
                                <label>Nama Rekening</label>
                                <input type="text" name="nama_rekening" required placeholder="Silahkan isi Nama Rekening" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="single-form">
                                <label>Bank Rekening</label><br />
                                <select name="bank" id="bank" required="" class="selectnya">
                                    <option value="">Pilih Bank</option>
                                    <option value="BNI">BNI</option>
                                    <option value="BRI">BRI</option>
                                    <option value="BCA">BCA</option>
                                    <option value="Mandiri">Mandiri</option>
                                    <option value="Danamon">Danamon</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="single-form">
                                <label>Nomor Rekening</label>
                                <input type="number" name="no_rekening" required placeholder="Silahkan isi Nomor Rekeningg" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="single-form">
                                <label>Nominal Penarikan</label>
                                <input type="number" name="nominal" required id="nominal" min="{{$pengaturan->minimal_penarikan}}" max="{{$saldo}}" placeholder="Silahkan isi Nominal Penarikan" />
                                <small style="font-size: 10px;">Minimal Penarikan {{UserHelp::rupiah($pengaturan->minimal_penarikan)}} dengan biaya {{$pengaturan->biaya_penarikan}}% dari total penarikan.</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger-soft my-0" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" id="simpan_faq" class="btn btn-success my-0">Tarik</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $(".tariksaldo").click(function () {
            $("#TariksaldoModal").modal("show");
        });
    });
</script>
@endsection
