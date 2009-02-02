<?php

require_once "includes/db.php";

function listTypes(){
	global $db;
	
	 $result =& $db->getCol("SELECT DISTINCT type FROM types ORDER BY type", 0);
	
	if (PEAR::isError($result)) {
	    die($result->getMessage());
	}
		
	return $result;
}
