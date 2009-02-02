<?php

require_once "includes/db.php";

function matchKey($source, $key){
	global $db;
	$result = $db->getOne("SELECT COUNT(*) FROM externallinks WHERE `key` = ? AND source = ?", array($key, $source));
	if(PEAR::isError($result)){
		die($result->getMessage());
	}
	return $result;
}

function pickKey($source, $key){
	global $db;
	if($source != 'mschedule'){
		return $key;
	}else{
		$array = explode(" ", $key);
		for($i = 0; $i < count($array); $i++){
			$key = implode(" ", array_slice($array, $i));
			if(matchKey($source, $key)){
				return $key;
			}
		}
		return;
	}

}

