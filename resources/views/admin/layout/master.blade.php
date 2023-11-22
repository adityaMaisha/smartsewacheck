<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport" />
    <title>Admin</title>
    <link id="style" href="{{ asset('dashboard/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="{{ asset('dashboard/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('dashboard/css/plugins.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

    <!-- Helper Style -->
    <link href="{{ asset('helper_script/snackbar/snackbar.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('helper_script/simple-lightbox/simple-lightbox.min.css') }}" rel="stylesheet" />

    @yield('style')
</head>

<body class="ltr main-body leftmenu">
    <!-- LOADEAR -->
    <div id="global-loader">
        <img src="{{ asset('dashboard/img/loader.svg') }}" class="loader-img" alt="Loader" />
    </div>
    <!-- END LOADEAR -->

    <!-- PAGE -->
    <div class="page">
        <!-- HEADER -->
        <div class="main-header side-header sticky">
            <div class="main-container container-fluid">
                <div class="main-header-left">
                    <a class="main-header-menu-icon" href="javascript:void(0);" id="mainSidebarToggle"><span></span></a>
                    <div class="hor-logo">
                        <a class="main-logo" href="{{ route('dashboard.home') }}">
                            <img src="{{ asset('dashboard/img/brand/logo.png') }}"
                                class="header-brand-img desktop-logo" />
                        </a>
                    </div>
                </div>
                <div class="main-header-center">
                    <div class="responsive-logo">
                        <a href="index.php.php"><img src="{{ asset('dashboard/img/brand/logo.png') }}"
                                class="mobile-logo" /></a>

                    </div>
                    <div class="input-group">
                        <div class="input-group-btn search-panel">
                            <select class="form-control select2">
                                <option label="All categories"> </option>
                                <option value="IT Projects">
                                    IT Projects
                                </option>
                                <option value="Business Case">
                                    Business Case
                                </option>
                                <option value="Microsoft Project">
                                    Microsoft Project
                                </option>
                                <option value="Risk Management">
                                    Risk Management
                                </option>
                                <option value="Team Building">
                                    Team Building
                                </option>
                            </select>
                        </div>
                        <input type="search" class="form-control rounded-0" placeholder="Search for anything..." />
                        <button class="btn search-btn"><i class="fa fa-search"></i></button>
                    </div>
                </div>
                <div class="main-header-right">
                    <button class="navbar-toggler navresponsive-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fe fe-more-vertical header-icons navbar-toggler-icon"></i>
                    </button>
                    <!-- Navresponsive closed -->
                    <div class="navbar navbar-expand-lg nav nav-item navbar-nav-right responsive-navbar navbar-dark">
                        <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                            <div class="d-flex order-lg-2 ms-auto">
                                <!-- Search -->
                                <div class="dropdown header-search">
                                    <a class="nav-link icon header-search">
                                        <i class="fe fe-search header-icons"></i>
                                    </a>
                                    <div class="dropdown-menu">
                                        <div class="main-form-search p-2">
                                            <div class="input-group">
                                                <div class="input-group-btn search-panel">
                                                    <select class="form-control select2">
                                                        <option label="All categories"> </option>
                                                        <option value="IT Projects">
                                                            IT Projects
                                                        </option>
                                                        <option value="Business Case">
                                                            Business Case
                                                        </option>
                                                        <option value="Microsoft Project">
                                                            Microsoft Project
                                                        </option>
                                                        <option value="Risk Management">
                                                            Risk Management
                                                        </option>
                                                        <option value="Team Building">
                                                            Team Building
                                                        </option>
                                                    </select>
                                                </div>
                                                <input type="search" class="form-control"
                                                    placeholder="Search for anything..." />
                                                <button class="btn search-btn">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                        height="20" viewbox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round" class="feather feather-search">
                                                        <circle cx="11" cy="11" r="8"></circle>
                                                        <line x1="21" y1="21" x2="16.65"
                                                            y2="16.65"></line>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- Search -->
<!-- Theme-Layout -->
                                <div class="dropdown d-flex main-header-theme">
                                    <a class="nav-link icon layout-setting">
                                        <span class="dark-layout">
                                            <i class="fa fa-moon header-icons"></i>
                                        </span>
                                        <span class="light-layout">
                                            <i class="fa fa-moon header-icons"></i>
                                        </span>
                                    </a>
                                </div>
<!-- Theme-Layout -->

<!-- Notification -->
                                <div class="dropdown main-header-notification">
                                    <a class="nav-link icon" href="javascript:void(0);">
                                        <i class="fa fa-bell header-icons"></i>
                                        <span class="badge bg-danger nav-link-badge">4</span>
                                    </a>
                                    <div class="dropdown-menu">
                                        <div class="header-navheading">
                                            <p class="main-notification-text">You have 1 unread notification<span
                                                    class="badge bg-pill bg-primary ms-3">View all</span></p>
                                        </div>
                                        <div class="main-notification-list">
                                            <div class="media new">
                                                <div class="main-img-user online"><img alt="avatar"
                                                        src="https://php.spruko.com/spruha/spruha/assets/img/users/5.jpg"></div>
                                                <div class="media-body">
                                                    <p>Congratulate <strong>Olivia James</strong> for New template
                                                        start</p>
                                                    <span>Oct 15 12:32pm</span>
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="main-img-user"><img alt="avatar"
                                                        src="https://php.spruko.com/spruha/spruha/assets/img/users/2.jpg">
                                                </div>
                                                <div class="media-body">
                                                    <p><strong>Joshua Gray</strong> New Message Received</p>
                                                    <span>Oct 13
                                                        02:56am</span>
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="main-img-user online"><img alt="avatar"
                                                        src="https://php.spruko.com/spruha/spruha/assets/img/users/3.jpg"></div>
                                                <div class="media-body">
                                                    <p><strong>Elizabeth Lewis</strong> added new schedule realease
                                                    </p><span>Oct
                                                        12 10:40pm</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="dropdown-footer">
                                            <a href="#">View All Notifications</a>
                                        </div>
                                    </div>
                                </div>
<!-- Notification -->
                                <!-- Profile -->
                                <div class="dropdown main-profile-menu">
                                    <a class="d-flex" href="javascript:void(0);">
                                        <span class="main-img-user"><img alt="avatar"
                                                src="{{ asset('dashboard/img/users/1.jpg') }}" /></span>
                                    </a>
                                    <div class="dropdown-menu">
                                        <div class="header-navheading">
                                            <h6 class="main-notification-title">Smart Sewa</h6>
                                            <p class="main-notification-text">Super Admin</p>
                                        </div>
                                        <a class="dropdown-item border-top" href="profile.php.html"> <i
                                                class="fa fa-user"></i> My Profile </a>
                                        <a class="dropdown-item" href="profile.php.html"> <i class="fa fa-edit"></i>
                                            Edit Profile </a>
                                        <a class="dropdown-item" href="signin.php"> <i class="fa fa-power-off"></i>
                                            Sign Out </a>
                                    </div>
                                </div>
                                <!-- Profile -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="sticky">
            <div class="main-menu main-sidebar main-sidebar-sticky side-menu">
                <div class="main-sidebar-header main-container-1 active">
                    <div class="sidemenu-logo">
                        <a class="main-logo" href="{{ route('dashboard.home') }}">
                            <img src="{{ asset('dashboard/img/logo.png') }}" class="header-brand-img desktop-logo" />
                        </a>
                    </div>
                    <div class="main-sidebar-body main-body-1">
                        <div class="slide-left disabled" id="slide-left"><i class="fe fe-chevron-left"></i></div>
                        <ul class="menu-nav nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('dashboard.home') }}">
                                    <span class="shape1"></span>
                                    <span class="shape2"></span>
                                    <i class="fa fa-dashboard sidemenu-icon menu-icon"></i>
                                    <span class="sidemenu-label">Dashboard</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link with-sub" href="javascript:void(0)">
                                    <span class="shape1"></span>
                                    <span class="shape2"></span>
                                    <i class="fa fa-users sidemenu-icon menu-icon"></i>
                                    <span class="sidemenu-label">Users </span>
                                    <i class="angle fa fa-chevron-circle-right"></i>
                                </a>
                                <ul class="nav-sub">
                                    <li class="nav-sub-item"><a class="nav-sub-link" href="{{ route('list.employee') }}">List Employees</a></li>
                                    <li class="nav-sub-item"><a class="nav-sub-link" href="{{ route('list.customers') }}">Customers</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link with-sub" href="javascript:void(0)">
                                    <span class="shape1"></span>
                                    <span class="shape2"></span>
                                    <i class="fa fa-user-plus sidemenu-icon menu-icon"></i>
                                    <span class="sidemenu-label">Vendors</span>
                                    <i class="angle fa fa-chevron-circle-right"></i>
                                </a>
                                <ul class="nav-sub">

                                    <li class="nav-sub-item"><a class="nav-sub-link" href="{{ route('labs.list') }}">Path Lab</a></li>
                                    {{-- <li class="nav-sub-item"><a class="nav-sub-link" href="{{ route('vendor.new.path.lab') }}">Path Lab</a></li> --}}
                                    <li class="nav-sub-item"><a class="nav-sub-link" href="{{ route('vendor.list.radiology.diagnostics') }}">Radiology Diagnostics</a></li>
                                    <li class="nav-sub-item"><a class="nav-sub-link" href="{{ route('vendor.hospital.list') }}">Hospitals & Others</a></li>
                                    <li class="nav-sub-item"><a class="nav-sub-link" href="{{ route('vendor.list.doctors.other') }}">Doctors & Other</a></li>
                                    <li class="nav-sub-item"><a class="nav-sub-link" href="{{ route('vendor.list.healthcare.professionals') }}">Healthcare Professionals</a></li>
                                    <li class="nav-sub-item"><a class="nav-sub-link" href="{{ route('vendor.list.htm.consumables.suplliers') }}">HTM Consumables Suplliers</a></li>
                                    {{-- <li class="nav-sub-item"><a class="nav-sub-link" href="#">Products</a></li>
                                    <li class="nav-sub-item"><a class="nav-sub-link" href="javascript:void(0)">Medicine</a></li> --}}
                                </ul>
                            </li>

                            {{-- <li class="nav-item">
                                <a class="nav-link with-sub" href="javascript:void(0)">
                                    <span class="shape1"></span>
                                    <span class="shape2"></span>
                                    <i class="fa fa-user-secret sidemenu-icon menu-icon"></i>
                                    <span class="sidemenu-label">Clients</span>
                                    <i class="angle fa fa-chevron-circle-right"></i>
                                </a>
                                <ul class="nav-sub">
                                    <li class="nav-sub-item"><a class="nav-sub-link" href="{{ route('labs.list') }}">Labs List</a> </li>
                                    <li class="nav-sub-item"><a class="nav-sub-link" href="javascript:;">Doctors</a> </li>
                                    <li class="nav-sub-item"><a class="nav-sub-link" href="{{ route('vendor.new.setup') }}">Hospital</a> </li>
                                </ul>
                            </li> --}}

                            <li class="nav-item">
                                <a class="nav-link with-sub" href="javascript:void(0)">
                                    <span class="shape1"></span>
                                    <span class="shape2"></span>
                                    <i class="fa fa-adjust sidemenu-icon menu-icon"></i>
                                    <span class="sidemenu-label">SmartSewa Services</span>
                                    <i class="angle fa fa-chevron-circle-right"></i>
                                </a>

                                <ul class="nav-sub">
                                    <li class="nav-sub-item"><a class="nav-sub-link" href="{{ route('list.end.custumers') }}">End Custumers</a></li>

                                    <li class="nav-sub-item"><a class="nav-sub-link" href="{{ route('list.business.clients') }}">Business Clients</a></li>

                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link with-sub" href="javascript:void(0)">
                                    <span class="shape1"></span>
                                    <span class="shape2"></span>
                                    <i class="fa fa-adjust sidemenu-icon menu-icon"></i>
                                    <span class="sidemenu-label">SmartSewa Products</span>
                                    <i class="angle fa fa-chevron-circle-right"></i>
                                </a>
                                <ul class="nav-sub">
                                    <li class="nav-sub-item"><a class="nav-sub-link" href="{{ route('packages.list') }}">Packages</a></li>
                                    <li class="nav-sub-item"><a class="nav-sub-link"
                                            href="{{route('products.labtest')}}">Lab Test</a></li>
                                    <li class="nav-sub-item"><a class="nav-sub-link"
                                            href="{{route('products.smarthealthcheckup.index')}}">Smart health checkup</a></li>
                                    <li class="nav-sub-item"><a class="nav-sub-link"
                                            href="{{route('products.appointmentdoctor.index')}}">Appointment with doctor</a></li>
                                    <li class="nav-sub-item"><a class="nav-sub-link"
                                            href="{{route('products.homecare.index')}}">Home care</a></li>
                                    <li class="nav-sub-item"><a class="nav-sub-link"
                                            href="{{route('products.criticalcare.index')}}">Critical care</a></li>
                                    <li class="nav-sub-item"><a class="nav-sub-link"
                                            href="{{route('products.organs.index')}}">Organs</a></li>
                                    <li class="nav-sub-item"><a class="nav-sub-link"
                                            href="{{route('products.banner.index')}}">Banner</a></li>
                                    <li class="nav-sub-item"><a class="nav-sub-link"
                                            href="">Coupon</a></li>
                                </ul>
                            </li>


                            <li class="nav-item">
                                <a class="nav-link with-sub" href="javascript:void(0)">
                                    <span class="shape1"></span>
                                    <span class="shape2"></span>
                                    <i class="fa fa-adjust sidemenu-icon menu-icon"></i>
                                    <span class="sidemenu-label">Order Management</span>
                                    <i class="angle fa fa-chevron-circle-right"></i>
                                </a>
                                <ul class="nav-sub">
                                    <li class="nav-sub-item"><a class="nav-sub-link" href="{{ route('order.end.customer') }}">End Custumers</a></li>
                                    <li class="nav-sub-item"><a class="nav-sub-link" href="{{ route('order.business.clients') }}">Business Clients</a></li>
                                    <li class="nav-sub-item"><a class="nav-sub-link" href="{{ route('assign.lab') }}">Assigns Lab</a></li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link with-sub" href="javascript:void(0)">
                                    <span class="shape1"></span>
                                    <span class="shape2"></span>
                                    <i class="fa fa-adjust sidemenu-icon menu-icon"></i>
                                    <span class="sidemenu-label">Payment History</span>
                                    <i class="angle fa fa-chevron-circle-right"></i>
                                </a>
                                <ul class="nav-sub">
                                    <li class="nav-sub-item"><a class="nav-sub-link" href="{{ route('payment.end.customer') }}">End Custumers</a></li>
                                    <li class="nav-sub-item"><a class="nav-sub-link" href="{{ route('payment.business.clients') }}">Business Clients</a></li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link with-sub" href="javascript:void(0)">
                                    <span class="shape1"></span>
                                    <span class="shape2"></span>
                                    <i class="fa fa-adjust sidemenu-icon menu-icon"></i>
                                    <span class="sidemenu-label">Inventory</span>
                                    <i class="angle fa fa-chevron-circle-right"></i>
                                </a>
                                <ul class="nav-sub">
                                    <li class="nav-sub-item"><a class="nav-sub-link" href="carousel.php.html">Lab
                                            Tests</a></li>
                                    <li class="nav-sub-item"><a class="nav-sub-link"
                                            href="collapse.php.html">Medicines</a></li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link with-sub" href="javascript:void(0)">
                                    <span class="shape1"></span>
                                    <span class="shape2"></span>
                                    <i class="fa fa-adjust sidemenu-icon menu-icon"></i>
                                    <span class="sidemenu-label">Department Management</span>
                                    <i class="angle fa fa-chevron-circle-right"></i>
                                </a>
                                <ul class="nav-sub">
                                    <li class="nav-sub-item"><a class="nav-sub-link"
                                            href="{{ route('list.roles') }}">Department Listing</a></li>
                                    <li class="nav-sub-item"><a class="nav-sub-link"
                                            href="{{ route('new.roles') }}">Department Create</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('setting.home') }}">
                                    <span class="shape1"></span>
                                    <span class="shape2"></span>
                                    <i class="fa fa-cog sidemenu-icon menu-icon"></i>
                                    <span class="sidemenu-label">Settings</span>
                                </a>
                            </li>
                        </ul>
                        <div class="slide-right" id="slide-right"><i class="fa fa-arrow-up"></i></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Body --}} @yield('content')

        <div class="main-footer text-center">
            <div class="container">
                <div class="row row-sm">
                    <div class="col-md-12">
                        <span>Copyright © 2023 <a href="javascript:;">SmartSewa</a>. Designed by <a
                                href="https://maishainfotech.com/" target="_blank">Maisha Infotech</a> All rights
                            reserved.</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- END FOOTER -->
    </div>

    <!-- BACK TO TOP -->
    <a href="#top" id="back-to-top"><i class="fe fe-arrow-up"></i></a>
    {{-- <script src="{{ asset('dashboard/plugins/jquery/jquery.min.js') }}"></script> --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>


    <!-- Helper Script -->
    <script src="{{ asset('helper_script/snackbar/snackbar.min.js') }}"></script>
    <script src="{{ asset('helper_script/simple-lightbox/simple-lightbox.min.js') }}"></script>


    <!-- BOOTSTRAP JS -->
    <script src="{{ asset('dashboard/plugins/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- PERFECT SCROLLBAR JS -->
    <script src="{{ asset('dashboard/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

    <!-- SIDEMENU JS -->
    <script src="{{ asset('dashboard/plugins/sidemenu/sidemenu.js') }}"></script>

    <!-- SIDEBAR JS -->
    <script src="{{ asset('dashboard/plugins/sidebar/sidebar.js') }}"></script>

    <!-- SELECT2 JS -->
    <script src="{{ asset('dashboard/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/select2.js') }}"></script>

    <!-- Internal Chart.Bundle js-->
    <script src="{{ asset('dashboard/plugins/chart.js/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/peity/jquery.peity.min.js') }}"></script>

    <script src="{{ asset('dashboard/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/morris.js/morris.min.js') }}"></script>

    <!-- Circle Progress js-->
    <script src="{{ asset('dashboard/plugins/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/chart-circle.js') }}"></script>

    <!-- Internal Dashboard js-->
    <script src="{{ asset('dashboard/js/index.js') }}"></script>
    <script src="{{ asset('dashboard/js/sticky.js') }}"></script>

    <!-- COLOR THEME JS -->
    <script src="{{ asset('dashboard/js/custom.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- CUSTOM JS -->
    {{-- <script src="assets/js/custom.js"></script> --}}
    <!-- INTERNAL DATA TABLE JS -->
    <script src="{{ asset('dashboard/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatable/js/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatable/js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatable/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatable/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/datatable/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/table-data.js') }}"></script>
    {{-- <script src="{{ asset('dashboard/js/select2.js') }}"></script> --}}


    <!-- INTERNAL JQUERY-UI JS -->
    <script src="{{ asset('dashboard/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>

    <!-- INTERNAL JQUERY.MASKEDINPUT JS -->
    <script src="{{ asset('dashboard/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>

    <!-- INTERNAL SPECTURM-COLORPICKER JS -->
    <script src="{{ asset('dashboard/plugins/spectrum-colorpicker/spectrum.js') }}"></script>

    <!-- INTERNAL ION-RANGESLIDER JS -->
    <script src="{{ asset('dashboard/plugins/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>

    <!-- INTERNAL FORM-ELEMENTS JS -->
    <script src="{{ asset('dashboard/js/form-elements.js') }}"></script>

    <!-- BOOTSTRAP-DATEPICKER JS -->
    <script src="{{ asset('dashboard/plugins/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>

    <!-- INTERNAL JQUERY-SIMPLE-DATETIMEPICKER JS -->
    <script src="{{ asset('dashboard/plugins/amazeui-datetimepicker/js/amazeui.datetimepicker.min.js') }}"></script>

    <!-- INTERNAL FILEUPLOADERS JS -->
    <script src="{{ asset('dashboard/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!-- INTERNAL JQUERY-STEPS JS -->
    <script src="{{ asset('dashboard/plugins/jquery-steps/jquery.steps.min.js') }}"></script>

    <!-- INTERNAL ACCORDION-WIZARD-FORM JS -->
    <script src="{{ asset('dashboard/plugins/accordion-Wizard-Form/jquery.accordion-wizard.min.js') }}"></script>

    <!-- INTERNAL FORM-WIZAR JS -->
    <script src="{{ asset('dashboard/js/form-wizard.js') }}"></script>

    <script src="{{ asset('dashboard/js/apexcharts.js') }}"></script>
    <script src="{{ asset('dashboard/js/ecommerce-dashboard.js') }}"></script>
    <script src="{{ asset('dashboard/js/themeColors.js') }}"></script>




    <script>
        function htmlError(){
            try {
                const $errorSpan = $("span[class*='ERROR__']:not(:empty):first");
                if ($errorSpan.length) $('html, body').animate({ scrollTop: $errorSpan.offset().top - ($(window).height() / 2) }, 'slow');
            } catch (e) {
                console.log('An error occurred: ' + e.message);
            }
        }
        /* Why Use : Scroll On Form Error */

        /* Official : https://www.polonel.com/snackbar */
        function python(snackText, snackActionText = '', snakColor = 'green'){
            Snackbar.show({text: snackText, pos: 'bottom-center', actionText: snackActionText, actionTextColor: snakColor, duration: 5000});
        }
        // python('Hello Word');
        // python('Hello Word', 'Thank You');
        // python('Hello Word', 'Thank You', 'red');

        /*
        function imageSlideBox() {
            $('a.popup_gallery_box').each(function() {
                var gallery = new SimpleLightbox(this, {});
            });
        }

        imageSlideBox();
        */
        /* Official : https://simplelightbox.com/ */
        // <a class="popup_gallery_box" href="https://picsum.photos/id/237/200/300"> <img class="w-25 br-5 img-fluid srb-img-s" src="https://picsum.photos/id/237/200/300"></a>
        // imageSlideBox();


        // function handleBrokenLinkClick(link) {
        //     link.click(function(event) {
        //         event.preventDefault();
        //         var url = link.attr("href");
        //         $.ajax({
        //             type: "HEAD",
        //             url: url,
        //             complete: function(xhr) {
        //                 if (xhr.status === 200) {
        //                     window.open(url, '_blank');
        //                 } else if (xhr.status === 404) {
        //                     python('Image Link Broken', 'Status 404', 'red');
        //                 }
        //             }
        //         });
        //     });
        // }

        // $(function() {
        //     handleBrokenLinkClick($(".broken_404"));
        // });
        // <a href="' . asset('documents12/'.$getInfo->employee_profile) . '" target="_NEW" class="broken_404">View Image</a>


        function _showBorder(attributeName='required') {
            const elements = document.querySelectorAll(`[${attributeName}]`);
            for (let i = 0; i < elements.length; i++) {
                elements[i].style.border = '2px solid red';
            }
            const select2Fields = document.querySelectorAll('.select2[required]');
            for (let i = 0; i < select2Fields.length; i++) {
                select2Fields[i].nextElementSibling.querySelector('.select2-selection').style.border = '2px solid red';
            }
        }
        // _showBorder();
        // _showBorder('required');
        // only required attribute html tag border red

    </script>
    @yield('script')
</body>
</html>
