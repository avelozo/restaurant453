<?php

	include_once DIR_BASE . "dataaccess/roleDA.php";
	include_once DIR_BASE . "model/model.role.php";

	class RoleMapper
	{
		private $roleDAO = null;

		function RoleMapper()
		{
			$this->roleDAO = new RoleDA();
		}

		public function getRoles($id = null)
		{
			$rolesRet = [];

			$roles = $this->roleDAO->getRoles($id);

			foreach ($roles as $role)
			{
				array_push($rolesRet, $this->createRole($role));
			}

			return $rolesRet;
		}
		
		public function addRole($role)
		{
			return $this->roleDAO->addRole($role);
		}

		public function updateRole($role)
		{
			return $this->roleDAO->updateRole($role);
		}

		public function deleteRole($id)
		{
			$employees = $this->roleDAO->countEmployees($id);
			
			if ($employees > 0)
				return "Not possible to delete. The role is associated to at least 1 employee.";
		
			return $this->roleDAO->deleteRole($id);
		}

		public function createRole($role)
		{
			$rol = new Role();

			$rol->id = $role['roleId'];

			if(isset($role['roleName']))
			{
				$rol->name = $role['roleName'];
			}
			
			return $rol;
		}
	}