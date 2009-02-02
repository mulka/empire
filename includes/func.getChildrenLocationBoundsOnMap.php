<?php

require_once "includes/db.php";
require_once "includes/func.convertBoundsToMinMax.php";

function getChildrenLocationBoundsOnMap($locId, $mapId = 'gps'){
	global $db;
        if($redirect = getLocationRedirect($locId)){
                $locId = $redirect;
	}

	if($mapId == "gps"){	
		$result =& $db->getAll("SELECT locations.locId, locations.name, AsText(Envelope(`loc-gpsbounds`.bounds)) AS bounds FROM `in`, `loc-gpsbounds` NATURAL JOIN `locations` WHERE `loc-gpsbounds`.locId = `in`.locA AND `in`.locB = ?", array($locId));
		if(DB::isError($result))
			die($result->getMessage ());
	}else{
		$result =& $db->getAll("SELECT locations.locId, locations.name, AsText(Envelope(`loc-mapbounds`.bounds)) AS bounds FROM `in`, `loc-mapbounds` NATURAL JOIN `locations` WHERE `loc-mapbounds`.locId = `in`.locA AND `in`.locB = ? AND `loc-mapbounds`.mapId = ?", array($locId, $mapId));
		if(DB::isError($result))
			die($result->getMessage ());
	}

	foreach($result as $key => $row){
		convertBoundsToMinMax($result[$key]);
        }

	return $result;
}
