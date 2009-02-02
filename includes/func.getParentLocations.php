<?php

require_once "includes/db.php";

function getParentLocations($locId){
	global $db;
	
	$result =& $db->getAll("SELECT locB FROM `in` WHERE locA = ?", array($locId));
	
	if (PEAR::isError($result)) {
	    die($result->getMessage());
	}
		
	return $result;
}