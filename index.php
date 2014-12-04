<?php
	require_once "config.php";
	include_once DIR_BASE . "checkupdate.php";

	$check = new CheckUpdate();
	$check->checkColumn();
	unset($check);

	include_once DIR_BASE . "view/header.php";
	include_once DIR_BASE . "view/footer.php";
	