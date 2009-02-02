<?php

require_once "includes/db.php";

function getExternalKeys($source, $locId){
	global $db;
	
	$result = $db->getAll("SELECT `key` FROM `externallinks` WHERE locId = ? AND source = ?", array($locId, $source));
	
	if (PEAR::isError($result)) {
	    die($result->getMessage());
	}

	$keys = array();
	foreach($result as $row){
		array_push($keys, $row['key']);
	}
	
	return $keys;
}
