<?php

require_once "includes/db.php";

function deleteExternalKey($source, $key, $locId){
	global $db;
	$result = $db->query("DELETE FROM `externallinks` WHERE source = ? AND `key` = ? AND locId = ?", array($source, $key, $locId));
	if(PEAR::isError($result)){
		die($result->getMessage());
	}
}
