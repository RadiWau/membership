<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- END: Head-->
@include('_partials.header')

@stack('custom-css')
<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu horizontal-menu-padding material-horizontal-layout material-layout 2-columns  " data-open="click" data-menu="horizontal-menu" data-col="2-columns">

   @include('_partials.navbar')

   @include('_partials.menu')
    <!-- BEGIN: Content-->
    <div class="app-content container center-layout mt-2">
        <div class="content-header row">
            
        </div>
        <div class="content-overlay"></div>
            <div class="content-wrapper">
                <div class="content-body">
                    @yield('content')
                </div>
            </div>
        </div>

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>
    @stack('scripts')
    @include('_partials.footer')
    @include('_partials.scripts')

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
                if(rupiah < 610.000){
                    $("#txt_message_nominal").fadeIn("slow");
                    $("#txt_message_nominal").text("Minimum Top 610.000");
                }else{
                    $("#txt_message_nominal").fadeOut("slow").text("");
                }
                
                
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