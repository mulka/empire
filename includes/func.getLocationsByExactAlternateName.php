<?php

require_once "includes/db.php";
require_once "includes/func.getLocationRedirect.php";

function getLocationsByExactAlternateName($name){
	global $db;
	$result =& $db->getAll("SELECT locId, name FROM `aka` WHERE name LIKE ? ORDER BY name", array($name));
	
	if (PEAR::isError($result)) {
	    die($result->getMessage());
	}
	return $result;
}
