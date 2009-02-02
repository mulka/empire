<?php

require_once "includes/db.php";

function setLocationRedirect($fromLocId, $toLocId){
	global $db;
	
	$result =& $db->query("INSERT INTO `redirect` (fromLocId, toLocId) VALUES (?, ?) ON DUPLICATE KEY UPDATE toLocId = ?", array($fromLocId, $toLocId, $toLocId));
	
	if (PEAR::isError($result)) {
	    die($result->getMessage());
	}
	
	return;
}
