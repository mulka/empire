<?php

require_once "includes/db.php";

function addExternalKey($source, $key, $locId){
	global $db;
	
	$result =& $db->query("INSERT IGNORE INTO `externallinks` (source, `key`, locId) VALUES (?, ?, ?)", array($source, $key, $locId));
	
	if (PEAR::isError($result)) {
	    die($result->getMessage());
	}
}
