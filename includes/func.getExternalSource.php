<?php

require_once "includes/db.php";

function getExternalSource($source){
	global $db;
	$result =& $db->getRow("SELECT * FROM externalsources WHERE source = ?", array($source));
	if (PEAR::isError($result)) {
	    die($result->getMessage());
	}
	return $result;
}
