<?php

require_once "includes/db.php";

function getFirstExternalKey($source, $locId){
	global $db;
	
	$result = $db->getOne("SELECT `key` FROM `externallinks` WHERE locId = ? AND source = ?", array($locId, $source));
	
	if (PEAR::isError($result)) {
	    die($result->getMessage());
	}
	
	return $result;
}
