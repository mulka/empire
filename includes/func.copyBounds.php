<?php

require_once "includes/db.php";

function copyBounds($oldMapId, $newMapId){
	global $db;
	
	$result =& $db->query("REPLACE INTO `loc-mapbounds` (locId, mapId, format, bounds) SELECT locId, ?, format, bounds FROM `loc-mapbounds` WHERE mapId = ?", array($newMapId, $oldMapId));
	
	if (PEAR::isError($result)) {
	    die($result->getMessage());
	}
}

