<?php

	include_once './tables/user.php';
	include_once './tables/email.php';
	include_once './tables/phone.php';

	$user = new User();
	$email = new Email();
	$phone = new Phone();

	if(isset($_POST['submit']))
	{
		//Inserta los campos del formulario como atributos de la clase User

		$user->setName($_POST['firstName']);
		$user->setLastName($_POST['lastName']);
		$user->setNick($_POST['username']);
		$user->setPwd($_POST['pwd']);
		//$user->setTypeUser($_POST['typeUser']);

		$repeatPwd = $_POST['repeatPwd'];

		if($user->getPwd() != $repeatPwd)
		{
			//Do nothing for now
		}
		else {
			
			//Inserta al usuario en la BBDD
			$user->insertUser($user->getName(), $user->getLastName(), $user->getNick(), $user->getPwd()/*, $user->getTypeUser()*/);

			//Obtiene el ID del usuario a través del username
			//Para crear el registro de email y teléfono
			//Y referenciar en sus claves foráneas
			$user_ID = $user->getIdByUsername($user->getNick());

			//Coloca los valores en el objeto correo
			$email->setAddress($_POST['email']);
			$email->setUserId($user_ID);

			//Inserta el Email en la BBDD
			$email->insertEmail($email->getAddress(), $email->getUserId());

			//Coloca los valores en el objeto teléfono
			$phone->setExtension("+58");
			$phone->setPhone($_POST['phone']);
			$phone->setUserId($user_ID);

			//Inserta el Teléfono en la BBDD
			$phone->insertPhone($phone->getExtension(), $phone->getPhone(), $phone->getUserId());

			header("Location: ../register.php");
		}
	}

?>