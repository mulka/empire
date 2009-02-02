<?php

require_once "includes/db.php";

function listLocationTypes(){
	global $db;
	
	$result =& $db->getAll("SELECT locations.*, types.type FROM locations LEFT JOIN types ON locations.locId = types.locId ORDER BY type, name");
	
	if (PEAR::isError($result)) {
	    die($result->getMessage());
	}
		
	return $result;
}