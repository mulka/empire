<?php

require_once "includes/db.php";

function getLocationById($locId){
	global $db;
	$result =& $db->getRow("SELECT * FROM locations WHERE locId = ?", array($locId));
	if (PEAR::isError($result)) {
	    die($result->getMessage());
	}
	return $result;
}
