<?php
	require_once "config.php";
	include_once "checkupdate.php";

	$check = new CheckUpdate();
	$check->checkColumn();
	unset($check);

	include_once DIR_BASE . "view/header.php";
	include_once DIR_BASE . "view/footer.php";
	