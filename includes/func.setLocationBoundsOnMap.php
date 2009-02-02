<?php

require_once "includes/func.getLocationBoundsOnMap.php";
require_once "includes/func.getMapById.php";
require_once "includes/func.empireLog.php";
require_once "includes/db.php";

function setLocationBoundsOnMap($locId, $bounds, $mapId = 'gps'){
	global $db;
	if(!getMapById($mapId)) $mapId = 'gps';

	$before = getLocationBoundsOnMap($locId, $mapId);
	$before = $before['bounds'];

	if($mapId == 'gps'){
		$result = $db->query("INSERT INTO `loc-gpsbounds` (locId, bounds) VALUES (?, PolygonFromText(?)) ON DUPLICATE KEY UPDATE bounds = PolygonFromText(?)", array($locId, $bounds, $bounds));
		if(DB::isError($result))
	        	die($result->getMessage ());
	}else{
		$result = $db->query("INSERT INTO `loc-mapbounds` (locId, mapId, format, bounds) VALUES (?, ?, ?, PolygonFromText(?)) ON DUPLICATE KEY UPDATE bounds = PolygonFromText(?)", array($locId, $mapId, 'gmaps', $bounds, $bounds));
		if(DB::isError($result))
	        	die($result->getMessage ());
	}

	empireLog('editmap', array('locId' => $locId, 'before' => $before, 'after' => $bounds));
}
