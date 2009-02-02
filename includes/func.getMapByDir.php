<?php

require_once "includes/db.php";

function getMapByDir($dir){
	global $db;
	
	$result = $db->getRow("SELECT * FROM maps WHERE dir = ?", array($dir));
	if(DB::isError($result)){
		die($result->getMessage ());
	}
	
	return $result;
}
