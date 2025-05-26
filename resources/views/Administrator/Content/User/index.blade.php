@extends('Administrator.app')


@section('title','Data User')

@section('content')
    COMING SOON
    <!--<div class="row">
        <div class="col-12">
             <section id="column">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title font-weight-bold">Data User</h4>
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
        </div>
    </div>

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
-->
@endsection

@push('custom-script')
    <script>
    </script>
@endpush
