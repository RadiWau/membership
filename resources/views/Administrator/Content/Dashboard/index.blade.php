@extends('Administrator.app')
@section('title','Dashboard')

@stack('scripts')
@section('content')
    <div class="row">
        <div class="col-xl-6 col-lg-6 col-12">
            <div class="card pull-up">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 id="countSilver">0</h3>
                                <h6>Paket Silver</h6>
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
            <div class="card pull-up">
                <div class="card-content">
                    <div class="card-body">
                        <div class="media d-flex">
                            <div class="media-body text-left">
                                <h3 class="warning" id="countGold">0</h3>
                                <h6>Paket Gold</h6>
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
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-1">
                <div class="card-header bg-primary" style="color:white;">
                    <h4 class="card-title" style="color:white;">List Aktifitas Member</h4>
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
                            COMING SOON
                            <!-- <div class="table-responsive my-2">
                                <table class="table table-striped table-bordered" id="tbl_member">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Sponsor Code</th>
                                            <th>Nama Member</th>
                                            <th>Aktifitas</th>
                                            <th>Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td><a href="/admin/member/detil_member/1">00000001</a></td>
                                            <td>Udin Komarudin</td>
                                            <td>Registrasi</td>
                                            <td>25 Maret 2025</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td><a href="/admin/member/detil_member/1">00000002</a></td>
                                            <td>Udin Komarudin</td>
                                            <td>Registrasi</td>
                                            <td>25 Maret 2025</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div> -->
                        </div >
                    </div >
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
 
   
    <script>
        $( document ).ready(function() {

            // summary box
            $.ajax({
                url         : "/admin/dashboard/summary_box",
                method      : "GET",
                dataType    : "JSON",
                success     : function(data)
                {
                    $("#countSilver").text(data[0].silver);
                    $("#countGold").text(data[0].gold);
                }
            }); // summary box
        });
    </script>

@endpush