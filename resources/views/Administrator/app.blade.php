<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->
@include('Administrator._partials.header')

<!-- END: Head-->


<body class="vertical-layout vertical-menu-modern material-vertical-layout material-layout 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

    <!-- BEGIN: NAVBAR-->
    @include('Administrator._partials.navbar')
    <!-- END: NAVBAR-->

    <!-- BEGIN: SIDEBAR -->
    @include('Administrator._partials.sidebar')
    <!-- END: SIDEBAR -->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-header row">
            <div class="content-header-dark bg-img col-12">
                <div class="row">
                    
                </div>
            </div>
        </div>
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-body">
                @yield('content')
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    @include('Administrator._partials.footer')
    <!-- END: Footer-->


    <!-- BEGIN: SCRIPT JS-->
    @stack('scripts')
    @include('Administrator._partials.scripts')
    <!-- END: SCRIPT JS-->

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
            }
        });

        function formatRupiah (angka, prefix) {
            // var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split   		= number_string.split('.'),
            sisa     		= split[0].length % 3,
            rupiah     		= split[0].substr(0, sisa),
            ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

            if(ribuan){
                const separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + '.' + split[1] : rupiah;
            return rupiah;
            
        } // end function format currency

        function formatMonth(month){

            switch(month) {
            case "01":
                return "January";
                break;
            case "02":
                return "Febuary";
                break;
            case "03":
                return "March";
                break;
            case "04":
                return "April";
                break;
            case "05":
                return "May";
                break;
            case "06":
                return "June";
                break;
            case "07":
                return "July";
                break;
            case "08":
                return "August";
                break;
            case "09":
                return "September";
                break;
            case "10":
                return "October";
                break;
            case "11":
                return "November";
                break;
            case "12":
                return "December";
                break;
            default:
                return "-"
            }
        } // end function format month

    </script>
    
</body>
<!-- END: Body-->

</html>