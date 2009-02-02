<?php

require_once "includes/db.php";

function listOrphanLocations(){
	global $db;
	
	//may be nice to have a view here
	$result =& $db->getAll("SELECT `locations`.* FROM `locations` LEFT JOIN `in` ON `locations`.locId = `in`.locA LEFT JOIN `redirect` ON `locations`.locId = `redirect`.fromLocId WHERE `in`.locB IS NULL AND `redirect`.fromLocId IS NULL");
	
	if (PEAR::isError($result)) {
		print "<pre>";
		var_dump($result);
	    die($result->getMessage());
	}
		
	return $result;
}
