<?php
	
	include_once "config.inc.php";

	class BaseDB
	{
		function connectDatabase()
		{

			try
			{
				global $host, $dbname, $user, $password;
				
			  	$pdo = new PDO('mysql:host=' . $host . ';dbname=' . $dbname . '', $user, $password);
			  	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			  	$pdo->exec('SET NAMES "utf8"');
			  	return $pdo;
			}
			catch (PDOException $e)
			{
			  	$error = 'Unable to connect to the database server. ' . $e->getMessage();
			  	echo $error;
			  	//include 'error.html.php';
			  	//exit();
			}
			catch (Exception $err)
			{
				$error = 'Error. ' . $e->getMessage();
				echo $error;
			 	//include 'error.html.php';
			  //	exit();
			}
		}
	}