<?php

require_once "includes/db.php";
require_once "includes/func.getExternalLinkByKey.php";

function getExternalLinks($locId){
	global $db;
	
	//TODO: figure out how to not have null or empty keys in the first place
	$result = $db->getAll("SELECT externallinks.`source`, `key` FROM `externallinks` LEFT JOIN `externalsources` ON externallinks.source = externalsources.source WHERE externallinks.locId = ? AND `externalsources`.private = 0 AND `key` IS NOT NULL AND `key` <> ''", array($locId));
	
	if (PEAR::isError($result)) {
		var_dump($result);
	    die($result->getMessage());
	}
	
	foreach($result as $index => $row){
		$externalInfo = getExternalLinkByKey($row['source'], $row['key']);
		$result[$index]['link'] = $externalInfo['link'];
		$result[$index]['name'] = $externalInfo['name'];
	}
	
	return $result;

}
