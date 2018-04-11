<?php
	
	session_start();

	if(!isset($_SESSION['logged_uid']))
	{
		header("Location: index.php");
	}

	include_once 'includes/db_connection.php';
	include_once 'includes/tables/user.php';

	$user = new User();
	$companies = new User();
	$uid = $_SESSION['logged_uid'];

	$user = $user->getUserById($uid);

	$admin = $companies->getAllUsersByRole(1);
	$companies = $companies->getAllUsersByRole(3);
	
	//var_dump($companies);
	/*
	foreach ($companies as $company) {
		echo $company->USC_CompanyName."<br>";
	}*/

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
			<div class="container d-flex justify-content-center p-5">
				<div class="text-center">
					<h4>Companies:</h4>
				</div>
			</div>
		</div>
		<div class="row mx-0 justify-content-center">
			<?php 
				foreach ($companies as $company) {
					echo
					'<a href="./portals.php?company='.$company->US_ID.'">
						<div class="text-center p-3 mx-4 my-3 rounded fig-companies">
							<figure class="figure">
							  <img src="" class="figure-img img-fluid rounded" alt="">
							  <figcaption class="figure-caption font-weight-bold">
							  	'.$company->USC_CompanyName."<br>".$company->USC_Website."<br>".$company->USC_WorkArea.'
							  </figcaption>
							</figure>
						</div>
					</a>';
				}
			 ?>
		</div>
		<!-- JQuery * Popper * Bootstrap JS -->
		<script src="js/jquery-3.2.1.slim.min.js"></script>
		<script src="js/popper.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/font-awesome.js"></script>
	</body>
</html>