<?php
	
	include_once "config.inc.php";
	
	public class BaseDB
	{
		function connectDatabase()
		{
			try
			{
				global $host, $dbname, $username, $password;
				
			  	$pdo = new PDO('mysql:host=' . $host . ';dbname=' . $dbname . '', $username, $password);
			  	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			  	$pdo->exec('SET NAMES "utf8"');
			  	return $pdo;
			}
			catch (PDOException $e)
			{
			  	$error = 'Unable to connect to the database server. ' . $e->getMessage();
			  	include 'error.html.php';
			  	exit();
			}
			catch (Exception $err)
			{
				$error = 'Error. ' . $e->getMessage();
			 	include 'error.html.php';
			  	exit();
			}
		}
	}