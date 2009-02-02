<?php

require_once "includes/db.php";

function getExternalLocId($source, $key){
	global $db;
	
	$result = $db->getOne("SELECT `locId` FROM `externalkeys` WHERE `key` = ? AND source = ?", array($key, $source));
	
	if (PEAR::isError($result)) {
	    die($result->getMessage());
	}
	
	return $result;
}
