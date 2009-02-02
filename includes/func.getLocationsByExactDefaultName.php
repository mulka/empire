<?php

require_once "includes/db.php";
require_once "includes/func.getLocationRedirect.php";

function getLocationsByExactDefaultName($name){
	global $db;
	$result =& $db->getAll("SELECT locId, name FROM locations WHERE name LIKE ? AND locId NOT IN (SELECT fromLocId FROM redirect)", array($name));
	
	if (PEAR::isError($result)) {
	    die($result->getMessage());
	}
	return $result;
}
