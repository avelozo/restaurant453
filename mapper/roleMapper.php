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

		public function addRole($role)
		{
			$this->roleDAO->addRole($role);
		}

		public function updateRole($role)
		{
			$this->roleDAO->updateRole($role);
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

		public function createRole($role)
		{
			$rol = new Role();

			$rol->id = $role['roleId'];
			$rol->name = $role['roleName'];

			return $rol;
		}
	}