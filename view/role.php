<?php

	require('../config.php');
	include_once DIR_BASE . "mapper/roleMapper.php";
	include_once DIR_BASE . "model/model.role.php";

	$roleMapper = new roleMapper();
	
	if (isset($_GET['add']))
	{
		$pageTitle = 'New Role';
		$action = 'addform';
		$name = '';
		$id = '';
		$button = 'Add role';

		include 'role.form.php';
		exit();
	}

	if (isset($_GET['addform']))
	{
		$role = new Role();
		$role->name = $_POST['name'];
		$roleMapper->addRole($role);
	
		header('Location: .');
		exit();
	}

	if (isset($_POST['action']) and $_POST['action'] == 'Edit')
	{
		$role = $roleMapper->getRoles($_POST['id'])[0];

		$pageTitle = 'Edit Role';
		$action = 'editform';
		$name = $role->name;
		$id = $role->id;
		$button = 'Update role';

		include 'role.form.php';
		exit();
	}

	if (isset($_GET['editform']))
	{
		$role = new Role();
		$role->id = $_POST['id'];
		$role->name = $_POST['name'];
		$roleMapper->updateRole($role);
	
		header('Location: .');
		exit();
	}

	if (isset($_POST['action']) and $_POST['action'] == 'Delete')
	{
		$roleMapper->deleteRole($_POST['id']);

		header('Location: .');
		exit();
	}

	// Display role list
	$roles = $roleMapper->getRoles();
	
	include 'role.html.php';
