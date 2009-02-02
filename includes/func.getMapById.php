<?php

require_once "includes/db.php";

function getMapById($mapId){
	global $db;
	
	$result = $db->getRow("SELECT * FROM maps WHERE mapId = ?", array($mapId));
	if(DB::isError($result)){
		die($result->getMessage ());
	}
	
	return $result;
}
