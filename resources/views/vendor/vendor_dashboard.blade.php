<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{ asset('admin_backend/assets') }}/images/favicon-32x32.png" type="image/png" />
    <!--plugins-->
    <link href="{{ asset('admin_backend/assets') }}/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <link href="{{ asset('admin_backend/assets') }}/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="{{ asset('admin_backend/assets') }}/plugins/perfect-scrollbar/css/perfect-scrollbar.css"
        rel="stylesheet" />
    <link href="{{ asset('admin_backend/assets') }}/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <!-- loader-->
    rel="stylesheet" />
    <script src="{{ asset('admin_backend/assets') }}/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('admin_backend/assets') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('admin_backend/assets') }}/css/app.css" rel="stylesheet">
    <link href="{{ asset('admin_backend/assets') }}/css/icons.css" rel="stylesheet">
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="{{ asset('admin_backend/assets') }}/css/dark-theme.css" />
    <link rel="stylesheet" href="{{ asset('admin_backend/assets') }}/css/semi-dark.css" />
    <link rel="stylesheet" href="{{ asset('admin_backend/assets') }}/css/header-colors.css" />
    <!-- DataTable -->
	<link href="{{ asset('admin_backend/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <!--input tags-->
	<link href="{{ asset('admin_backend/assets/plugins/input-tags/css/tagsinput.css') }}" rel="stylesheet" />

    <!-- Front Awsome Cdn-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
        integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

    <title>Rukada - Responsive Bootstrap 5 Admin Template</title>
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->
        @include('vendor.body.sideber');
        <!--end sidebar wrapper -->
        <!--start header -->
        @include('vendor.body.header');


        <!--end header -->
        <!--start page wrapper -->
        <div class="page-wrapper">
            @yield('vendor');
        </div>
        <!--end page wrapper -->
        <!--start overlay-->
        <div class="overlay toggle-icon"></div>
        <!--end overlay-->
        <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i
                class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->
        @include('vendor.body.footer');
    </div>
    <!--end wrapper-->
    <!--start switcher-->

    <!--end switcher-->
    <!-- Bootstrap JS -->
    <script src="{{ asset('admin_backend/assets') }}/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="{{ asset('admin_backend/assets') }}/js/jquery.min.js"></script>
    <script src="{{ asset('admin_backend/assets') }}/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="{{ asset('admin_backend/assets') }}/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="{{ asset('admin_backend/assets') }}/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="{{ asset('admin_backend/assets') }}/plugins/chartjs/js/Chart.min.js"></script>
    <script src="{{ asset('admin_backend/assets') }}/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="{{ asset('admin_backend/assets') }}/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="{{ asset('admin_backend/assets') }}/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
    <script src="{{ asset('admin_backend/assets') }}/plugins/sparkline-charts/jquery.sparkline.min.js"></script>
    <script src="{{ asset('admin_backend/assets') }}/plugins/jquery-knob/excanvas.js"></script>
    <script src="{{ asset('admin_backend/assets') }}/plugins/jquery-knob/jquery.knob.js"></script>
    <script>
        $(function() {
			  $(".knob").knob();
		  });
    </script>
    <script src="{{ asset('admin_backend/assets') }}/js/index.js"></script>
    <!--app JS-->
    <script src="{{ asset('admin_backend/assets') }}/js/app.js"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        @if(Session::has('message'))
     var type = "{{ Session::get('alert-type','info') }}"
     switch(type){
        case 'info':
        toastr.info(" {{ Session::get('message') }} ");
        break;

        case 'success':
        toastr.success(" {{ Session::get('message') }} ");
        break;

        case 'warning':
        toastr.warning(" {{ Session::get('message') }} ");
        break;

        case 'error':
        toastr.error(" {{ Session::get('message') }} ");
        break;
     }
     @endif
    </script>

    <!--Datatable-->
<script src="{{ asset('admin_backend/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script>
		$(document).ready(function() {
			$('#example').DataTable();
		  } );
	</script>
<!--Datatable-->


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
 <script src="{{ asset('admin_backend/assets/js/code.js') }}"></script>

 <script src="{{ asset('admin_backend/assets/plugins/input-tags/js/tagsinput.js') }}"></script>

 	<script src='https://cdn.tiny.cloud/1/vdqx2klew412up5bcbpwivg1th6nrh3murc6maz8bukgos4v/tinymce/5/tinymce.min.js' referrerpolicy="origin">
	</script>

	<script>
		tinymce.init({
		  selector: '#mytextarea'
		});
	</script>

<script src="assets/plugins/input-tags/js/tagsinput.js"></script>

<script src='https://cdn.tiny.cloud/1/vdqx2klew412up5bcbpwivg1th6nrh3murc6maz8bukgos4v/tinymce/5/tinymce.min.js' referrerpolicy="origin">
</script>
<script>
    tinymce.init({
      selector: '#mytextarea'
    });
</script>


</body>

</html>
