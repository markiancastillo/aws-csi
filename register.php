<?php
	include('controllers/register_controller.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Account Registration</title>

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
		<div class="card card-register mx-auto mt-5">
			<div class="card-header">Account Registration</div>
			<div class="card-body">
				<?php echo $msgDisplay; ?>
				<form class="form-horizontal" method="POST">
					<div class="form-group">
						<div class="form-row">
							<div class="col-md-6">
								<label for="inpFN">First Name</label>
								<input class="form-control" type="text" name="inpFN" maxlength="100" id="inpFN" placeholder="First Name" required="true" />
							</div>
							<div class="col-md-6">
								<label for="inpLN">Last Name</label>
								<input class="form-control" type="text" name="inpLN" maxlength="100" id="inpLN" placeholder="Last Name" required="true" />
							</div>
						</div>
					</div>
					<div class="form-group">
						<label for="inpEmail">Email address</label>
						<input class="form-control" id="inpEmail" name="inpEmail" type="email" maxlength="120" placeholder="Enter a valid email address" required="true">
					</div>
					<div class="form-group">
						<div class="form-row">
							<div class="col-md-6">
								<label for="inpPW">Password</label>
								<input class="form-control" type="password" name="inpPW" maxlength="50" id="inpPW" placeholder="Password" required="true" />
							</div>
							<div class="col-md-6">
								<label for="inpConfirm">Confirm Password</label>
								<input class="form-control" type="password" name="inpConfirm" maxlength="50" id="inpConfirm" placeholder="Re-type Password" required="true" />
							</div>
						</div>
					</div>
					<button class="btn btn-primary btn-block" id="btnRegister" name="btnRegister">Register</button>
				</form>
				<div class="text-center">
					<a href="login.php" class="d-block small mt-3">Back to Login Page</a>
						<a href="forgot_password.php" class="d-block small">Forgot Password?</a>
				</div>
			</div>
		</div>
	</div>
</body>
</html>