<?php

require_once "includes/db.php";

function getChildrenLocations($locId){
	global $db;
	
	$result =& $db->getAll("SELECT locations.* FROM `in`, locations WHERE locations.locId = `in`.locA AND `in`.locB = ? ORDER BY name", array($locId));
	
	if (PEAR::isError($result)) {
	    die($result->getMessage());
	}
		
	return $result;
}