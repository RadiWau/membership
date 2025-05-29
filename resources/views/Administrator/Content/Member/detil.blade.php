@extends('Administrator.app')
@section('title','Detil Member')
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
                {!! Session::get('topup_gagal') !!}
            </div>
        @endif
        @if(Session::has('user_success'))
            <div class="alert alert-success alert-dismissable fade show" role="alert">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                {!! Session::get('user_success') !!}
            </div>
        @endif

    </div>
</div>
<div class="row">
    <div class="col-12">
        <section class="users-view">
            <div class="row">
                <div class="col-12 col-sm-7">
                    <div class="media mb-2">
                        <a class="mr-1" href="#">
                            <img src="../../../app-assets/images/portrait/small/avatar-s-26.png" alt="users view avatar" class="users-avatar-shadow rounded-circle" height="64" width="64">
                        </a>
                        <div class="media-body pt-25">
                            <h4 class="media-heading">
                                <span class="users-view-name">{{Str::upper($profile->nama_lengkap)}}</span>
                            </h4>
                            <span>Nomor Kartu : </span>
                            <span class="users-view-id">
                                @if(isset($card))
                                    {{$card['member_card_no']}}
                                @else
                                    - 
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-5 px-0 d-flex justify-content-end align-items-center px-1 mb-2">
                    <a href="/admin/member" class="btn btn-sm btn-primary">Kembali</a>
                </div>
            </div>
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <table class="table table-borderless" width="100%">
                                    <tbody>
                                        <tr>
                                            <td>Tanggal Daftar</td>
                                            <td>:</td>
                                            <td><span style="margin-left:-10px;">{{\Carbon\Carbon::parse($profile['created_at'])->format('d-m-Y H:i:s')}}</span></td>
                                        </tr>
                                        <tr>
                                            <td>Aktifititas Terakhir</td>
                                            <td>:</td>
                                            <td width="30%"><span style="margin-left:-10px;"> {{$profile['last_login'] !== null ? \Carbon\Carbon::parse($profile['last_login'])->format('d-m-Y H:i:s') : '-' }}</span></td>
                                        </tr>
                                        <tr>
                                            <td>Kode Sponsor</td>
                                            <td>:</td>
                                            <td width="30%"><span style="margin-left:-10px;"> {{isset($sponsor) && $sponsor['sponsor_code'] !== null ? $sponsor['sponsor_code'] : '-' }} </span></td>
                                        </tr>
                                        <tr>
                                            <td>Lihat Topup Silver</td>
                                            <td>:</td>
                                            <td width="30%">                                                
                                                <button type="button" class="btn badge-secondary" {{isset($paketSilver) && $paketSilver['paket_level'] == 1 && $paketSilver['status_paket'] == 2 ? '' : 'disabled'}} onclick="window.open('/admin/member/lihat_topup/<?= $profile['user_id'] ?>/1', '_blank')">
                                                    <span style="letter-spacing: 2px;">Lihat</span>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Lihat Topup Gold</td>
                                            <td>:</td>
                                            <td width="30%">
                                                 <button type="button" class="btn btn-warning" {{isset($paketGold) && $paketGold['paket_level'] == 2 && $paketGold['status_paket'] == 2 ? '' : 'disabled'}} onclick="window.open('/admin/member/lihat_topup/<?= $profile['user_id'] ?>/2', '_blank')">
                                                    <span style="letter-spacing: 2px;">Lihat</span>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Status </td>
                                            <td>:</td>
                                            <td width="30%">
                                                @if($profile->status == 1)
                                                    <span class="badge badge-info users-view-status">{{$profile_status}}</span>
                                                @elseif($profile->status == 2)
                                                    <span class="badge badge-success users-view-status">{{$profile_status}}</span>
                                                @elseif($profile->status == 3)
                                                    <span class="badge badge-danger users-view-status">{{$profile_status}}</span>
                                                @elseif($profile->status == 4)
                                                    <span class="badge badge-secondary users-view-status">{{$profile_status}}</span>
                                                @else
                                                    <span class="badge badge-warning users-view-status">{{$profile_status}}</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Nomor Kartu </td>
                                            <td>:</td>
                                            <td width="30%">
                                                <button type="button" class="btn btn-info" {{ $profile['status'] == 2 ? "" : "disabled" }} data-toggle="modal" data-target="#InputMemberCard">
                                                    <span style="letter-spacing: 2px;">Lihat</span>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Ganti Password </td>
                                            <td>:</td>
                                            <td width="30%">
                                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#inputPassword">
                                                    <span style="letter-spacing: 2px;">Ganti</span>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12 col-md-8">
                                <div class="row">
                                    <div class="col-xl-6 col-md-12 col-6">
                                        @if((isset($paketSilver)) && $paketSilver->paket_level == 1 && $paketSilver->status_paket == 1)
                                            <button type="button" class="btn badge-secondary px-3 py-1" data-toggle="modal" data-target="#UploadFileBuktiTopupSilver">
                                                <span style="letter-spacing: 2px;">Unggah Bukti Bayar Member Silver</span>
                                            </button>
                                        @else
                                             <button type="button" class="btn badge-secondary px-3 py-1" disabled>
                                                <span style="letter-spacing: 2px;">Unggah Bukti Bayar Member Silver</span>
                                            </button>
                                        @endif
                                    </div>
                                    <div class="col-xl-6 col-md-12 col-6">
                                        <button type="button" class="btn btn-warning px-3 py-1" {{isset($paketGold) && $paketGold['paket_level'] == 2 && $paketGold['status_paket'] == 2 ? 'disabled' : ''}} data-toggle="modal" data-target="#UploadFileBuktiTopupGold">
                                            <span style="letter-spacing: 2px;">Unggah Bukti Bayar Member Gold</span>
                                        </button>
                                    </div>
                                </div>
                                <br/>
                                <br/>
                                <div class="row">
                                    @if((isset($paketSilver)) && $paketSilver->paket_level == 1 && $paketSilver->status_paket == 2)
                                    <div class="col-xl-6 col-md-12 col-6">
                                        <button type="button" class="btn badge-secondary px-3 py-1">
                                            <span style="letter-spacing: 2px; color:white;">Benefit Silver : {{number_format($paketSilver->saldo, 0, '.', '.')}}</span>
                                        </button>
                                    </div>
                                    @endif

                                    @if((isset($paketGold)) && $paketGold->paket_level == 2 && $paketGold->status_paket == 2)
                                    <div class="col-xl-6 col-md-12 col-6">
                                        <button type="button" class="btn btn-warning px-3 py-1">
                                            <span style="letter-spacing: 2px; color:white;">Benefit Gold : {{number_format($paketGold->saldo, 0, '.', '.')}}</span>
                                        </button>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-1">
                        <div class="card-header bg-primary" style="color:white;">
                            <h4 class="card-title" style="color:white;">List Aktifitas Sub Member</h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                    <li><a data-action="close"><i class="ft-x"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-content">
                            <div class="row">
                                <div class="col-12">
                                    COMMING SOON
                                    <!-- <div class="table-responsive my-2">
                                        <table class="table table-striped table-bordered" id="tbl_member">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Sponsor Code</th>
                                                    <th>Member</th>
                                                    <th>Paket</th>
                                                    <th>Status</th>
                                                    <th>Tanggal Daftar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td><a href="/admin/member/detil_member/1">00000001</a></td>
                                                    <td>Udin Komarudin</td>
                                                    <td><span class="badge badge-secondary users-view-status">Silver</span></td>
                                                    <td>Aktif</td>
                                                    <td>25 Maret 2025</td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td><a href="/admin/member/detil_member/1">00000002</a></td>
                                                    <td>Udin Komarudin</td>
                                                    <td><span class="badge badge-warning users-view-status">Gold</span></td>
                                                    <td>Aktif</td>
                                                    <td>25 Maret 2025</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>


<div class="modal animated fade text-left" id="UploadFileBuktiTopupSilver" style="border-radius: 15px !important;" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="border-radius: 15px !important;" role="document">
        <div class="modal-content">
            <div class="modal-header bg-white pb-0 border-0">
                <h4 class="modal-title text-primary font-weight-bold" id="modal_title">Unggah Bukti Transfer Paket Silver</h4>
                <button type="button" onclick="closeModal()" class="close text-dark" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('member.action.toptup')}}" method="post" enctype="multipart/form-data">
                    <div class="row">
                        @csrf
                        <div class="col-12">
                            <div class="form-group">
                                <input type="hidden" id="paket_level" name="paket_level" value="1">
                                <input type="hidden" id="txt_user" name="txt_user" value="{{$profile['user_id']}}">
                                <input type="file" id="txt_file" name="txt_file" class="form-control input-rounded" accept="image/*" required>
                                <small class="text-danger" id="file_alert"></small>
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

<div class="modal animated fade text-left" id="UploadFileBuktiTopupGold" style="border-radius: 15px !important;" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="border-radius: 15px !important;" role="document">
        <div class="modal-content">
            <div class="modal-header bg-white pb-0 border-0">
                <h4 class="modal-title text-primary font-weight-bold" id="modal_title">Unggah Bukti Transfer Gold</h4>
                <button type="button" onclick="closeModal()" class="close text-dark" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('member.action.toptup')}}" method="post" enctype="multipart/form-data">
                    <div class="row">
                        @csrf
                        <div class="col-12">
                            <div class="form-group">
                                <input type="hidden" id="paket_level" name="paket_level" value="2">
                                <input type="hidden" id="txt_user" name="txt_user" value="{{$profile['user_id']}}">
                                <input type="file" id="txt_file" name="txt_file" class="form-control input-rounded" accept="image/*" required>
                                <small class="text-danger" id="file_alert"></small>
                            </div>
                        </div>
                        <div class="col-md-12 mt-1 text-right">
                            <div class="form-group">                            
                                <button type="submit" id="save_gold" class="btn btn-primary">Simpan</button>
                                <button id="cancel_modal" onclick="closeModal()" data-dismiss="modal" class="btn btn-info">Batal</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal animated fade text-left" id="InputMemberCard" style="border-radius: 15px !important;" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="border-radius: 15px !important;" role="document">
        <div class="modal-content">
            <div class="modal-header bg-white pb-0 border-0">
                <h4 class="modal-title text-primary font-weight-bold" id="modal_title">Input Nomor Kartu</h4>
                <button type="button" onclick="closeModal()" class="close text-dark" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('member.action.member.card')}}" method="post">
                    <div class="row">
                        @csrf
                        <div class="col-12">
                            <div class="form-group">
                                <input type="hidden" id="user_id" name="user_id" value="{{$profile->user_id}}">
                                <label for="txt_member_card" class="text-left float-left">Kata Sandi</label>
                                <input type="text" id="txt_member_card" name="txt_member_card" class="form-control input-rounded" placeholder="Masukkan Nomor Kartu" value="{{ old('txt_member_card') }}" required>
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

<div class="modal animated fade text-left" id="inputPassword" style="border-radius: 15px !important;" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="border-radius: 15px !important;" role="document">
        <div class="modal-content">
            <div class="modal-header bg-white pb-0 border-0">
                <h4 class="modal-title text-primary font-weight-bold" id="modal_title">Ganti Kata Sandi</h4>
                <button type="button" onclick="closeModal()" class="close text-dark" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('member.action.ganti.password')}}" method="post">
                    @csrf
                    <div class="row ">
                        <div class="col-12">
                            <div class="form-group">
                                <input type="hidden" id="user_id" name="user_id" value="{{$profile->user_id}}">
                                <label for="txt_sandi" class="text-left float-left">Kata Sandi</label>
                                <input type="text" id="txt_sandi" name="txt_sandi" class="form-control input-rounded" placeholder="Masukkan kata sandi" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="txt_sandi_ulangi" class="text-left float-left">Ulangi Kata Sandi</label>
                                <input type="text" id="txt_sandi_ulangi" name="txt_sandi_ulangi" class="form-control input-rounded" placeholder="Masukkan kata sandi" required>
                            </div>
                        </div>
                    </div>
                     <div class="col-md-12 mt-1 text-right">
                        <div class="form-group">                            
                            <button type="submit" id="save_silver" class="btn btn-primary">Ganti</button>
                            <button id="cancel_modal" onclick="closeModal()" data-dismiss="modal" class="btn btn-info">Batal</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('custom-script')
    <script>
        $.ajaxSetup({
            headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token()}}"
                }
        });

        const closeModal = () => {
            $("#txt_file").empty("");
            $("#UploadFileBuktiTopup").modal("hide");
        }

        
        const showAll = () => {

            const csrf = "{{ csrf_token()}}";

            $('#tbl_member').DataTable({
                'ajax': {
                    'method' : 'POST',
                    'data': {
                        '_token' : csrf
                    }
                },
                'columns': [
                    { 
                        width       : "2%",
                        data        : null,
                        className   : 'text-center',
                        render      : function (data, type, row, meta){
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    { 
                        data     : 'jasa_id',
                        visible  : false,
                        className: 'text-center'
                    },
                    { 
                        width       : "auto",
                        data        : 'nama_jasa',
                        className   : 'text-center'
                    },
                    { 
                        width       : "auto",
                        data        : 'harga_jasa',
                        className   : 'text-center'
                    },
                    { 
                        width       : "auto",
                        data        : 'name',
                        className   : 'text-center'
                    },
                    { 
                        width       : "auto",
                        data        : null,
                        className   : 'text-center',
                        render      : function(data, type, full) {
                            return `
                                {{ \Carbon\Carbon::parse(`+data.created_at+`)->format('d-m-Y')}}
                            `;
                        }
                    },
                    { 
                        width       : "auto",
                        data        : null,
                        sortable    : false,
                        className   : 'text-center',
                        render      : function(data, type, full) {
                            return `
                                <div class="row">
                                    <div class="col-md-6">
                                        <a class="btn btn-sm btn-success" href="#" onclick="showJasa(this)" data-jasaid="${data.jasa_id}"><i class="far fa-edit"></i></a> &nbsp;
                                    </div>
                                    <div class="col-md-6">
                                        <a class="btn btn-sm btn-danger" href="#" onclick="deleteJasa(this)" data-jasaid="${data.jasa_id}"><i class="fas fa-trash"></i></a> &nbsp;
                                    </div>
                                </div>
                            `;
                        }
                    },
                ]
            });
        }
        
        $( document ).ready(function() {
            $('.select2-select').select2({
                width:'100%'
            });

            showAll();

        });

    </script>
@endpush
