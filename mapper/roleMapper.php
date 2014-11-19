<?php

	include_once "dataaccess/roleDA.php";
	include_once "model/model.role.php";

	class RoleMapper
	{
		private $roleDAO = null;

		function RoleMapper()
		{
			$this->roleDAO = new RoleDA();
		}

		public function getRoles()
		{
			$rolesRet = [];

			$roles = $this->roleDAO->getRoles();

			foreach ($roles as $role)
			{
				array_push($rolesRet, $this->createRole($role));
			}

			return $rolesRet;
		}

		private function createRole($role)
		{
			$rol = new Role();

			$rol->id = $role['roleId'];
			$rol->name = $role['roleName'];

			return $rol;
		}
	}