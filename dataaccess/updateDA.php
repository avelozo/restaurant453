<?php

	include_once DIR_BASE . "dataaccess/db.inc.php";

	class UpdateDA extends BaseDB
	{
		private $conn;

		function UpdateDA()
		{
			$this->conn = parent::connectDatabase();
		}
	
		function removeColumn($table, $column)
		{
			try
			{
				$sql = 'ALTER TABLE ' . $table . ' DROP COLUMN ' . $column;

			    $prep = $this->conn->prepare($sql);
			    
			    $prep->execute();
			}
			catch (PDOException $e)
			{
			    $error = 'Error fetching columns: ' . $e->getMessage();
			    die($error);
			    exit();
			}	
		}

		function getColumns($table)
		{
			try
			{
				$sql = 'SHOW COLUMNS FROM ' . $table;

			    $prep = $this->conn->prepare($sql);
			    
			    $prep->execute();
			    return $prep->fetchAll();
			}
			catch (PDOException $e)
			{
			    $error = 'Error fetching columns: ' . $e->getMessage();
			    die($error);
			    exit();
			}	
		}
	}