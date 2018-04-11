<?php
	
	session_start();

	if(!isset($_SESSION['logged_uid']))
	{
		header("Location: index.php");
	}

	include_once 'includes/db_connection.php';
	include_once 'includes/tables/user.php';

	$user = new User();

	$user = $user->getUserById($_SESSION['logged_uid']);

?>

<!DOCTYPE html>
<html>
	<head>
		<title>IPN Digital | Welcome!</title>
		<meta charset="utf-8">
		<!--Bootstrap CSS-->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="x-ua-compatible" content="ie-edge">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<!-- *********** -->
		<link rel="stylesheet" href="css/stylesheet.css" type="text/css">
	</head>
	<body>
		<div class="nav">
			<div class="container">
				<div class="row d-flex justify-content-between mt-3">
					<div class="ml-5">
						<button class="btn btn-primary p-1">
							<a class="nav-link text-light" href="./mainpage.php">IPN Digital</a>
						</button>
					</div>
					<div class="">
						<button class="btn btn-info p-1">
							<a class="nav-link text-light" href="./account_config.php"><i class="fas fa-cog"></i> Account Config</a>
						</button>
						<button class="btn btn-danger p-1">
							<a class="nav-link text-light" href="./includes/logout.php"><i class="fas fa-power-off"></i> Log out!</a>
						</button>
					</div>
				</div>
			</div>
		</div>
		<div>
			<div class="container d-flex justify-content-center p-5" style="height: 550px;">
				<div class="text-center">
					<h4>Your sales:</h4>
				</div>
			</div>
			<div>
				
			</div>
		</div>
		<!-- JQuery * Popper * Bootstrap JS -->
		<script src="js/jquery-3.2.1.slim.min.js"></script>
		<script src="js/popper.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/font-awesome.js"></script>
	</body>
</html>