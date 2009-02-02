<?php

require_once "includes/db.php";

function deleteLocationBoundsOnMap($locId){
	global $db;
	$result = $db->query("DELETE FROM `loc-gpsbounds` WHERE locId = ?", array($locId));
	if(PEAR::isError($result)){
		die($result->getMessage());
	}
}
