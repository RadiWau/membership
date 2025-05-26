
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    @include('_partials.header')

    @stack('custom-css')
</head>
<!-- END: Head-->


<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu content-left-sidebar chat-application  fixed-navbar" data-open="click" data-menu="vertical-menu" data-col="content-left-sidebar">
    <!-- BEGIN: Content-->
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
                                @yield('title-auth')
                            </div>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="card-body p-0">
                            @yield('content')
                        </div>
                        @yield('text-footer')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->

    @include('_partials.scripts')

    @stack('custom-script')

</body>
<!-- END: Body-->

</html>