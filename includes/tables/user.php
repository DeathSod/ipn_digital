<?php

	include_once 'db_connection.php';

	class User extends IpnConnection{

		private $name;
		private $lname;
		private $nick;
		private $pwd;
		private $typeUser;

		//Getters & Setters

		public function getName()
		{
			return $this->name;
		}

		public function setName($name)
		{
			$this->name = $name;
		}

		public function getLastName()
		{
			return $this->lname;
		}

		public function setLastName($lname)
		{
			$this->lname = $lname;
		}

		public function getNick()
		{
			return $this->nick;
		}

		public function setNick($nick)
		{
			$this->nick = $nick;
		}

		public function getPwd()
		{
			return $this->pwd;
		}

		public function setPwd($pwd)
		{
			$this->pwd = $pwd;
		}

		public function getTypeUser()
		{
			return $this->typeUser;
		}

		public function setTypeUser($typeUser)
		{
			$this->typeUser = $typeUser;
		}

		//

		//Inserta Usuario en la BBDD
		public function insertUser($name, $lname, $nick, $pwd/*, $typeUser*/)
		{
			$sql = "INSERT INTO User (US_Nick, US_Password, US_Name, US_LastName, US_FK_RO/*, US_FK_TY*/) VALUES (:Username, :Password, :firstName, :lastName, 2/*, :TypeUser*/)";

			$conn = $this->connect();
			$stmt = $conn->prepare($sql);
			$stmt->execute(['Username' => $nick, 'Password' => $pwd, 'firstName' => $name, 'lastName' => $lname/*, 'TypeUser' => $typeUser*/]);

			$this->close_connect($conn);
		}

		//Obtiene todos los usuarios de la BBDD
		public function getAllUsers()
		{
			//Preparamos la consulta
			$sql = "SELECT * FROM User;";
			//Conecta con la BBDD
			$conn = $this->connect();
			//Ejecuta el query en la BBDD y devuelve los resultados
			$stmt = $conn->prepare($sql);
			$stmt->execute();
			$users = $stmt->fetchAll();
			/*Imprime los resultados
			foreach ($users as $user) {
				echo $user->US_ID."<br>";
			}*/

			//Cierra la conexión
			$this->close_connect($conn);

			//return $users
		}

		public function getAllUsersByType($typeUser)
		{
			$sql = "SELECT * FROM User WHERE US_FK_TY = :TypeUser";

			$conn = $this->connect();
			$stmt = $conn->prepare($sql);
			$stmt->execute(['TypeUser' => $typeUser]);
			$users = $stmt->fetchAll();

			$this->close_connect($connect);

			//return $users
		}

		//** Obtener al usuario por sus atributos Unique **//

		//Obtiene un usuario por su id al ser PK
		public function getUserById($id)
		{
			$sql = "SELECT * FROM User WHERE US_ID = :Id";

			$conn = $this->connect();
			$stmt = $conn->prepare($sql);
			$stmt->execute(['Id' => $id]);
			$user = $stmt->fetch();

			$this->close_connect($conn);

			return $user;
		}

		//Obtiene un usuario por su nick al ser único
		public function getUserByUsername($nick)
		{
			$sql = "SELECT * FROM User WHERE US_Nick = :Username";

			$conn = $this->connect();
			$stmt = $conn->prepare($sql);
			$stmt->execute(['Username' => $nick]);
			$user = $stmt->fetch();

			$this->close_connect($conn);

			return $user;
		}

		//** Obtener datos específicos del usuario basado en los atributos Unique **//

		//Obtiene el Id de un usuario por su Username al ser único
		public function getIdByUsername($nick)
		{
			$sql = "SELECT US_ID FROM User WHERE US_Nick = :Username";

			$conn = $this->connect();
			$stmt = $conn->prepare($sql);
			$stmt->execute(['Username' => $nick]);
			$user = $stmt->fetch()->US_ID;

			$this->close_connect($conn);

			return $user;
		}

		//Obtiene el password de un Usuario por su Id al ser PK
		public function getPasswordById($id)
		{
			$sql = "SELECT US_Password FROM User WHERE US_ID = :Id";

			$conn = $this->connect();
			$stmt = $conn->prepare($sql);
			$stmt->execute(['Id' => $id]);
			$user = $stmt->fetch()->US_Password;

			$this->close_connect($conn);

			return $user;
		}

		//Obtiene el password de un Usuario por su Username al ser Unique
		public function getPasswordByUsername($nick)
		{
			$sql = "SELECT US_Password FROM User WHERE US_Nick = :Username";

			$conn = $this->connect();
			$stmt = $conn->prepare($sql);
			$stmt->execute(['Username' => $nick]);
			$user = $stmt->fetch();

			$this->close_connect($conn);

			return $user;
		}

		//Actualiza los datos de un usuario
		public function updateUser()
		{

		}

		//Elimina un usuario de la BBDD
		public function deleteUser()
		{

		}

	}

?>