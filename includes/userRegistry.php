<?php

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require '../vendor/autoload.php';

	if(isset($_POST['submit']))
	{
		$val = "";
		$display = "display=Person";
		if(isset($_POST['checkboxTC_P']))
		{

			include_once 'db_connection.php';
			include_once './tables/user.php';
			include_once './tables/email.php';

			//Verifica si hay algún campo vacío
			if(empty($_POST['firstName']) || empty($_POST['lastName']) ||  empty($_POST['pwd']) || empty($_POST['repeatPwd']) || empty($_POST['email']))
			{
				if(empty($_POST['firstName']))
				{
					$val .= "?firstName=empty";
				}
				if(empty($_POST['lastName']))
				{
					if(empty($val))
					{
						$val .= "?lastName=empty";
					}
					else
					{
						$val .= "&lastName=empty";
					}
				}
				if(empty($_POST['pwd']))
				{
					if(empty($val))
					{
						$val .= "?pwd=empty";
					}
					else
					{
						$val .= "&pwd=empty";
					}
				}
				if(empty($_POST['repeatPwd']))
				{
					if(empty($val))
					{
						$val .= "?repeatPwd=empty";
					}
					else
					{
						$val .= "&repeatPwd=empty";
					}
				}
				if(empty($_POST['email']))
				{
					if(empty($val))
					{
						$val .= "?email=empty";
					}
					else
					{
						$val .= "&email=empty";
					}
				}

				//Reenvía a la página de registro concatenando todos los campos vacíos para mensaje html de error en formulario
				header("Location: ../register.php" . $val ."&".$display);

			}

			else
			{
				//Valida si el nombre tiene otra cosa además de letras y espacios
				if(!preg_match("/^[a-zA-Z áéíóúÁÉÍÓÚñÑ]*$/", $_POST['firstName']) || !preg_match("/^[a-zA-Z áéíóúÁÉÍÓÚñÑ]*$/", $_POST['lastName']))
				{
					if(!preg_match("/^[a-zA-Z áéíóúÁÉÍÓÚñÑ]*$/", $_POST['firstName']))
					{
						$val .= "?firstName=invalid";
					}
					if(!preg_match("/^[a-zA-Z áéíóúÁÉÍÓÚñÑ]*$/", $_POST['lastName']))
					{
						if(empty($val))
						{
							$val .= "?lastName=invalid";
						}
						else
						{
							$val .= "&lastName=invalid";
						}
					}

					header("Location: ../register.php" . $val ."&".$display);
				}
				
				else {
					if($_POST['role'] == "choose" || $_POST['country'] == "choose")
					{
						if($_POST['role'] == "choose")
						{
							$val .= "?role=invalid";
						}
						if($_POST['country'] == "choose")
						{
							if(empty($val))
							{
								$val .= "?country=invalid";
							}
							else
							{
								$val .= "&country=invalid";
							}
						}
						
						header("Location: ../register.php" . $val ."&".$display);
					}
					else
					{
						//Revisa si el correo está correctamente estructurado
						if(filter_var(htmlspecialchars($_POST['email']), FILTER_VALIDATE_EMAIL) === FALSE)
						{
							$val .= "?email=invalid";
							header("Location: ../register.php" . $val ."&".$display);
						}

						else
						{
							//Revisa si las contraseñas coinciden
							if($_POST['pwd'] != $_POST['repeatPwd'])
							{
								//En caso de que no manda el mensaje para indicar que ese fue el caso y mostrar el mensaje de error
								header("Location: ../register.php?repeatPwd=failed"."&".$display);
							}

							else {
								
								//Crea los objetos con la clase de la tabla relacionada
								$user = new User();
								$email = new Email();

								//Verifica en la BBDD si existe el correo
								$num_rows = $email->getAllEmailsByAddress($_POST['email']);

								if($num_rows)
								{
									$val .= "?email=exists";
									header("Location: ../register.php" . $val ."&".$display);
								}
								else
								{

									//Inserta los campos del formulario como atributos de la clase User
									$user->setName($_POST['firstName']);
									$user->setLastName($_POST['lastName']);
									$user->setPwd($_POST['pwd']);

									$role = $_POST['role'];
									$place = $_POST['country'];

									//Inserta al usuario en la BBDD
									$user_ID = $user->insertUserP($user->getName(), $user->getLastName(), password_hash($user->getPwd(), PASSWORD_DEFAULT, ['cost' => 12]), $role, $place);

									//Coloca los valores en el objeto correo
									$email->setAddress($_POST['email']);
									$email->setUserId($user_ID);

									//Inserta el Email en la BBDD
									$email->insertEmail($email->getAddress(), $email->getUserId());
									/*
									$mail = new PHPMailer(true);

									try {
									    //Server settings
									    $mail->SMTPDebug = 0;                                     // Enable verbose debug output
									    $mail->isSMTP();                                          // Set mailer to use SMTP
									    $mail->Host = 'smtp.gmail.com';                           // Specify main and backup SMTP servers
									    $mail->SMTPAuth = true;                                   // Enable SMTP authentication
									    $mail->Username = 'mailtester.sw@gmail.com';                  // SMTP username
									    $mail->Password = 'ipndigital';                           // SMTP password
									    $mail->SMTPSecure = 'tls';                                // Enable TLS encryption, `ssl` also accepted
									    $mail->Port = 587;                                        // TCP port to connect to
									    $mail->CharSet = 'UTF-8';
									    $mail->SMTPOptions = array(
									                    'ssl' => array(
									                        'verify_peer' => false,
									                        'verify_peer_name' => false,
									                        'allow_self_signed' => true
									                    )
									                );

									    //Recipients
									    $mail->setFrom('mailtester.sw@gmail.com', 'IPN Digital');
									    $mail->addAddress($email->getAddress(), $user->getName().' '.$user->getLastName());     // Add a recipient
									    //$mail->addAddress($email->getAddress());                                              // Name is optional
									    
									    //Attachments
									    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
									    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

									    //Content
									    $mail->isHTML(true);                                  // Set email format to HTML
									    $mail->Subject = '[INF] Thanks for registering at IPN Digital';
									    $mail->Body    = '
									    <h1>Welcome to IPN Digital!</h1> Thanks for registering. Your username is: '.$user->getNick().'.<br>
									    You can now log in using your username or this email. Hope you enjoy of our services.
									    ';
									    $mail->AltBody = 'Welcome to IPN Digital! Thanks for registering. Your username is: '.$user->getNick().'. You can now log in using your username or this email. Hope you enjoy of our services.
									    ';

									    $mail->send();
									    echo 'Message has been sent';
									} catch (Exception $e) {
										$val .= "&mailsent=false";
									    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
									}*/

									header("Location: ../register.php?register=success&".$display);
								}
							}
						}
					}
				}
				
			}
		}
		else{
			$val .= "?termsP=off&".$display;
			header("Location: ../register.php" . $val);
		}
	}
	elseif(isset($_POST['submitC']))
	{
		$val = "";
		$display = "display=Company";
		
		if(isset($_POST['checkboxTC_C']))
		{
			include_once 'db_connection.php';
			include_once './tables/user.php';
			include_once './tables/email.php';

			//Verifica si hay algún campo vacío
			if(empty($_POST['company'] || $_POST['website'] || $_POST['workArea'] || $_POST['firstNameC']) || empty($_POST['lastNameC']) ||  empty($_POST['pwdC']) || empty($_POST['repeatPwdC']) || empty($_POST['emailC']))
			{
				if(empty($_POST['company']))
				{
					$val .= "?company=empty";
				}
				if(empty($_POST['website']))
				{
					if(empty($val))
					{
						$val .= "?website=empty";
					}
					else
					{
						$val .= "&website=empty";
					}
				}
				if(empty($_POST['workArea']))
				{
					if(empty($val))
					{
						$val .= "?workArea=empty";
					}
					else
					{
						$val .= "&workArea=empty";
					}
				}
				if(empty($_POST['firstNameC']))
				{
					if(empty($val))
					{
						$val .= "?firstNameC=empty";
					}
					else
					{
						$val .= "&firstNameC=empty";
					}
				}
				if(empty($_POST['lastNameC']))
				{
					if(empty($val))
					{
						$val .= "?lastNameC=empty";
					}
					else
					{
						$val .= "&lastNameC=empty";
					}
				}
				if(empty($_POST['pwdC']))
				{
					if(empty($val))
					{
						$val .= "?pwdC=empty";
					}
					else
					{
						$val .= "&pwdC=empty";
					}
				}
				if(empty($_POST['repeatPwdC']))
				{
					if(empty($val))
					{
						$val .= "?repeatPwdC=empty";
					}
					else
					{
						$val .= "&repeatPwdC=empty";
					}
				}
				if(empty($_POST['emailC']))
				{
					if(empty($val))
					{
						$val .= "?emailC=empty";
					}
					else
					{
						$val .= "&emailC=empty";
					}
				}

				//Reenvía a la página de registro concatenando todos los campos vacíos para mensaje html de error en formulario
				header("Location: ../register.php" . $val ."&". $display);
			}

			else
			{
				if(!preg_match("/^[a-zA-Z áéíóúÁÉÍÓÚñÑ.]*$/", $_POST['company']))
				{
					$val .= "?company=invalid";
					header("Location: ../register.php" . $val ."&". $display);
				}
				else
				{
					if(!preg_match("/^[a-zA-Z áéíóúÁÉÍÓÚñÑ]*$/", $_POST['firstNameC']) || !preg_match("/^[a-zA-Z áéíóúÁÉÍÓÚñÑ]*$/", $_POST['lastNameC']))
					{
						if(!preg_match("/^[a-zA-Z áéíóúÁÉÍÓÚñÑ]*$/", $_POST['firstNameC']))
						{
							$val .= "?firstNameC=invalid";
						}
						if(!preg_match("/^[a-zA-Z áéíóúÁÉÍÓÚñÑ]*$/", $_POST['lastNameC']))
						{
							if(empty($val))
							{
								$val .= "?lastNameC=invalid";
							}
							else
							{
								$val .= "&lastNameC=invalid";
							}
						}

						header("Location: ../register.php" . $val ."&". $display);
					}
					else{
						$url = $_POST['website'];
						$url = filter_var($url, FILTER_SANITIZE_URL);
						if(!filter_var($url, FILTER_VALIDATE_URL))
						{
							$val .= "?website=invalid";
							header("Location: ../register.php" . $val ."&". $display);
						}
						else
						{
							if(!preg_match("/^[a-zA-Z áéíóúÁÉÍÓÚñÑ]*$/", $_POST['workArea']))
							{
								$val .= "?workArea=invalid";
								header("Location: ../register.php" . $val ."&". $display);
							}
							else
							{
								if($_POST['role'] == "choose" || $_POST['countryC'] == "choose")
								{
									if($_POST['role'] == "choose")
									{
										$val .= "?role=invalid";
									}
									if($_POST['countryC'] == "choose")
									{
										if(empty($val))
										{
											$val .= "?countryC=invalid";
										}
										else
										{
											$val .= "&countryC=invalid";
										}
									}
									
									header("Location: ../register.php" . $val ."&".$display);
								}
								else
								{

									if(filter_var(htmlspecialchars($_POST['emailC']), FILTER_VALIDATE_EMAIL) === FALSE)
									{
										$val .= "?emailC=invalid";
										header("Location: ../register.php" . $val ."&".$display);
									}
									else
									{
										if($_POST['pwdC'] != $_POST['repeatPwdC'])
										{
											header("Location: ../register.php?repeatPwdC=failed"."&".$display);
										}

										else 
										{
											$user = new User();
											$email = new Email();

											$num_rows = $email->getAllEmailsByAddress($_POST['emailC']);
											$url_rows = $user->getUsersWebsite($url);

											if($num_rows || $url_rows)
											{
												if($num_rows)
												{
													$val .= "?emailC=exists";
												}
												if($url_rows)
												{
													if(empty($val))
													{
														$val .="?website=exists";
													}
													else
													{
														$val .="&website=exists";
													}
												}

												header("Location: ../register.php" . $val ."&".$display);
											}
											else
											{
												//Inserta los campos del formulario como atributos de la clase User
												$user->setName($_POST['firstNameC']);
												$user->setLastName($_POST['lastNameC']);
												$user->setPwd($_POST['pwdC']);
												$user->setCoName($_POST['company']);
												$user->setWebsite($_POST['website']);
												$user->setWorkArea($_POST['workArea']);

												$role = $_POST['role'];
												$place = $_POST['countryC'];

												//Inserta al usuario en la BBDD
												$user_ID = $user->insertUserC($user->getName(), $user->getLastName(), password_hash($user->getPwd(), PASSWORD_DEFAULT, ['cost' => 12]), $user->getCoName(), $user->getWebsite(), $user->getWorkArea(), $role, $place);

												//Coloca los valores en el objeto correo
												$email->setAddress($_POST['emailC']);
												$email->setUserId($user_ID);

												//Inserta el Email en la BBDD
												$email->insertEmail($email->getAddress(), $email->getUserId());

												/*
												$mail = new PHPMailer(true);

												try {
												    //Server settings
												    $mail->SMTPDebug = 0;                                     // Enable verbose debug output
												    $mail->isSMTP();                                          // Set mailer to use SMTP
												    $mail->Host = 'smtp.gmail.com';                           // Specify main and backup SMTP servers
												    $mail->SMTPAuth = true;                                   // Enable SMTP authentication
												    $mail->Username = 'mailtester.sw@gmail.com';                  // SMTP username
												    $mail->Password = 'ipndigital';                           // SMTP password
												    $mail->SMTPSecure = 'tls';                                // Enable TLS encryption, `ssl` also accepted
												    $mail->Port = 587;                                        // TCP port to connect to
												    $mail->CharSet = 'UTF-8';
												    $mail->SMTPOptions = array(
												                    'ssl' => array(
												                        'verify_peer' => false,
												                        'verify_peer_name' => false,
												                        'allow_self_signed' => true
												                    )
												                );

												    //Recipients
												    $mail->setFrom('mailtester.sw@gmail.com', 'IPN Digital');
												    $mail->addAddress($email->getAddress(), $user->getName().' '.$user->getLastName());     // Add a recipient
												    //$mail->addAddress($email->getAddress());                                              // Name is optional
												    
												    //Attachments
												    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
												    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

												    //Content
												    $mail->isHTML(true);                                  // Set email format to HTML
												    $mail->Subject = '[INF] Thanks for registering at IPN Digital';
												    $mail->Body    = '
												    <h1>Welcome to IPN Digital!</h1> Thanks for registering. Your username is: '.$user->getNick().'.<br>
												    You can now log in using your username or this email. Hope you enjoy of our services.
												    ';
												    $mail->AltBody = 'Welcome to IPN Digital! Thanks for registering. Your username is: '.$user->getNick().'. You can now log in using your username or this email. Hope you enjoy of our services.
												    ';

												    $mail->send();
												    echo 'Message has been sent';
												} catch (Exception $e) {
													$val .= "&mailsent=false";
												    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
												}*/

												header("Location: ../register.php?register=success&".$display);
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
		else{
			$val .= "?termsC=off&".$display;
			header("Location: ../register.php" . $val);
		}

	}

?>