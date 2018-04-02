<?php

	class IpnConnection {

		private $dbServerName;
		private $dbUsername;
		private $dbPassword;
		private $dbName;
		private $dsn;

		public function __construct()
		{
			$this->dbServerName = "localhost";
			$this->dbUsername = "root";
			$this->dbPassword = "";
			$this->dbName = "dbipndigital";
			$this->dsn = "mysql:host=".$this->dbServerName.";dbname=".$this->dbName.";charset=utf8mb4";
		}

		protected function connect()
		{
			try {
				//Conecta con la BBDD
				$conn = new PDO($this->dsn, $this->dbUsername, $this->dbPassword);
				//Se fija este atributo para que pueda lanzar excepciones
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				//Devuleve los resultados de las consultas como objetos
				$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
				return $conn;
			} catch (Exception $e) {
				echo "Connection failed: " . $e->getMessage();
				return null;
			}
		}

		protected function close_connect($conn)
		{
			$conn = null;
		}

	}



?>