<?php

	session_start();

	if(!isset($_SESSION['logged_uid']))
	{
		header("Location: index.php");
	}

	include_once 'includes/db_connection.php';
	include_once 'includes/tables/user.php';
	include_once 'includes/tables/email.php';

	$user = new User();
	$mail = new Email();
	$uid = $_SESSION['logged_uid'];

	$user = $user->getUserById($uid);
	$mail = $mail->getEmailByUser($_SESSION['logged_uid']);

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
							<a class="nav-link text-light" href="./mainpage.php">IPN Digital</a>
						</button>
					</div>
					<div class="">
						<button class="btn btn-info p-1">
							<a class="nav-link text-light" href="./mainpage.php"><i class="fas fa-home"></i> Home</a>
						</button>
						<button class="btn btn-danger p-1">
							<a class="nav-link text-light" href="./includes/logout.php"><i class="fas fa-power-off"></i> Log out!</a>
						</button>
					</div>
				</div>
			</div>
		</div>
		<?php
			if(isset($_POST['submitName']))
			{
				if(empty($_POST['firstName']))
				{
					$message_r = "You left the name input field empty. Try again...";
				}
				else
				{
					$name = $_POST['firstName'];
					$user2 = new User();
					$user2->updateUser($uid, "US_NameContact", $name);
					$message_g = "You have successfully updated your name";
				}
			}
			elseif(isset($_POST['submitLastName']))
			{
				if(empty($_POST['lastName']))
				{
					$message_r = "You left the last name input field empty. Try again...";
				}
				else
				{
					$lname = $_POST['lastName'];
					$user2 = new User();
					$user2->updateUser($uid, "US_LastNameContact", $lname);
					$message_g = "You have successfully updated your last name";
				}
			}
			elseif(isset($_POST['submitEmail']))
			{
				if(empty($_POST['email']))
				{
					$message_r = "You left the email input field empty. Try again...";
				}
				else
				{
					$email = $_POST['email'];
					$mail2 = new Email();
					$mail2->updateEmail($uid, "EM_Address", $email);
					$message_g = "You have successfully updated your email address";	
				}
			}
			elseif(isset($_POST['submitPwd']))
			{
				if(empty($_POST['oldPassword']) || empty($_POST['newPassword']) || empty($_POST['repeatPassword']))
				{
					$message_r = "To change your password you can't leave empty fields. Try again...";
				}
				else{
					if($_POST['newPassword'] != $_POST['repeatPassword'])
					{
						$message_r = "The passwords need to match. Try again...";		
					}
					else
					{
						$pwd = password_hash($_POST['newPassword'], PASSWORD_DEFAULT, ['cost' => 12]);
						$user2 = new User();
						$user2->updateUser($uid, "US_Password", $pwd);
						$message_g = "You have successfully updated your password";
					}
				}
			}
			elseif(isset($_POST['submitDelete']))
			{
				if(empty($_POST['deleteUser']))
				{
					$message_r = "In order to delete your account you cant leave the password empty. Try again...";
				}
			}
		?>
		<div class="w-100">
			<?php
			if(isset($message_r))
			{
				echo 
				'<div class="alert alert-danger offset-md-3 col-md-6 mt-4 mb-0 text-center">
					'.$message_r.'
				</div>';
			}
			elseif(isset($message_g))
			{
				echo 
				'<div class="alert alert-success offset-md-3 col-md-6 mt-4 mb-0 text-center">
					'.$message_g.'
				</div>';
			}
			?>
		</div>
		<div>
			<div class="container my-5">
				<div class="card offset-md-2 col-md-8 px-0">
					<div class="card-header bg-light text-light">
						<ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
					      <li class="nav-item mx-1">
					        <a class="nav-link active" id="personalInfo-tab" data-toggle="tab" href="#personalInfo" role="tab" aria-controls="personalInfo" aria-selected="true">Personal Info Tab</a>
					      </li>
					      <li class="nav-item mx-1">
					        <a class="nav-link" id="dfp-tab" data-toggle="tab" href="#dfp" role="tab" aria-controls="dfp" aria-selected="false">DFP Settings Tab</a>
					      </li>
					      <li class="nav-item mx-1">
					        <a class="nav-link" id="credits-tab" data-toggle="tab" href="#credits" role="tab" aria-controls="credits" aria-selected="false">Credits Tab</a>
					      </li>
					    </ul>
					</div>
					<div class="tab-content" id="myTabContent">
						<div class="tab-pane fade show active" id="personalInfo" role="tabpanel" aria-labelledby="personalInfo-tab">
							<ul class="list-group list-group-flush">
								
								<li class="list-group-item">
									<div class="container row justify-content-around">
										<h5 class="p-3 col-md-3">First Name(s):</h5>
										<span class="p-3 col-md-6 text-center">
											<?php 
											if(isset($message_g) && isset($name))
											{
												echo $name;
											}
											elseif(isset($message_r))
											{
												echo $user->US_NameContact;
											}
											else{
												echo $user->US_NameContact;
											}
											?>
											</span>
										<button class="btn btn-primary w-25 offset-1 col-md-2" data-toggle="modal" data-target="#nameModal"><i class="fas fa-wrench"></i> Change</button>
									</div>
								</li>

								<li class="list-group-item">
									<div class="container row justify-content-around">
										<h5 class="p-3 col-md-3">Last name(s):</h5>
										<span class="p-3 col-md-6 text-center">
											<?php 
											if(isset($message_g) && isset($lname))
											{
												echo $lname;
											}
											elseif(isset($message_r))
											{
												echo $user->US_LastNameContact;
											}
											else{
												echo $user->US_LastNameContact;
											}
											?>
											</span>
										<button class="btn btn-primary w-25 offset-1 col-md-2" data-toggle="modal" data-target="#lastNameModal"><i class="fas fa-wrench"></i> Change</button>
									</div>
								</li>

								<li class="list-group-item">
									<div class="container row justify-content-around">
										<h5 class="p-3 col-md-3">Email(s):</h5>
										<span class="p-3 col-md-6 text-center">
											<?php 
											if(isset($message_g) && isset($email))
											{
												echo $email;
											}
											elseif(isset($message_r))
											{
												echo $mail->EM_Address;
											}
											else{
												echo $mail->EM_Address;
											}
											?>
										</span>
										<button class="btn btn-primary w-25 offset-1 col-md-2" data-toggle="modal" data-target="#emailModal"><i class="fas fa-wrench"></i> Change</button>
									</div>
								</li>

								<li class="list-group-item">
									<div class="container row justify-content-around">
										<h5 class="p-3 col-md-3">Password:</h5>
										<span class="p-3 col-md-6 text-center">**********</span>
										<button class="btn btn-primary w-25 offset-1 col-md-2" data-toggle="modal" data-target="#passwordModal"><i class="fas fa-wrench"></i> Change</button>
									</div>
								</li>

								<li class="list-group-item">
									<div class="container row justify-content-around">
										<h5 class="p-3 col-md-4">Delete account</h5>
										<span class="p-3 col-md-5"></span>
										<button class="btn btn-danger w-25 offset-1 col-md-2 font-weight-bold" data-toggle="modal" data-target="#deleteModal"><i class="fas fa-trash"></i> Delete</button>
									</div>
								</li>

							</ul>	
						</div>
						<div class="tab-pane fade" id="dfp" role="tabpanel" aria-labelledby="dfp-tab">
							<h1 class="mt-2 p-3 text-center">DFP Settings</h1>
						</div>
						<div class="tab-pane fade" id="credits" role="tabpanel" aria-labelledby="credits-tab">
							<h1 class="mt-2 p-3 text-center">Your Credits</h1>
						</div>
					</div>
				</div>

				<!-- MODALs -->
				<!-- First Name -->
				<div class="modal fade" id="nameModal" tabindex="-1" role="dialog" aria-labelledby="nameModalLabel" aria-hidden="true">
				  <div class="modal-dialog modal-dialog-centered" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="nameModalLabel">Update - First Name</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <form action="" method="POST">
					      <div class="modal-body container-fluid">
				        	<div class="form-group offset-md-2 col-md-8">
								<label for="inputFirstName">First Name:</label>
								<input type="text" id="inputFirstName" name="firstName" class="form-control" placeholder="<?php if(isset($message_g) &&isset($name)){echo $name;}elseif(isset($message_r)){echo $user->US_NameContact;}else{echo $user->US_NameContact;} ?>" value="<?php if(isset($message_g) && isset($name)){echo $name;}elseif(isset($message_r)){echo $user->US_NameContact;}else{echo $user->US_NameContact;} ?>">
							</div>
					      </div>
					      <div class="modal-footer">
					      	<button type="submit" name="submitName" class="btn btn-primary">Save changes</button>
					        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					      </div>
					  </form>
				    </div>
				  </div>
				</div>

				<!-- Last Name -->
				<div class="modal fade" id="lastNameModal" tabindex="-1" role="dialog" aria-labelledby="lastNameModalLabel" aria-hidden="true">
				  <div class="modal-dialog modal-dialog-centered" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="lastNameModalLabel">Update - Last Name</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <form action="" method="POST">
					      <div class="modal-body container-fluid">
				        	<div class="form-group offset-md-2 col-md-8">
								<label for="inputLastName">Last Name:</label>
								<input type="text" id="inputLastName" name="lastName" class="form-control" placeholder="<?php if(isset($message_g) &&isset($lname)){echo $lname;}elseif(isset($message_r)){echo $user->US_LastNameContact;}else{echo $user->US_LastNameContact;} ?>" value="<?php if(isset($message_g) && isset($lname)){echo $lname;}elseif(isset($message_r)){echo $user->US_LastNameContact;}else{echo $user->US_LastNameContact;} ?>">
							</div>
					      </div>
					      <div class="modal-footer">
					        <button type="submit" name="submitLastName" class="btn btn-primary">Save changes</button>
					        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					      </div>
					  </form>
				    </div>
				  </div>
				</div>

				<!-- Email -->
				<div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="emailModalLabel" aria-hidden="true">
				  <div class="modal-dialog modal-dialog-centered" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="emailModalLabel">Update - Email</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <form action="" method="POST">
					      <div class="modal-body container-fluid">
				        	<div class="form-group offset-md-2 col-md-8">
								<label for="inputEmail">Email:</label>
								<input type="text" id="inputEmail" name="email" class="form-control" placeholder="<?php if(isset($message_g) &&isset($email)){echo $email;}elseif(isset($message_r)){echo $mail->EM_Address;}else{echo $mail->EM_Address;} ?>" value="<?php if(isset($message_g) && isset($email)){echo $email;}elseif(isset($message_r)){echo $mail->EM_Address;}else{echo $mail->EM_Address;} ?>">
							</div>
					      </div>
					      <div class="modal-footer">
					        <button type="submit" name="submitEmail" class="btn btn-primary">Save changes</button>
					        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					      </div>
					  </form>
				    </div>
				  </div>
				</div>

				<!-- Password -->
				<div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel" aria-hidden="true">
				  <div class="modal-dialog modal-dialog-centered" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="passwordModalLabel">Update - Password</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <form action="" method="POST">
					      <div class="modal-body container-fluid">
				        	<div class="form-group offset-md-2 col-md-8">
								<label for="inputOldPassword">Old Password:</label>
								<input type="password" id="inputOldPassword" name="oldPassword" class="form-control" placeholder="Your old password goes here">
								<label for="inputNewPassword">New Password:</label>
								<input type="password" id="inputNewPassword" name="newPassword" class="form-control" placeholder="Your new password goes here">
								<label for="inputRepeatPassword">Repeat New Password:</label>
								<input type="password" id="inputRepeatPassword" name="repeatPassword" class="form-control" placeholder="Repeat your new password here">
							</div>
					      </div>
					      <div class="modal-footer">
					        <button type="submit" name="submitPwd" class="btn btn-primary">Save changes</button>
					        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					      </div>
					  </form>
				    </div>
				  </div>
				</div>

				<!-- Delete Account-->
				<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
				  <div class="modal-dialog modal-dialog-centered" role="document">
				    <div class="modal-content">
				      <div class="modal-header">
				        <h5 class="modal-title" id="usernameModalLabel">Delete User</h5>
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				          <span aria-hidden="true">&times;</span>
				        </button>
				      </div>
				      <form action="" method="POST">
					      <div class="modal-body container-fluid">
				        	<div class="form-group offset-md-1 col-md-10">
								<h5 class="text-center">¿Are you sure you want to delete your account?</h5>
								<hr>
								<label for="inputDeleteUser">Type your password to confirm:</label>
								<input type="text" id="inputDeleteUser" name="deleteUser" class="form-control" placeholder="Your password goes here">
							</div>
					      </div>
					      <div class="modal-footer">
					        <button type="submit" name="submitDelete" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button>
					        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					      </div>
					  </form>
				    </div>
				  </div>
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