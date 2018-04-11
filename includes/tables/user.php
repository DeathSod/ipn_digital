<?php

	class User extends IpnConnection{

		private $name;
		private $lname;
		private $pwd;
		private $cName;
		private $website;
		private $wArea;

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

		public function getPwd()
		{
			return $this->pwd;
		}

		public function setPwd($pwd)
		{
			$this->pwd = $pwd;
		}

		public function getCoName()
		{
			return $this->cName;
		}

		public function setCoName($cName)
		{
			$this->cName = $cName;
		}

		public function getWebsite()
		{
			return $this->website;
		}

		public function setWebsite($website)
		{
			$this->website = $website;
		}

		public function getWorkArea()
		{
			return $this->wArea;
		}

		public function setWorkArea($wArea)
		{
			$this->wArea = $wArea;
		}

		//

		//Inserta Usuario en la BBDD
		public function insertUserP($name, $lname, $pwd, $role, $place)
		{
			$sql = "INSERT INTO User (US_NameContact, US_LastNameContact, US_Password, US_FK_RO, US_FK_PL) VALUES (:firstName, :lastName, :Password, :Role, :Place)";

			$conn = $this->connect();
			$stmt = $conn->prepare($sql);
			$stmt->execute(['firstName' => $name, 'lastName' => $lname, 'Password' => $pwd, 'Role' => $role, 'Place' => $place]);

			$id = $conn->lastInsertId();

			$this->close_connect($conn);

			return $id;
		}

		public function insertUserC($name, $lname, $pwd, $cName, $website, $wArea, $role, $place)
		{
			$sql = "INSERT INTO User (US_NameContact, US_LastNameContact, US_Password, USC_CompanyName, USC_Website, USC_WorkArea, US_FK_RO, US_FK_PL) VALUES (:firstName, :lastName, :Password, :Company, :Website, :Work, :Role, :Place)";

			$conn = $this->connect();
			$stmt = $conn->prepare($sql);
			$stmt->execute(['firstName' => $name, 'lastName' => $lname, 'Password' => $pwd, 'Company' => $cName, 'Website' => $website, 'Work' => $wArea, 'Role' => $role, 'Place' => $place]);

			$id = $conn->lastInsertId();

			$this->close_connect($conn);

			return $id;
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

		public function getAllUsersByRole($role)
		{
			$sql = "SELECT * FROM User WHERE US_FK_RO = :Role";

			$conn = $this->connect();
			$stmt = $conn->prepare($sql);
			$stmt->execute(['Role' => $role]);
			$users = $stmt->fetchAll();

			$this->close_connect($conn);

			return $users;
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

		//** Obtener datos específicos del usuario basado en los atributos Unique **//

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

		public function getUsersWebsite($website)
		{
			$sql = "SELECT * FROM User WHERE USC_Website = :Website";

			$conn = $this->connect();
			$stmt = $conn->prepare($sql);
			$stmt->execute(['Website' => $website]);

			$rows = $stmt->fetchColumn();

			$this->close_connect($conn);

			return $rows;
		}

		//Actualiza los datos de un usuario
		public function updateUser($id, $column, $value)
		{
			$sql = "UPDATE User SET ".$column."=:Value WHERE US_ID=:Id";

			$conn = $this->connect();
			$stmt = $conn->prepare($sql);
			$stmt->execute(['Value' => $value, 'Id' => $id]);

			$this->close_connect($conn);

		}

		//Elimina un usuario de la BBDD
		public function deleteUser($id)
		{
			$sql = "DELETE FROM User Where US_ID=:Id";

			$conn = $this->connect();
			$stmt = $conn->prepare($sql);
			$stmt->execute(['Id' => $id]);

			$this-close_connect($conn);
		}

	}

?>