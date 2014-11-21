<?php

class Role
{
	public $id;
	public $name;

	function Role($id = '',
				  $name = '')
	{
		$this->id = $id;
		$this->name = $name;
	}
}