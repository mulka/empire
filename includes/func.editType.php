<?php

require_once "includes/db.php";

function editType($locId, $type){
	global $db;
	
	$result =& $db->query("INSERT INTO types (locId, type) VALUES (?, ?) ON DUPLICATE KEY UPDATE type = ?", array($locId, $type, $type));
	
	if (PEAR::isError($result)) {
	    die($result->getMessage());
	}

}