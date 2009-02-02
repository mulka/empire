<?php

require_once "includes/db.php";
require_once "includes/func.convertBoundsToMinMax.php";
require_once "includes/func.getLocationRedirect.php";
require_once "includes/func.getCustomMap.php";

function getAllLocationsWithBoundsOnMap($mapId = "gps"){
	global $db;

	if($mapId != 'gps'){
		die("getAllLocationBoundsOnMap function doesn't support non-gps maps yet");
	}
	
		$result = $db->getAll("SELECT locations.*, AsText(Envelope(bounds)) AS bounds FROM `loc-gpsbounds` NATURAL JOIN locations");
		if(DB::isError($result)){
			die($result->getMessage ());
		}

	//$map = getCustomMap($locId);
	if($result){
		foreach($result as $key => $row){
			$temp =  $row['bounds'];
			$result[$key]['bounds'] = array('bounds' => $temp);
			convertBoundsToMinMax($result[$key]['bounds']);
		}
	//}else if($map['mapId']){
	//	$result = array('miny' => -85, 'minx' => -175, 'maxy' => 85, 'maxx' => 175); 
	}
	return $result;
}
