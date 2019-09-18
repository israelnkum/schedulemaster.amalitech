<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'AMALITECH - Schedule Master') }}</title>
    <!-- base:css -->
    <link rel="stylesheet" href="{{asset('public/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/vendor.bundle.base.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/font-awesome.min.css')}}">

    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('public/css/summernote-bs4.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/style.css')}}">

    <!-- endinject -->
    <link rel="stylesheet" href="{{asset('public/css/bootstrap-datepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/tempusdominus-bootstrap-4.min.css')}}">

    <link rel="stylesheet" href="{{asset('public/css/toastr.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/dataTables.bootstrap4.css')}}">
    <link rel="shortcut icon" href="{{asset('public/favicon.ico')}}" />
</head>
<body>


<div class="container-scroller">
    <!-- partial:partials/_horizontal-navbar.html -->
    <div class="horizontal-menu">
        <nav class="navbar top-navbar col-lg-12 col-12 p-0">
            <div class="container">
                <div class="text-left navbar-brand-wrapper d-flex align-items-center justify-content-between">
                    <a class="navbar-brand brand-logo" href="{{route('home')}}"><img class="text-white" src="{{asset('public/amalitech.png')}}" alt="logo"/></a>
                    <a class="navbar-brand brand-logo-mini" href="{{route('home')}}"><img src="{{asset('public/amalitech.png')}}" alt="logo"/></a>
                </div>
                <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                    <ul class="navbar-nav navbar-nav-right">
                        <li class="nav-item nav-search d-none d-lg-flex">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="search">
                                    <i class="mdi mdi-magnify"></i>
                                    </span>
                                </div>
                                <form action="{{route('search-candidate')}}" novalidate class="needs-validation" method="get">
                                    <input type="text" class="form-control" name="search" required placeholder="Search Candidates" aria-label="search" aria-describedby="search">
                                </form>
                            </div>
                        </li>
                        {{-- <li class="nav-item dropdown">
                             <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center" id="notificationDropdown" href="#" data-toggle="dropdown">
                                 <i class="mdi mdi-bell-outline mx-0"></i>
                             </a>
                             <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                                 <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                                 <a class="dropdown-item preview-item">
                                     <div class="preview-thumbnail">
                                         <div class="preview-icon bg-success">
                                             <i class="mdi mdi-information mx-0"></i>
                                         </div>
                                     </div>
                                     <div class="preview-item-content">
                                         <h6 class="preview-subject font-weight-normal">Application Error</h6>
                                         <p class="font-weight-light small-text mb-0 text-muted">
                                             Just now
                                         </p>
                                     </div>
                                 </a>
                                 <a class="dropdown-item preview-item">
                                     <div class="preview-thumbnail">
                                         <div class="preview-icon bg-warning">
                                             <i class="mdi mdi-settings mx-0"></i>
                                         </div>
                                     </div>
                                     <div class="preview-item-content">
                                         <h6 class="preview-subject font-weight-normal">Settings</h6>
                                         <p class="font-weight-light small-text mb-0 text-muted">
                                             Private message
                                         </p>
                                     </div>
                                 </a>
                                 <a class="dropdown-item preview-item">
                                     <div class="preview-thumbnail">
                                         <div class="preview-icon bg-info">
                                             <i class="mdi mdi-account-box mx-0"></i>
                                         </div>
                                     </div>
                                     <div class="preview-item-content">
                                         <h6 class="preview-subject font-weight-normal">New user registration</h6>
                                         <p class="font-weight-light small-text mb-0 text-muted">
                                             2 days ago
                                         </p>
                                     </div>
                                 </a>
                             </div>
                         </li>
                         <li class="nav-item dropdown">
                             <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="messageDropdown" href="#" data-toggle="dropdown">
                                 <i class="mdi mdi-email-outline mx-0"></i>
                                 <p class="notification-ripple notification-ripple-bg">
                                     <span class="ripple notification-ripple-bg"></span>
                                     <span class="ripple notification-ripple-bg"></span>
                                     <span class="ripple notification-ripple-bg"></span>
                                 </p>
                             </a>
                             <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                                 <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
                                 <a class="dropdown-item preview-item">
                                     <div class="preview-thumbnail">
                                         <img src="http://www.urbanui.com/hiliteui/template/images/faces/face4.jpg" alt="image" class="profile-pic">
                                     </div>
                                     <div class="preview-item-content flex-grow">
                                         <h6 class="preview-subject ellipsis font-weight-normal">David Grey
                                         </h6>
                                         <p class="font-weight-light small-text text-muted mb-0">
                                             The meeting is cancelled
                                         </p>
                                     </div>
                                 </a>
                                 <a class="dropdown-item preview-item">
                                     <div class="preview-thumbnail">
                                         <img src="http://www.urbanui.com/hiliteui/template/images/faces/face2.jpg" alt="image" class="profile-pic">
                                     </div>
                                     <div class="preview-item-content flex-grow">
                                         <h6 class="preview-subject ellipsis font-weight-normal">Tim Cook
                                         </h6>
                                         <p class="font-weight-light small-text text-muted mb-0">
                                             New product launch
                                         </p>
                                     </div>
                                 </a>
                                 <a class="dropdown-item preview-item">
                                     <div class="preview-thumbnail">
                                         <img src="http://www.urbanui.com/hiliteui/template/images/faces/face3.jpg" alt="image" class="profile-pic">
                                     </div>
                                     <div class="preview-item-content flex-grow">
                                         <h6 class="preview-subject ellipsis font-weight-normal"> Johnson
                                         </h6>
                                         <p class="font-weight-light small-text text-muted mb-0">
                                             Upcoming board meeting
                                         </p>
                                     </div>
                                 </a>
                             </div>
                         </li>--}}
                        <li class="nav-item dropdown nav-settings d-none d-lg-flex">
                            <a  class="dropdown-toggle text-white text-decoration-none" href="#" data-toggle="dropdown" id="appDropdown">
                                {{Auth::user()->name}}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="appDropdown">
                                <a class="dropdown-item">
                                    <i class="mdi mdi-face-profile text-primary"></i>
                                    My Profile
                                </a>

                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="mdi mdi-logout text-primary"></i>
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        <li class="nav-item nav-user-icon">
                            <a class="nav-link" href="#">
                                <img class="img-fluid" height="auto" width="40" src="{{asset('public/avata.svg')}}" alt="profile"/>
                            </a>
                        </li>
                    </ul>
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
                        <span class="mdi mdi-menu"></span>
                    </button>
                </div>
            </div>
        </nav>
        <nav class="bottom-navbar">
            <div class="container">
                <ul class="nav page-navigation">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('home')}}">
                            <i class="mdi mdi-shield-check menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('schedules.index')}}">
                            <i class="mdi mdi-calendar menu-icon"></i>
                            <span class="menu-title">Scheduler</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('appointment.index')}}">
                            <i class="mdi mdi-book-open menu-icon"></i>
                            <span class="menu-title">Book Slot</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('set-emails.index')}}">
                            <i class="mdi mdi-email menu-icon"></i>
                            <span class="menu-title">Setup Email</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('candidates.index')}}">
                            <i class="mdi mdi-account-multiple menu-icon"></i>
                            <span class="menu-title">Candidates</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('users.index')}}">
                            <i class="mdi mdi-account-multiple menu-icon"></i>
                            <span class="menu-title">Users</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <div class="main-panel">

        @yield('dash-content')
        <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            <div class="footer-wrapper">
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-center text-sm-left d-block d-sm-inline-block">SCHEDULE MASTER &copy; {{date('Y')}}. All rights reserved. </span>
                        {{--                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Designed by: <a href="https://www.urbanui.com/" target="_blank">UrbanUI</a>. </span>--}}
                    </div>
                </footer>
            </div>
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->


<!-- container-scroller -->
<!-- base:js -->
<script src="{{asset('public/js/vendor.bundle.base.js')}}"></script>
<!-- endinject -->
<!-- inject:js -->
<script src="{{asset('public/js/off-canvas.js')}}"></script>
<script src="{{asset('public/js/hoverable-collapse.js')}}"></script>
<script src="{{asset('public/js/template.js')}}"></script>
<script src="{{asset('public/js/settings.js')}}"></script>
<script src="{{asset('public/js/todolist.js')}}"></script>
<script src="{{asset('public/js/users.js')}}"></script>
<script src="{{asset('public/js/dashboard.js')}}"></script>
<!-- endinject -->

<script src="{{asset('public/js/moment.min.js')}}"></script>
<script src="{{asset('public/js/tempusdominus-bootstrap-4.js')}}"></script>
<script src="{{asset('public/js/bootstrap-datepicker.min.js')}}"></script>

<!-- Custom js for this page-->

<script src="{{asset('public/js/formpickers.js')}}"></script>
<script src="{{asset('public/js/toastr.min.js')}}"></script>
<script src="{{asset('public/js/select2.min.js')}}"></script>
<script src="{{asset('public/js/select2.js')}}"></script>

<script src="{{asset('public/js/dataTables/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('public/js/dataTables/buttons.flash.min.js')}}"></script>
<script src="{{asset('public/js/dataTables/jszip.min.js')}}"></script>
<script src="{{asset('public/js/dataTables/pdfmake.min.js')}}"></script>
<script src="{{asset('public/js/dataTables/vfs_fonts.js')}}"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="{{asset('public/js/dataTables/buttons.print.min.js')}}"></script>






<!-- plugin js for this page -->
<script src="{{asset('public/js/dataTables/jquery.dataTables.js')}}"></script>
<script src="{{asset('public/js/dataTables/dataTables.bootstrap4.js')}}"></script>
<!-- End plugin js for this page -->
<!-- Custom js for this page-->
<script src="{{asset('public/js/dataTables/data-table.js')}}"></script>




<script src="{{asset('public/js/summernote-bs4.min.js')}}" referrerpolicy="origin"></script>
<script>
    if ($("#summernoteExample").length) {
        $('#summernoteExample').summernote({

            height: 300,
            tabsize: 2
        });

        $('#merge_field').change(function () {
            $("#summernoteExample").summernote('editor.saveRange');

            // Editor loses selected range (e.g after blur)

            $("#summernoteExample").summernote('editor.restoreRange');
            $("#summernoteExample").summernote('editor.focus');
            $("#summernoteExample").summernote('editor.insertText', $('#merge_field').val());

            $('#merge_field').val('').trigger("change")
        });


    }



    if ($("#subscription").length) {
        $('#subscription').summernote({

            height: 100,
            tabsize: 2
        });
    }

</script>
<!-- endinject -->
@toastr_render

<script>
    /*
   * Form Validation
    */
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>
</body>
</html>

