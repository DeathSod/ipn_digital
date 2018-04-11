<?php

	class Email extends IpnConnection{

		private $address;
		private $userId;

		//Getters & Setters

		public function getAddress()
		{
			return $this->address;
		}

		public function setAddress($address)
		{
			$this->address = $address;
		}

		public function getUserId()
		{
			return $this->userId;
		}

		public function setUserId($userId)
		{
			$this->userId = $userId;
		}

		//

		//Inserta el correo en la BBDD
		public function insertEmail($address, $userId)
		{
			$sql = "INSERT INTO Email (EM_Address, EM_FK_US) VALUES (:Address, :User)";

			$conn = $this->connect();
			$stmt = $conn->prepare($sql);
			$stmt->execute(['Address' => $address, 'User' => $userId]);

			$this->close_connect($conn);
		}

		//Obtiene todos los correos de la BBDD
		public function getAllEmails()
		{
			//Preparamos la consulta
			$sql = "SELECT * FROM Email;";
			//Conecta con la BBDD
			$conn = $this->connect();
			//Prepara y ejecuta el query en la BBDD y devuelve los resultados
			$stmt = $conn->prepare($sql);
			$stmt->execute();
			$emails = $stmt->fetchAll();
			
			/*Imprime los resultados
			foreach ($emails as $email) {
				echo $email->EM_Address."<br>";
			}
			*/

			$this->close_connect($conn);

			//return $emails;
		}

		public function getEmailByUser($user)
		{
			$sql = "SELECT * FROM Email WHERE EM_FK_US = :User";

			$conn = $this->connect();
			$stmt = $conn->prepare($sql);
			$stmt->execute(['User' => $user]);
			$email = $stmt->fetch();

			$this->close_connect($conn);

			return $email;
		}

		public function getAllEmailsByAddress($address)
		{
			$sql = "SELECT * FROM Email WHERE EM_Address = :Address";

			$conn = $this->connect();
			$stmt = $conn->prepare($sql);
			$stmt->execute(['Address' => $address]);

			$rows = $stmt->fetchColumn();

			$this->close_connect($conn);

			return $rows;
		}

		//Obtener el Id del correo basado en la dirección
		//Se usaría principalmente para el delete
		public function getIdByAddress($address)
		{
			$sql = "SELECT EM_ID FROM Email WHERE EM_Address = :Address";

			$conn = $this->connect();
			$stmt = $conn->prepare($sql);
			$stmt->execute(['Address' => $address]);

			$emailId = $stmt->fetch()->EM_ID;

			$this->close_connect($conn);

			return $emailId;
		}

		public function getUserByAddress($address)
		{
			$sql = "SELECT EM_FK_US FROM Email WHERE EM_Address = :Address";

			$conn = $this->connect();
			$stmt = $conn->prepare($sql);
			$stmt->execute(['Address' => $address]);

			$user = $stmt->fetch();

			$this->close_connect($conn);

			return $user;
		}

		public function updateEmail($id, $column, $value)
		{
			$sql = "UPDATE Email SET ".$column."=:Value WHERE EM_FK_US=:Id";

			$conn = $this->connect();
			$stmt = $conn->prepare($sql);
			$stmt->execute(['Value' => $value, 'Id' => $id]);

			$this->close_connect($conn);
		}

		public function deleteEmail()
		{

		}

	}

?>