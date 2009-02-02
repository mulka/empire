<?php

require_once "includes/db.php";

function attachMap($locId, $mapId){
	global $db;
	
	$result =& $db->query("REPLACE INTO `loc-map` (locId, mapId) VALUES (?, ?)", array($locId, $mapId));
	
	if (PEAR::isError($result)) {
	    die($result->getMessage());
	}
}
