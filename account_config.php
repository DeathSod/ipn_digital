<?php

	session_start();

?>

<!DOCTYPE html>
<html>
	<head>
		<title>IPN Digital | Account Management</title>
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
					<div class="">
						<button class="btn btn-primary p-1">
							<a class="nav-link text-light" href="">IPN Digital</a>
						</button>
					</div>
					<div class="">
						<button class="btn btn-info p-1">
							<a class="nav-link text-light" href="./mainpage.php"><i class="fas fa-home"></i> Home</a>
						</button>
						<button class="btn btn-danger p-1">
							<a class="nav-link text-light" href=""><i class="fas fa-power-off"></i> Log out!</a>
						</button>
					</div>
				</div>
			</div>
		</div>
		<div>
			<div class="container my-5">
				<div class="card offset-md-2 col-md-8 px-0">
					<div class="card-header bg-light text-light">
						<ul class="nav nav-tabs card-header-tabs">
					      <li class="nav-item mx-1">
					        <a class="nav-link active" href="#">Personal Info Tab</a>
					      </li>
					      <li class="nav-item mx-1">
					        <a class="nav-link" href="#">DFP Settings Tab</a>
					      </li>
					      <li class="nav-item mx-1">
					        <a class="nav-link" href="#">Credits Tab</a>
					      </li>
					    </ul>
						<!--<h3 class="text-center mb-0">Your personal information</h3>-->
					</div>
					<ul class="list-group list-group-flush">
						<li class="list-group-item">
							<div class="container row justify-content-around">
								<h5 class="p-3 col-md-4">First Name(s):</h5>
								<span class="p-3 col-md-6"></span>
								<button class="btn btn-primary w-25 col-md-2 font-weight-bold"><i class="fas fa-wrench"></i> Change</button>
							</div>
						</li>
						<li class="list-group-item">
							<div class="container row justify-content-around">
								<h5 class="p-3 col-md-4">Last name(s):</h5>
								<span class="p-3 col-md-6"></span>
								<button class="btn btn-primary w-25 col-md-2 font-weight-bold"><i class="fas fa-wrench"></i> Change</button>
							</div>
						</li>
						<li class="list-group-item">
							<div class="container row justify-content-around">
								<h5 class="p-3 col-md-4">Phone:</h5>
								<span class="p-3 col-md-6"></span>
								<button class="btn btn-primary w-25 col-md-2 font-weight-bold"><i class="fas fa-wrench"></i> Change</button>
							</div>
						</li>
						<li class="list-group-item">
							<div class="container row justify-content-around">
								<h5 class="p-3 col-md-4">E-mail:</h5>
								<span class="p-3 col-md-6"></span>
								<button class="btn btn-primary w-25 col-md-2 font-weight-bold"><i class="fas fa-wrench"></i> Change</button>
							</div>
						</li>
						<li class="list-group-item">
							<div class="container row justify-content-around">
								<h5 class="p-3 col-md-4">Username:</h5>
								<span class="p-3 col-md-6"></span>
								<button class="btn btn-primary w-25 col-md-2 font-weight-bold"><i class="fas fa-wrench"></i> Change</button>
							</div>
						</li>
						<li class="list-group-item">
							<div class="container row justify-content-around">
								<h5 class="p-3 col-md-4">Password:</h5>
								<span class="p-3 col-md-6"></span>
								<button class="btn btn-primary w-25 col-md-2 font-weight-bold"><i class="fas fa-wrench"></i> Change</button>
							</div>
						</li>
						<li class="list-group-item">
							<div class="container row justify-content-around">
								<h5 class="p-3 col-md-4">Delete account</h5>
								<span class="p-3 col-md-6"></span>
								<button class="btn btn-danger w-25 col-md-2 font-weight-bold"><i class="fas fa-trash"></i> Delete</button>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- JQuery * Popper * Bootstrap JS -->
		<script src="js/jquery-3.2.1.slim.min.js"></script>
		<script src="js/popper.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/font-awesome.js"></script>
	</body>
</html>