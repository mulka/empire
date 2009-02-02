<?php

require_once "includes/db.php";

function getFirstExternalLocId($source, $key){
	global $db;
	
	$result = $db->getOne("SELECT `locId` FROM `externallinks` WHERE `key` = ? AND source = ? LIMIT 1", array($key, $source));
	
	if (PEAR::isError($result)) {
	    die($result->getMessage());
	}
	
	return $result;
}
