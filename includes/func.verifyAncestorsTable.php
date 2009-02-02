<?php

require_once "includes/db.php";
require_once "includes/func.listOrphanLocations.php";
require_once "includes/func.getChildrenLocations.php";

function verifyAncestorsTable(){
	global $db;
	refreshAncestorsTable('ANCESTORS');
	//exec("mysqldump -u empire_dev -px,pZ9RENCewEQXQy empire_dev ancestors > temp/ancestors.sql");
	//exec("mysqldump -u empire_dev -px,pZ9RENCewEQXQy empire_dev ancestors > temp/ancestors.sql");
	exec("mysqldump -u root -pykywi empire ancestors > temp/ancestors.sql");
	exec("mysqldump -u root -pykywi empire ANCESTORS > temp/ancestors2.sql");
	exec("diff -i temp/ancestors.sql temp/ancestors2.sql", $output);
	if(count($output)){
		print "<pre>";
		var_dump($output);
		die();
	}
	$locations = $db->getAll("SELECT locId FROM ancestors WHERE level = ?", array($level));
	if (PEAR::isError($locations)) {
		die($locations->getMessage());
	}
}
