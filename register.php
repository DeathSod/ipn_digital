<?php
	
	session_start();

?>

<!DOCTYPE html>
<html>
	<head>
		<title>IPN Digital | Register Now</title>
		<meta charset="utf-8">
		<!--Bootstrap CSS-->
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta http-equiv="x-ua-compatible" content="ie-edge">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<!-- *********** -->
		<link rel="stylesheet" href="css/stylesheet.css" type="text/css">
	</head>
	<body>
		<div>
			<header>
				<nav class="navbar navbar-dark bg-dark navbar-fixed-top justify-content-between">
					<a class="navbar-brand" href="./index.php">IPN Digital</a>
					<div class="form-box-register">
						<ul class="login-register row">
							<form class="form-inline" action="#" method="POST" accept-charset="utf-8">
								<li><input class="form-control form-control-sm" type="text" name="user" placeholder="Enter User or Email" required="true"></li>
								<li><input class="form-control form-control-sm" type="password" name="password" placeholder=" Enter Password" required="true"></li>
								<li><button class="btn btn-outline-light" type="submit">Log In</button></li>
							</form>
						</ul>
					</div>
				</nav>
			</header>
		</div>
		<div class="bg-register">
			<div class="register-section">
				<!--<hr class="hr-register">-->
				<div class="register-box">
					<h1>
						¡Welcome to IPN Digital!
					</h1>
					<p>
						Please leave your information below and begin your journey into <span>advertising</span>
					</p>
					<form action="./includes/userRegistry.php" method="POST" accept-charset="utf-8">
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="inputFirstName">First Name:</label>
								<input type="text" id="inputFirstName" name="firstName" class="form-control" placeholder="Enter Your First Name" required>
							</div>
							<div class="form-group col-md-6">
								<label for="inputLastName">Last Name:</label>
								<input type="text" id="inputLastName" name="lastName" class="form-control" placeholder="Enter Your Last Name" required>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="inputTypeUser">You're here as a:</label>
								<select id="inputTypeUser" name="typeUser" class="form-control">
									<option selected value="choose">Choose One...</option>
									<option value="person">Person</option>
									<option value="company">Company</option>
									<option value="association">Association</option>
								</select>
							</div>
							<div class="form-group col-md-6">
								<label for="inputPhone">Phone:</label>
								<input type="text" id="inputPhone" name="phone" class="form-control" placeholder="Example: +584141234567" required>
							</div>
						</div>
						<div class="form-group">
							<label for="inputEmail">Email:</label>
							<input type="email" id="inputEmail" name="email" class="form-control" placeholder="Enter Your E-mail Here" required>
							<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
						</div>
						<div class="form-group">
							<label for="inputUsername">Username:</label>
							<input type="text" id="inputUsername" name="username" class="form-control" placeholder="Enter Your Username" required>
							<small id="usernameHelp" class="form-text text-muted">This is what you'll use to log in.</small>
						</div>
						<div class="form-group">
							<label for="inputPassword">Password:</label>
							<input type="password" id="inputPassword" name="pwd" class="form-control" placeholder="Insert Your Password" required>
							<small id="pwHelp" class="form-text text-muted">Be sure to store this password somewhere safe.</small>
						</div>
						<div class="form-group">
							<label for="inputRPassword">Repeat Password:</label>
							<input type="password" id="inputRPassword" name="repeatPwd" class="form-control" placeholder="Repeat Your Password" required>
							<small id="pwdUnmachted"></small>
						</div>
						<div class="form-check text-center">
					      <input class="form-check-input" name="checkboxTC" type="checkbox" id="gridCheck" required>
					      <label class="form-check-label" for="gridCheck">
					        I've read the terms and conditions
					      </label>
					    </div>
					    <button type="submit" name="submit" class="btn btn-outline-dark offset-md-3 col-md-6">Sign in!</button>
					</form>
				</div>
			</div>
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
		<script src="js/main.js"></script>
		<!-- ****************************** -->
	</body>
</html>