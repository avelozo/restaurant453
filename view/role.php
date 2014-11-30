<?php

	require('../config.php');
	include_once DIR_BASE . "business/roleBS.php";
	include_once DIR_BASE . "model/model.role.php";

	$roleBS = new RoleBS();
	
	if (isset($_POST['add']))
	{
		$role = new Role();

		$pageTitle	= 'New Role';
		$action		= 'addform';

		include 'role.form.php';
		exit();
	}

	if (isset($_GET['addform']))
	{
		$role = new Role(null,
						 $_POST['name']);

		$roleBS->addRole($role);
	
		header('Location: .');
		exit();
	}

	if (isset($_POST['action']) and $_POST['action'] == 'iedit')
	{
		$role = $roleBS->getRoles($_POST['id'])[0];

		$pageTitle	= 'Edit Role';
		$action		= 'editform';
		
		include 'role.form.php';
		exit();
	}

	if (isset($_GET['editform']))
	{
		$role = new Role($_POST['id'],
						 $_POST['name']);

		$roleBS->updateRole($role);
	
		header('Location: .');
		exit();
	}

	if (isset($_POST['action']) and $_POST['action'] == 'idelete')
	{
		$roleBS->deleteRole($_POST['id']);

		header('Location: .');
		exit();
	}

	// Display role list
	$roles = $roleBS->getRoles();
	
	include 'role.html.php';
