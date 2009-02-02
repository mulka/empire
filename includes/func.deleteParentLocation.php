<?php

require_once "includes/db.php";

function deleteParentLocation($locId){
	global $db;
	$result = $db->query("DELETE FROM `in` WHERE locA = ?", array($locId));
	if(PEAR::isError($result)){
		die($result->getMessage());
	}
}
