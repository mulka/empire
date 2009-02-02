<?php
require_once "includes/db.php";
require_once "includes/func.convertXYToPoint.php";

function getLocationsByGps($x, $y){
	global $db;
	
	$point = convertXYToPoint($x, $y);
	$result =& $db->getAll("SELECT locations.*, AsText(bounds) FROM locations NATURAL JOIN `loc-gpsbounds` WHERE Contains(bounds, GeomFromText(?)) ORDER BY Area(bounds)", array($point));
	if(DB::isError($result)){
		die($result->getMessage ());
	}
	
	return $result;
}
