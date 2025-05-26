@extends('auth.layout')

@section('title','Daftar Member')

@section('title-auth')
    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
        <span>Buat Akun Member</span>
    </h6>
@endsection       

@section('content')
<form class="form p-3 pb-0" style="margin-top: -20px" method="post" action="{{route('auth.action.register')}}">
    @if(Session::has('regis_success'))
        <div class="alert alert-success alert-dismissable fade show" role="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            {{ Session::get('regis_success') }}
        </div>
    @elseif(Session::has('regis_gagal'))
        <div class="alert alert-danger alert-dismissable fade show" role="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            {!! Session::get('regis_gagal') !!}
        </div>
    @endif
    
    @csrf
    <div class="row ">
        <div class="col-12">
            <div class="form-group">
                <label for="txt_username" class="text-left float-left">Username <span style="color:red;"> * </span></label>
                <input type="text" id="txt_username" name="txt_username" class="form-control input-rounded" placeholder="Masukkan username" value="{{ old('txt_username') }}" required>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="txt_nama" class="text-left float-left">Nama Lengkap <span style="color:red;"> * </span></label>
                <input type="text" id="txt_nama" name="txt_nama" class="form-control input-rounded" placeholder="Masukkan nama lengkap" value="{{ old('txt_nama') }}" required>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="txt_email" class="text-left float-left">Email</label>
                <input type="email" id="txt_email" name="txt_email" class="form-control input-rounded" placeholder="Masukkan email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" value="{{ old('txt_email') }}">
            </div>
            @error('txt_email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="txt_no_hp" class="text-left float-left">No Hp / WA yang Aktif <span style="color:red;"> * </span> </label>
                <input type="text" id="txt_no_hp" name="txt_no_hp" class="form-control input-rounded" placeholder="Masukkan no Hp" required value="{{ old('txt_no_hp') }}">
            </div>
            @error('txt_no_hp')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="txt_paket" class="text-left float-left">Paket <span style="color:red;"> * </span> </label><br/>
                <div class="input-group">
                    <div class="d-inline-block custom-control custom-radio mr-1">
                        <input type="radio" id="txt_paket_silver" name="txt_paket" value="1" class="custom-control-input pilih_paket">
                        <label class="custom-control-label" for="txt_paket_silver">Silver</label>
                    </div>
                    <div class="d-inline-block custom-control custom-radio">
                        <input type="radio" id="txt_paket_emas" name="txt_paket" value="2" class="custom-control-input pilih_paket">
                        <label class="custom-control-label" for="txt_paket_emas">Gold</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 paketDiv" style="display:none">
            <div class="form-group" id="priceSilver" style="display:none">
                <label class="text-left float-left">Paket Silver : RP 110.000 </label>
            </div>
            <div class="form-group" id="priceGold" style="display:none">
                <label class="text-left float-left">Paket Gold : minimal topup RP 610.000 </label>
            </div>
        </div>
        <br/>
        <br/>

        <div class="col-12 paketDivNominal" style="display:none">
            <div class="form-group">
                <label for="txt_provinsi" class="text-left float-left">Nominal Topup <span style="color:red;"> * </span> </label>
                <input type="text" id="txt_nominal" name="txt_nominal" class="form-control input-rounded inputAngka" placeholder="Masukkan Nominal Topup">
                <label for="txt_message_nominal" id="txt_message_nominal" class="text-left float-left red"></label>
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
                <label for="txt_alamat" class="text-left float-left">Alamat <span style="color:red;"> * </span> </label>
                <input type="text" id="txt_alamat" name="txt_alamat" class="form-control input-rounded" placeholder="Masukkan Alamat Lengkap" required>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="txt_bank" class="text-left float-left">Bank <span style="color:red;"> * </span> </label>
                <select name="txt_bank" id="txt_bank" class="select2-select" required>
                    <option value=""> -- Pilih Bank -- </option>
                </select>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="txt_atas_nama" class="text-left float-left">Atas Nama <span style="color:red;"> * </span> </label>
                <input type="text" id="txt_atas_nama" name="txt_atas_nama" class="form-control input-rounded" placeholder="Masukan Nama Rekeing" required>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="txt_nomor_rekening" class="text-left float-left">Nomor Rekening <span style="color:red;"> * </span> </label>
                <input type="text" id="txt_nomor_rekening" name="txt_nomor_rekening" class="form-control input-rounded" placeholder="Masukan Nomor Rekeing" required>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="txt_kode_sponsor" class="text-left float-left">Sponsor</label>
                <input type="text" id="txt_kode_sponsor" name="txt_kode_sponsor" class="form-control input-rounded" placeholder="Kode Sponsor" value="{{$referal}}" readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary px-3 py-1"><span class="" style="letter-spacing: 2px;">Daftar</span></button>
        </div>
    </div>

</form>
@endsection

@section('text-footer')
    <p class="text-center"><a href="/" class="card-link">Sudah Punya Akun</a> <a href="/forget-password" class="card-link">Lupa Kata Sandi</a></p>
@endsection  


@push('custom-script')
    <script>
        $('.inputAngka').on('keyup', function() {
            var angka = $(this).val();
            angka = angka.replace(/[^,\d]/g, '').toString(); // Hapus semua selain angka
            if (angka) {
                var split = angka.split(',');
                var sisa = split[0].length % 3;
                var rupiah = split[0].substr(0, sisa);
                var ribuan = split[0].substr(sisa).match(/\d{3}/g);

                if (ribuan) {
                    var separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                $(this).val(rupiah);
                if($('input[name="txt_paket"]:checked').val() == 2){
                    if(rupiah < 610.000){
                        $("#txt_message_nominal").fadeIn("slow");
                        $("#txt_message_nominal").text("Minimum Top 610.000");
                        console.log(rupiah);
                        console.log("Di Bawahh");
                    }else{
                        console.log("Di atas");
                        $("#txt_message_nominal").fadeOut("slow").text("");
                    }
                }
                
                
            }
        });

    </script>
    <script>
        $('.select2-select').select2({
            width:'100%'
        });

        $(document).on("click", ".pilih_paket", function(){
            paket = this.value;
            $(".paketDiv").fadeIn("slow");
            if(paket == 1){ // silver                
                $("#priceGold").fadeOut("slow");
                $("#priceSilver").fadeIn("slow");
                $(".paketDivNominal").fadeOut("slow");
            }else{                
                $("#priceSilver").fadeOut("slow");
                $("#priceGold").fadeIn("slow");
                $(".paketDivNominal").fadeIn("slow");
            }
        });

        var prov_id = "";
        var kab_id  = "";
        var kec_id  = "";
        var kel_id  = "";
        const getProvinsi = () => {

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
                    });

                }
            }); // end ajax
        }; // end list provinsi

        $(document).on("change", "#txt_provinsi", function(){
            prov_id = this.value;
            $('#txt_kabupaten').empty();
            getKabupaten(prov_id);
        });
        
        const getKabupaten = (prov_id = null) => {

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
                    });

                }
            }); // end ajax
        }; // end list kabupaten

        $(document).on("change", "#txt_kabupaten", function(){
            kab_id = this.value;
            $('#txt_kecamatan').empty();
            getKecamatan(kab_id);
        });

        const getKecamatan = (kab_id = null) => {

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
                    });

                }
            }); // end ajax
        }; // end list kecamatan

        $(document).on("change", "#txt_kecamatan", function(){
            kec_id = this.value;
            $('#txt_kelurahan').empty();
            getKelurahan(kec_id);
        });

        const getKelurahan = (kec_id = null) => {

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
                    });

                }
            }); // end ajax
        }; // end list kelurahan

        const getBank = () => {

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
                    });

                }
            }); // end ajax
        }; // end list Bank

        $(document).ready(function(){
            getProvinsi(); // list provinsi
            getBank(); // list bank
            
        });
    </script>
@endpush

