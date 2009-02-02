<?php

require_once "includes/db.php";
require_once "includes/func.getFirstParentLocation.php";
require_once "includes/func.getLocationBoundsOnMap.php";

function getFirstParentLocationBoundsOnMap($locId, $mapId){
	while(!$bounds){
		$location = getFirstParentLocation($locId);
		if(!$location) break;
		$locId = $location['locId'];
		$bounds = getLocationBoundsOnMap($locId, $mapId);
	}

	return $bounds;
}
