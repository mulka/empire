<?php

require_once "includes/func.pickKey.php";
require_once "includes/db.php";


function getExternalLocIds($source, $key){
	global $db;
	$key = pickKey($source, $key);
	
	$result = $db->getAll("SELECT `locId` FROM `externallinks` WHERE `key` = ? AND source = ?", array($key, $source));
	
	if (PEAR::isError($result)) {
	    die($result->getMessage());
	}

	$locIds = array();
	foreach($result as $row){
		array_push($locIds, $row['locId']);
	}
	return $locIds;
}
