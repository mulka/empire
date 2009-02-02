<?php

require_once "includes/db.php";

function getLocationsOnMap($mapId){
	global $db;
	
	$result = $db->getAll("SELECT locations.name, `loc-mapbounds`.*, AsText(Envelope(`loc-mapbounds`.bounds)) AS bounds FROM `loc-mapbounds` NATURAL JOIN locations WHERE mapId = ?", array($mapId));
	if(DB::isError($result))
		die($result->getMessage ());
		
	foreach($result as $key => $row){
		convertBoundsToMinMax($result[$key]);
	}
	
	return $result;
}