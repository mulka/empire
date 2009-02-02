<?php

require_once "includes/func.getLocationById.php";
require_once "includes/db.php";

function getExternalLinkByKey($source, $key){
	global $db;
	
	$result = $db->getRow("SELECT * FROM `externalsources` WHERE source = ?", array($source));
	
	if (PEAR::isError($result)) {
	    die($result->getMessage());
	}

	if($result['locId']){
		$result['location'] = getLocationById($result['locId']);
	}
	
	$keyString = "<key>";
	
	if(strstr($result['format'], $keyString)){
		$result['link'] = str_replace($keyString, $key, $result['format']);
	}else{
		$result['link'] = $result['format'] . $key;
	}
	
	return $result;
}
