<?php

require_once "includes/db.php";

function getExternalUrls($locId){
	global $db;
	
	$result = $db->getCol("SELECT `url` FROM `externalurls` WHERE locId = ?", 0, array($locId));
	
	if (PEAR::isError($result)) {
		var_dump($result);
	    die($result->getMessage());
	}
	
	return $result;

}
