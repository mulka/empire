<?php

require_once "includes/db.php";
require_once "includes/func.convertBoundsToMinMax.php";

function getChildrenLocationBounds($locId){
	global $db;
	
	$result =& $db->getAll("SELECT locations.locId, locations.name, AsText(Envelope(`loc-gpsbounds`.bounds)) AS bounds FROM `in`, `loc-gpsbounds` NATURAL JOIN `locations` WHERE `loc-gpsbounds`.locId = `in`.locA AND `in`.locB = ?", array($locId));
	if(DB::isError($result))
		die($result->getMessage ());
	foreach($result as $key => $row){
		convertBoundsToMinMax($result[$key]);
	}
	
	return $result;
}