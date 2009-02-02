<?php

require_once "includes/db.php";

function getFirstParentLocation($locId){
	global $db;
	
	//TODO: may want to create a database view to deal with joining these two tables
	$result =& $db->getRow("SELECT locations.* FROM `in`, `locations` WHERE `in`.locB = `locations`.locId AND locA = ? LIMIT 1", array($locId));
	
	if (PEAR::isError($result)) {
	    die($result->getMessage());
	}
		
	return $result;
}