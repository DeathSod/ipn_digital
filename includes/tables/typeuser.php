<?php

	include_once 'db_connection.php';

	class TypeUser extends IpnConnection{

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

		//

		public function getAllTypeUsers()
		{

		}

	}

?>