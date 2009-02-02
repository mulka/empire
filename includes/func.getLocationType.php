<?php

require_once "includes/db.php";

function getLocationType($locId){
	global $db;
	
	$result =& $db->getOne("SELECT type FROM types WHERE locId = ?", array($locId));
	
	if (PEAR::isError($result)) {
	    die($result->getMessage());
	}
	
	return $result;
}
