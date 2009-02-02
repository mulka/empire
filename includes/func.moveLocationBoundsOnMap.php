<?php

require_once "includes/db.php";

function moveLocationBoundsOnMap($locId1, $locId2, $mapId = 'gps'){
	global $db;
	
	if($mapId = 'gps'){
		$result = $db->query("UPDATE `loc-gpsbounds` SET locId = ? WHERE locId = ?", array($locId2, $locId1));
		if(PEAR::isError($result)){
			die($result->getMessage());
		}
	}

}
