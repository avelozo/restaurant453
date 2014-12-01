<?php

	include_once DIR_BASE . "mapper/roleMapper.php";
	include_once DIR_BASE . "model/model.role.php";

	class RoleBS
	{
		private $roleMapper = null;

		function RoleBS()
		{
			$this->roleMapper = new RoleMapper();
		}

		public function getRoles($id = null)
		{
			return $this->roleMapper->getRoles($id);
		}

		public function addRole($role)
		{
			if (!$this->validateName($role->name))
				return 'Invalid name';
			
			return $this->roleMapper->addRole($role);
		}
		
		public function updateRole($role)
		{
			if (!$this->validateName($role->name))
				return 'Invalid name';

			return $this->roleMapper->updateRole($role);
		}
		
		public function deleteRole($id)
		{
			return $this->roleMapper->deleteRole($id);
		}
		
		private function validateName($name)
		{
			return (strlen($name) > 0) && (strlen($name) <= 45);
		}
	}