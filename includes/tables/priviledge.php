<?php

	class Priviledge extends IpnConnection{

		private $name;

		//Getters & Setters

		public function getName()
		{
			return $this->name;
		}

		public function setName($name)
		{
			$this->name = $name;
		}

		//Obtiene todos los permisos de la BBDD
		public function getAllPriviledges()
		{
			$sql = "SELECT * FROM Priviledge";

			$conn = $this->connect();
			$stmt = $conn->prepare($sql);
			$stmt->execute();

			$priviledges = $stmt->fetchAll();

			$this->close_connect($conn);

			//return $priviledges;
		}

		//Obitene el permiso por el nombre al ser Unique
		public function getPriviledgeByName($name)
		{
			$sql = "SELECT * FROM Priviledge WHERE PR_Name = :Name";

			$conn = $this->connect();
			$stmt = $conn->prepare($sql);
			$stmt->execute(['Name' => $name]);

			$priviledge = $stmt->fetch();

			$this->close_connect($conn);

			return $priviledge;
		}

		//Actualiza el permiso
		public function updatePriviledge()
		{

		}

		//Elimina el permiso
		public function deletePriviledge()
		{

		}

	}

?>