@extends('app')


@section('title','Data Profile')
@stack('scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@section('content')
    <section id="page-account-settings">
        <div class="row">
            <!-- left menu section -->
            <div class="col-md-3 mb-2 mb-md-0">
                <ul class="nav nav-pills flex-column mt-md-0 mt-1">
                    <li class="nav-item">
                        <a class="nav-link d-flex active" id="account-pill-general" data-toggle="pill" href="#account-vertical-general" aria-expanded="true">
                            <i class="ft-user mr-50"></i>
                            Profil
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex" id="account-pill-connections" data-toggle="pill" href="#account-vertical-connections" aria-expanded="false">
                            <i class="ft-feather mr-50"></i>
                            Link Referal
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex" id="account-pill-password" data-toggle="pill" href="#account-vertical-password" aria-expanded="false">
                            <i class="ft-lock mr-50"></i>
                            Ganti Password
                        </a>
                    </li>
                </ul>
            </div>
            <!-- right content section -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="row">
                                    <div class="col-12">
                                        @if(Session::has('user_success'))
                                            <div class="alert alert-success alert-dismissable fade show" role="alert">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                                {{ Session::get('user_success') }}
                                            </div>
                                        @elseif(Session::has('user_gagal'))
                                            <div class="alert alert-danger alert-dismissable fade show" role="alert">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                                {{ Session::get('user_gagal') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane active" id="account-vertical-general" aria-labelledby="account-pill-general" aria-expanded="true">
                                    <form novalidate>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="account-name">Nama Lengkap</label>
                                                        <input type="text" class="form-control" id="txt_nama_Lengkap" name="txt_nama_Lengkap" placeholder="Nama Lengkap" required value="{{$data->nama_lengkap}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="account-e-mail">E-mail</label>
                                                        <input type="email" class="form-control" id="txt_email" name="txt_email" placeholder="Email" required value="{{$data->email}}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="account-e-mail">Nomor Hp</label>
                                                        <input type="text" class="form-control" id="txt_no_hp" name="txt_no_hp" placeholder="No HP" required value="{{$data->no_hp}}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="txt_provinsi" class="text-left float-left">Provinsi <span style="color:red;"> * </span> </label>
                                                    <select name="txt_provinsi" id="txt_provinsi" width="100%" class="select2-select" required>
                                                        <option value=""> -- Pilih Provinsi -- </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="txt_kabupaten" class="text-left float-left">Kabupaten <span style="color:red;"> * </span> </label>
                                                    <select name="txt_kabupaten" id="txt_kabupaten" class="select2-select" required>
                                                        <option value=""> -- Pilih Kabupaten -- </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="txt_kecamatan" class="text-left float-left">Kecamatan <span style="color:red;"> * </span> </label>
                                                    <select name="txt_kecamatan" id="txt_kecamatan" class="select2-select" required>
                                                        <option value=""> -- Pilih Kecamatan -- </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="txt_kelurahan" class="text-left float-left">Kelurahan <span style="color:red;"> * </span> </label>
                                                    <select name="txt_kelurahan" id="txt_kelurahan" class="select2-select" required>
                                                        <option value=""> -- Pilih Kelurahan -- </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="account-e-mail">Alamat</label>
                                                        <input type="text" class="form-control" id="txt_alamat" name="txt_alamat" placeholder="Alamat" value="{{$data->alamat}}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="txt_bank" class="text-left float-left">Bank </label>
                                                    <select name="txt_bank" id="txt_bank" class="select2-select" required>
                                                        <option value=""> -- Pilih Bank -- </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="txt_atas_nama" class="text-left float-left">Atas Nama  </label>
                                                    <input type="text" id="txt_atas_nama" name="txt_atas_nama" class="form-control input-rounded" placeholder="Masukan Nama Rekeing" value="{{$data->atas_nama}}" required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="txt_nomor_rekening" class="text-left float-left">Nomor Rekening </label>
                                                    <input type="text" id="txt_nomor_rekening" name="txt_nomor_rekening" class="form-control input-rounded" placeholder="Masukan Nomor Rekeing" value="{{$data->norek}}" required>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Simpan</button>
                                                <button type="button" class="btn btn-light">Batal</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane fade" id="account-vertical-connections" role="tabpanel" aria-labelledby="account-pill-connections" aria-expanded="false">
                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <button class=" btn btn-sm btn-info float-right" id="btnLink">Copy Link</button>
                                            <h6>Link Referal</h6>
                                            <span id="txtLink"><a href="{{env('APP_URL')}}:8000/referal/{{$sponsor['sponsor_code']}}">{{env('APP_URL')}}:8000/referal/{{$sponsor['sponsor_code']}}</a></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="account-vertical-password" role="tabpanel" aria-labelledby="account-pill-password" aria-expanded="false">
                                    <form method="post" action="{{route('profile.action.ganti.password')}}" id="form_password" novalidate>
                                        @csrf
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="account-old-password">Password Lama</label>
                                                        <input type="password" class="form-control" id="txt_pass" name="txt_pass" required placeholder="Password Lama">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="account-new-password">Password Baru</label>
                                                        <input type="password" id="txt_pass_baru" name="txt_pass_baru" class="form-control" placeholder="New Password" required  minlength="6" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <div class="controls">
                                                        <label for="account-retype-new-password">Ulangi Password Baru</label>
                                                        <input type="password" id="txt_pass_conf" name="txt_pass_conf" class="form-control" required placeholder="New Password" minlength="6" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                <button type="submit" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0">Simpan</button>
                                                <button type="button" class="btn btn-light">Batal</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@push('scripts')
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>

        $('.select2-select').select2({
            width:'100%'
        });

        var prov_id = "{{$data->provinsi}}";
        var kab_id  = "{{$data->kabupaten}}";
        var kec_id  = "{{$data->kecamatan}}";
        var kel_id  = "{{$data->kelurahan}}";
        var bank_id = "{{$data->bank}}";

        const getProvinsi = (prov_id=null) => {

            const url = "{{route('data.provinsi')}}";
            const csrf = "{{ csrf_token()}}";

            $.ajax({
                url         : url,
                method      : "POST",
                data        : {
                                "_token" : csrf
                            },
                dataType    : "JSON",
                success     : function(response)
                {

                    $('#txt_provinsi').select2({
                        placeholder: "-- Pilih Provinsi --",
                        allowClear: true,
                        data: response,
                        width:"100%"
                    }).val(prov_id);

                }
            }); // end ajax
        }; // end list provinsi

        const getKabupaten = (kab_id = null) => {

            const url = "{{route('data.kabupaten')}}";
            const csrf = "{{ csrf_token()}}";

            $('#txt_kabupaten').empty();
            $.ajax({
                url         : url,
                method      : "POST",
                data        : {
                                "_token" : csrf,
                                "prov_id" : prov_id
                            },
                dataType    : "JSON",
                success     : function(response)
                {
                    $('#txt_kabupaten').select2({
                        placeholder: "-- Pilih Kabupaten --",
                        allowClear: true,
                        data: response,
                        width:"100%"
                    }).val(kab_id);

                }
            }); // end ajax
        }; // end list kabupaten

        // $(document).on("change", "#txt_kabupaten", function(){
        //     kab_id = this.value;
        //     $('#txt_kecamatan').empty();
        //     getKecamatan(kab_id);
        // });

        const getKecamatan = (kec_id = null) => {

            const url = "{{route('data.kecamatan')}}";
            const csrf = "{{ csrf_token()}}";

            $('#txt_kecamatan').empty();
            $.ajax({
                url         : url,
                method      : "POST",
                data        : {
                                "_token" : csrf,
                                "kab_id" : kab_id
                            },
                dataType    : "JSON",
                success     : function(response)
                {
                    $('#txt_kecamatan').select2({
                        placeholder: "-- Pilih Kecamatan --",
                        allowClear: true,
                        data: response,
                        width:"100%"
                    }).val(kec_id);

                }
            }); // end ajax
        }; // end list kecamatan

        $(document).on("change", "#txt_kecamatan", function(){
            kec_id = this.value;
            $('#txt_kelurahan').empty();
            getKelurahan(kec_id);
        });

        const getKelurahan = (kel_id = null) => {

            const url = "{{route('data.kelurahan')}}";
            const csrf = "{{ csrf_token()}}";

            $('#txt_kelurahan').empty();
            $.ajax({
                url         : url,
                method      : "POST",
                data        : {
                                "_token" : csrf,
                                "kec_id" : kec_id
                            },
                dataType    : "JSON",
                success     : function(response)
                {
                    $('#txt_kelurahan').select2({
                        placeholder: "-- Pilih Kelurahan --",
                        allowClear: true,
                        data: response,
                        width:"100%"
                    }).val(kel_id);

                }
            }); // end ajax
        }; // end list kelurahan

        const getBank = (bank_id) => {

            const url = "{{route('data.bank')}}";
            const csrf = "{{ csrf_token()}}";

            $.ajax({
                url         : url,
                method      : "POST",
                data        : {
                                "_token" : csrf
                            },
                dataType    : "JSON",
                success     : function(response)
                {
                    $('#txt_bank').select2({
                        placeholder: "-- Pilih Bank --",
                        allowClear: true,
                        data: response,
                        width:"100%"
                    }).val(bank_id);

                }
            }); // end ajax
        }; // end list Bank


        $(document).ready(function(){

            getProvinsi(prov_id); // list provinsi
            getKabupaten(kab_id); // list kabupaten
            getKecamatan(kec_id); // list kecamatan
            getKelurahan(kel_id); // list kelurahan
            getBank(bank_id); // list bank
            
            $(document).on('click', '#txt_provinsi', function() {
                alert('Tombol diklik!');
                // prov_id = this.value;
                // alert('Radi');
                // $('#txt_kabupaten').empty();
                // $('#txt_kecamatan').empty();
                // $('#txt_kelurahan').empty();
                // getKabupaten(prov_id);
            });

            $('#btnLink').click(function() {
                const text = $('#txtLink').text(); // Get span text
                const $temp = $('<input>'); // Create temporary input
                $('body').append($temp);
                $temp.val(text).select(); // Set value and select it
                document.execCommand('copy'); // Copy to clipboard
                $temp.remove(); // Clean up
            });

           
            
            $(document).on("keyup", "#txt_pass", function(){
                
                const url = "{{route('profile.action.cek.password')}}";
                const csrf = "{{ csrf_token()}}";

                $.ajax({
                    url         : url,
                    method      : "POST",
                    data        : {
                                    "_token" : csrf,
                                    "password": this.value
                                },
                    success     : function(response)
                    {
                        console.log(response);
                        if(response == "Pass"){
                            $("#txt_pass_baru").prop('disabled', false);
                            $("#txt_pass_conf").prop('disabled', false);
                        }
                    }
                }); // end ajax
            });
            
            
            $(document).on("keyup", "#txt_pass_conf", function(){                
                if(this.value !== $("#txt_pass_baru").val()){
                    console.log("TIDAK SAMA");
                }else{
                    console.log("SAMA");
                }
            });

            $("#form_password").on("submit", function(e) {
                if (!confirm("Anda Yakin Ingin Mengganti Kata Sandi Anda ?")) {
                    e.preventDefault();
                }
                
            });


        });
    </script>


@endpush