<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin | @yield('title')</title>
    <link href="{{asset('backend/img/favicon.png')}}" rel="icon" type="image/png">
    <!-- Custom fonts for this template-->
    <link href="{{asset('backend/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="{{asset('backend/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend/css/datatables-bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend/css/bootstrap-datepicker3.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend/vendor/select2/select2.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend/vendor/select2/select2-bootstrap.min.css')}}" rel="stylesheet">
    
    {{-- animate css --}}
    {{-- <link href="{{asset('backend/vendor/animate/animate.css')}}" rel="stylesheet"> --}}
    <link href="{{asset('backend/vendor/aos/css/aos.css')}}" rel="stylesheet">
    <style>
        
        body{
            font-family: 'Roboto', sans-serif;
        }
        label{
            font-weight: bolder;
        }
        
        .typeahead {
            z-index: 1051;
        }

        /*If using icon span before input, like <i class="fa fa-asterisk prefix"></i>*/
        span.twitter-typeahead {
            width: 100%;
            /* width: calc(100%); */
            /* margin-left: 3rem; */
        }

        /* Aspect of the dropdown of results*/
        .typeahead.dropdown-menu,
        span.twitter-typeahead .tt-menu {
            margin-top: 0.75rem;
            min-width: 100%;
            background: white;
            /*as large as input*/
            border: none;
            box-shadow: 0 2px 5px 0 rgba(0, 0, 0, .16), 0 2px 10px 0 rgba(0, 0, 0, .12);
            border-radius: 3px;
            /* font-size: 1.2rem; */
        }

        /*Aspect of results, done*/
        span.twitter-typeahead .tt-suggestion {            
            color: #4285F4;
            cursor: pointer;
            padding: .25rem .5rem;
            text-transform: capitalize;
            /* font-weight: 400; */
        }

        /*Hover a result, done*/
        span.twitter-typeahead .active.tt-suggestion,
        span.twitter-typeahead .tt-suggestion.tt-cursor,
        span.twitter-typeahead .active.tt-suggestion:focus,
        span.twitter-typeahead .tt-suggestion.tt-cursor:focus,
        span.twitter-typeahead .active.tt-suggestion:hover,
        span.twitter-typeahead .tt-suggestion.tt-cursor:hover {
            background-color: #4285F4;
            color: #fff;
            border-radius: 3px;
            /* background-color: #EEEEEE;
            color: #4285F4; */
        }

        label.active {
            color: #4285F4 !important;
        }

        //datatables
        .table {
            font-size: 11px;
        }
    </style>
         

    


</head>

<body id="page-top" class="">

    <!-- Page Wrapper -->
    <div id="wrapper">
        @include('backend.component.sidebar')
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                @include('backend.component.navbar')
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    {{-- <div class="d-sm-flex align-items-center justify-content-between mb-4"> --}}
                        {{-- <h1 class="h3 mb-0 text-gray-800">@yield('title')</h1> --}}
                        {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>        --}}
                    {{-- </div> --}}

                    <!-- Content Row -->
                    <div class="row">
                        @include('backend.component.success')
                        @include('backend.component.error')
                        @yield('content')
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            @include('backend.component.footer')

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih tombol "Logout" untuk keluar. "Cancel" untuk batal keluar</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{route('logout')}}">Logout</a>
                </div>
            </div>
        </div>
    </div>    
    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('backend/vendor/jquery/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('backend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}" type="text/javascript"></script>
    {{-- <script src="{{asset('backend/js/bootstrap-datepicker.min.js')}}" type="text/javascript"></script> --}}

    <!-- Core plugin JavaScript-->
    <script src="{{asset('backend/vendor/jquery-easing/jquery.easing.min.js')}}" type="text/javascript"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('backend/js/sb-admin-2.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('backend/js/style.js')}}" type="text/javascript"></script>
    <script src="{{asset('backend/js/jquery-datatables.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('backend/js/datatables-bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('backend/vendor/select2/select2.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('backend/vendor/fontawesome-iconpicker/fontawesome-iconpicker.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('backend/vendor/uploadHBR/js/modernizr.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('backend/vendor/uploadHBR/js/uploadHBR.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('backend/js/bloodhound.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('backend/js/typeahead.jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('backend/vendor/aos/js/aos.js')}}" type="text/javascript"></script>
    @stack('scripts')
</body>
</html>
