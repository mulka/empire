<?php

require_once "includes/db.php";

function getDefaultLocationsForMap($mapId){
	global $db;
	
	$result =& $db->getAll("SELECT locations.* FROM `loc-map` NATURAL JOIN `locations` WHERE mapId = ?", array($mapId));
	
	if (PEAR::isError($result)) {
	    die($result->getMessage());
	}
		
	return $result;
}