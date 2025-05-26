@extends('app')

@push('custom-css')


@endpush

@section('title','Data Customers')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <div class="row">
        <div class="col-12">
             <!-- Column rendering table -->
             <section id="column">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title font-weight-bold">Data Customers</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content collapse show">
                                <div class="card-body card-dashboard dataTables_wrapper dt-bootstrap">
                                   <div class="row mb-2">
                                        <div class="col-12">
                                            <button class="btn btn-primary" onclick="addCustomer()">Add Customer</button>
                                        </div>
                                   </div>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered" id="tbl_customers" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Customers Id</th>
                                                    <th>Customers Name</th>
                                                    <th>PIC</th>
                                                    <th>Email</th>
                                                    <th>Jump</th>
                                                    <th>Status</th>
                                                    <th>Created At</th>
                                                    <th>Created By</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Customers Id</td>
                                                    <td>Customers Name</td>
                                                    <td>PIC</td>
                                                    <td>Email</td>
                                                    <td>Jump</td>
                                                    <td>Status</td>
                                                    <td>Created At</td>
                                                    <td>Created By</td>
                                                    <td>Action</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Column rendering table -->
        </div>
    </div>

    <!-- Modal Add Customers -->
    <div class="modal animated fade text-left" id="addCustomersModal" style="border-radius: 15px !important;" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="border-radius: 15px !important;" role="document">
            <div class="modal-content">
                <div class="modal-header bg-white pb-0 border-0">
                    <h4 class="modal-title text-primary font-weight-bold" id="modal_title"></h4>
                    <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" id="FormCustomers" enctype="multipart/form-data">
                        @csrf
                        <div class="row position-relative">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="no-telp-perusahaan-inp" class="text-dark">Company Name</label>
                                    <input type="hidden" id="customer_id" name="customer_id">
                                    <input type="text" id="customer_name" class="form-control input-rounded" placeholder="Insert Company Name" name="customer_name">
                                    <small class="text-danger" id="customer_name_alert"></small>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="no-telp-perusahaan-inp" class="text-dark">PIC</label>
                                    <input type="text" id="pic" class="form-control input-rounded" placeholder="Insert PIC Name" name="pic">
                                    <small class="text-danger" id="pic_alert"></small>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="no-telp-perusahaan-inp" class="text-dark">Email</label>
                                    <input type="email" id="email" class="form-control input-rounded" placeholder="Insert Email" name="email">
                                    <small class="text-danger" id="email_alert"></small>
                                </div>
                            </div>
                            <div class="col-12 div_logo">
                                <div class="form-group">
                                    <img id="imgLogo" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="no-telp-perusahaan-inp" class="text-dark">Logo</label>
                                    <input type="file" id="logo_customer" class="form-control input-rounded" placeholder="Upload Logo" name="logo_customer" accept="image/png, image/gif, image/jpeg, image/jpg" />
                                    <small class="text-danger" id="logo_customer_alert"></small>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="role" class="text-dark">Jump Server</label>
                                    <select name="jump_server" id="jump_server" class="select2-select" required>
                                        <option value="">-- Choise Jump Server --</option>
                                        <option value="1">Yes</option>
                                        <option value="2">No</option>
                                    </select>
                                    <small class="text-danger" id="jump_server_alert"></small>
                                </div>
                            </div>
                            <div class="col-12 jump_div" style="display:none;">
                                <div class="form-group">
                                    <label for="no-telp-perusahaan-inp" class="text-dark">Ip Address</label>
                                    <input type="text" id="ip_address" class="form-control input-rounded" placeholder="Insert IP Address" name="ip_address">
                                    <small class="text-danger" id="ip_address_alert"></small>
                                </div>
                                <div class="form-group">
                                    <label for="no-telp-perusahaan-inp" class="text-dark">Username</label>
                                    <input type="text" id="username" class="form-control input-rounded" placeholder="Insert Username" name="username">
                                    <small class="text-danger" id="username_alert"></small>
                                </div>
                                <div class="form-group">
                                    <label for="no-telp-perusahaan-inp" class="text-dark">Password</label>
                                    <input type="text" id="password" class="form-control input-rounded" placeholder="Insert Password" name="password">
                                    <small class="text-danger" id="password_alert"></small>
                                </div>
                            </div>
                            <div class="col-md-12 mt-1 text-right">
                                <div class="form-group" id="customers_btn"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Import Customers -->
    <div class="modal animated fade text-left" id="importCustomersModal" style="border-radius: 15px !important;" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="border-radius: 15px !important;" role="document">
            <div class="modal-content">
                <div class="modal-header bg-white pb-0 border-0">
                    <h4 class="modal-title text-primary font-weight-bold" id="modal_title">Import Customer</h4>
                    <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" id="importCustomers" enctype="multipart/form-data">
                        @csrf
                        <div class="row position-relative">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="import_customer" class="text-dark">Customer</label>
                                    <input type="file" id="import_customer" class="form-control input-rounded" placeholder="Upload Data Customer" name="import_customer" accept=".xls,.xlsx"/>
                                    <small class="text-danger" id="import_customer_alert"></small>
                                </div>
                            </div>
                            <div class="col-md-12 mt-1 text-right">
                                <div class="form-group" id="customers_btn">
                                    <a href="#" id="upload_customer" onclick="uploadCustomer()" class="btn btn-primary">Save</a>
                                    <a href="#" class="btn btn-info" data-dismiss="modal" aria-label="Close">Back</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-script')
    <script src="{{asset('app-assets/js/scripts/tables/datatables/datatable-advanced.js')}}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token()}}"
                }
        });

        $( document ).ready(function() {
            $('.select2-select').select2({
                width:'100%'
            });

            showAll();

        });

        const showAll = () => {
            const url = "{{route('apps.customers.show.all')}}";
            const csrf = "{{ csrf_token()}}";

            $('#tbl_customers').DataTable({
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
                        data        : 'customer_id',
                        visible     : false,
                        className   : 'text-center'
                    },
                    { 
                        width       :"5%",
                        data        : 'customer_name',
                        className   : 'text-center'
                    },
                    { 
                        width       : "5%",
                        data        : 'pic',
                        className   : 'text-center'
                    },
                    { 
                        width       : "5%",
                        data        : 'email',
                        className   : 'text-center'
                    },
                    { 
                        width       :"3%",
                        data        : null,
                        className   : 'text-center',
                        render      : function(data, type, full) {
                           return data.jump_server == 1 ? "Yes" : "No";
                        }
                    },
                    { 
                        width       :"3%",
                        data        : null,
                        className   : 'text-center',
                        render      : function(data, type, full) {

                           return data.status == 1 ? "Active" : "Not Active";
                        }
                    },
                    { 
                        width       :"3%",
                        data        : null,
                        className   : 'text-center',
                        render      : function(data, type, full) {
                            return `
                                {{ \Carbon\Carbon::parse(`+data.created_at+`)->format('d-m-Y')}}
                            `;
                        }
                    },
                    { 
                        width       : "5%",
                        data        : 'name',
                        className   : 'text-center'
                    },
                    { 
                        width       :"20%",
                        data        : null,
                        sortable    : false,
                        className   : 'text-center',
                        render  : function(data, type, full) {
                            return `
                                <div class="row">
                                    <div class="col-md-5">
                                        <a class="btn btn-sm btn-success" title="edit" href="#" onclick="showCustomer(this)" data-id="${data.customer_id}"><i class="far fa-edit"></i></a> &nbsp;
                                    </div>
                                    <div class="col-md-5">
                                        <a class="btn btn-sm btn-danger" title="delete" href="#" onclick="deleteCustomer(this)" data-id="${data.customer_id}"><i class="fas fa-trash"></i></a> &nbsp;
                                    </div>
                                </div>
                            `;
                        }
                    },
                ]
            });

        }

        const addCustomer = () =>{

            let button = `
                <a href="#" id="save_customer" onclick="saveCustomer()" class="btn btn-primary">Save</a>
                <a href="#" id="cancel_customers" onclick="closeModal()" class="btn btn-info">Back</a>
            `;

            $('#customers_btn').html(button);
            $('#modal_title').text('Add Customers');
            $("#addCustomersModal").modal("show");
        }

        const saveCustomer =  () => {
            
            const url             = "{{route('apps.customers.store')}}";
            const csrf            = "{{ csrf_token()}}";

            const customer_name   = $('#customer_name').val();
            const pic             = $('#pic').val();
            const email           = $('#email').val();
            const logo            = $('#logo_customer')[0].files[0];
            const jump_server     = $('#jump_server option:selected').val();
            const ip_address      = $('#ip_address').val();
            const username        = $('#username').val();
            const password        = $('#password').val();

            var fileSelect = document.getElementById('logo_customer');
            var files = fileSelect.files;
            var file = files[0]

            var form = $('#FormCustomers')[0];
            var form_data = new FormData(form);

            
            $.ajax({
                url: url,
                type: "post",
                contentType: false,
                processData: false,
                dataType : 'json',
                enctype: "multipart/form-data",
                data: new FormData(form),
                beforeSend:function () {
                    Notiflix.Loading.hourglass({
                        svgColor:"#6777ef"
                    });
                },
                success: function(response) {
                    Notiflix.Loading.remove();
                   if(response.code == 200){
                        Notiflix.Notify.success('Add Customer Device Success');
                        location.reload();
                   }else{
                    Notiflix.Notify.failure(response.message);
                   }
                },
                error:function(err){
                    Notiflix.Loading.remove();

                    Notiflix.Notify.failure('Add Customer Device Failed');

                    if (err.responseJSON.code == 400) {
                        $('#customer_name_alert').text((err.responseJSON.message.customer_name) ? err.responseJSON.message.customer_name.join() : "");
                        $('#logo_customer_alert').text((err.responseJSON.message.logo_customer) ? err.responseJSON.message.logo_customer.join() : "");
                        $('#jump_server_alert').text((err.responseJSON.message.jump_server) ? err.responseJSON.message.jump_server.join() : "");
                        $('#ip_address_alert').text((err.responseJSON.message.ip_address) ? err.responseJSON.message.ip_address.join() : "");
                        $('#username_alert').text((err.responseJSON.message.username) ? err.responseJSON.message.username.join() : "");
                        $('#password_alert').text((err.responseJSON.message.password) ? err.responseJSON.message.password.join() : "");
                    }
                }
            });
        }

        const showCustomer = (d) => {
            
            event.preventDefault();
            const url = "{{route('apps.customers.show')}}";

            $.ajax({
                url: url,
                type: "post",
                data: {
                    'customer_id' : d.getAttribute('data-id'),
                },
                beforeSend:function () {
                    Notiflix.Loading.hourglass({
                        svgColor:"#6777ef"
                    });
                },
                success: function(response) {

                    let data = response.data;
                    $('#customer_id').val(data.customer_id);
                    $('#customer_name').val(data.customer_name);
                    $('#pic').val(data.pic);
                    $('#email').val(data.email);
                    $('#imgLogo').show().attr("src", "/customers/logo/"+data.customer_id);
                    $('#jump_server').val(data.jump_server);

                    if(data.jump_server == 1){
                        $(".jump_div").fadeIn("slow");
                    }
                    $('#ip_address').val(data.ip_address);
                    $('#username').val(data.username);
                    $('#password').val(data.password);

                    Notiflix.Loading.remove();

                },
                error:function(err){
                    Notiflix.Loading.remove();
                    Notiflix.Notify.failure('Show Customer Failed');
                }
            });

            let button = `
                <a href="#" id="save_customer" onclick="updateCustomer('${d.getAttribute('data-id')}')" class="btn btn-primary">Update</a>
                <a href="#" id="cancel_customer" onclick="closeModal()" class="btn btn-info">Back</a>
            `;

            $('#customers_btn').html(button);

            $('#modal_title').text('Update Customer');

            $("#addCustomersModal").modal("show");
        }

        const updateCustomer = (id) => {
            event.preventDefault();
            
            const url               = "{{route('apps.customers.update')}}";
            const csrf              = "{{ csrf_token()}}";

            const customer_id       = id;
            const customer_name     = $('#customer_name').val();
            const pic               = $('#pic').val();
            const email             = $('#email').val();
            const logo              = $('#logo_customer')[0].files[0];
            const jump_server       = $('#jump_server option:selected').val();
            const ip_address        = $('#ip_address').val();
            const username          = $('#username').val();
            const password          = $('#password').val();

            var fileSelect = document.getElementById('logo_customer');
            var files = fileSelect.files;
            var file = files[0]

            var form = $('#FormCustomers')[0];
            var form_data = new FormData(form);

            $.ajax({
                url: url,
                type: "post",
                contentType: false,
                processData: false,
                dataType : 'json',
                enctype: "multipart/form-data",
                data: new FormData(form),
                beforeSend:function () {
                    Notiflix.Loading.hourglass({
                        svgColor:"#6777ef"
                    });
                },
                success: function(response) {
                    Notiflix.Loading.remove();
                   if(response.code == 200){
                        Notiflix.Notify.success('Edit Customer Device Success');
                        location.reload();
                   }else{
                    Notiflix.Notify.failure(response.message);
                   }
                },
                error:function(err){
                    Notiflix.Loading.remove();

                    Notiflix.Notify.failure('Edit Customer Device Failed');

                    if (err.responseJSON.code == 400) {
                        $('#customer_name_alert').text((err.responseJSON.message.customer_name) ? err.responseJSON.message.customer_name.join() : "");
                        $('#logo_customer_alert').text((err.responseJSON.message.logo_customer) ? err.responseJSON.message.logo_customer.join() : "");
                        $('#jump_server_alert').text((err.responseJSON.message.jump_server) ? err.responseJSON.message.jump_server.join() : "");
                        $('#ip_address_alert').text((err.responseJSON.message.ip_address) ? err.responseJSON.message.ip_address.join() : "");
                        $('#username_alert').text((err.responseJSON.message.username) ? err.responseJSON.message.username.join() : "");
                        $('#password_alert').text((err.responseJSON.message.password) ? err.responseJSON.message.password.join() : "");
                    }
                }
            });
        }

        const deleteCustomer = (d) => {
            event.preventDefault();

            let id = d.getAttribute('data-id');

            const url = "{{route('apps.customers.delete')}}";
            const csrf = "{{ csrf_token()}}";

            Notiflix.Confirm.show(
                'Delete Customer',
                'Are You Sure ?',
                'Yes',
                'Cancel',
                function() {
                    $.ajax({
                        url: url,
                        type: "post",
                        data: {
                            'customer_id' : id,
                        },
                        beforeSend:function () {
                            Notiflix.Loading.hourglass({
                                svgColor:"#6777ef"
                            });
                        },
                        success: function(response) {
                            Notiflix.Loading.remove();
                            Notiflix.Notify.success('Delete Customer Successfully');
                            location.reload();
                        },
                        error:function(err){
                            console.log(err);
                            Notiflix.Notify.failure('Delete Customer Failed');
                        }
                    });
                }
            );
        }

        
        $(document).on("change", "#jump_server", function(){
            const value = $(this).val();
            if(value == 1){
                $(".jump_div").fadeIn("slow")
            }else{
                $("#ip_address").val("");
                $("#username").val("");
                $("#password").val("");
                $(".jump_div").fadeOut("slow")
            }
        });

        $(document).on("click", "#show_password", function(){
            $(this).toggleClass("active");
            if ($(this).hasClass("active")) {
                $("#password").attr("type", "text");
                $("#show_password").removeClass("fa fa-solid fa-lock").addClass( "fa fa-solid fa-unlock" );
            } else {
                $("#password").attr("type", "password");
                $("#show_password").removeClass("fa fa-solid fa-unlock").addClass( "fa fa-solid fa-lock" );
            }
        })

        const closeModal = () => {
            $("#FormCustomers")[0].reset();
            $('#customer_name').val("");
            $('#pic').val("");
            $('#email').val("");
            $('#jump_server option:selected').val("");
            $('#ip_address').val("");
            $('#username').val("");
            $('#password').val("");
            $(".jump_div").hide();
            $('#imgLogo').hide();
            $("#addCustomersModal").modal("hide");
        }

        const importCustomer = () =>{

            $("#importCustomersModal").modal("show");
        }

        const uploadCustomer =  () => {
            
            const url             = "{{route('apps.customers.import')}}";
            const csrf            = "{{ csrf_token()}}";

            const logo            = $('#logo_customer')[0].files[0];


            var form = $('#importCustomers')[0];
            var form_data = new FormData(form);

            
            $.ajax({
                url: url,
                type: "post",
                contentType: false,
                processData: false,
                dataType : 'json',
                enctype: "multipart/form-data",
                data: new FormData(form),
                beforeSend:function () {
                    Notiflix.Loading.hourglass({
                        svgColor:"#6777ef"
                    });
                },
                success: function(response) {
                    
                    Notiflix.Loading.remove();
                    if(response.code == 200){
                        Notiflix.Notify.success('Import Customer Success');
                        location.reload();
                    }else{
                        Notiflix.Notify.failure(response.message);
                    }
                },
                error:function(err){
                    Notiflix.Loading.remove();

                    Notiflix.Notify.failure('Import Customer Failed');

                    if (err.responseJSON.code == 400) {
                        $('#import_customer_alert').text((err.responseJSON.message.import_customer) ? err.responseJSON.message.import_customer.join() : "");
                    }
                }
            });
        }
    </script>
@endpush
