<?php

require_once "includes/db.php";
require_once "includes/func.getCustomMap.php";
require_once "includes/func.getFirstMapOfParents.php";

function getDefaultMap($locId){
	global $db;
	$result = getCustomMap($locId);
	
	//see if any of its ancestors have a custom map
        if(!$result){
                $result = getFirstMapOfParents($locId);
        }

	return $result;
}
