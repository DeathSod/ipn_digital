<?php

	class Place extends IpnConnection{

		private $name;
		private $type;

		//Getters & Setters

		public function getName()
		{
			return $this->name;
		}

		public function setName($name)
		{
			$this->name = $name;
		}

		public function getTypee()
		{
			return $this->type;
		}

		public function setType($type)
		{
			$this->type = $type;
		}

		//Obtiene todos los roles de la BBDD
		
		public function getAllPlaces()
		{
			$sql = "SELECT * FROM Place ORDER BY PL_ID ASC";

			$conn = $this->connect();
			$stmt = $conn->prepare($sql);
			$stmt->execute();

			$places = $stmt->fetchAll();

			$this->close_connect($conn);

			return $places;
		}

		public function getAllCountries()
		{
			$sql = "SELECT * FROM Place WHERE PL_Type = 'Country' ORDER BY PL_ID ASC";

			$conn = $this->connect();
			$stmt = $conn->prepare($sql);
			$stmt->execute();

			$countries = $stmt->fetchAll();

			$this->close_connect($conn);

			return $countries;
		}

		//Actualiza el rol
		public function updatePlace()
		{

		}

		//Elimina el rol
		public function deletePlace()
		{

		}

	}

?>