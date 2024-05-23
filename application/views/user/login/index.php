<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url(); ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url(); ?>assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

	<div class="container">

		<!-- Outer Row -->
		<div class="row justify-content-center">

			<div class="col-xl-6 col-lg-6 col-md-6">

				<div class="card o-hidden border-0 shadow-lg my-5">
					<div class="card-body p-0">
						<!-- Nested Row within Card Body -->
						<div class="row">
							<!-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> -->
							<div class="col-lg-12">
								<div class="p-5">
									<div class="text-center p-3">
										<img src="<?= base_url() ?>assets/img/image1.png" style="height:200px; width:200px;">
									</div>
									<div class="text-center">
										<h1 class="h4 text-gray-900 mb-4"><b>Phone Book System</b></h1>
										<h1 class="h4 text-gray-900 mb-4">Login</h1>
									</div>
									<div class="text-center">
										<?= $this->session->flashdata('message')?? '' ?>
									</div>
									<form id="loginForm" method="POST" action="<?= base_url() ?>user/login">
										<div class="form-group">
											<input type="email" name="email" class="form-control form-control-user" placeholder="Enter Email" value="<?= set_value('email'); ?>">
										</div>
										<div class="form-group">
											<input type="password" name="password" class="form-control form-control-user" placeholder="Password">
										</div>
										<hr>
										<!-- <a href="index.html" class="btn btn-google btn-user btn-block">
											<i class="fab fa-google fa-fw"></i> Login with Google
										</a>
										<a href="index.html" class="btn btn-facebook btn-user btn-block">
											<i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
										</a> -->
										<button type="submit" class="btn btn-round btn-primary btn-user btn-block" onclick="">
											Login
										</button>
									</form>
									<div class="text-center">
										<a class="small" href="forgot-password.html">Forgot Password?</a>
									</div>
									<div class="text-center">
										<a class="small" href="<?= base_url(); ?>user/register">Create an Account!</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>

		</div>

	</div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?= base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url(); ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url(); ?>assets/js/sb-admin-2.min.js"></script>

</body>

</html>

<script>

    function login(){

        event.preventDefault();
        var form = document.getElementById("loginForm");
        var formData = new FormData(form);

        //console.log(formData);
		console.log(Array.from(formData.entries()));

        $.ajax({
            type: "POST",
            url: "{{ url('/') }}/api/user/login",
            data: formData,
            processData: false,
            contentType: false,
            success: function (res){
                //console.log(res);
                if(res.status == 0){
                    alert(res.message?? '');
                }
                else{
                    window.location.href = "{{ url('/') }}/user/dashboard";
                }
            }
        });

    }

</script>