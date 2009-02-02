<?php

require_once "includes/func.getLocationBoundsOnMap.php";

function getLocationCentersOnMap($locId, $mapId = "gps"){

	$bounds = getLocationBoundsOnMap($locId, $mapId);

	$x = ($bounds['maxx'] + $bounds['minx']) / 2;
	$y = ($bounds['maxy'] + $bounds['miny']) / 2;

	return array('x' => $x, 'y' => $y);
}
