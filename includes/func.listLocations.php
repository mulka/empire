<?php

require_once "includes/db.php";

function listLocations(){
	global $db;
	
	 $result =& $db->getAll("SELECT * FROM locations WHERE locId NOT IN (SELECT fromLocId FROM redirect) ORDER BY name");
	
	if (PEAR::isError($result)) {
	    die($result->getMessage());
	}
		
	return $result;
}
