<?php
	
	include_once 'db_connection.php';

	class Rol_Pri extends IpnConnection{

		private $roleId;
		private $priviledgeId;

		//Getters & Setters

		public function getRoleId()
		{
			return $this->roleId;
		}

		public function setRoleId($roleId)
		{
			$this->roleId = $roleId;
		}

		public function getPriviledgeId()
		{
			return $this->priviledgeId;
		}

		public function setPriviledgeId($priviledgeId)
		{
			$this->priviledgeId = $priviledgeId;
		}

		//

		public function getRelationByIds($roleId, $priviledgeId)
		{
			
		}

		public function updateRelationRolPri()
		{

		}

		public function deleteRelationRolPri()
		{
			
		}

	}

?>