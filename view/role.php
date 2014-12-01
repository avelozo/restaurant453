<?php

	require('../config.php');
	include_once DIR_BASE . "business/roleBS.php";
	include_once DIR_BASE . "model/model.role.php";

	$error = '';
	$roleBS = new RoleBS();
	
	if (isset($_POST['add']))
	{
		$role = new Role();

		$action	= 'addform';

		include 'role.form.php';
		exit();
	}

	if (isset($_GET['addform']))
	{
		$role = new Role(null,
						 $_POST['name']);

		$error = $roleBS->addRole($role);
	}

	if (isset($_POST['action']) and $_POST['action'] == 'iedit')
	{
		$role = $roleBS->getRoles($_POST['id'])[0];

		$action	= 'editform';
		
		include 'role.form.php';
		exit();
	}

	if (isset($_GET['editform']))
	{
		$role = new Role($_POST['id'],
						 $_POST['name']);

		$error = $roleBS->updateRole($role);
	}

	if (isset($_POST['action']) and $_POST['action'] == 'idelete')
	{
		$error = $roleBS->deleteRole($_POST['id']);
	}

	// Display role list
	$roles = $roleBS->getRoles();
	
	include 'role.html.php';
