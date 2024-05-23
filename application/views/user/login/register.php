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
										<h1 class="h4 text-gray-900 mb-4">Register</h1>
									</div>
									<form id="registerForm" method="POST" action="<?= base_url() ?>user/register">
										<div class="form-group">
											<input name="name" class="form-control form-control-user" placeholder="Surname" value="<?= set_value('name'); ?>">
											<?= form_error('name','<small class="text-danger pl-1">','</small>')?? ''; ?>
										</div>
                                        <div class="form-group">
											<input type="number" name="contact" class="form-control form-control-user"  placeholder="Contact" value="<?= set_value('contact'); ?>">
											<?= form_error('contact','<small class="text-danger pl-1">','</small>')?? ''; ?>
										</div>
                                        <div class="form-group">
											<input type="email" name="email" class="form-control form-control-user" placeholder="Username/Email" value="<?= set_value('email'); ?>">
											<?= form_error('email','<small class="text-danger pl-1">','</small>')?? ''; ?>
										</div>
										<div class="form-group">
											<input type="password" name="password" class="form-control form-control-user" placeholder="Password" value="<?= set_value('password'); ?>">
											<?= form_error('password','<small class="text-danger pl-1">','</small>')?? ''; ?>
										</div>
                                        <div class="form-group">
											<input type="password" name="password_confirm" class="form-control form-control-user" placeholder="Password Confirm" value="<?= set_value('password_confirm'); ?>">
											<?= form_error('password_confirm','<small class="text-danger pl-1">','</small>')?? ''; ?>
										</div>
										<hr>
										<!-- <a href="index.html" class="btn btn-google btn-user btn-block">
											<i class="fab fa-google fa-fw"></i> Login with Google
										</a>
										<a href="index.html" class="btn btn-facebook btn-user btn-block">
											<i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
										</a> -->
										<button type="submit" class="btn btn-round btn-primary btn-user btn-block">
											Register
										</button>
									</form>
	
									<div class="text-center">
										<a class="small" href="forgot-password.html">Forgot Password?</a>
									</div>
									<div class="text-center">
                                        <a class="small" href="<?= base_url(); ?>user/login">Sign In</a>
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

    function register(){

        event.preventDefault();
        var form = document.getElementById("registerForm");
        var formData = new FormData(form);

        //console.log(formData);
		//console.log(Array.from(formData.entries()));

        $.ajax({
            type: "POST",
            url: "<?=base_url();?>api/user/signup",
            data: formData,
            processData: false,
            contentType: false,
            success: function (res){
				var data = JSON.parse(res);
				//console.log(data.status);
                if(data.status == 1){
					window.location.href = "<?=base_url();?>user/dashboard";
                }
                else{
					alert(data.message?? '');
                }
            }
        });

    }

</script>