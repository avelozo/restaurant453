<?php
	include_once DIR_BASE . 'dataaccess/updateDA.php';

	class CheckUpdate
	{
		function checkColumn()
		{
			$updateDA = new UpdateDA();

			$table = 'role';
			$oldColumnName = 'roleDescription';

			$columns = $updateDA->getColumns($table);

			if($this->existColumn($oldColumnName, $columns))
			{
				$updateDA->removeColumn($table, $oldColumnName);
			}
		}

		function existColumn($columnName, $columns)
		{
			foreach ($columns as $column)
			{
				if($column[0] == $columnName)
					return true;
			}

			return false;
		}
	}