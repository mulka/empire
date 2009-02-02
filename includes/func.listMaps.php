<?php

require_once "includes/db.php";

function listMaps(){
	global $db;
	
	$result =& $db->getAll("SELECT * FROM maps");
	
	if (PEAR::isError($result)) {
	    die($result->getMessage());
	}
		
	return $result;
}