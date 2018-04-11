<?php

	class Role extends IpnConnection{

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

		//Obtiene todos los roles de la BBDD
		public function getAllRoles()
		{
			$sql = "SELECT * FROM Role WHERE RO_ID > 1 ORDER BY RO_ID ASC";

			$conn = $this->connect();
			$stmt = $conn->prepare($sql);
			$stmt->execute();

			$roles = $stmt->fetchAll();

			$this->close_connect($conn);

			return $roles;
		}

		//Obitene el rol por el nombre al ser Unique
		public function getRoleByName($name)
		{
			$sql = "SELECT * FROM Role WHERE RO_Name = :Name";

			$conn = $this->connect();
			$stmt = $conn->prepare($sql);
			$stmt->execute(['Name' => $name]);

			$role = $stmt->fetch();

			$this->close_connect($conn);

			return $role;
		}

		//Actualiza el rol
		public function updateRole()
		{

		}

		//Elimina el rol
		public function deleteRole()
		{

		}

	}

?>