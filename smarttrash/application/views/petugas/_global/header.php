<!doctype html>
<html lang="en" class="no-focus">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

        <title>Smart Trash Monitoring</title>


        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="<?=base_url();?>assets/img/favicons/favicon.png">
        <link rel="icon" type="image/png" sizes="192x192" href="<?=base_url();?>assets/img/favicons/favicon-192x192.png">
        <link rel="apple-touch-icon" sizes="180x180" href="<?=base_url();?>assets/img/favicons/apple-touch-icon-180x180.png">
        <!-- END Icons -->

		<link rel="stylesheet" href="<?=base_url();?>assets/js/plugins/datatables/dataTables.bootstrap4.min.css">

        <!-- Stylesheets -->
		<link rel="stylesheet" id="css-main" href="<?=base_url();?>assets/css/codebase.min.css">

		<link href="<?=base_url();?>assets/toastr/css/toastr.min.css" rel="stylesheet">


        <!-- END Stylesheets -->
		<script type="text/javascript" src='http://maps.google.com/maps/api/js?key=AIzaSyCz1LkOZmWBZRyC1WUJcrOqZiK-7yMuQXk&libraries=places'></script>
    <script src="<?=base_url();?>assets/js/core/jquery.min.js"></script>
    <style type="text/css">
        .map-wrapper {
        position: relative;
        height: 100%;
        width: 100%;
        }

        #map {
        position: absolute;
        top: 0;
        bottom: 0;
        right: 0;
        left: 0;
        }
        </style>

	</head>
<body>

        <div id="page-container" class="sidebar-o side-scroll page-header-fixed page-header-inverse main-content-boxed">
            <nav id="sidebar">
                <!-- Sidebar Scroll Container -->
                <div id="sidebar-scroll">
                    <!-- Sidebar Content -->
                    <div class="sidebar-content">
                        <!-- Side Header -->
                        <div class="content-header content-header-fullrow px-15" style="background-color:#42a5f5">
                            <!-- Mini Mode -->
                            <div class="content-header-section sidebar-mini-visible-b" >
                                <!-- Logo -->
                                <span class="content-header-item font-w700 font-size-xl float-left animated fadeIn">
                                    <span class="text-dual-primary-dark">S</span><span class="text-primary">TM</span>
                                </span>
                                <!-- END Logo -->
                            </div>
                            <!-- END Mini Mode -->

                            <!-- Normal Mode -->
                            <div class="content-header-section text-center align-parent sidebar-mini-hidden" >
                                <!-- Close Sidebar, Visible only on mobile screens -->
                                <!-- Layout API, functionality initialized in Codebase() -> uiApiLayout() -->
                                <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r" data-toggle="layout" data-action="sidebar_close">
                                    <i class="fa fa-times" style="color:#fff"></i>
                                </button>
                                <!-- END Close Sidebar -->

                                <!-- Logo -->
                                <div class="content-header-item">
                                    <a class="link-effect font-w700" href="index.html">
									<!--<img src="<?//=base_url('assets/img/logo-white.png');?>" width="40px">-->
                                        <span style="color:#fff" class="font-size-xl">SMART</span><span class="font-size-xl" style="color:#fff"> TRASH</span>
                                    </a>
                                </div>
                                <!-- END Logo -->
                            </div>
                            <!-- END Normal Mode -->
                        </div>
                        <!-- END Side Header -->

                        <!-- Side User -->
                        <div class="content-side content-side-full content-side-user px-10 align-parent" style="height:100px;">
                            <!-- Visible only in mini mode -->
                            <div class="sidebar-mini-visible-b align-v animated fadeIn">
                                <img class="img-avatar img-avatar32" src="assets/img/avatars/avatar15.jpg" alt="">
                            </div>
                            <!-- END Visible only in mini mode -->

                            <!-- Visible only in normal mode -->
                            <div class="sidebar-mini-hidden-b text-center" >
								<div class="row">
									<div class="col-md-6">
										<a class="img-link" href="be_pages_generic_profile.html">
											<img class="img-avatar" src="<?=base_url();?>assets/img/avatars/avatar15.jpg" alt="">
										</a>
									</div>
									<div class="col-md-6">
										<ul class="list-inline mt-12" style="align:left">
											<li class="list-inline-item">
												<a class="link-effect text-dual-primary-dark font-size-xs font-w600 text-uppercase" href="be_pages_generic_profile.html">Admin</a>
											</li>
											<br/>
											<li class="list-inline-item">
												<a class="link-effect text-dual-primary-dark" href="<?=base_url('Auth/logout');?>"> Keluar
												</a>
											</li>
										</ul>
									</div>
								</div>
                            </div>
                            <!-- END Visible only in normal mode -->
                        </div>
                        <!-- END Side User -->

                        <?php //var_dump($this->session->userdata('logged_in'));
							$this->load->view('petugas/_global/side_nav');
						?>

                    </div>
                    <!-- Sidebar Content -->
                </div>
                <!-- END Sidebar Scroll Container -->
            </nav>
            <!-- END Sidebar -->

            <!-- Header -->
            <header id="page-header" style="background-color:#42a5f5">
                <!-- Header Content -->
                <div class="content-header">
                    <!-- Left Section -->
                    <div class="content-header-section">
                        <!-- Toggle Sidebar -->
                        <!-- Layout API, functionality initialized in Codebase() -> uiApiLayout() -->
                        <button type="button" class="btn btn-circle btn-dual-secondary" data-toggle="layout" data-action="sidebar_toggle">
                            <i class="fa fa-navicon"></i>
                        </button>
                        <!-- END Toggle Sidebar -->
                    </div>
                    <!-- END Left Section -->

                    <!-- Right Section -->
                    <div class="content-header-section">
                        <!-- User Dropdown -->
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-rounded btn-dual-secondary" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Admin<i class="fa fa-angle-down ml-5"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right min-width-150" aria-labelledby="page-header-user-dropdown">

                                <a class="dropdown-item" href="<?=base_url('Auth/logout');?>">
                                    <i class="si si-logout mr-5"></i> Sign Out
                                </a>
                            </div>
                        </div>
                        <!-- END User Dropdown -->
                    </div>
                    <!-- END Right Section -->
                </div>
                <!-- END Header Content -->

            </header>
            <!-- END Header -->
