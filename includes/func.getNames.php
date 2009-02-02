<?php
require_once "includes/db.php";

function getNames($locId){
	global $db;
	
	$result =& $db->getCol("SELECT name FROM `aka` WHERE locId = ? ORDER BY name", 0, array($locId));
	
	if (PEAR::isError($result)) {
	    die($result->getMessage());
	}
	
	return $result;
}
