<?php

require_once "includes/db.php";

function getLocationRedirect($locId){
	global $db;
	
	$result =& $db->getOne("SELECT toLocId FROM redirect WHERE fromLocId = ?", array($locId));
	
	if (PEAR::isError($result)) {
	    die($result->getMessage());
	}
	
	return $result;
}
