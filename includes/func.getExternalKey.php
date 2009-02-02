<?php

require_once "includes/db.php";

function getExternalKey($source, $locId){
	global $db;
	
	$result = $db->getOne("SELECT `key` FROM `externalkeys` WHERE locId = ? AND source = ?", array($locId, $source));
	
	if (PEAR::isError($result)) {
	    die($result->getMessage());
	}
	
	return $result;
}