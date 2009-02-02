<?php

require_once "includes/db.php";

function addName($locId, $name){
	global $db;
	
	$result =& $db->query("INSERT IGNORE INTO `aka` (locId, name) VALUES (?, ?)", array($locId, $name));
	
	if (PEAR::isError($result)) {
	    die($result->getMessage());
	}
	
	return;
}
