@extends('Administrator.app')

@section('title','Data Member')

@stack('scripts')
@section('content')

<div class="row">
    <div class="col-xl-6 col-md-6 col-12">
        <div class="card badge-secondary">
            <div class="card-content">
                <div class="card-body">
                    <div class="media d-flex">
                        <div class="media-body text-white text-left">
                            <h3 class="text-white" id="countSilver">0</h3>
                            <span>Member Silver</span>
                        </div>
                        <div class="align-self-center">
                            <i class="icon-user text-white font-large-2 float-right"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6 col-md-6 col-12">
        <div class="card bg-warning">
            <div class="card-content">
                <div class="card-body">
                    <div class="media d-flex">
                        <div class="media-body text-white text-left">
                            <h3 class="text-white" id="countGold">0</h3>
                            <span>Member Gold</span>
                        </div>
                        <div class="align-self-center">
                            <i class="icon-user text-white font-large-2 float-right"></i>
                        </div>
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
                <h4 class="card-title" style="color:white;">List Member</h4>
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
                        <div class="table-responsive my-2">
                            <table class="table table-striped table-bordered" id="tbl_member" width="100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Member Id</th>
                                        <th>Nomor Hp</th>
                                        <th>Nama Member</th>
                                        <th>Paket</th>
                                        <th>Sponsor Code</th>
                                        <th>Status Member</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div >
                </div >
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="{{asset('app-assets/vendors/js/tables/datatable/datatables.min.js')}}"></script>
    
    <script>
        const showAll = () => {

            const csrf = "{{ csrf_token()}}";
            const url = "{{ route('member.list')}}";

            $('#tbl_member').DataTable({
                'ajax': {
                    'url':url,
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
                        data     : 'user_id',
                        visible  : false,
                        className: 'text-center'
                    },
                    { 
                        width       : "auto",
                        data        : null,
                        className   : 'text-center',
                        render      : function(data, type, full) {

                            return `
                                <a href='/admin/member/detil_member/`+data.user_id+`'> `+data.no_hp+` </a>
                            `;
                        }
                    },
                    { 
                        width       : "auto",
                        data        : 'nama_lengkap',
                        className   : 'text-center'
                    },
                    { 
                        width       : "auto",
                        data        : null,
                        className   : 'text-center',
                        render      : function(data, type, full) {
                            
                            console.log(data.paket_value);
                            if(data.paket == 1){
                                return `
                                    <span class="badge badge-secondary users-view-status">`+data.paket_value+`</span>
                                `;
                            }else{
                                return `
                                    <span class="badge badge-warning users-view-status">`+data.paket_value+`</span>
                                `;
                            }
                            
                        }
                    },
                    { 
                        width       : "auto",
                        data        : 'sponsor_code',
                        className   : 'text-center'
                    },
                    { 
                        width       : "auto",
                        data        : null,
                        className   : 'text-center',
                        render      : function(data, type, full) {
                            
                            if(data.status == 1){
                                return `
                                    <span class="badge badge-primary users-view-status">`+data.status_member+`</span>
                                `;
                            }
                            else if(data.status == 2){
                                 return `
                                    <span class="badge badge-success users-view-status">`+data.status_member+`</span>
                                `;
                            }
                            else if(data.status == 3){
                                 return `
                                    <span class="badge badge-info users-view-status">`+data.status_member+`</span>
                                `;
                            }
                            else{
                                return `
                                    <span class="badge badge-warning users-view-status">`+data.status_member+`</span>
                                `;
                            }
                            
                        }
                    }
                ]
            });

        }

        $( document ).ready(function() {
            // summary box
            $.ajax({
                url         : "/admin/member/count_mamber",
                method      : "GET",
                dataType    : "JSON",
                success     : function(data)
                {
                    $("#countSilver").text(data[0].silver);
                    $("#countGold").text(data[0].gold);
                }
            }); // summary box
            
            showAll();
        });

    </script>
@endpush
