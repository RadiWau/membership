
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    @include('_partials.header')
    @stack('custom-css')
</head>

<body class="vertical-layout vertical-menu content-left-sidebar chat-application  fixed-navbar" data-open="click" data-menu="vertical-menu" data-col="content-left-sidebar">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div class="card mx-auto border-grey border-lighten-3 m-0" style="max-width: 400px">
                    <div class="card-header border-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card-title text-center">
                                    <img src="{{asset('app-assets/images/logo.png')}}" width="200px" height="150px"></img>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                                    <span>Masuk</span>
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="card-body p-0">
                            <form class="form p-3 pb-0" style="margin-top: -20px" method="post" action="{{route('admin.action.login')}}">
                                @if(Session::has('login_gagal'))
                                    <div class="alert alert-danger alert-dismissable fade show" role="alert">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                        {{ Session::get('login_gagal') }}
                                    </div>
                                @endif
                                
                                @csrf
                                <div class="row ">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="txt_email" class="text-left float-left">Email</label>
                                            <input type="text" id="txt_email" name="txt_email" class="form-control input-rounded" placeholder="Masukkan email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" >
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="txt_password" class="text-left float-left">Kata Sandi</label>
                                            <input type="password" id="txt_password" name="txt_password" class="form-control input-rounded" placeholder="Kata Sandi" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn btn-primary px-3 py-1"><span class="" style="letter-spacing: 2px;">Masuk</span></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->

</body>
<!-- END: Body-->

</html>