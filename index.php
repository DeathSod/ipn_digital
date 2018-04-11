<?php
	
	session_start();

	if(isset($_SESSION['logged_uid']))
	{
		header("Location: mainpage.php");
	}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>IPN Digital | Home Page</title>
		<meta charset="utf-8">
		<!--Bootstrap CSS-->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="x-ua-compatible" content="IE=Edge">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<!-- *********** -->
		<link rel="stylesheet" href="css/stylesheet.css" type="text/css">
	</head>
	<body>
		<div class="bg-init">
			<header>
				<nav class="navbar navbar-dark bg-dark navbar-fixed-top justify-content-between">
					<a class="navbar-brand" href="#">IPN Digital</a>
					<div class="form-box">
						<ul class="login-register row">
							<form class="form-inline" action="./includes/login.php" method="POST" accept-charset="utf-8">
								<li><div class="form-check">
									<label class="form-check-label mr-2" for="rememberMe" style="color:#fff;font-family: 'GO'">Remember Me?</label>
									<input class="form-check-input" type="checkbox" id="rememberMe" value="1">
								</div></li>
								<li><input class="form-control form-control-sm" type="text" name="user" placeholder="Enter Email" required="true"></li>
								<li><input class="form-control form-control-sm" type="password" name="password" placeholder=" Enter Password" required="true"></li>
								<li><button class="btn btn-outline-light" type="submit" name="login">Log In</button></li>
							</form>
							<li><a href="./register.php"><button class="btn btn-outline-light">Register Now</button></a></li>
						</ul>
					</div>
				</nav>
			</header>
			<section class="intro text-center">
				<div>
					<img class="" src="./img/cover-image-3.jpg" alt="">
				</div>
				<h1>Buying and selling ads <br/><span>has never been easier</span></h1>
			</section>	
		</div>
		<div class="info-container">
			<section>
				<div class="info-desc">
					<hr class="hr-info col-offset-1">
					<h2 class="text-center offset-md-4 col-md-4">With us you can</h2>
				</div>
				<div class="info row justify-content-between">
					<div class="util-ipn">
						<figure class="figure">
							<img class="figure-img img-fluid rounded" src="./img/buy.svg" alt="">
							<p class="text-center"><span class="font-weight-bold">Buy</span> ads</span></p>
						</figure>
					</div>
					<div class="util-ipn">
						<figure class="figure">
							<img class="figure-img img-fluid rounded" src="./img/sell.svg" alt="">
							<p class="text-center"><span class="font-weight-bold">Sell</span> spaces</span></p>
						</figure>
					</div>
					<div class="util-ipn">
						<figure class="figure">
							<img class="figure-img img-fluid rounded" src="./img/dfp.png" alt="">
							<p class="text-center"><span class="font-weight-bold">Connect</span> to your DFP</p>
						</figure>
					</div>
					<div class="util-ipn">
						<figure class="figure">
							<img class="figure-img img-fluid rounded" src="./img/report.svg" alt="">
							<p class="text-center"><span class="font-weight-bold">Tailored</span> Reports</p>
						</figure>
					</div>
				</div>
			</section>	
		</div>
		<footer>
			<div class="footer-info">
				<div class="footer-div row text-center">
					<div class="links-container col-md-4 offset-md-2 row">
						<div class="links-section" id="items-1st">
							<p>Section 1</p>
							<hr class="footer-hr">
							<ul>
								<a href="#"><li>Link 1</li></a>
								<a href="#"><li>Link 2</li></a>
								<a href="#"><li>Link 3</li></a>
								<a href="#"><li>Link 4</li></a>
							</ul>
						</div>
						<div class="links-section">
							<p>Section 2</p>
							<hr class="footer-hr">
							<ul>
								<a href="#"><li>Link 1</li></a>
								<a href="#"><li>Link 2</li></a>
								<a href="#"><li>Link 3</li></a>
								<a href="#"><li>Link 4</li></a>
							</ul>
						</div>
						<div class="links-section" id="items-last">
							<p>Section 3</p>
							<hr class="footer-hr">
							<ul>
								<a href="#"><li>Link 1</li></a>
								<a href="#"><li>Link 2</li></a>
								<a href="#"><li>Link 3</li></a>
								<a href="#"><li>Link 4</li></a>
							</ul>
						</div>
					</div>
					<div class="offset-md-1">
						<div class="sn-container">
							<h4 class="sn-info">You can find us here</h4>
							<button class=""><i class="icon fab fa-facebook-f"></i></button>
							<button><i class="icon fab fa-instagram"></i></button>
							<button><i class="icon fab fa-twitter"></i></button>
							<button ><i class="icon fab fa-linkedin-in"></i></button>
						</div>
					</div>
				</div>
			</div>
			<div class="footer-bottom text-center">
				<p>Here goes the &copy; 2018 - IPN Digital</p>
			</div>
		</footer>
		<!-- JQuery * Popper * Bootstrap JS -->
		<script src="js/jquery-3.2.1.slim.min.js"></script>
		<script src="js/popper.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/font-awesome.js"></script>
		<!-- ****************************** -->
	</body>
</html>