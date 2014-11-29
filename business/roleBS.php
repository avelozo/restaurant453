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
			$this->roleMapper->addRole($role);
		}
		
		public function updateRole($role)
		{
			$this->roleMapper->updateRole($role);
		}
		
		public function deleteRole($id)
		{
			$this->roleMapper->deleteRole($id);
		}
		
		private function getPostData()
		{
			$role = new role();
			
			$role->id = $_POST['id'];
			$role->name = $_POST['name'];
			
			return $role;
		}
	}