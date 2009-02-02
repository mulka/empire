<?php

require_once "includes/db.php";
require_once "includes/func.convertBoundsToMinMax.php";
require_once "includes/func.getLocationRedirect.php";
require_once "includes/func.getCustomMap.php";

function getLocationBoundsOnMap($locId, $mapId = "gps"){
	global $db;
	if($redirect = getLocationRedirect($locId)){
		$locId = $redirect;
	}
	
	if($mapId == "gps"){
		$result = $db->getRow("SELECT AsText(Envelope(bounds)) AS bounds FROM `loc-gpsbounds` WHERE locId = ?", array($locId));
		if(DB::isError($result)){
			die($result->getMessage ());
		}
	}else{
		$result = $db->getRow("SELECT *, AsText(Envelope(bounds)) AS bounds FROM `loc-mapbounds` WHERE locId = ? AND mapId = ?", array($locId, $mapId));
		if(DB::isError($result)){
			die($result->getMessage ());
		}
	}

	$map = getCustomMap($locId);
	
	if($result){
		convertBoundsToMinMax($result);
	}else if($map['mapId']){
		$result = array('miny' => -85, 'minx' => -175, 'maxy' => 85, 'maxx' => 175); 
	}
	return $result;
}
