<?php

require_once "includes/db.php";
require_once "includes/func.convertBoundsToMinMax.php";

function listBoundsOnMap($mapId = "gps"){
	global $db;
	
	if($mapId == "gps"){
		$result = $db->getAll("SELECT locId, name, AsText(Envelope(bounds)) AS bounds FROM `loc-gpsbounds` NATURAL JOIN locations WHERE MBRContains((SELECT bounds FROM `loc-gpsbounds` WHERE locId = 108), bounds) ORDER BY Area(bounds) DESC LIMIT 10");
		if(DB::isError($result)){
			die($result->getMessage ());
		}
	}else{
		$result = $db->getAll("SELECT *, AsText(Envelope(bounds)) AS bounds FROM `loc-mapbounds` WHERE mapId = ?", array($mapId));
		if(DB::isError($result)){
			die($result->getMessage ());
		}
	}
	if($result){
		foreach($result as $key => $row){
			convertBoundsToMinMax($result[$key]);
		}
	}
	return $result;
}
