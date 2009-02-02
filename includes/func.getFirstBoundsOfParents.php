<?php

require_once "includes/func.getFirstParentLocation.php";
require_once "includes/func.getLocationBoundsOnMap.php";

function getFirstBoundsOfParents($locId, $mapId = 'gps'){
	if(!is_numeric($mapId)) $mapId = 'gps';
	$location = getFirstParentLocation($locId);
	if(!$location) return false;
	$bounds = getLocationBoundsOnMap($location['locId'], $mapId);
	if($bounds) return array_merge($location, $bounds);
	
	return getFirstBoundsOfParents($location['locId'], $mapId);
}
