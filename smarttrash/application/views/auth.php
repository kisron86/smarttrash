<!doctype html>
<html lang="en" class="no-focus">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

        <title>Smart Trash Monitoring</title>

        <meta name="description" content="Ujian Berbasis Komputer Dinas Pendidikan Kota Bekasi">
        <meta name="author" content="Dinas Pendidikan Kota Bekasi">
        <meta name="robots" content="noindex, nofollow">

        <!-- Open Graph Meta -->
        <meta property="og:title" content="Ujian Berbasis Komputer Dinas Pendidikan Kota Bekasi">
        <meta property="og:site_name" content="Dinas Pendidikan Kota Bekasi">
        <meta property="og:description" content="Ujian Berbasis Komputer Dinas Pendidikan Kota Bekasi">
        <meta property="og:type" content="website">
        <meta property="og:url" content="">
        <meta property="og:image" content="">

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="<?=base_url();?>assets/img/favicons/favicon.png">
        <link rel="icon" type="image/png" sizes="192x192" href="<?=base_url();?>assets/img/favicons/favicon-192x192.png">
        <link rel="apple-touch-icon" sizes="180x180" href="<?=base_url();?>assets/img/favicons/apple-touch-icon-180x180.png">
        <!-- END Icons -->

        <!-- Stylesheets -->
		<link rel="stylesheet" id="css-main" href="<?=base_url();?>assets/css/codebase.min.css">
		<link href="<?=base_url();?>assets/toastr/css/toastr.min.css" rel="stylesheet">
        <!-- END Stylesheets -->
	</head>
<body>
    <div id="page-container" class="main-content-boxed">
            <!-- Main Container -->
	<main id="main-container">
		<!-- Page Content -->
		<div class="bg-image" style="background-image: url('assets/img/auth.jpg');">
			<div class="row mx-0 bg-black-op">
				<div class="hero-static col-md-6 col-xl-8 d-none d-md-flex align-items-md-end">
					<div class="p-30 invisible" data-toggle="appear">
						<p class="font-size-h3 font-w600 text-white">
							Internet of Things Project
						</p>
						<p class="font-italic text-white-op">
							Copyright &copy; <span class="js-year-copy">2019</span>
						</p>
					</div>
				</div>
				<div class="hero-static col-md-6 col-xl-4 d-flex align-items-center bg-white invisible" data-toggle="appear" data-class="animated fadeInRight">
					<div class="content content-full">
						<!-- Header -->
						<div class="px-30 py-10">
							<a class="link-effect font-w700" href="<?=base_url();?>">
								<span class="font-size-xl text-primary-dark">Pemerintah Kota</span><span class="font-size-xl"> Surabaya</span>
							</a>
							<h1 class="h3 font-w700 mt-30 mb-10">LOGIN</h1>
							<h2 class="h5 font-w400 text-muted mb-0">Smart Trash Monitoring</h2>
						</div>
						<!-- END Header -->

						<form class="js-validation-signin px-30" id="checkform" action="<?= base_url('auth/login'); ?>" method="post">
							<div class="form-group row">
								<div class="col-12">
									<div class="form-material floating">
										<input type="text" class="form-control" id="login-username" name="login-username">
										<label for="login-username">Username</label>
									</div>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-12">
									<div class="form-material floating">
										<input type="password" class="form-control" id="login-password" name="login-password">
										<label for="login-password">Password</label>
									</div>
								</div>
							</div>
							<?php echo $captcha_img;?>
							<div class="form-group row">
								<div class="col-12">
									<div class="form-material floating">
										<input type="text" class="form-control" id="kode" name="kode">
										<label for="login-password">Kode Keamanan</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<div id="btnLogin"></div>
								
							</div>
						</form>
						<!-- END Sign In Form -->
					</div>
				</div>
			</div>
		</div>
		<!-- END Page Content -->
	</main>
            <!-- END Main Container -->
        </div>
        <!-- END Page Container -->

        <!-- Codebase Core JS -->
        <script src="<?=base_url();?>assets/js/core/jquery.min.js"></script>
        <script src="<?=base_url();?>assets/js/core/bootstrap.bundle.min.js"></script>
        <script src="<?=base_url();?>assets/js/core/jquery.slimscroll.min.js"></script>
        <script src="<?=base_url();?>assets/js/core/jquery.scrollLock.min.js"></script>
        <script src="<?=base_url();?>assets/js/core/jquery.appear.min.js"></script>
        <script src="<?=base_url();?>assets/js/core/jquery.countTo.min.js"></script>
        <script src="<?=base_url();?>assets/js/core/js.cookie.min.js"></script>
        <script src="<?=base_url();?>assets/js/codebase.js"></script>
		<script src="<?=base_url();?>assets/toastr/js/toastr.min.js"></script>

        <!-- Page JS Plugins -->
        <script src="<?=base_url();?>assets/js/plugins/jquery-validation/jquery.validate.min.js"></script>

        <!-- Page JS Code -->
        <script src="<?=base_url();?>assets/js/pages/op_auth_signin.js"></script>
		<script type="text/javascript">
	
			$(document).ready(function(){
				var Tombol = '<button type="submit" class="btn btn-sm btn-hero btn-alt-primary"><i class="si si-login mr-10"></i> Sign In</button>';
				$('#btnLogin').html(Tombol);

				$('#checkform').submit(function(e){
					e.preventDefault();
					Login();
				});
			});

			function Login(){
				$.ajax({
					url: $('#checkform').attr('action'),
					type: "POST",
					cache: false,
					data: $('#checkform').serialize(),
					dataType: 'json',
					success : function(json){
						if(json.status == 1){
							toastr.success('Redirecting.....')
							window.location.href = json.url;
						} else {
							toastr.error(json.pesan);
							$('#pass').val('');
						}
					}
				});
			}

		</script>
    </body>
</html>