<?php

	include_once 'db_connection.php';

	class Phone extends IpnConnection{

		private $extension;
		private $phone;
		private $userId;

		//Getters & Setters

		public function getExtension()
		{
			return $this->extension;
		}

		public function setExtension($extension)
		{
			$this->extension = $extension;
		}

		public function getPhone()
		{
			return $this->phone;
		}

		public function setPhone($phone)
		{
			$this->phone = $phone;
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

		public function insertPhone($extension, $phone, $userId)
		{
			$sql = "INSERT INTO Phone (PH_Extension, PH_Number, PH_FK_US) VALUES (:Extension, :Phone, :User)";

			$conn = $this->connect();
			$stmt = $conn->prepare($sql);
			$stmt->execute(['Extension' => $extension, 'Phone' => $phone, 'User' => $userId]);

			$this->close_connect($conn);
		}

		public function getAllPhones()
		{
			//Preparamos la consulta
			$sql = "SELECT * FROM Phone;";
			//Conecta con la BBDD
			$conn = $this->connect();
			//Ejecuta el query en la BBDD y devuelve los resultados
			$stmt = $conn->prepare($sql);
			$stmt->execute();
			$phones = $stmt->fetchAll();
			/*Imprime los resultados
			foreach ($phones as $phone) {
				echo $phone->PH_Number."<br>";
			}*/

			$this->close_connect($conn);

			//return $phones
		}

		public function updatePhone()
		{

		}

		public function deletePhone()
		{

		}

	}

?>