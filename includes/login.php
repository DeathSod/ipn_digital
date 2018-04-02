<?php
	
	include_once './tables/user.php';
	include_once './tables/email.php';

	$user = new User();
	$email = new Email();

	//Verifica si se presionó el botón de login
	if(isset($_POST['login']))
	{
		//Obtiene los campos del login
		$userOrMail = $_POST['user'];
		$pwd = $_POST['password'];

		//Comprueba si los campos no están vacíos
		if(!empty($userOrMail) && !empty($pwd))
		{
			//Estas dos variables son para observar si el usuario o el correo existen en la BBDD
			//El primero se convierte en array para poder contar si devuelve al menos una fila debido a que es un objeto con muchos datos
			$loginUser = (array) $user->getUserByUsername($userOrMail);
			//En el segundo no es necesario ya que solo devuelve un valor
			$loginMail = $email->getUserByAddress($userOrMail);

			//En caso de que si haya colocado el username entra acá
			if(count($loginUser) > 1)
			{
				//Obtiene la contraseña del usuario basado en el username
				$loginPwd = $user->getPasswordByUsername($userOrMail);

				//Luego compara con la contraseña colocada en el form
				if($loginPwd->US_Password == $pwd)
				{
					//Redirige al inicio de sesión
					header("Location: ../mainpage.php");
				}
				else
				{
					//Debería mandar advertencia de la contraseña
					//"Contraseña incorrecta"
					//Posiblemente se pueda hacer con Session y JS
					//Eso o redirigir a otra página para hacer login, tipo FB
					header("Location: ../");
				}

			}
			//Si fue con el correo entra acá
			elseif(count($loginMail) > 0)
			{
				//Obtiene la contraseña del usuario basado en su id
				//Ya que para que un correo exista debe haber un usuario
				$loginPwd = $user->getPasswordById($loginMail->EM_FK_US);

				//Compara la contraseña del form con la obtenida
				//Este caso para cuando es un correo lo que se ingresó
				if($loginPwd == $pwd)
				{
					header("Location: ../mainpage.php");
				}
				else
				{
					//Debería mandar advertencia de la contraseña
					//"Contraseña incorrecta"
					//Posiblemente se pueda hacer con Session y JS
					//Eso o redirigir a otra página para hacer login, tipo FB
					header("Location: ../");
				}
			}
			//Si ninguna coincide no existe el usuario
			else
			{
				//Debería mandar advertencia de usuario
				//"El username o correo ingresado no existe"
				//Posiblemente se pueda hacer con Session y JS
				//Eso o redirigir a otra página para hacer login, tipo FB
				header("Location: ../");
			}
		}
	}

?>