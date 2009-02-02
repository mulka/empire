<?php

require_once "includes/db.php";

function editExternalKey($source, $locId, $externalKey){
	global $db;
	
	$result =& $db->query("INSERT INTO `externallinks` (`locId`, `source`, `key`) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE `key` = ?", array($locId, $source, $externalKey, $externalKey));
	
	if (PEAR::isError($result)) {
	    die($result->getMessage());
	}

}
