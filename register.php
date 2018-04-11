<?php
	
	session_start();

	if(isset($_SESSION['logged_uid']))
	{
		header("Location: mainpage.php");
	}

	include_once './includes/db_connection.php';
	include_once './includes/tables/role.php';
	include_once './includes/tables/place.php';

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
							<form class="form-inline" action="./includes/login.php" method="POST" accept-charset="utf-8">
								<li><input class="form-control form-control-sm" type="text" name="user" placeholder="Enter Email" required="true"></li>
								<li><input class="form-control form-control-sm" type="password" name="password" placeholder=" Enter Password" required="true"></li>
								<li><button class="btn btn-outline-light" type="submit" name="login">Log In</button></li>
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
					<?php 
						if(isset($_GET['register'])):
							if($_GET['register'] == "success"):?>
								<div class="alert alert-success mt-3 mx-3 mb-0 text-center">
									Se ha registrado exitosamente
								</div>
							<?php endif;
						endif;
					?>
					<h1>
						¡Welcome to IPN Digital!
					</h1>
					<p class="form-header">
						Please leave your information below and begin your journey into <span>advertising</span>
					</p>
					<form action="includes/userRegistry.php" method="POST" accept-charset="utf-8">
						<div class="form-row">
							<div class="form-group offset-md-3 col-md-6 text-center">
								<label for="inputRole">You're here as a: <span class="requiredForm">*</span></label>
								<select id="inputRole" name="role" class="form-control">
									<option <?php if(!isset($_GET['display'])){echo "selected";} ?> value="choose">Choose One...</option>
									<?php
										$role = new Role();
										$roles = $role->getAllRoles();
										foreach ($roles as $row) {
											if(isset($_GET['display']))
											{
												if($_GET['display'] == "Person")
												{
													if($_GET['display'] == $row->RO_Name)
													{
														echo '<option selected value="'.$row->RO_ID.'">'.$row->RO_Name.'</option>';	
													}
													else
													{
														echo '<option value="'.$row->RO_ID.'">'.$row->RO_Name.'</option>';
													}
												}
												elseif($_GET['display'] == "Company")
												{
													if($_GET['display'] == $row->RO_Name)
													{
														echo '<option selected value="'.$row->RO_ID.'">'.$row->RO_Name.'</option>';	
													}
													else
													{
														echo '<option value="'.$row->RO_ID.'">'.$row->RO_Name.'</option>';
													}
												}
											}
											else
											{
												echo '<option value="'.$row->RO_ID.'">'.$row->RO_Name.'</option>';	
											}
										}
									?>
								</select>
								<p class="warning-mssg">
									<?php 
										if(isset($_GET['role']))
										{
											if($_GET['role'] == "invalid")
											{
												echo "You need to select an option";
											}
											else 
											{
												echo "";
											}
										}

									?>
								</p>
							</div>
						</div>
						<hr>
						<div id="regLayout">
							<div id="personLayout">
								<div class="form-row">
									<div class="form-group col-md-5 offset-md-1">
										<label for="inputFirstName">First Name: <span class="requiredForm">*</span></label>
										<input type="text" id="inputFirstName" name="firstName" class="form-control" placeholder="Enter Your First Name">
										<p class="warning-mssg">
											<?php 
												if(isset($_GET['firstName']))
												{
													if($_GET['firstName'] == "empty")
													{
														echo "You need to fill this field";
													}
													elseif($_GET['firstName'] == "invalid")
													{
														echo "This field should only have letters";
													}
												}
												else {
													echo "";
												}
											?> 
										</p>
									</div>
									<div class="form-group col-md-5">
										<label for="inputLastName">Last Name: <span class="requiredForm">*</span></label>
										<input type="text" id="inputLastName" name="lastName" class="form-control" placeholder="Enter Your Last Name">
										<p class="warning-mssg">
											<?php 
												if(isset($_GET['lastName']))
												{
													if($_GET['lastName'] == "empty")
													{
														echo "You need to fill this field";
													}
													elseif($_GET['lastName'] == "invalid")
													{
														echo "This field should only have letters";
													}
												}
												else {
													echo "";
												}
											?> 
										</p>
									</div>
								</div>
								<div class="form-group offset-md-1 col-md-10 px-0">
									<label for="inputCountry">Country: <span class="requiredForm">*</span></label>
									<select id="inputCountry" name="country" class="form-control">
										<option selected value="choose">Choose One...</option>
										<?php
											$country = new Place();
											$countries = $country->getAllCountries();
											foreach ($countries as $row) {
												echo '<option value="'.$row->PL_ID.'">'.$row->PL_Name.'</option>';
											}
										?>
									</select>
									<p class="warning-mssg">
										<?php 
											if(isset($_GET['country']))
											{
												if($_GET['country'] == "invalid")
												{
													echo "You need to select an option";
												}
												else 
												{
													echo "";
												}
											}

										?>
									</p>
								</div>
								<div class="form-group offset-md-1 col-md-10 px-0">
									<label for="inputEmail">Email: <span class="requiredForm">*</span></label>
									<input type="text" id="inputEmail" name="email" class="form-control" placeholder="Enter Your E-mail Here">
									<?php 
										if(isset($_GET['email']))
										{
											if($_GET['email'] == "empty")
											{
												echo "<p class=\"warning-mssg\">You need to fill this field</p>";
											}
											elseif($_GET['email'] == "invalid")
											{
												echo "<p class=\"warning-mssg\">The email you submitted is invalid</p>";
											}
											elseif ($_GET['email'] == "exists") {
												echo "<p class=\"warning-mssg\">This email is already in use</p>";
											}
										}
										else {
											echo "<small id=\"emailHelp\" class=\"form-text text-muted\">We'll never share your email with anyone else.</small>";
										}
									?>
								</div>
								<div class="form-group offset-md-1 col-md-10 px-0">
									<label for="inputPassword">Password: <span class="requiredForm">*</span></label>
									<input type="password" id="inputPassword" name="pwd" class="form-control" placeholder="Insert Your Password">
									<?php
										if(isset($_GET['pwd']))
										{
											if($_GET['pwd'] == "empty")
											{
												echo "<p class=\"warning-mssg\">You need to fill this field</p>";
											}
										}
										else {
											echo "<small id=\"pwHelp\" class=\"form-text text-muted\">Be sure to store this password somewhere safe.</small>";
										}
									?> 
								</div>
								<div class="form-group offset-md-1 col-md-10 px-0">
									<label for="inputRPassword">Repeat Password: <span class="requiredForm">*</span></label>
									<input type="password" id="inputRPassword" name="repeatPwd" class="form-control" placeholder="Repeat Your Password">
									<p class="warning-mssg">
										<?php 
											if(isset($_GET['repeatPwd']))
											{
												if($_GET['repeatPwd'] == "empty")
												{
													echo "You need to fill this field";
												}
												elseif ($_GET['repeatPwd'] == "failed")
												{
													echo "Passwords don't match, try again";
												}
											}
											else {
												echo "";
											}
										?> 
									</p>
								</div>
								<div class="form-check text-center">
							      <input class="form-check-input" name="checkboxTC_P" type="checkbox" id="gridCheck">
							      <label class="form-check-label" for="gridCheck">
							        I've read the terms and conditions
							      </label>
							      <p class="warning-mssg">
										<?php 
											if(isset($_GET['termsP']))
											{
												if($_GET['termsP'] == "off")
												{
													echo "You need to check this box";
												}
												
											}
											else {
												echo "";
											}
										?> 
									</p>
							    </div>
							    <button type="submit" name="submit" class="btn btn-outline-dark offset-md-3 col-md-6">Sign in!</button>
							</div>
							<div id="companyLayout">
								<div class="form-group offset-md-1 col-md-10 px-0">
									<label for="inputCompany">Company Name: <span class="requiredForm">*</span></label>
									<input type="text" id="inputCompany" name="company" class="form-control" placeholder="Enter the name of your company here">
									<?php 
										if(isset($_GET['company']))
										{
											if($_GET['company'] == "empty")
											{
												echo "<p class=\"warning-mssg\">You need to fill this field</p>";
											}
											elseif($_GET['company'] == "invalid")
											{
												echo "<p class=\"warning-mssg\">The company name you submitted has invalid characters.</p>";
											}
											elseif ($_GET['company'] == "exists") {
												echo "<p class=\"warning-mssg\">This company is already registered</p>";
											}
										}
									?>
								</div>
								<div class="form-group offset-md-1 col-md-10 px-0">
									<label for="inputWebsite">Website: <span class="requiredForm">*</span></label>
									<input type="text" id="inputWebsite" name="website" class="form-control" placeholder="Example: https://www.ipndigital.com">
									<?php 
										if(isset($_GET['website']))
										{
											if($_GET['website'] == "empty")
											{
												echo "<p class=\"warning-mssg\">You need to fill this field</p>";
											}
											elseif($_GET['website'] == "invalid")
											{
												echo "<p class=\"warning-mssg\">The website you submitted has invalid characters</p>";
											}
											elseif ($_GET['website'] == "exists") {
												echo "<p class=\"warning-mssg\">This website is already registered by other company</p>";
											}
										}
									?>
								</div>
								<div class="form-group offset-md-1 col-md-10 px-0">
									<label for="inputWorkArea">Company's Line of Work: <span class="requiredForm">*</span></label>
									<input type="text" id="inputWorkArea" name="workArea" class="form-control" placeholder="Enter your company's line of work here">
									<?php 
										if(isset($_GET['workArea']))
										{
											if($_GET['workArea'] == "empty")
											{
												echo "<p class=\"warning-mssg\">You need to fill this field</p>";
											}
											elseif($_GET['workArea'] == "invalid")
											{
												echo "<p class=\"warning-mssg\">The line of work you submitted is invalid</p>";
											}
										}
									?>
								</div>
								<div class="form-row">
									<div class="form-group offset-md-1 col-md-5">
										<label for="inputFirstNameC">First Name: <span class="requiredForm">*</span></label>
										<input type="text" id="inputFirstNameC" name="firstNameC" class="form-control" placeholder="Enter Your First Name">
										<p class="warning-mssg">
											<?php 
												if(isset($_GET['firstNameC']))
												{
													if($_GET['firstNameC'] == "empty")
													{
														echo "You need to fill this field";
													}
													elseif($_GET['firstNameC'] == "invalid")
													{
														echo "This field should only have letters";
													}
												}
												else {
													echo "";
												}
											?> 
										</p>
									</div>
									<div class="form-group col-md-5">
										<label for="inputLastNameC">Last Name: <span class="requiredForm">*</span></label>
										<input type="text" id="inputLastNameC" name="lastNameC" class="form-control" placeholder="Enter Your Last Name">
										<p class="warning-mssg">
											<?php 
												if(isset($_GET['lastNameC']))
												{
													if($_GET['lastNameC'] == "empty")
													{
														echo "You need to fill this field";
													}
													elseif($_GET['lastNameC'] == "invalid")
													{
														echo "This field should only have letters";
													}
												}
												else {
													echo "";
												}
											?> 
										</p>
									</div>
								</div>
								<div class="form-group offset-md-1 col-md-10 px-0">
									<label for="inputCountryC">Country: <span class="requiredForm">*</span></label>
									<select id="inputCountryC" name="countryC" class="form-control">
										<option selected value="choose">Choose One...</option>
										<?php
											$country = new Place();
											$countries = $country->getAllCountries();
											foreach ($countries as $row) {
												echo '<option value="'.$row->PL_ID.'">'.$row->PL_Name.'</option>';
											}
										?>
									</select>
									<p class="warning-mssg">
										<?php 
											if(isset($_GET['countryC']))
											{
												if($_GET['countryC'] == "invalid")
												{
													echo "You need to select an option";
												}
												else 
												{
													echo "";
												}
											}

										?>
									</p>
								</div>
								<div class="form-group offset-md-1 col-md-10 px-0">
									<label for="inputEmailC">Email: <span class="requiredForm">*</span></label>
									<input type="text" id="inputEmailC" name="emailC" class="form-control" placeholder="Enter Your E-mail Here">
									<?php 
										if(isset($_GET['emailC']))
										{
											if($_GET['emailC'] == "empty")
											{
												echo "<p class=\"warning-mssg\">You need to fill this field</p>";
											}
											elseif($_GET['emailC'] == "invalid")
											{
												echo "<p class=\"warning-mssg\">The email you submitted is invalid</p>";
											}
											elseif ($_GET['emailC'] == "exists") {
												echo "<p class=\"warning-mssg\">This email is already in use</p>";
											}
										}
										else {
											echo "<small id=\"emailHelp\" class=\"form-text text-muted\">We'll never share your email with anyone else.</small>";
										}
									?>
								</div>
								<div class="form-group offset-md-1 col-md-10 px-0">
									<label for="inputPasswordC">Password: <span class="requiredForm">*</span></label>
									<input type="password" id="inputPasswordC" name="pwdC" class="form-control" placeholder="Insert Your Password">
									<?php
										if(isset($_GET['pwdC']))
										{
											if($_GET['pwdC'] == "empty")
											{
												echo "<p class=\"warning-mssg\">You need to fill this field</p>";
											}
										}
										else {
											echo "<small id=\"pwHelp\" class=\"form-text text-muted\">Be sure to store this password somewhere safe.</small>";
										}
									?> 
								</div>
								<div class="form-group offset-md-1 col-md-10 px-0">
									<label for="inputRPasswordC">Repeat Password: <span class="requiredForm">*</span></label>
									<input type="password" id="inputRPasswordC" name="repeatPwdC" class="form-control" placeholder="Repeat Your Password">
									<p class="warning-mssg">
										<?php 
											if(isset($_GET['repeatPwdC']))
											{
												if($_GET['repeatPwdC'] == "empty")
												{
													echo "You need to fill this field";
												}
												elseif ($_GET['repeatPwdC'] == "failed")
												{
													echo "Passwords don't match, try again";
												}
											}
											else {
												echo "";
											}
										?> 
									</p>
								</div>
								<div class="form-check text-center">
							      <input class="form-check-input" name="checkboxTC_C" type="checkbox" id="gridCheckC">
							      <label class="form-check-label" for="gridCheckC">
							        I've read the terms and conditions
							      </label>
							      <p class="warning-mssg">
										<?php 
											if(isset($_GET['termsC']))
											{
												if($_GET['termsC'] == "off")
												{
													echo "You need to check this box";
												}
												
											}
											else {
												echo "";
											}
										?> 
									</p>
							    </div>
							    <button type="submit" name="submitC" class="btn btn-outline-dark offset-md-3 col-md-6">Sign in!</button>
							</div>
						</div>
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