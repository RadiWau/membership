@extends('app')

@push('custom-css')


@endpush

@section('title','Dashboard')

@section('content')
    <div class="row">
        <div class="col-12">
            @if(Session::has('topup_sukses'))
                <div class="alert alert-success alert-dismissable fade show" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    {{ Session::get('topup_sukses') }}
                </div>
            @elseif(Session::has('topup_gagal'))
                <div class="alert alert-danger alert-dismissable fade show" role="alert">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    {{ Session::get('topup_gagal') }}
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-12">
            <div class="card pull-up">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="info">{{isset($paketSilver) && $paketSilver['paket_level'] == 1 && $paketSilver['status_paket'] == 2 ? number_format($paketSilver['saldo'], 0, '.', '.') : '0'}}</h3>
                                <h6>Total Pendapatan Paket Silver</h6>
                            </div>
                            <div>
                                <i class="icon-basket-loaded info font-large-2 float-right"></i>
                            </div>
                        </div>
                        <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                            <div class="progress-bar bg-gradient-x-secondary" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-12">
            @if(!$paketGold)
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#topUpPaketGold">
                    <span style="letter-spacing: 2px;">TOPUP PAKET GOLD</span>
                </button>
            @else
                <div class="card pull-up">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="media-body text-left">
                                    <h3 class="warning">{{isset($paketGold) && $paketGold['paket_level'] == 2 && $paketGold['status_paket'] == 2 ? number_format($paketGold['saldo'], 0, '.', '.') : '0'}}</h3>
                                    <h6>Total Pendapatan Paket Gold</h6>
                                </div>
                                <div>
                                    <i class="icon-pie-chart warning font-large-2 float-right"></i>
                                </div>
                            </div>
                            <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                                <div class="progress-bar bg-gradient-x-warning" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-12">
            <div id="accordionCrypto" role="tablist" aria-multiselectable="true">
                <div class="card accordion collapse-icon accordion-icon-rotate">

                    <a id="heading31" data-toggle="collapse" href="#logAktifitas" aria-expanded="true" aria-controls="logAktifitas" class="card-header bg-info p-1 bg-lighten-1">
                        <div class="card-title lead white">LOG AKTIFITAS MEMBER</div>
                    </a>
                    <div id="logAktifitas" role="tabpanel" data-parent="#logAktifitas" aria-labelledby="heading31" class=" collapse show" aria-expanded="true">
                        <div class="card-content">
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered" id="tbl_aktifitas" width="100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Sponsor Code</th>
                                                <th>Nama Member</th>
                                                <th>Paket Member</th>
                                                <th>Dibuat</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>RK1122</td>
                                                <td>Saprudin</td>
                                                <td>Silver</td>
                                                <td>26 Maret 2025</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal animated fade text-left" id="topUpPaketGold" style="border-radius: 15px !important;" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="border-radius: 15px !important;" role="document">
            <div class="modal-content">
                <div class="modal-header bg-white pb-0 border-0">
                    <h4 class="modal-title text-primary font-weight-bold" id="modal_title">Form Topup Paket Gold</h4>
                    <button type="button" onclick="closeModal()" class="close text-dark" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('member.topup')}}" id="formTopup" method="post">
                        <div class="row">
                            @csrf
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="txt_provinsi" class="text-left float-left">Nominal Topup <span style="color:red;"> * </span> </label>
                                    <input type="text" id="txt_nominal" name="txt_nominal" class="form-control input-rounded inputAngka" placeholder="Masukkan Nominal Topup" required>
                                    <label for="txt_message_nominal" id="txt_message_nominal" class="text-left float-left red"></label>
                                </div>
                            </div>
                            <div class="col-md-12 mt-1 text-right">
                                <div class="form-group">                            
                                    <button type="submit" id="save_silver" class="btn btn-primary">Simpan</button>
                                    <button id="cancel_modal" onclick="closeModal()" data-dismiss="modal" class="btn btn-info">Batal</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token()}}"
                }
        });

        $( document ).ready(function() {
            $("#formTopup").on("submit", function(e) {
                var nominal = $('#txt_nominal').val().trim();

                if (nominal < 610.00) {
                    e.preventDefault(); // cancel form submission
                    $("#txt_message_nominal").text("Nominal Topup Kurang Dari 610.000");
                }
            });
            

        });

        
        
        
    </script>
@endpush
