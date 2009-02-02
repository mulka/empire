<?php

require_once "includes/db.php";

function moveChildrenLocations($locId1, $locId2){
	global $db;
	$result = $db->query("UPDATE `in` SET locB = ? WHERE locB = ?", array($locId2, $locId1));
	if(PEAR::isError($result)){
		die($result->getMessage());
	}
}
