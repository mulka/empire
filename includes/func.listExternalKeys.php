<?php

require_once "includes/db.php";

function listExternalKeys($source){
	global $db;
	
	$result =& $db->getAll("SELECT locations.*, `external`.`key` AS externalKey FROM (SELECT * FROM `externallinks` WHERE source = ?) AS external LEFT JOIN locations ON locations.locId = `external`.locId  ORDER BY `externalKey`, name", array($source));
	
	if (PEAR::isError($result)) {
		var_dump($result);
	    die($result->getMessage());
	}
		
	return $result;
}
