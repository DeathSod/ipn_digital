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

	$role = $user->US_FK_RO;

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
					<div class="text-center my-auto">
						Welcome <?php echo $user->US_NameContact . " " . $user->US_LastNameContact; ?> !
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
			<div class="container d-flex justify-content-center align-items-center p-5" style="height: 550px;">
				<?php
					if($role == 2):
				?>
				<div class="col-md-4 text-center">
					<a href="./companies.php">
						<figure class="figure util-ipn">
						  <img src="./img/buy.svg" class="figure-img img-fluid rounded" alt="An icon of a shopping cart.">
						  <figcaption class="figure-caption">Buy spaces</figcaption>
						</figure>
					</a>
				</div>
				<div class="col-md-4 text-center">
					<a href="./salespage.php">
						<figure class="figure util-ipn">
						  <img src="./img/sell.svg" class="figure-img img-fluid rounded" alt="An icon of a dollar sign inside a circle.">
						  <figcaption class="figure-caption">Check your purchases</figcaption>
						</figure>
					</a>
				</div>
				<?php
					else:
				?>
				<div class="col-md-4 text-center">
					<a href="./salespage.php">
						<figure class="figure util-ipn">
						  <img src="./img/sell.svg" class="figure-img img-fluid rounded" alt="An icon of a dollar sign inside a circle.">
						  <figcaption class="figure-caption">Check your sales</figcaption>
						</figure>
					</a>
				</div>
				<?php
					endif;
				?>
				<div class="col-md-4 text-center">
					<a href="">
						<figure class="figure util-ipn">
						  <img src="./img/dfp.png" class="figure-img img-fluid rounded" alt="The logo of Google's DoubleClik for Publishers platform">
						  <figcaption class="figure-caption">See your DFP settings</figcaption>
						</figure>
					</a>
				</div>
				<div class="col-md-4 text-center">
					<a href="./reportspage.php">
						<figure class="figure util-ipn">
						  <img src="./img/report.svg" class="figure-img img-fluid rounded" alt="An icon of a pie chart">
						  <figcaption class="figure-caption">See your account statistics.</figcaption>
						</figure>
					</a>
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