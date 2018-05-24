<?php  
	include('controllers/login_controller.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	
	<title>Login</title>
	<!-- jQuery -->
	<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="js/jquery.easing.min.js"></script>

	<!-- Bootstrap -->
	<link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.min.css">
	<script type="text/javascript" src="lib/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>

	<!-- Font Awesome -->
	<link rel="stylesheet" type="text/css" href="lib/fontawesome/fontawesome-all.min.css">

	<!-- sb-admin template -->
	<link href="css/sb-admin.css" rel="stylesheet">
</head>
<body class="bg-dark">
	<div class="container">
		<div class="card card-login mx-auto mt-5">
			<div class="card-header">Login</div>
			<div class="card-body">
				<?php echo $msgDisplay; ?>
				<form class="form-horizontal" method="POST">
					<div class="form-group">
						<label for="inpEmail">Email address</label>
						<input class="form-control" id="inpEmail" name="inpEmail" type="email" placeholder="Enter email" required="true">
					</div>
					<div class="form-group">
						<label for="inpPassword">Password</label>
						<input class="form-control" id="inpPassword" name="inpPassword" type="password" placeholder="Password" required="true">
					</div>
					<button class="btn btn-primary btn-block" id="btnLogin" name="btnLogin">Login</button>
					<div class="text-center">
						<a href="register.php" class="d-block small mt-3">Register an Account</a>
						<a href="forgot_password.php" class="d-block small">Forgot Password?</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>