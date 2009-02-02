<?php

require_once "includes/db.php";

function getNewLocations($count = 5){
	global $db;
	
	 $result =& $db->getAll("SELECT * FROM log NATURAL JOIN logcreate NATURAL JOIN locations WHERE action = 'create' ORDER BY timestamp DESC LIMIT ?", array($count));
	
	if (PEAR::isError($result)) {
	    die($result->getMessage());
	}
		
	return $result;
}
